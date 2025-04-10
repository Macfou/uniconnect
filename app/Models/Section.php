<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'section_name',
        'classification',
        'year_level',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'section', 'section_name');
    }
}

