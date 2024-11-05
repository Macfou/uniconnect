<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventAttendee extends Model
{
    protected $table = 'event_attendees';

    protected $fillable = [
        'event_id', 'attendee_id', 'registered_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }

    public function event()
    {
        return $this->belongsTo(Listing::class, 'event_id');
    }
}


