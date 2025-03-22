<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackRating extends Model
{
    use HasFactory;

    protected $fillable = ['feedback_id', 'listing_id', 'user_id', 'category', 'question_number', 'rating'];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
