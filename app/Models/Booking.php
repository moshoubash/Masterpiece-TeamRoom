<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'space_id', 'renter_id', 'start_datetime', 'end_datetime', 'num_attendees',
        'booking_purpose', 'status', 'total_price', 'service_fee', 'host_payout',
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

    public function messages()
    {
        return $this->hasMany(Message::class, 'booking_id', 'id');
    }
}