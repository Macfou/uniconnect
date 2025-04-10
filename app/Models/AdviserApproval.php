<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdviserApproval extends Model
{
    use HasFactory;

    protected $table = 'adviserapproval';

    protected $fillable = [
        'adviser_id', 
        'user_id', 
        'listings_id'
    ];

    // Optionally, define relationships if needed
    public function adviser()
    {
        return $this->belongsTo(User::class, 'adviser_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listings_id');
    }
}
