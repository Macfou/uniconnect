<?php
namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BringIn extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'bring_in'; // Ensure the table name is correct

    // Mass assignable attributes
    protected $fillable = [
        'equipment',
        'quantity',
        'user_id',
        'listings_id',
        'rejection_reason',
        'status',
        'image',
        'date_in',
        'date_out',
    ];

    // Cast attributes to array if storing as JSON
    protected $casts = [
        'equipment' => 'array',
        'quantity' => 'array',
         // Ensure this is an array if you're storing multiple images
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
