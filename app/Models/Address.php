<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'type',
    ];

    // Define relationships

    /**
     * The user this address belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
