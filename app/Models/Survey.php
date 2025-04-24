<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'commentquestions';

    protected $fillable = [
        'user_id', 'listings_id', 'overall', 'venue', 'time',
        'speaker1', 'speaker2', 'speaker3', 'speaker4', 'speaker5'
    ];
}
