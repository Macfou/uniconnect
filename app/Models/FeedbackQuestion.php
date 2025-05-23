<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackQuestion extends Model
{
    use HasFactory;

    protected $table = 'feedback_questions';

    protected $fillable = [
        'listings_id',
        'users_id',
        'q_one', 'q_two', 'q_three', 'q_four', 'q_five',
        'q_six', 'q_seven', 'q_eight', 'q_nine', 'q_ten',
        'q_eleven', 'q_twelve', 'q_thirteen', 'q_fourteen', 'q_fifteen',
        'q_sixteen', 'q_seventeen', 'q_eighteen', 'q_nineteen', 'q_twenty',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listings_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}