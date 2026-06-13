<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name',
        'position',
        'phone',
        'email',
        'hire_date',
        'staff_type',
        'status',
        'remark'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}