<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GsoCategory extends Model
{
    use HasFactory;

    protected $table = 'gsocategory'; 

    protected $fillable = ['name', 'quantity']; // Ensure this is declared only once
}
