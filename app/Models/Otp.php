<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'otp_code', 'expires_at'];

    public function isExpired()
    {
        return Carbon::now()->gt($this->expires_at);
    }
}


