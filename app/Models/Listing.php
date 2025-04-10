<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    

    
   
    protected $fillable = [
         'rejection_reason'
    ];



    //protected $fillable = ['title', 'tags', 'venue', 'website', 'organizations', 'email', 'description'];

    public function scopeFilter($query, array $filters) {
        if($filters['organizations'] ?? false) {
            $query->where('organizations', 'like', '%' . request('organizations') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'event_date' => 'date',
        
    ];

    

    public function eventTimings()
{
    return $this->hasMany(EventTiming::class, 'listing_id');
}

public function attendees()
{
    return $this->hasMany(EventAttendee::class, 'event_id');
}
    
public static function isFacilityBooked($venue, $date, $time)
{
    return self::where('venue', $venue)
                ->where('event_date', $date)
                ->where('event_time', $time)
                ->exists();
}

    
}
