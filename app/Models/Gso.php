<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gso extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'gso';

    protected $fillable = ['email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $primaryKey = 'id'; // Default primary key
}

