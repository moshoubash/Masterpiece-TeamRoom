<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class UserService
{
    /**
     * Upload and update user profile picture.
     */
    public function uploadProfilePicture(UploadedFile $image): string
    {
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/profile-pictures');
        $image->move($destinationPath, $name);
        return '/images/profile-pictures/' . $name;
    }

    /**
     * Get host statistics.
     */
    public function getHostStats(User $host): array
    {
        $totalBookings = 0;
        $hostRooms = $host->spaces()->count();

        $totalHostBookings = 0;

        $hostTotalBookingsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->where('spaces.host_id', $host->id)
            ->get();

        foreach ($hostTotalBookingsOnSpces as $booking) {
            $totalHostBookings += 1;
        }

        $hostProfits = 0;

        $hostProfitsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->where('spaces.host_id', $host->id)
            ->get();

        foreach ($hostProfitsOnSpces as $booking) {
            if ($booking->status == 'completed') {
                $hostProfits += $booking->host_payout;
            }
        }

        $cancelledBookings = 0;

        $cancelledBookingsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->where('spaces.host_id', $host->id)
            ->where('bookings.status', 'cancelled')
            ->get();

        foreach ($cancelledBookingsOnSpces as $booking) {
            $cancelledBookings += 1;
        }

        $pendingBookingsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->join('users', 'bookings.renter_id', '=', 'users.id')
            ->where('spaces.host_id', $host->id)
            ->where('bookings.status', 'pending')
            ->select('bookings.id as booking_id', 'spaces.*', 'bookings.*', 'users.*')
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        $mostBookedSpaces = DB::table('bookings')
            ->join('spaces', 'bookings.space_id', '=', 'spaces.id')
            ->where('spaces.host_id', $host->id)
            ->select('spaces.id', 'spaces.title', DB::raw('COUNT(bookings.id) as bookings_count'))
            ->groupBy('spaces.id', 'spaces.title')
            ->orderByDesc('bookings_count')
            ->take(3)
            ->get();

        $recentBookings = DB::table('bookings')
            ->join('spaces', 'bookings.space_id', '=', 'spaces.id')
            ->join('users', 'bookings.renter_id', '=', 'users.id')
            ->where('spaces.host_id', $host->id)
            ->select('bookings.id as booking_id', 'spaces.*', 'bookings.*', 'users.*')
            ->orderBy('bookings.created_at', 'desc')
            ->paginate(6);

        return [
            'totalBookings' => $totalBookings,
            'hostRooms' => $hostRooms,
            'totalHostBookings' => $totalHostBookings,
            'hostProfits' => $hostProfits,
            'cancelledBookings' => $cancelledBookings,
            'pendingBookingsOnSpces' => $pendingBookingsOnSpces,
            'mostBookedSpaces' => $mostBookedSpaces,
            'recentBookings' => $recentBookings,
        ];
    }
}
