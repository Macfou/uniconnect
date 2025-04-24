<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Listing;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'listings_id', 'users_id',
        'q_one', 'q_two', 'q_three', 'q_four', 'q_five',
        'q_six', 'q_seven', 'q_eight', 'q_nine', 'q_ten',
        'q_eleven', 'q_twelve', 'q_thirteen', 'q_fourteen', 'q_fifteen',
        'q_sixteen', 'q_seventeen', 'q_eighteen', 'q_nineteen', 'q_twenty',
        'r_one', 'r_two', 'r_three', 'r_four', 'r_five',
        'r_six', 'r_seven', 'r_eight', 'r_nine', 'r_ten',
        'r_eleven', 'r_twelve', 'r_thirteen', 'r_fourteen', 'r_fifteen',
        'r_sixteen', 'r_seventeen', 'r_eighteen', 'r_nineteen', 'r_twenty',
    ];
    

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relationship with Listing
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listings_id');
    }
}
