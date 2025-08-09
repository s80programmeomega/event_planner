<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\EventType;
use App\Models\Availability;
use App\Models\Booking;
use App\Models\CalendarConnection;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone',
        'bio',
        'role',
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

    // A host can create multiple event types
    public function eventTypes()
    {
        return $this->hasMany(EventType::class);
    }

    // A host has many availability slots
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    // As a host, you have many bookings
    public function hostedBookings()
    {
        return $this->hasMany(Booking::class, 'host_id');
    }

    // As an attendee, you have many bookings
    public function attendeeBookings()
    {
        return $this->hasMany(Booking::class, 'attendee_id');
    }

    // Calendar connections (OAuth)
    public function calendarConnections()
    {
        return $this->hasMany(CalendarConnection::class);
    }
}