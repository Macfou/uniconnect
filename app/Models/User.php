<?php

namespace App\Models;


use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',  // For admin users
        'fname',
        'lname',
        'miname',
        'org',
        'status',
        'year_level',
        'section',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    // Relationship With Listings
    public function listings() {
        return $this->hasMany(Listing::class, 'user_id');
    }

 

    // Method to get full name
    public function getFullNameAttribute()
    {
        if ($this->is_admin) {
            return $this->name;
        }
        return trim("{$this->fname} {$this->miname} {$this->lname}");
    }

    // check if admin
    public function isInAdminUsersTable()
    {
        $exists = DB::table('admin_users')->whereRaw('LOWER(email) = ?', [strtolower($this->email)])->exists();
    
        Log::info('Authenticated user:', [auth()->user()]);
        Log::info("Checking admin_users for email: {$this->email}, exists: " . ($exists ? 'true' : 'false'));
    
        return $exists; // Make sure to return the $exists value
    }

    
    
    
    
}