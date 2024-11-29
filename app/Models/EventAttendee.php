<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event()
{
    return $this->belongsTo(Listing::class, 'event_id');
}

}
