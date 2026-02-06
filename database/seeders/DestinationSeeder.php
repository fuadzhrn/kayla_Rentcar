<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Dalam Kota',
                'fee_per_day' => 250000,
                'is_active' => true,
            ],
            [
                'name' => 'Luar Kota',
                'fee_per_day' => 350000,
                'is_active' => true,
            ],
            [
                'name' => 'Antar Provinsi',
                'fee_per_day' => 500000,
                'is_active' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::firstOrCreate(
                ['name' => $destination['name']],
                $destination
            );
        }
    }
}
