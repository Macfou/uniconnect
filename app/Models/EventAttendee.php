<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'attendee_id'];

   

    public function user()
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }

    public function event()
{
    return $this->belongsTo(Listing::class, 'event_id');
}

public function feedback()
{
    return $this->hasOne(Feedback::class, 'event_id', 'event_id')
        ->where('user_id', auth()->id()); // match using user_id!
}




}
