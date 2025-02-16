<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GsoInventory extends Model
{
    use HasFactory;

    protected $table = 'gsocategory';

    public function category()
    {
        return $this->belongsTo(GsoCategory::class, 'category_id', 'id');
    }   
}
