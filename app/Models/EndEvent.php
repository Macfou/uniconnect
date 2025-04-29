<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndEvent extends Model
{
    use HasFactory;

    protected $table = 'end_event'; // Set manually because it's not plural

    protected $fillable = [
        'listings_id',
        'users_id',
        'end_event',
    ];
}
