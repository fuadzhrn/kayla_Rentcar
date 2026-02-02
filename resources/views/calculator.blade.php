<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Sewa - Kayla Rentcar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/calculator.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <div class="logo">Kayla <span>Rentcar</span></div>
        <ul class="nav-links">
            <li><a href="/">Beranda</a></li>
            <li><a href="gallery">Gallery</a></li>
            <li><a href="/#vehicles">Kendaraan</a></li>
            <li><a href="/#pricing">Paket</a></li>
            <li><a href="/#contact">Kontak</a></li>
        </ul>
    </nav>

    <!-- CALCULATOR SECTION -->
    <div class="calculator-container">
        <h1>Kalkulator <span>Harga Sewa</span></h1>
        
        <div class="calculator-wrapper">
            <!-- Vehicle Card -->
            <div class="vehicle-selection">
                <div class="vehicle-preview">
                    <div class="vehicle-image" id="vehicleImage">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="vehicle-details">
                        <h2 id="vehicleName">Pilih Kendaraan</h2>
                        <p id="vehiclePrice" class="vehicle-price">Rp -</p>
                        <div class="vehicle-features">
                            <span id="vehiclePassengers">-</span>
                            <span id="vehicleTransmission">-</span>
                            <span id="vehicleAC">-</span>
                        </div>
                        <button class="btn-change-vehicle" onclick="window.location.href='/#vehicles'">
                            <i class="fas fa-exchange-alt"></i> Ubah Kendaraan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Calculator Form -->
            <div class="calculator-form">
                <div class="form-group">
                    <label for="startDate">
                        <i class="fas fa-calendar-alt"></i> Tanggal Mulai Sewa
                    </label>
                    <input type="date" id="startDate" onchange="calculateTotal()">
                </div>

                <div class="form-group">
                    <label for="endDate">
                        <i class="fas fa-calendar-alt"></i> Tanggal Akhir Sewa
                    </label>
                    <input type="date" id="endDate" onchange="calculateTotal()">
                </div>

                <!-- Duration Display -->
                <div class="duration-display">
                    <div class="duration-item">
                        <span class="duration-label">Jumlah Hari</span>
                        <span class="duration-value" id="durationDays">0</span>
                    </div>
                    <div class="duration-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="duration-item">
                        <span class="duration-label">Harga per Hari</span>
                        <span class="duration-value" id="pricePerDay">Rp -</span>
                    </div>
                    <div class="duration-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="duration-item">
                        <span class="duration-label">Total Harga</span>
                        <span class="duration-value" id="totalPrice">Rp -</span>
                    </div>
                </div>

                <!-- Cost Breakdown -->
                <div class="cost-breakdown">
                    <h3>Rincian Biaya</h3>
                    <div class="breakdown-item">
                        <span>Subtotal (<span id="breakdownDays">0</span> hari × Rp <span id="breakdownPricePerDay">0</span>)</span>
                        <span id="breakdownSubtotal">Rp 0</span>
                    </div>
                    <div class="breakdown-total">
                        <span>Total Pembayaran</span>
                        <span id="breakdownTotal">Rp 0</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="calculator-actions">
                    <button class="btn btn-secondary" onclick="resetCalculator()">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button class="btn btn-primary" onclick="bookNow()">
                        <i class="fas fa-check-circle"></i> Pesan Sekarang
                    </button>
                </div>

                <p class="disclaimer">
                    <i class="fas fa-info-circle"></i> Klik tombol "Pesan Sekarang" untuk melanjutkan ke proses booking
                </p>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Kayla Rentcar</h4>
                <p>Solusi rental mobil terpercaya dengan harga kompetitif dan layanan terbaik.</p>
            </div>
            <div class="footer-section">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="/">Beranda</a></li>
                    <li><a href="gallery">Gallery</a></li>
                    <li><a href="/#vehicles">Kendaraan</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Kontak</h4>
                <p><i class="fas fa-phone"></i> +62 123 456 7890</p>
                <p><i class="fas fa-envelope"></i> info@kaylarentcar.com</p>
            </div>
            <div class="footer-section">
                <h4>Sosial Media</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Kayla Rentcar. All rights reserved.</p>
        </div>
    </footer>

    <script src="/js/calculator.js"></script>
</body>
</html>
