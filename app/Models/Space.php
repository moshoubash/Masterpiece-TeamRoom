<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = [
        'host_id', 'title', 'description', 'street_address', 'city',
        'postal_code', 'country', 'latitude', 'longitude', 'capacity',
        'hourly_rate', 'min_booking_duration', 'max_booking_duration', 'is_active', 'is_deleted', 'slug'
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id', 'id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'space_amenities', 'space_id', 'amenity_id');
    }

    public function images()
    {
        return $this->hasMany(SpaceImage::class, 'space_id', 'id');
    }

    public function availability()
    {
        return $this->hasMany(SpaceAvailability::class, 'space_id', 'id');
    }

    public function availabilityExceptions()
    {
        return $this->hasMany(AvailabilityException::class, 'space_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'space_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'space_id', 'id');
    }
}