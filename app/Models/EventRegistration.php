<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model {
    use HasFactory;

    protected $fillable = ['listing_id', 'email', 'full_name', 'year', 'college'];

    public function listing() {
        return $this->belongsTo(Listing::class);
    }
}

