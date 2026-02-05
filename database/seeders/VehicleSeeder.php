<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\VehicleImage;
use App\Models\VehicleFeature;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Toyota Avanza 2024',
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'year' => 2024,
                'vehicle_type' => 'MPV',
                'transmission' => 'Manual',
                'engine_cc' => 1496,
                'fuel_type' => 'Petrol',
                'seat_capacity' => 7,
                'price_per_day' => 350000,
                'price_per_week' => 2100000,
                'price_per_month' => 7000000,
                'description' => 'Kendaraan keluarga yang nyaman dan irit bahan bakar',
                'is_available' => true,
            ],
            [
                'name' => 'Honda City 2023',
                'brand' => 'Honda',
                'model' => 'City',
                'year' => 2023,
                'vehicle_type' => 'Sedan',
                'transmission' => 'Automatic',
                'engine_cc' => 1496,
                'fuel_type' => 'Petrol',
                'seat_capacity' => 5,
                'price_per_day' => 400000,
                'price_per_week' => 2400000,
                'price_per_month' => 8000000,
                'description' => 'Sedan modern dengan transmisi otomatis',
                'is_available' => true,
            ],
            [
                'name' => 'Daihatsu Xenia 2022',
                'brand' => 'Daihatsu',
                'model' => 'Xenia',
                'year' => 2022,
                'vehicle_type' => 'MPV',
                'transmission' => 'Manual',
                'engine_cc' => 1325,
                'fuel_type' => 'Petrol',
                'seat_capacity' => 7,
                'price_per_day' => 300000,
                'price_per_week' => 1800000,
                'price_per_month' => 6000000,
                'description' => 'Mobil keluarga dengan harga terjangkau',
                'is_available' => true,
            ],
            [
                'name' => 'Toyota Rush 2024',
                'brand' => 'Toyota',
                'model' => 'Rush',
                'year' => 2024,
                'vehicle_type' => 'SUV',
                'transmission' => 'Automatic',
                'engine_cc' => 1496,
                'fuel_type' => 'Petrol',
                'seat_capacity' => 7,
                'price_per_day' => 450000,
                'price_per_week' => 2700000,
                'price_per_month' => 9000000,
                'description' => 'SUV kompak dengan gaya sporty',
                'is_available' => true,
            ],
            [
                'name' => 'Mitsubishi Pajero 2023',
                'brand' => 'Mitsubishi',
                'model' => 'Pajero',
                'year' => 2023,
                'vehicle_type' => 'SUV',
                'transmission' => 'Automatic',
                'engine_cc' => 3000,
                'fuel_type' => 'Diesel',
                'seat_capacity' => 7,
                'price_per_day' => 600000,
                'price_per_week' => 3600000,
                'price_per_month' => 12000000,
                'description' => 'SUV premium dengan performa handal',
                'is_available' => true,
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::create($vehicleData);
        }
    }
}
