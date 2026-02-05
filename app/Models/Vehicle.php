<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'model',
        'year',
        'vehicle_type',
        'transmission',
        'engine_cc',
        'fuel_type',
        'seat_capacity',
        'price_per_day',
        'price_per_week',
        'price_per_month',
        'description',
        'image',
        'is_available',
    ];

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function features()
    {
        return $this->hasMany(VehicleFeature::class);
    }

    public function specifications()
    {
        return $this->hasMany(VehicleSpecification::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Accessor untuk mendapatkan primary image path dengan asset helper
    public function primaryImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                $primaryImage = $this->images()->where('is_primary', true)->first();
                if ($primaryImage) {
                    return asset('storage/' . $primaryImage->image_path);
                }
                return asset('/img/gambar_bg.png');
            }
        );
    }
}
