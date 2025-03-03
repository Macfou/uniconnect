<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'background_image',
        'organization',
        'date',
        'venue',
        'signatory_one',
        'signatory_two',
        'left_logo',
        'right_logo',
        'org_creator',
    ];
    
}
