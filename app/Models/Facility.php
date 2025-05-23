<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;


    protected $table = 'facilities'; 
    
    protected $fillable = ['facility_name', 'description', 'image', 'sitting_capacity', 'classification', 'status'];
}

