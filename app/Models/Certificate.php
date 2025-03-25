<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'file_path'];

    public function event()
    {
        return $this->belongsTo(Listing::class, 'event_id');
    }
}
