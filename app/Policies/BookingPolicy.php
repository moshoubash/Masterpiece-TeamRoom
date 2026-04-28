<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use App\Models\Space;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        return $user->id === $booking->renter_id || $user->id === $booking->space->host_id || $user->hasRole('admin') || $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can create a booking.
     */
    public function create(User $user, Space $space): bool
    {
        // A host cannot book their own space
        return $user->id !== $space->host_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Booking $booking): bool
    {
        return $user->id === $booking->space->host_id || $user->hasRole('admin') || $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can manage (approve/reject/complete) the booking.
     */
    public function manage(User $user, Booking $booking): bool
    {
        return $user->id === $booking->space->host_id || $user->hasRole('admin') || $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booking $booking): bool
    {
        return $user->hasRole('admin') || $user->hasRole('superadmin');
    }
}
