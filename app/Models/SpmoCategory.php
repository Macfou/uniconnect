<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmoCategory extends Model
{
    use HasFactory;

    protected $table = 'spmocategory'; 

    protected $fillable = ['name', 'quantity']; // Ensure this is declared only once
}
