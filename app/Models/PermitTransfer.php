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
];

}
