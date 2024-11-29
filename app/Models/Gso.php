<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gso extends Model
{
    use Notifiable;

    protected $table = 'gso';

    protected $fillable = ['email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    // If needed, specify your custom primary key
    protected $primaryKey = 'id'; // Defaul
    
}
