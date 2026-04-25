<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    /**
     * Create a new booking.
     */
    public function createBooking(array $data): Booking
    {
        $start_datetime = date('Y-m-d H:i:s', strtotime("{$data['date']} {$data['start_time']}"));
        $end_datetime = date('Y-m-d H:i:s', strtotime("{$data['date']} {$data['end_time']}"));

        return Booking::create([
            'space_id' => $data['space_id'],
            'renter_id' => Auth::user()->id,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
            'num_attendees' => $data['num_attendees'],
            'total_price' => $data['total_price'],
            'service_fee' => $data['service_fee'],
            'host_payout' => $data['host_payout']
        ]);
    }

    /**
     * Update booking status and send notification.
     */
    public function updateBookingStatus(Booking $booking, string $status, string $notificationTitle, string $notificationMessage): void
    {
        $booking->status = $status;
        $booking->save();

        if ($notificationTitle && $notificationMessage) {
            Notification::create([
                'user_id' => $booking->renter_id,
                'title' => $notificationTitle,
                'notification_type' => 'Booking',
                'message' => $notificationMessage . ' on ' . $booking->start_datetime
            ]);
        }
    }
}
