<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ Correct import
use Illuminate\Notifications\Notifiable;

class Ufmo extends Authenticatable
{
    use Notifiable;

    protected $table = 'ufmo';

    protected $fillable = ['email', 'password']; // Adjust based on your columns

    protected $hidden = ['password'];
}
