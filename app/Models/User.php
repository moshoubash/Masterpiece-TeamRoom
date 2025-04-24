<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'phone_number',
        'profile_picture_url', 'bio', 'company_name', 'is_verified', 'is_deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function spaces()
    {
        return $this->hasMany(Space::class, 'host_id', 'id');
    }

    public function bookingsAsRenter()
    {
        return $this->hasMany(Booking::class, 'renter_id', 'id');
    }

    public function bookingsCancelled()
    {
        return $this->hasMany(Booking::class, 'cancelled_by', 'id');
    }

    public function reviewsAsReviewer()
    {
        return $this->hasMany(Review::class, 'reviewer_id', 'id');
    }

    public function reviewsAsReviewee()
    {
        return $this->hasMany(Review::class, 'reviewee_id', 'id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }
}
