<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UscApproval extends Model
{
    use HasFactory;

    protected $table = 'uscapproval';

    protected $fillable = [
         
        'user_id', 
        'listings_id',
        'status',
        'rejection_reason',
    ];

    // Optionally, define relationships if needed
  

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listings_id');
    }
}
