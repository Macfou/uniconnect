<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAdmin extends Model
{
    use HasFactory;

    protected $table = 'event_admin';

    protected $fillable = [
        'title',
        'description',
        'venue',
        'date',
        'time',
    ];
}


