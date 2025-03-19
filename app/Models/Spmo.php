<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ Change Model to Authenticatable
use Illuminate\Notifications\Notifiable;

class Spmo extends Authenticatable
{
    use Notifiable; // Optional, if you need notifications

    protected $table = 'spmo'; // ✅ Set the table name

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed', // ✅ Ensure password hashing is applied
    ];
}
