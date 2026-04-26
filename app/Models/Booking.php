<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'space_id', 'renter_id', 'start_datetime', 'end_datetime', 'num_attendees', 
        'status', 'total_price', 'service_fee', 'host_payout',
        'cancellation_reason', 'cancelled_by'
    ];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id', 'id');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by', 'id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'booking_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'booking_id', 'id');
    }

    /**
     * Check if the booking can be refunded.
     */
    public function getCanRefundAttribute(): bool
    {
        $currentTime = \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime('+3 hours')));
        $hoursSinceBookingCreated = \Carbon\Carbon::parse($this->created_at)->diffInHours($currentTime, true);
        
        return $hoursSinceBookingCreated <= 24 && \Carbon\Carbon::parse($this->start_datetime)->isFuture();
    }
}