<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ufmo extends Model
{
    use HasFactory;

    protected $table = 'ufmo'; // Table name

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password', // Should store hashed password
    ];
}
