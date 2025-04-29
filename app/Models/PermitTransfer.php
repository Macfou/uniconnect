<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitTransfer extends Model
{
    protected $table = 'permit_transfer';

protected $fillable = [
    'user_id',
    'listings_id',
    'equipment',
    'quantity',
    'image',
    'from',
    'to',
    'gso_id',
    'status',
    'date_transfer',
    'remarks',
];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function listings()
{
    return $this->belongsTo(Listing::class, 'listings_id');
}

}
