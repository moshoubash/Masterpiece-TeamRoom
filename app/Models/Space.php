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

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'space_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'space_id', 'id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class,'space_id', 'id');
    }

    /**
     * Scope a query to filter spaces based on request parameters.
     */
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $query->orderBy('hourly_rate', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('hourly_rate', 'desc');
                    break;
            }
        }

        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('city', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (isset($filters['capacity'])) {
            $query->where('capacity', '>=', $filters['capacity']);
        }

        if (isset($filters['date'])) {
            $selectedDay = \Carbon\Carbon::parse($filters['date'])->format('l');
            $query->whereHas('availability', function ($q) use ($selectedDay) {
                $q->where('day_of_week', $selectedDay);
            });
        }

        if (isset($filters['start_time']) && isset($filters['end_time'])) {
            $query->whereHas('availability', function ($q) use ($filters) {
                $q->where('start_time', '<=', $filters['start_time'])
                    ->where('end_time', '>=', $filters['end_time']);
            });
        }

        if (isset($filters['amenities'])) {
            foreach ($filters['amenities'] as $amenityId) {
                $query->whereHas('amenities', function ($q) use ($amenityId) {
                    $q->where('id', $amenityId);
                });
            }
        }

        if (isset($filters['location'])) {
            $query->where('city', $filters['location']);
        }

        if (isset($filters['min_price'])) {
            $query->where('hourly_rate', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('hourly_rate', '<=', $filters['max_price']);
        }

        return $query;
    }

    /**
     * Get the average rating of the space.
     */
    public function getAverageRatingAttribute(): float
    {
        return (float) ($this->reviews()->avg('rating') ?? 0.0);
    }

    /**
     * Get the total number of reviews.
     */
    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    /**
     * Check if the space is available right now.
     */
    public function getIsAvailableNowAttribute(): bool
    {
        if ($this->is_deleted) {
            return false;
        }

        $today = now()->format('l');
        $currentTime = now()->format('H:i:s');

        return $this->availability()
            ->where('day_of_week', $today)
            ->where('is_available', true)
            ->where('start_time', '<=', $currentTime)
            ->where('end_time', '>=', $currentTime)
            ->exists();
    }
}