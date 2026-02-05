<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalya Rentcar - Solusi Rental Mobil Terpercaya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/landing.css">
</head>
<body>
    <!-- LOADING SCREEN -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-container">
            <div class="loading-car">
                <i class="fas fa-car"></i>
            </div>
            <div class="loading-track">
                <div class="loading-progress"></div>
            </div>
            <h2 class="loading-text">KALYA <span>RENTCAR</span></h2>
            <p class="loading-subtext">Perjalanan Anda dimulai dari sini...</p>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav>
        <div class="logo"><i class="fas fa-car"></i> Kalya <span>Rentcar</span></div>
        <ul class="nav-links" id="navLinks">
            <li><a href="#home">Beranda</a></li>
            <li><a href="gallery">Gallery</a></li>
            <li><a href="#vehicles">Kendaraan</a></li>
            <li><a href="#location">Alamat</a></li>
            <li><a href="/login" style="color: #FFD700; font-weight: 600;"><i class="fas fa-lock"></i> Admin</a></li>
        </ul>
        <button class="burger-menu" id="burgerMenu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- HERO SECTION -->
    <section id="home" class="hero">
        <!-- Background -->
        <div class="hero-bg"></div>

        <!-- Content Wrapper -->
        <div class="hero-container">
            <!-- Left Column - Content -->
            <div class="hero-left">
                <h1 class="hero-title">
                    Sewa Mobil Impian<br>
                    Anda Bersama <span>Kalya</span><br>
                    <span>Rentcar</span>
                </h1>
                <p class="hero-description">
                    Nikmati pengalaman berkendara terbaik dengan armada mobil terlengkap, harga kompetitif, dan layanan pelanggan yang responsif. Perjalanan Anda adalah prioritas kami.
                </p>

                <div class="hero-buttons">
                    <a href="calculator" class="btn btn-primary">
                        <i class="fas fa-car"></i> Sewa Sekarang
                    </a>
                    <a href="#vehicles" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i> Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="hero-badges">
                    <div class="badge">
                        <i class="fas fa-check-circle"></i>
                        <span>5000+ Pelanggan Puas</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>Asuransi Lengkap</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-headset"></i>
                        <span>Dukungan 24/7</span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Image -->
            <div class="hero-right">
                <div class="hero-image-wrapper">
                    <img src="/img/gambar_bg.png" alt="Car" class="hero-car-image">
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="stats">
        <h2 class="section-title">Kepercayaan <span>Pelanggan</span></h2>
        <div class="stats-grid">
            <div class="stat-box scroll-fade">
                <div class="stat-number" data-value="5000">5000+</div>
                <div class="stat-label">Pelanggan Puas</div>
            </div>
            <div class="stat-box scroll-fade">
                <div class="stat-number" data-value="150">150+</div>
                <div class="stat-label">Kendaraan Tersedia</div>
            </div>
            <div class="stat-box scroll-fade">
                <div class="stat-number" data-value="25000">25000+</div>
                <div class="stat-label">Perjalanan Sukses</div>
            </div>
            <div class="stat-box scroll-fade">
                <div class="stat-number" data-value="8">8+</div>
                <div class="stat-label">Tahun Berpengalaman</div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="features" class="features">
        <h2 class="section-title">Mengapa Memilih <span>Kami?</span></h2>
        <div class="features-grid">
            <div class="feature-card scroll-fade">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Aman & Terpercaya</h3>
                <p>Semua kendaraan diasuransikan penuh dan dilengkapi dengan fitur keselamatan terkini untuk kenyamanan Anda.</p>
            </div>
            <div class="feature-card scroll-fade">
                <div class="feature-icon"><i class="fas fa-wallet"></i></div>
                <h3>Harga Terjangkau</h3>
                <p>Paket sewa dengan harga kompetitif dan transparan tanpa biaya tersembunyi. Dapatkan penawaran terbaik hari ini.</p>
            </div>
            <div class="feature-card scroll-fade">
                <div class="feature-icon"><i class="fas fa-headset"></i></div>
                <h3>Dukungan 24/7</h3>
                <p>Tim customer service kami siap membantu Anda kapan saja. Hubungi kami melalui telepon atau chat online.</p>
            </div>
            <div class="feature-card scroll-fade">
                <div class="feature-icon"><i class="fas fa-tachometer-alt"></i></div>
                <h3>Kendaraan Berkualitas</h3>
                <p>Armada kendaraan selalu dalam kondisi prima dengan pemeliharaan rutin dan standar kebersihan tinggi.</p>
            </div>
            <div class="feature-card scroll-fade">
                <div class="feature-icon"><i class="fas fa-map-marked-alt"></i></div>
                <h3>Lokasi Strategis</h3>
                <p>Layanan pickup dan drop-off tersedia di berbagai lokasi untuk kemudahan Anda bepergian.</p>
            </div>
            <div class="feature-card scroll-fade">
                <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                <h3>Booking Mudah</h3>
                <p>Pesan mobil Anda dalam hitungan menit melalui aplikasi mobile atau website kami yang user-friendly.</p>
            </div>
        </div>
    </section>

    <!-- RENTAL TYPES SECTION -->
    <section id="rental-types" class="rental-types">
        <h2 class="section-title">Tipe <span>Sewa</span></h2>
        <div class="rental-types-grid">
            @forelse($rentalTypes as $type)
            <div class="rental-card scroll-fade" data-rental-type="{{ strtolower(str_replace([' ', '&'], ['-', 'dan'], $type->name)) }}">
                <div class="rental-icon">
                    <i class="fas {{ $type->icon }}"></i>
                </div>
                <h3>{{ $type->name }}</h3>
                <p>{{ $type->description }}</p>
                <button class="rental-btn" onclick="handleRentalTypeClick('{{ strtolower(str_replace([' ', '&'], ['-', 'dan'], $type->name)) }}', '{{ $type->name }}')">Pesan Sekarang</button>
            </div>
            @empty
            <div class="alert alert-info" style="grid-column: 1 / -1;">
                <i class="fas fa-info-circle"></i> Jenis layanan tidak tersedia
            </div>
            @endforelse
        </div>
    </section>

    <!-- VEHICLES SECTION -->
    <section id="vehicles" class="vehicles">
        <h2 class="section-title">Armada <span>Kendaraan</span></h2>
        <div class="vehicles-slider-container">
            <div class="vehicles-slider">
            @forelse($vehicles as $vehicle)
            <div class="vehicle-card scroll-fade">
                <div class="vehicle-image"><img src="{{ $vehicle->primary_image }}" alt="{{ $vehicle->name }}"></div>
                <div class="vehicle-info">
                    <h4>{{ $vehicle->brand }} {{ $vehicle->model }}</h4>
                    <div class="vehicle-specs">
                        <span><i class="fas fa-users"></i> {{ $vehicle->seat_capacity }} Penumpang</span>
                        <span><i class="fas fa-gear"></i> {{ ucfirst($vehicle->transmission) }}</span>
                        @if($vehicle->fuel_type)
                        <span><i class="fas fa-gas-pump"></i> {{ ucfirst($vehicle->fuel_type) }}</span>
                        @endif
                        <span><i class="fas fa-snowflake"></i> AC Dingin</span>
                    </div>
                    <div class="vehicle-price">Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}/hari</div>
                    <a href="calculator?vehicle={{ urlencode($vehicle->brand . ' ' . $vehicle->model) }}" class="vehicle-btn">Pesan Sekarang</a>
                </div>
            </div>
            @empty
            <div class="vehicle-card scroll-fade">
                <div class="vehicle-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-car" style="font-size: 60px; color: #ccc;"></i>
                </div>
                <div class="vehicle-info">
                    <h4>Tidak Ada Kendaraan</h4>
                    <p style="color: #999; font-size: 14px;">Daftar kendaraan sedang tidak tersedia</p>
                </div>
            </div>
            @endforelse
        </div>
        <div class="slider-controls">
            <button class="slider-btn slider-prev" onclick="prevVehicle()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="slider-dots" id="sliderDots"></div>
            <button class="slider-btn slider-next" onclick="nextVehicle()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="how-it-works">
        <h2 class="section-title">Cara <span>Kerja</span></h2>
        <div class="steps-container">
            <div class="step scroll-fade">
                <div class="step-number">1</div>
                <span class="step-arrow"><i class="fas fa-arrow-right"></i></span>
                <h4>Pilih Kendaraan</h4>
                <p>Pilih dari berbagai pilihan kendaraan yang sesuai dengan kebutuhan Anda.</p>
            </div>
            <div class="step scroll-fade">
                <div class="step-number">2</div>
                <span class="step-arrow"><i class="fas fa-arrow-right"></i></span>
                <h4>Tentukan Tanggal</h4>
                <p>Pilih tanggal mulai dan akhir sewa yang Anda inginkan dengan mudah.</p>
            </div>
            <div class="step scroll-fade">
                <div class="step-number">3</div>
                <span class="step-arrow"><i class="fas fa-arrow-right"></i></span>
                <h4>Proses Pembayaran</h4>
                <p>Lakukan pembayaran melalui berbagai metode yang aman dan terpercaya.</p>
            </div>
            <div class="step scroll-fade">
                <div class="step-number">4</div>
                <h4>Nikmati Perjalanan</h4>
                <p>Ambil kendaraan Anda dan mulai petualangan dengan percaya diri.</p>
            </div>
        </div>
    </section>

    <!-- LOCATION SECTION -->
    <section id="location" class="location">
        <h2 class="section-title">Kunjungi <span>Kami</span></h2>
        <div class="location-container">
            <div class="location-info scroll-fade">
                <h3>Alamat Kantor Utama</h3>
                <div class="address-box">
                    <div class="address-item">
                        <div class="address-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="address-text">
                            <h4>Kantor Pusat</h4>
                            <p>Jl. Sudirman No. 123, Jakarta Pusat 12190, Indonesia</p>
                        </div>
                    </div>
                    <div class="address-item">
                        <div class="address-icon"><i class="fas fa-phone"></i></div>
                        <div class="address-text">
                            <h4>Telepon</h4>
                            <p>+62 21-5555-1234</p>
                        </div>
                    </div>
                    <div class="address-item">
                        <div class="address-icon"><i class="fas fa-envelope"></i></div>
                        <div class="address-text">
                            <h4>Email</h4>
                            <p>info@kalyarentcar.com</p>
                        </div>
                    </div>
                    <div class="address-item">
                        <div class="address-icon"><i class="fas fa-clock"></i></div>
                        <div class="address-text">
                            <h4>Jam Operasional</h4>
                            <p>Senin - Minggu: 07:00 - 22:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="location-map scroll-fade">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322811!2d106.82969961177974!3d-6.200000261819916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5f3f3f3f3f3%3A0x3f3f3f3f3f3f3f3f!2sJl.%20Sudirman%2C%20Jakarta%20Pusat!5e0!3m2!1sid!2sid!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h5>Tentang Kalya Rentcar</h5>
                <p>Kami adalah penyedia layanan rental mobil terpercaya dengan pengalaman lebih dari 8 tahun. Komitmen kami adalah memberikan layanan terbaik untuk setiap pelanggan.</p>
            </div>
            <div class="footer-section">
                <h5>Menu Cepat</h5>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#vehicles">Kendaraan</a></li>
                    <li><a href="#pricing">Paket</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h5>Layanan</h5>
                <ul>
                    <li><a href="#rental-types">Lepas Kunci</a></li>
                    <li><a href="#rental-types">Mobil + Driver</a></li>
                    <li><a href="#rental-types">Driver Only</a></li>
                    <li><a href="#rental-types">Antar Jemput Bandara</a></li>
                    <li><a href="#rental-types">Wisata Tour Dalam & Luar Kota</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h5>Hubungi Kami</h5>
                <ul>
                    <li><a href="tel:+62812345678"><i class="fas fa-phone"></i> +62 812-345-678</a></li>
                    <li><a href="mailto:info@kalyarentcar.com"><i class="fas fa-envelope"></i> info@kalyarentcar.com</a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</a></li>
                    <li style="margin-top: 1rem;">
                        <a href="#" style="color: #FFD700; margin-right: 1rem;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color: #FFD700; margin-right: 1rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color: #FFD700;"><i class="fab fa-twitter"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Kalya Rentcar. Semua hak dilindungi. | Design dengan <span style="color: #FFD700;">❤</span> untuk perjalanan Anda.</p>
        </div>
    </footer>

    <!-- FLOATING WHATSAPP BUTTON -->
    <a href="https://wa.me/6282156970588?text=Halo%20Kalya%20Rentcar%2C%20saya%20ingin%20memesan%20rental%20mobil.%20Mohon%20informasi%20mengenai%20ketersediaan%20kendaraan%20dan%20harga%20terbaru.%20Terima%20kasih." class="whatsapp-float" target="_blank" rel="noopener noreferrer" title="Chat dengan kami di WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="/js/landing.js"></script>
    <script src="/js/rental-types-handler.js"></script>
</body>
</html>
