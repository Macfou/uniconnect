<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BorrowRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id', 'equipment_id', 'quantity', 'status', 'user_id',
    ];

    // Relationship with Listing (Event)
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    // Relationship with Equipment (GSOCategory)
    public function equipment()
    {
        return $this->belongsTo(GSOCategory::class, 'equipment_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
