<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    use HasFactory;

    protected $fillable = [
        'event_type_id',
        'host_id',
        'attendee_id',
        'status',
        'start_time',
        'end_time',
        'notes',
        'timezone',
        'meeting_link'
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function attendee()
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }
}
