<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpmoBorrowRequest extends Model
{
    use HasFactory;

    protected $table = 'spmoborrow';

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
        return $this->belongsTo(SpmoCategory::class, 'equipment_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}


