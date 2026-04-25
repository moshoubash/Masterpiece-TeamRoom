<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Space;
use App\Models\Booking;
use App\Models\SpaceAvailability;
use App\Http\Requests\Payment\ProcessPaymentRequest;
use App\Http\Requests\Payment\RefundPaymentRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $space = Space::findOrFail($request->space_id);
        $bookingDay = Carbon::parse($request->date);

        // Check if the space is available on this day
        $availability = SpaceAvailability::where('space_id', $space->id)
            ->where('day_of_week', $bookingDay->format('l'))
            ->first();

        if (!$availability) {
            return back()->with('availability', 'This space is not available on the selected day.');
        }

        // Check if requested hours are within the available hours for this day
        $requestedStart = Carbon::parse($request->start_time);
        $requestedEnd = Carbon::parse($request->end_time);

        $availableStart = Carbon::parse($availability->start_time);
        $availableEnd = Carbon::parse($availability->end_time);

        if ($requestedStart->lt($availableStart) || $requestedEnd->gt($availableEnd)) {
            return back()->with('availability', 'The requested time is outside the available hours for this space on the selected day.');
        }

        // Check if the space is already booked for the requested time
        $requestedStart = Carbon::parse($request->date . ' ' . $request->start_time);
        $requestedEnd = Carbon::parse($request->date . ' ' . $request->end_time);

        $existingBooking = Booking::where('space_id', $space->id)
            ->where(function ($query) use ($requestedStart, $requestedEnd) {
                $query->where(function ($q) use ($requestedStart, $requestedEnd) {
                    $q->where('start_datetime', '<', $requestedEnd)
                        ->where('end_datetime', '>', $requestedStart);
                });
            })
            ->exists();

        if ($existingBooking) {
            return back()->with('availability', 'This space is already booked for the requested time.');
        }

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

    public function process(ProcessPaymentRequest $request, PaymentService $paymentService)
    {
        try {
            $result = $paymentService->processPayment($request->validated());

            if (isset($result['requires_action']) && $result['requires_action']) {
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $result['payment_intent_client_secret']
                ]);
            }

            return redirect()->route('bookings.confirmation', $result['booking']->id);
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

    public function refund(RefundPaymentRequest $request, Booking $booking, PaymentService $paymentService)
    {
        try {
            $paymentService->refundPayment($booking, $request->validated());

            return back()->with('success', 'Refund successful.');
        } catch (\Exception $e) {
            return back()->withErrors(['refund' => 'Refund failed: ' . $e->getMessage()]);
        }
    }
}
