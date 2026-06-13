<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'customer_type',
        'interested_vehicle',
        'budget',
        'preferred_payment',
        'note'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}