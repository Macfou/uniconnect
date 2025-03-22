<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedSection extends Model {
    use HasFactory;

    protected $fillable = ['faculty_id', 'organization_id', 'year_level', 'section_name'];
}
