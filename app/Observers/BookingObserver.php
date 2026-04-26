<?php

namespace App\Observers;

use App\Models\Booking;
use App\Services\CreateNewActivity;
use Illuminate\Support\Facades\Auth;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        (new CreateNewActivity(
            Auth::id() ?? $booking->renter_id,
            'booking',
            'Booking Created',
            "Booking for '{$booking->space->title}' was created"
        ))->execute();
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        if ($booking->isDirty('status')) {
            $status = ucfirst($booking->status);
            (new CreateNewActivity(
                Auth::id() ?? $booking->renter_id,
                'booking',
                "Booking {$status}",
                "Booking for '{$booking->space->title}' status changed to {$booking->status}"
            ))->execute();
        }
    }
}
