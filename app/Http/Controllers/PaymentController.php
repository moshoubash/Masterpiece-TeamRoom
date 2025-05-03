<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Exception\ApiErrorException;
use Carbon\Carbon;
use App\Models\Space;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $date = $request->date;

        $start_datetime = date('Y-m-d H:i:s', strtotime("$date $start_time"));
        $end_datetime = date('Y-m-d H:i:s', strtotime("$date $end_time"));

        $request->merge([
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
        ]);

        return view('pages.payment.checkout', compact('request'));
    }

    public function process(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => intval($request->total_price * 100),
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
                'confirm' => true
            ]);

            if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $paymentIntent->client_secret
                ]);
            }

            $booking = Booking::create([
                'renter_id' => Auth::user()->id,
                'space_id' => $request->space_id,
                'date' => $request->date,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'num_attendees' => $request->num_attendees,
                'total_price' => $request->total_price,
                'host_payout' => $request->host_payout,
                'service_fee' => $request->service_fee,
                'status' => 'pending'
            ]);

            $transaction = Transaction::create([
                'transaction_type' => 'payment',
                'booking_id' => $booking->id,
                'amount' => $request->total_price,
                'payment_method' => 'stripe',
                'status' => 'completed',
                'payment_intent_id' => $paymentIntent->id
            ]);

            $space = Space::find($request->space_id);

            Notification::create([
                'notification_type' => 'booking',
                'user_id' => $space->host_id,
                'title' => 'New Booking',
                'message' => 'New booking from ' . Auth::user()->first_name . ' ' . Auth::user()->last_name
            ]);

            Activity::create([
                'user_id' => Auth::user()->id,
                'type' => 'System',
                'name' => 'Booked Space',
                'description' => 'Booked space: ' . $space->name . ' for ' . $request->date . ' from ' . $request->start_time . ' to ' . $request->end_time
            ]);

            return redirect()->route('bookings.confirmation', $booking->id);
        } catch (\Stripe\Exception\CardException $e) {
            return back()->withErrors(['card' => $e->getMessage()]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }


    public function confirmation($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('pages.payment.confirmation', compact('booking'));
    }

    public function refund(Request $request, Booking $booking)
    {
        try {
            // Find related transaction
            $transaction = Transaction::where('booking_id', $booking->id)->first();
            
            if (!$transaction) {
                return back()->withErrors(['refund' => 'Transaction not found.']);
            }

            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            // Find the payment intent ID
            $paymentIntentId = $transaction->payment_intent_id;

            $refund = \Stripe\Refund::create([
                'payment_intent' => $paymentIntentId,
            ]);

            $booking->status = 'cancelled';
            $booking->cancellation_reason = $request->input('cancellation_reason');
            $booking->cancelled_by = $request->input('cancelled_by');
            $booking->save();

            Transaction::create([
                'transaction_type' => 'refund',
                'booking_id' => $booking->id,
                'amount' => $transaction->amount,
                'payment_method' => 'stripe',
                'status' => 'failed',
                'payment_intent_id' => $transaction->payment_intent_id
            ]);

            Notification::create([
                'notification_type' => 'refund',
                'user_id' => $booking->renter_id,
                'title' => 'Refund',
                'message' => 'Your refund request has been processed.'
            ]);

            return back()->with('success', 'Refund successful.');
        } catch (\Exception $e) {
            return back()->withErrors(['refund' => 'Refund failed: ' . $e->getMessage()]);
        }
    }
}
