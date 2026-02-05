<?php

namespace Database\Seeders;

use App\Models\RentalType;
use Illuminate\Database\Seeder;

class RentalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rentalTypes = [
            [
                'name' => 'Lepas Kunci',
                'description' => 'Sewa mobil tanpa driver. Anda bebas mengendarai sendiri sesuai kenyamanan Anda.',
                'icon' => 'fa-key',
                'order' => 0,
            ],
            [
                'name' => 'Mobil + Driver',
                'description' => 'Sewa mobil lengkap dengan driver profesional dan berpengalaman untuk perjalanan Anda.',
                'icon' => 'fa-car-side',
                'order' => 1,
            ],
            [
                'name' => 'Driver Only',
                'description' => 'Butuh driver untuk mobil pribadi Anda? Kami sediakan driver profesional siap melayani.',
                'icon' => 'fa-user-tie',
                'order' => 2,
            ],
            [
                'name' => 'Antar Jemput Bandara',
                'description' => 'Layanan antar jemput bandara dengan mobil nyaman dan driver yang ramah dan tepat waktu.',
                'icon' => 'fa-plane',
                'order' => 3,
            ],
            [
                'name' => 'Wisata Tour Dalam & Luar Kota',
                'description' => 'Paket tour lengkap dengan mobil nyaman dan driver yang mengenal destinasi wisata terbaik.',
                'icon' => 'fa-map-location-dot',
                'order' => 4,
            ],
        ];

        foreach ($rentalTypes as $type) {
            RentalType::create($type);
        }
    }
}
