<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSpecification extends Model
{
    protected $fillable = [
        'vehicle_id',
        'specification_name',
        'specification_value',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
