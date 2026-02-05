<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'order',
    ];
}
