<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['orgNameAbbv', 'orgName', 'orgLogo'];

    public function organization()
{
    return $this->belongsTo(Organization::class, 'org', 'id');
}

}
