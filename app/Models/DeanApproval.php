<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeanApproval extends Model
{
    use HasFactory;

    protected $table = 'deanapproval';

    protected $fillable = [
        'dean_id', 
        'user_id', 
        'listings_id'
    ];

    // Optionally, define relationships if needed
    public function dean()
    {
        return $this->belongsTo(User::class, 'dean_id');
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
