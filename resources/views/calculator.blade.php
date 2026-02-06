<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sewa Mobil - Kalya Rentcar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/calculator-new.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <div class="logo"><i class="fas fa-car"></i> Kalya <span>Rentcar</span></div>
        <ul class="nav-links" id="navLinks">
            <li><a href="/">Beranda</a></li>
            <li><a href="gallery">Gallery</a></li>
            <li><a href="/#vehicles">Kendaraan</a></li>
            <li><a href="/#location">Alamat</a></li>
        </ul>
        <button class="burger-menu" id="burgerMenu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- RENTAL PAGE HEADER -->
    <div class="rental-header">
        <h1>Formulir <span>Sewa Mobil</span></h1>
        <p>Isi data diri Anda dan pilih layanan yang diinginkan untuk melanjutkan pemesanan</p>
    </div>

    <!-- MAIN RENTAL CONTAINER -->
    <div class="rental-main-container">
        <div class="rental-wrapper">
            <!-- LEFT: FORM -->
            <div class="rental-form-section">
                <form class="rental-form" id="rentalForm">
                    <!-- PERSONAL INFO SECTION -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-user-circle"></i> Data Pemesan
                        </h3>
                        
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" id="nama" name="nama" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <div class="form-group">
                            <label for="whatsapp">Nomor WhatsApp <span class="required">*</span></label>
                            <input type="tel" id="whatsapp" name="whatsapp" placeholder="Contoh: 081234567890" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="optional">(Opsional)</span></label>
                            <input type="email" id="email" name="email" placeholder="Contoh: email@gmail.com">
                        </div>
                    </div>

                    <!-- SERVICE TYPE SECTION -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-concierge-bell"></i> Jenis Layanan
                        </h3>
                        
                        <div class="form-group">
                            <label for="service">Pilih Layanan <span class="required">*</span></label>
                            <select id="service" name="service" required onchange="updateServiceInfo()">
                                <option value="">-- Pilih Layanan --</option>
                                <option value="lepas-kunci">Lepas Kunci</option>
                                <option value="mobil-driver">Mobil + Driver</option>
                            </select>
                        </div>

                        <div class="service-info" id="serviceInfo">
                            <p id="serviceDescription"></p>
                        </div>

                        <!-- TUJUAN PERJALANAN - Muncul hanya untuk Mobil + Driver -->
                        <div class="form-group" id="destinationGroup" style="display: none; margin-top: 20px;">
                            <label for="destination">Tujuan Perjalanan <span class="required">*</span></label>
                            <select id="destination" name="destination" onchange="updateCalculator()">
                                <option value="">-- Pilih Tujuan --</option>
                                @forelse($destinations ?? [] as $dest)
                                <option value="{{ $dest->id }}" data-fee="{{ $dest->fee_per_day }}">{{ $dest->name }} (+Rp {{ number_format($dest->fee_per_day, 0, ',', '.') }}/hari)</option>
                                @empty
                                <option value="">Tidak ada tujuan tersedia</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <!-- RENTAL DETAILS SECTION -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-calendar-check"></i> Detail Sewa
                        </h3>
                        
                        <div class="form-group">
                            <label for="vehicle">Pilih Kendaraan <span class="required">*</span></label>
                            <select id="vehicle" name="vehicle" required onchange="updateCalculator()">
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" data-price="{{ $vehicle->price_per_day }}">{{ $vehicle->name }} - Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}/hari</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="checkin">Tanggal Sewa <span class="required">*</span></label>
                                <input type="date" id="checkin" name="checkin" required onchange="calculateDays()">
                            </div>
                            <div class="form-group">
                                <label for="checkout">Tanggal Kembali <span class="required">*</span></label>
                                <input type="date" id="checkout" name="checkout" required onchange="calculateDays()">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="days">Durasi Sewa</label>
                            <input type="number" id="days" name="days" value="1" min="1" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" onclick="handleFormSubmit(event)">
                        <i class="fas fa-check-circle"></i> Lanjutkan Pemesanan
                    </button>
                </form>
            </div>

            <!-- RIGHT: CALCULATOR -->
            <div class="calculator-sidebar">
                <div class="calculator-card">
                    <h3 class="calculator-title">
                        <i class="fas fa-calculator"></i> Kalkulator Harga
                    </h3>
                    
                    <div class="calculator-content">
                        <div class="calc-item">
                            <span class="calc-label">Kendaraan</span>
                            <span class="calc-value" id="calcVehicle">-</span>
                        </div>

                        <div class="calc-item">
                            <span class="calc-label">Harga/Hari</span>
                            <span class="calc-value" id="calcPrice">Rp 0</span>
                        </div>

                        <div class="calc-item">
                            <span class="calc-label">Durasi</span>
                            <span class="calc-value" id="calcDays">0 hari</span>
                        </div>

                        <div id="calcBreakdown"></div>

                        <div class="calc-divider"></div>

                        <div class="calc-item grand-total">
                            <span class="calc-label">Total Harga</span>
                            <span class="calc-value" id="calcTotal">Rp 0</span>
                        </div>

                        <p class="calculator-note">
                            <i class="fas fa-info-circle"></i> Harga akan diupdate sesuai pilihan Anda
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FLOATING WHATSAPP BUTTON -->
    <a href="https://wa.me/628123456789" class="whatsapp-float" target="_blank" rel="noopener noreferrer" title="Chat dengan kami">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="/js/calculator-new.js"></script>
</body>
</html>
