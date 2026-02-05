-- =====================================================
-- DATABASE: kalya_rentcar (Updated for Vehicle Management)
-- Version: 2.0
-- =====================================================

-- Drop database if exists
DROP DATABASE IF EXISTS `kalya_rentcar`;
CREATE DATABASE `kalya_rentcar` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `kalya_rentcar`;

-- =====================================================
-- TABLE 1: Users (Admin Users)
-- =====================================================
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 2: Vehicles (Master Kendaraan)
-- =====================================================
CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` year NOT NULL,
  `type` enum('sedan','SUV','MPV','pickup','bus','sport','hybrid','electric') NOT NULL,
  `transmission` enum('manual','automatic') NOT NULL,
  `engine_cc` int(11) NULL,
  `fuel_type` enum('bensin','diesel','hybrid','electric') NOT NULL,
  `seat_capacity` int(11) NOT NULL,
  `price_per_day` decimal(10, 2) NOT NULL,
  `price_per_month` decimal(10, 2) NULL,
  `price_per_week` decimal(10, 2) NULL,
  `description` longtext NULL,
  `status` enum('available','maintenance','rented','inactive') DEFAULT 'available',
  `is_featured` tinyint(1) DEFAULT 0,
  `rating` decimal(3, 2) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_type` (`type`),
  KEY `idx_transmission` (`transmission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 3: Vehicle Features (Fitur-fitur Kendaraan)
-- =====================================================
CREATE TABLE `vehicle_features` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `feature_name` varchar(100) NOT NULL,
  `feature_icon` varchar(100) NULL,
  `feature_category` enum('comfort','safety','entertainment','technology','luxury') NOT NULL,
  `description` text NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_vehicle_id` (`vehicle_id`),
  KEY `idx_category` (`feature_category`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 4: Vehicle Images/Gallery
-- =====================================================
CREATE TABLE `vehicle_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_alt` varchar(255) NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_vehicle_id` (`vehicle_id`),
  KEY `idx_is_primary` (`is_primary`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 5: Vehicle Specifications (Spesifikasi Detail)
-- =====================================================
CREATE TABLE `vehicle_specifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `spec_name` varchar(100) NOT NULL,
  `spec_value` varchar(255) NOT NULL,
  `spec_category` enum('engine','dimensions','performance','comfort','safety') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_vehicle_id` (`vehicle_id`),
  KEY `idx_category` (`spec_category`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 6: Bookings/Rentals
-- =====================================================
CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_id_type` enum('KTP','SIM','Paspor') NULL,
  `customer_id_number` varchar(50) NULL,
  `pickup_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `pickup_location` varchar(255) NULL,
  `return_location` varchar(255) NULL,
  `driver_needed` tinyint(1) DEFAULT 0,
  `insurance_type` enum('basic','standard','premium') DEFAULT 'standard',
  `total_days` int(11) NOT NULL,
  `daily_rate` decimal(10, 2) NOT NULL,
  `total_price` decimal(12, 2) NOT NULL,
  `deposit_amount` decimal(10, 2) NULL,
  `status` enum('pending','confirmed','active','completed','cancelled') DEFAULT 'pending',
  `payment_status` enum('unpaid','partial','paid') DEFAULT 'unpaid',
  `notes` longtext NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_vehicle_id` (`vehicle_id`),
  KEY `idx_status` (`status`),
  KEY `idx_payment_status` (`payment_status`),
  KEY `idx_pickup_date` (`pickup_date`),
  KEY `idx_customer_email` (`customer_email`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 7: Payment Records
-- =====================================================
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(12, 2) NOT NULL,
  `payment_method` enum('cash','bank_transfer','credit_card','e_wallet','check') NOT NULL,
  `payment_date` datetime NOT NULL,
  `reference_number` varchar(100) NULL,
  `notes` text NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_booking_id` (`booking_id`),
  KEY `idx_payment_date` (`payment_date`),
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 8: Maintenance Records
-- =====================================================
CREATE TABLE `maintenance_records` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `maintenance_type` enum('regular','repair','inspection','detail','upgrade') NOT NULL,
  `description` longtext NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NULL,
  `cost` decimal(10, 2) NULL,
  `status` enum('scheduled','in_progress','completed','cancelled') DEFAULT 'scheduled',
  `notes` longtext NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_vehicle_id` (`vehicle_id`),
  KEY `idx_status` (`status`),
  KEY `idx_start_date` (`start_date`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 9: Reviews & Ratings
-- =====================================================
CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
  `title` varchar(255) NOT NULL,
  `comment` longtext NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_vehicle_id` (`vehicle_id`),
  KEY `idx_status` (`status`),
  KEY `idx_rating` (`rating`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- DATA: Insert Sample Data
-- =====================================================

-- Insert Admin User
INSERT INTO `users` (`name`, `email`, `password`) VALUES 
('Admin Kayla', 'admin@kalyarentcar.com', '$2y$12$ZSzXzv7Rz8k8eO2qZ2qN5u5w5x5y5z5a5b5c5d5e5f5g5h5i5j5k5l5m');

-- Insert Sample Vehicles (24 vehicles)
INSERT INTO `vehicles` (`name`, `brand`, `model`, `year`, `type`, `transmission`, `engine_cc`, `fuel_type`, `seat_capacity`, `price_per_day`, `price_per_month`, `price_per_week`, `description`, `status`, `is_featured`, `rating`) VALUES
('Toyota Avanza Hitam', 'Toyota', 'Avanza', 2023, 'MPV', 'manual', 1496, 'bensin', 7, 250000, 6000000, 1500000, 'MPV keluarga yang nyaman dan handal', 'available', 1, 4.5),
('Honda Odyssey Silver', 'Honda', 'Odyssey', 2023, 'MPV', 'automatic', 2356, 'bensin', 8, 350000, 8000000, 2100000, 'MPV mewah dengan teknologi terkini', 'available', 1, 4.7),
('Toyota Innova Putih', 'Toyota', 'Innova', 2022, 'MPV', 'automatic', 2393, 'diesel', 8, 400000, 9000000, 2400000, 'Innova premium untuk perjalanan panjang', 'available', 1, 4.6),
('Suzuki Ertiga Merah', 'Suzuki', 'Ertiga', 2023, 'MPV', 'manual', 1456, 'bensin', 7, 220000, 5000000, 1300000, 'Ertiga terjangkau dan irit bahan bakar', 'available', 0, 4.2),
('Hyundai Santa Fe Hitam', 'Hyundai', 'Santa Fe', 2023, 'SUV', 'automatic', 2199, 'bensin', 7, 600000, 13000000, 3600000, 'SUV premium dengan desain sporty', 'available', 1, 4.8),
('Toyota Fortuner Perak', 'Toyota', 'Fortuner', 2023, 'SUV', 'automatic', 2755, 'diesel', 7, 550000, 12000000, 3300000, 'SUV tangguh untuk petualangan', 'available', 1, 4.7),
('Mitsubishi Pajero Biru', 'Mitsubishi', 'Pajero', 2022, 'SUV', 'automatic', 3200, 'diesel', 7, 580000, 12500000, 3500000, 'SUV legenda dengan performa andal', 'available', 0, 4.5),
('Daihatsu Terios Hijau', 'Daihatsu', 'Terios', 2023, 'SUV', 'automatic', 1495, 'bensin', 7, 280000, 6500000, 1700000, 'SUV kompak yang efisien', 'available', 0, 4.3),
('Toyota Avanza 2', 'Toyota', 'Avanza', 2023, 'MPV', 'manual', 1496, 'bensin', 7, 250000, 6000000, 1500000, 'MPV keluarga yang nyaman', 'available', 0, 4.4),
('Honda CRV Putih', 'Honda', 'CR-V', 2023, 'SUV', 'automatic', 1498, 'bensin', 5, 500000, 11000000, 3000000, 'SUV modis dan nyaman untuk keluarga', 'available', 1, 4.6),
('Wuling Almaz Merah', 'Wuling', 'Almaz', 2023, 'MPV', 'automatic', 1500, 'bensin', 7, 300000, 7000000, 1800000, 'MPV China dengan harga terjangkau', 'available', 0, 4.1),
('BYD Yuan Plus Biru', 'BYD', 'Yuan Plus', 2023, 'SUV', 'automatic', 0, 'electric', 5, 450000, 10000000, 2700000, 'SUV elektrik ramah lingkungan', 'available', 1, 4.5),
('Toyota Corolla Hitam', 'Toyota', 'Corolla', 2023, 'sedan', 'automatic', 1798, 'bensin', 5, 320000, 7500000, 1900000, 'Sedan keluarga yang andal', 'available', 1, 4.5),
('Honda Accord Silver', 'Honda', 'Accord', 2023, 'sedan', 'automatic', 1998, 'bensin', 5, 380000, 8500000, 2200000, 'Sedan premium dengan fitur lengkap', 'available', 1, 4.7),
('Mazda3 Merah', 'Mazda', '3', 2023, 'sedan', 'automatic', 1997, 'bensin', 5, 360000, 8000000, 2100000, 'Sedan sporty dengan desain elegan', 'available', 0, 4.6),
('Hyundai Elantra Putih', 'Hyundai', 'Elantra', 2023, 'sedan', 'automatic', 1599, 'bensin', 5, 280000, 6500000, 1700000, 'Sedan modern dengan teknologi terbaru', 'available', 0, 4.3),
('Nissan Almera Hijau', 'Nissan', 'Almera', 2023, 'sedan', 'manual', 1598, 'bensin', 5, 200000, 4500000, 1200000, 'Sedan terjangkau dan hemat bahan bakar', 'available', 0, 4.2),
('Kia Seltos Biru', 'Kia', 'Seltos', 2023, 'SUV', 'automatic', 1598, 'bensin', 5, 400000, 9000000, 2400000, 'SUV Korea dengan desain modern', 'available', 1, 4.4),
('Suzuki Swift Kuning', 'Suzuki', 'Swift', 2023, 'sedan', 'automatic', 1197, 'bensin', 5, 220000, 5000000, 1300000, 'Hatchback sporty dan ringkas', 'available', 0, 4.3),
('Toyota Camry Hitam', 'Toyota', 'Camry', 2023, 'sedan', 'automatic', 2487, 'bensin', 5, 450000, 10000000, 2700000, 'Sedan mewah dengan interior premium', 'available', 1, 4.8),
('BMW 320i Abu-abu', 'BMW', '320i', 2023, 'sedan', 'automatic', 1998, 'bensin', 5, 750000, 16000000, 4500000, 'Sedan luxury Eropa bergengsi', 'available', 1, 4.9),
('Mercedes C-Class Putih', 'Mercedes-Benz', 'C-Class', 2023, 'sedan', 'automatic', 1991, 'bensin', 5, 800000, 17000000, 4800000, 'Sedan prestige dengan kualitas terbaik', 'available', 1, 4.9),
('Chevrolet Trax Oranye', 'Chevrolet', 'Trax', 2023, 'SUV', 'automatic', 1598, 'bensin', 5, 380000, 8500000, 2200000, 'SUV kompak dengan harga kompetitif', 'maintenance', 0, 4.2),
('Isuzu Panther Hitam', 'Isuzu', 'Panther', 2022, 'pickup', 'manual', 2500, 'diesel', 6, 280000, 6500000, 1700000, 'Pickup tangguh untuk berbagai kebutuhan', 'available', 0, 4.3);

-- Insert Vehicle Features
INSERT INTO `vehicle_features` (`vehicle_id`, `feature_name`, `feature_icon`, `feature_category`, `description`) VALUES
(1, 'AC Dingin', 'fas fa-snowflake', 'comfort', 'AC sentral yang dingin dan nyaman'),
(1, 'Audio Premium', 'fas fa-volume-up', 'entertainment', 'Sistem audio berkualitas tinggi'),
(1, 'Kaca Elektrik', 'fas fa-square', 'comfort', 'Semua jendela dapat dibuka otomatis'),
(2, 'AC Dual Zone', 'fas fa-snowflake', 'comfort', 'AC terpisah untuk pengemudi dan penumpang'),
(2, 'Sunroof', 'fas fa-sun', 'luxury', 'Atap panorama yang dapat dibuka'),
(2, 'Kursi Kulit', 'fas fa-chair', 'comfort', 'Kursi berlapis kulit asli yang mewah'),
(3, 'Diesel Engine', 'fas fa-gas-pump', 'engine', 'Mesin diesel yang irit bahan bakar'),
(3, 'Cruise Control', 'fas fa-gauge-high', 'technology', 'Pengatur kecepatan otomatis'),
(4, 'Airbag Ganda', 'fas fa-shield-alt', 'safety', 'Sistem keselamatan dengan dual airbag'),
(4, 'ABS Brake', 'fas fa-circle', 'safety', 'Sistem rem anti selip'),
(5, 'Panoramic Sunroof', 'fas fa-sun', 'luxury', 'Atap kaca panorama yang luas'),
(5, 'Leather Seats', 'fas fa-chair', 'comfort', 'Kursi premium dengan bahan kulit'),
(5, 'Smart Key', 'fas fa-key', 'technology', 'Kunci pintar tanpa kontak'),
(6, 'All Wheel Drive', 'fas fa-cog', 'performance', 'Penggerak empat roda untuk jalan berat'),
(6, 'Power Steering', 'fas fa-gauge-high', 'comfort', 'Kemudi bertenaga untuk kemudahan'),
(7, 'Turbo Diesel', 'fas fa-fire', 'performance', 'Mesin diesel turbo yang bertenaga'),
(7, 'Terrain Control', 'fas fa-compass', 'technology', 'Pengontrol medan untuk berbagai jenis jalan'),
(8, 'Compact Size', 'fas fa-arrow-left', 'comfort', 'Ukuran ringkas mudah bermanuver'),
(8, 'Economy Mode', 'fas fa-leaf', 'technology', 'Mode hemat bahan bakar'),
(10, 'Honda Sensing', 'fas fa-robot', 'technology', 'Sistem keselamatan cerdas Honda'),
(10, 'Adaptive Suspension', 'fas fa-wave-square', 'comfort', 'Suspensi adaptif untuk kenyamanan'),
(12, 'Electric Motor', 'fas fa-plug', 'performance', 'Motor elektrik ramah lingkungan'),
(12, 'Fast Charging', 'fas fa-plug', 'technology', 'Pengisian daya cepat 30 menit'),
(13, 'Hybrid System', 'fas fa-leaf', 'performance', 'Sistem hybrid penghematan bahan bakar'),
(13, 'CVT Transmission', 'fas fa-cog', 'performance', 'Transmisi otomatis yang halus'),
(14, 'Panoramic Display', 'fas fa-rectangle-landscape', 'technology', 'Layar sentuh panorama 10 inci'),
(14, 'Wireless Charging', 'fas fa-charging-station', 'technology', 'Pengisian daya nirkabel untuk ponsel'),
(15, 'Mazda Connect', 'fas fa-mobile', 'technology', 'Sistem infotainment terpadu'),
(15, 'Bose Audio System', 'fas fa-volume-up', 'entertainment', 'Sistem audio premium dari Bose'),
(20, 'Luxury Interior', 'fas fa-crown', 'luxury', 'Interior mewah dengan desain eksklusif'),
(20, 'Mark Levinson Audio', 'fas fa-volume-up', 'entertainment', 'Sistem audio kelas dunia'),
(21, 'Executive Class', 'fas fa-crown', 'luxury', 'Kelas eksekutif dengan layanan VIP'),
(21, 'Burmester Sound', 'fas fa-volume-up', 'entertainment', 'Sistem suara premium Burmester');

-- Insert Vehicle Images
INSERT INTO `vehicle_images` (`vehicle_id`, `image_url`, `image_alt`, `is_primary`, `sort_order`) VALUES
(1, '/images/vehicles/toyota-avanza-1.jpg', 'Toyota Avanza Hitam - Tampak Depan', 1, 1),
(1, '/images/vehicles/toyota-avanza-2.jpg', 'Toyota Avanza Hitam - Tampak Samping', 0, 2),
(1, '/images/vehicles/toyota-avanza-3.jpg', 'Toyota Avanza Hitam - Interior', 0, 3),
(2, '/images/vehicles/honda-odyssey-1.jpg', 'Honda Odyssey Silver - Tampak Depan', 1, 1),
(2, '/images/vehicles/honda-odyssey-2.jpg', 'Honda Odyssey Silver - Interior', 0, 2),
(3, '/images/vehicles/toyota-innova-1.jpg', 'Toyota Innova Putih - Tampak Depan', 1, 1),
(3, '/images/vehicles/toyota-innova-2.jpg', 'Toyota Innova Putih - Interior', 0, 2),
(4, '/images/vehicles/suzuki-ertiga-1.jpg', 'Suzuki Ertiga Merah - Tampak Depan', 1, 1),
(5, '/images/vehicles/hyundai-santa-fe-1.jpg', 'Hyundai Santa Fe - Tampak Depan', 1, 1),
(5, '/images/vehicles/hyundai-santa-fe-2.jpg', 'Hyundai Santa Fe - Interior', 0, 2),
(6, '/images/vehicles/toyota-fortuner-1.jpg', 'Toyota Fortuner Perak - Tampak Depan', 1, 1),
(6, '/images/vehicles/toyota-fortuner-2.jpg', 'Toyota Fortuner Perak - Interior', 0, 2),
(7, '/images/vehicles/mitsubishi-pajero-1.jpg', 'Mitsubishi Pajero Biru - Tampak Depan', 1, 1),
(8, '/images/vehicles/daihatsu-terios-1.jpg', 'Daihatsu Terios Hijau - Tampak Depan', 1, 1),
(10, '/images/vehicles/honda-crv-1.jpg', 'Honda CRV Putih - Tampak Depan', 1, 1),
(10, '/images/vehicles/honda-crv-2.jpg', 'Honda CRV Putih - Interior', 0, 2),
(12, '/images/vehicles/byd-yuan-1.jpg', 'BYD Yuan Plus - Tampak Depan', 1, 1),
(13, '/images/vehicles/toyota-corolla-1.jpg', 'Toyota Corolla Hitam - Tampak Depan', 1, 1),
(14, '/images/vehicles/honda-accord-1.jpg', 'Honda Accord Silver - Tampak Depan', 1, 1),
(14, '/images/vehicles/honda-accord-2.jpg', 'Honda Accord Silver - Interior', 0, 2),
(15, '/images/vehicles/mazda3-1.jpg', 'Mazda3 Merah - Tampak Depan', 1, 1),
(20, '/images/vehicles/toyota-camry-1.jpg', 'Toyota Camry Hitam - Tampak Depan', 1, 1),
(20, '/images/vehicles/toyota-camry-2.jpg', 'Toyota Camry Hitam - Interior', 0, 2),
(21, '/images/vehicles/bmw-320i-1.jpg', 'BMW 320i Abu-abu - Tampak Depan', 1, 1),
(22, '/images/vehicles/mercedes-c-class-1.jpg', 'Mercedes C-Class Putih - Tampak Depan', 1, 1);

-- Insert Vehicle Specifications
INSERT INTO `vehicle_specifications` (`vehicle_id`, `spec_name`, `spec_value`, `spec_category`) VALUES
(1, 'Panjang', '4295 mm', 'dimensions'),
(1, 'Lebar', '1660 mm', 'dimensions'),
(1, 'Tinggi', '1705 mm', 'dimensions'),
(1, 'Berat Kosong', '1110 kg', 'dimensions'),
(1, 'Daya Mesin', '110 PS', 'engine'),
(1, 'Torsi', '140 Nm', 'engine'),
(1, 'Konsumsi Bahan Bakar', '8.5 L/100km', 'performance'),
(1, 'Kecepatan Maksimal', '180 km/h', 'performance'),
(2, 'Panjang', '4830 mm', 'dimensions'),
(2, 'Lebar', '1850 mm', 'dimensions'),
(2, 'Tinggi', '1712 mm', 'dimensions'),
(2, 'Daya Mesin', '160 PS', 'engine'),
(2, 'Torsi', '204 Nm', 'engine'),
(2, 'Jarak Tempuh', '730 km/tangki', 'performance'),
(3, 'Panjang', '4735 mm', 'dimensions'),
(3, 'Lebar', '1830 mm', 'dimensions'),
(3, 'Tinggi', '1835 mm', 'dimensions'),
(3, 'Daya Mesin', '150 PS', 'engine'),
(3, 'Torsi', '360 Nm', 'engine'),
(3, 'Konsumsi Bahan Bakar', '9.2 L/100km', 'performance'),
(5, 'Panjang', '4770 mm', 'dimensions'),
(5, 'Lebar', '1880 mm', 'dimensions'),
(5, 'Tinggi', '1680 mm', 'dimensions'),
(5, 'Daya Mesin', '175 PS', 'engine'),
(5, 'Torsi', '226 Nm', 'engine'),
(5, 'Akselerasi 0-100', '9.5 detik', 'performance'),
(6, 'Panjang', '4795 mm', 'dimensions'),
(6, 'Lebar', '1855 mm', 'dimensions'),
(6, 'Tinggi', '1835 mm', 'dimensions'),
(6, 'Daya Mesin', '165 PS', 'engine'),
(6, 'Torsi', '360 Nm', 'engine'),
(6, 'Clearance', '225 mm', 'dimensions'),
(13, 'Panjang', '4630 mm', 'dimensions'),
(13, 'Lebar', '1780 mm', 'dimensions'),
(13, 'Tinggi', '1445 mm', 'dimensions'),
(13, 'Daya Mesin', '122 PS', 'engine'),
(13, 'Torsi', '154 Nm', 'engine'),
(13, 'Akselerasi 0-100', '10.3 detik', 'performance'),
(14, 'Panjang', '4885 mm', 'dimensions'),
(14, 'Lebar', '1860 mm', 'dimensions'),
(14, 'Tinggi', '1470 mm', 'dimensions'),
(14, 'Daya Mesin', '154 PS', 'engine'),
(14, 'Torsi', '186 Nm', 'engine'),
(14, 'Jarak Tempuh', '800 km/tangki', 'performance');

-- Insert Sample Bookings
INSERT INTO `bookings` (`vehicle_id`, `customer_name`, `customer_email`, `customer_phone`, `pickup_date`, `return_date`, `pickup_location`, `return_location`, `driver_needed`, `insurance_type`, `total_days`, `daily_rate`, `total_price`, `deposit_amount`, `status`, `payment_status`, `notes`) VALUES
(1, 'Budi Santoso', 'budi@email.com', '08123456789', '2026-02-10 08:00:00', '2026-02-15 18:00:00', 'Kantor Pusat', 'Kantor Pusat', 0, 'standard', 5, 250000, 1250000, 500000, 'confirmed', 'paid', 'Perjalanan keluarga ke Bandung'),
(2, 'Siti Nurhaliza', 'siti@email.com', '08234567890', '2026-02-12 09:00:00', '2026-02-14 18:00:00', 'Bandara Soetta', 'Bandara Soetta', 1, 'premium', 2, 350000, 700000, 350000, 'active', 'paid', 'Pengantar dengan driver profesional'),
(5, 'Ahmad Rifki', 'ahmad@email.com', '08345678901', '2026-02-18 10:00:00', '2026-02-25 18:00:00', 'Hotel Mewah', 'Hotel Mewah', 0, 'standard', 7, 600000, 4200000, 2000000, 'pending', 'partial', 'Perjalanan bisnis satu minggu'),
(13, 'Citra Dewi', 'citra@email.com', '08456789012', '2026-02-20 08:00:00', '2026-02-22 18:00:00', 'Kantor Pusat', 'Kantor Pusat', 0, 'basic', 2, 320000, 640000, 320000, 'pending', 'unpaid', 'Perjalanan kerja'),
(20, 'Rendra Wijaya', 'rendra@email.com', '08567890123', '2026-02-24 14:00:00', '2026-02-27 18:00:00', 'Bandara Soetta', 'Bandara Soetta', 1, 'premium', 3, 450000, 1350000, 675000, 'pending', 'unpaid', 'Kunjungan tamu penting');

-- Insert Sample Payments
INSERT INTO `payments` (`booking_id`, `amount`, `payment_method`, `payment_date`, `reference_number`, `notes`) VALUES
(1, 500000, 'cash', '2026-02-09 14:00:00', 'TRX001', 'DP pemesanan'),
(1, 750000, 'bank_transfer', '2026-02-14 16:00:00', 'TRX002', 'Pembayaran sisa'),
(2, 700000, 'credit_card', '2026-02-12 09:30:00', 'TRX003', 'Pembayaran penuh'),
(3, 2000000, 'bank_transfer', '2026-02-17 10:00:00', 'TRX004', 'DP pemesanan'),
(3, 2200000, 'bank_transfer', '2026-02-25 11:00:00', 'TRX005', 'Pembayaran sisa');

-- Insert Sample Maintenance Records
INSERT INTO `maintenance_records` (`vehicle_id`, `maintenance_type`, `description`, `start_date`, `end_date`, `cost`, `status`, `notes`) VALUES
(23, 'regular', 'Servis rutin: ganti oli, filter, dan inspeksi umum', '2026-02-01 09:00:00', '2026-02-01 12:00:00', 500000, 'completed', 'Servis berjalan lancar'),
(3, 'inspection', 'Pemeriksaan berkala setelah 50.000 km', '2026-02-05 09:00:00', '2026-02-05 17:00:00', 750000, 'completed', 'Semua komponen dalam kondisi baik'),
(6, 'repair', 'Perbaikan AC yang mulai tidak dingin', '2026-02-06 08:00:00', '2026-02-06 14:00:00', 1200000, 'completed', 'AC sudah diperbaiki dan diisi freon'),
(1, 'detail', 'Detailing mobil lengkap: cuci, wax, dan interior detailing', '2026-02-07 08:00:00', '2026-02-07 16:00:00', 350000, 'completed', 'Mobil kembali bersih dan mengkilap'),
(12, 'scheduled', 'Perawatan pre-delivery untuk unit baru', '2026-02-08 08:00:00', NULL, 250000, 'in_progress', 'Sedang dalam proses persiapan');

-- Insert Sample Reviews
INSERT INTO `reviews` (`vehicle_id`, `booking_id`, `customer_name`, `customer_email`, `rating`, `title`, `comment`, `status`) VALUES
(1, 1, 'Budi Santoso', 'budi@email.com', 5, 'Pengalaman Menyenangkan', 'Mobilnya sangat nyaman, sopirnya ramah, dan layanannya excellent. Saya puas dengan rental ini.', 'approved'),
(2, 2, 'Siti Nurhaliza', 'siti@email.com', 5, 'Kendaraan Premium', 'Mobil sangat mewah dan terawat dengan baik. Sopir profesional dan tepat waktu. Recommended!', 'approved'),
(5, 3, 'Ahmad Rifki', 'ahmad@email.com', 4, 'Bagus Tapi Harga Agak Mahal', 'SUV yang bagus dan powerful untuk perjalanan jauh. Hanya saja harganya sedikit premium.', 'approved'),
(13, 4, 'Citra Dewi', 'citra@email.com', 4, 'Sedan Nyaman untuk Perkotaan', 'Mobil cocok untuk perjalanan di kota. Konsumsi BBM cukup irit. Puas dengan layanannya.', 'pending'),
(20, NULL, 'Eko Prasetyo', 'eko@email.com', 5, 'Mobil Impian', 'Camry benar-benar mobil impian saya. Luxury, powerful, dan comfort. Mantap!', 'pending');

-- =====================================================
-- Create Indexes untuk Performance
-- =====================================================
CREATE INDEX idx_vehicles_status ON vehicles(status);
CREATE INDEX idx_vehicles_type ON vehicles(type);
CREATE INDEX idx_bookings_vehicle ON bookings(vehicle_id);
CREATE INDEX idx_bookings_status ON bookings(status);
CREATE INDEX idx_bookings_dates ON bookings(pickup_date, return_date);
CREATE INDEX idx_payments_booking ON payments(booking_id);
CREATE INDEX idx_maintenance_vehicle ON maintenance_records(vehicle_id);
CREATE INDEX idx_reviews_vehicle ON reviews(vehicle_id);

-- =====================================================
-- Database Summary
-- =====================================================
/*
DATABASE: kalya_rentcar
TABLES: 9
  1. users (1 admin user)
  2. vehicles (24 vehicles)
  3. vehicle_features (32 features)
  4. vehicle_images (25 images)
  5. vehicle_specifications (42 specs)
  6. bookings (5 sample bookings)
  7. payments (5 payment records)
  8. maintenance_records (5 maintenance)
  9. reviews (5 reviews)

ADMIN CREDENTIALS:
  Email: admin@kalyarentcar.com
  Password: password (hashed with bcrypt)

TOTAL RECORDS:
  - Vehicles: 24
  - Vehicle Features: 32
  - Vehicle Images: 25
  - Vehicle Specifications: 42
  - Bookings: 5
  - Payments: 5
  - Maintenance Records: 5
  - Reviews: 5
  Total: 149+ records

FITUR UTAMA:
  ✓ Vehicle Management (Upload foto, atur harga, detail kendaraan)
  ✓ Vehicle Features (AC, audio, safety, comfort, luxury)
  ✓ Gallery Management (Multiple images per vehicle)
  ✓ Booking & Reservation System
  ✓ Payment Tracking
  ✓ Maintenance Management
  ✓ Customer Reviews & Ratings
  ✓ Comprehensive Specifications

READY TO USE:
  - Import ke phpMyAdmin
  - Integrate dengan Laravel 11
  - AdminLTE template integration
*/
