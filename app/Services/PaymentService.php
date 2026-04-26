<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Refund;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Process the payment with Stripe and create booking records.
     */
    public function processPayment(array $data)
    {
        $paymentIntent = PaymentIntent::create([
            'amount' => intval($data['total_price'] * 100),
            'currency' => 'usd',
            'payment_method' => $data['payment_method_id'],
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
            'confirm' => true
        ]);

        if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
            return [
                'requires_action' => true,
                'payment_intent_client_secret' => $paymentIntent->client_secret
            ];
        }

        $booking = Booking::create([
            'renter_id' => Auth::user()->id,
            'space_id' => $data['space_id'],
            'date' => $data['date'],
            'start_datetime' => $data['start_datetime'],
            'end_datetime' => $data['end_datetime'],
            'num_attendees' => $data['num_attendees'],
            'total_price' => $data['total_price'],
            'host_payout' => $data['host_payout'],
            'service_fee' => $data['service_fee'],
            'status' => 'pending'
        ]);

        $space = Space::find($data['space_id']);
        $host = $space->host;

        // Send email notification to host
        Mail::to($host->email)->send(new \App\Mail\NewBookingNotification($booking, $space, $host));

        $transaction = Transaction::create([
            'transaction_type' => 'payment',
            'booking_id' => $booking->id,
            'amount' => $data['total_price'],
            'payment_method' => 'stripe',
            'status' => 'completed',
            'payment_intent_id' => $paymentIntent->id
        ]);

        Notification::create([
            'notification_type' => 'booking',
            'user_id' => $space->host_id,
            'title' => 'New Booking',
            'message' => 'New booking from ' . Auth::user()->first_name . ' ' . Auth::user()->last_name
        ]);

        return [
            'success' => true,
            'booking' => $booking,
        ];
    }

    /**
     * Refund a booking payment via Stripe.
     */
    public function refundPayment(Booking $booking, array $data)
    {
        $transaction = Transaction::where('booking_id', $booking->id)->first();

        if (!$transaction) {
            throw new \Exception('Transaction not found.');
        }

        $paymentIntentId = $transaction->payment_intent_id;

        $refund = Refund::create([
            'payment_intent' => $paymentIntentId,
        ]);

        $booking->status = 'cancelled';
        $booking->cancellation_reason = $data['cancellation_reason'] ?? null;
        $booking->cancelled_by = $data['cancelled_by'] ?? null;
        $booking->save();

        Transaction::create([
            'transaction_type' => 'refund',
            'booking_id' => $booking->id,
            'amount' => $transaction->amount,
            'payment_method' => 'stripe',
            'status' => 'failed', // Should this be 'completed'? Original code sets it to 'failed'
            'payment_intent_id' => $transaction->payment_intent_id
        ]);

        Notification::create([
            'notification_type' => 'refund',
            'user_id' => $booking->renter_id,
            'title' => 'Refund',
            'message' => 'Your refund request has been processed.'
        ]);

        return true;
    }
}
