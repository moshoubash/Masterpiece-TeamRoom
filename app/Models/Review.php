<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'booking_id', 'reviewer_id', 'reviewee_id', 'space_id', 'rating',
        'review_text', 'response_text'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id', 'id');
    }

    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee_id', 'id');
    }

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}
