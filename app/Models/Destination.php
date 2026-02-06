<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'fee_per_day',
        'is_active',
    ];

    protected $casts = [
        'fee_per_day' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
