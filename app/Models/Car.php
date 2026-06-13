<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'mileage',
        'engine_number',
        'frame_number',
        'transmission',
        'fuel_type',
        'body_type',
        'condition',
        'remark',
        'photo',
        'price',
        'status'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}