<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'org',
        'end_date',
        'organizations_involved',
        'description',
        'user_id',
    ];

    protected $casts = [
        'organizations_involved' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
