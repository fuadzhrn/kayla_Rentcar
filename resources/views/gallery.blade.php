<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Kalya Rentcar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/gallery.css">
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

    <!-- GALLERY HEADER -->
    <div class="gallery-header">
        <h1>Gallery <span>Kalya Rentcar</span></h1>
        <p>Dokumentasi lengkap armada dan layanan kami</p>
    </div>

    <!-- GALLERY GRID -->
    <div class="gallery-container">
        <div class="gallery-grid">
            @forelse($allGalleries as $gallery)
                <div class="gallery-item" {{ $gallery->is_featured ? 'data-featured="true"' : '' }}>
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h3>{{ $gallery->title }}</h3>
                            @if($gallery->is_featured)
                                <span class="badge-featured"><i class="fas fa-star"></i> Featured</span>
                            @endif
                        </div>
                        <a href="{{ asset('storage/' . $gallery->image_path) }}" class="gallery-btn" data-lightbox="gallery" data-title="{{ $gallery->title }}">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                    <i class="fas fa-image" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                    <p style="color: #666; font-size: 18px;">Belum ada foto di galeri</p>
                </div>
            @endforelse
        </div>

        <!-- PAGINATION CONTROLS -->
        <div class="pagination-controls">
            <button class="pagination-btn" id="prevBtn" onclick="previousPage()">
                <i class="fas fa-chevron-left"></i> <span class="btn-text">Sebelumnya</span>
            </button>
            <span class="pagination-info">
                Halaman <span id="currentPage">1</span> dari <span id="totalPages">2</span>
            </span>
            <button class="pagination-btn" id="nextBtn" onclick="nextPage()">
                <span class="btn-text">Berikutnya</span> <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- LIGHTBOX MODAL -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-content">
            <button class="lightbox-close" onclick="closeLightbox()">
                <i class="fas fa-times"></i>
            </button>
            <button class="lightbox-nav prev" onclick="prevImage()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <img id="lightboxImage" src="" alt="Preview">
            <button class="lightbox-nav next" onclick="nextImage()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

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
                    <li><a href="/">Beranda</a></li>
                    <li><a href="gallery">Gallery</a></li>
                    <li><a href="/#vehicles">Kendaraan</a></li>
                    <li><a href="/#location">Alamat</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h5>Layanan</h5>
                <ul>
                    <li><a href="/#rental-types">Lepas Kunci</a></li>
                    <li><a href="/#rental-types">Mobil + Driver</a></li>
                    <li><a href="/#rental-types">Driver Only</a></li>
                    <li><a href="/#rental-types">Antar Jemput Bandara</a></li>
                    <li><a href="/#rental-types">Wisata Tour Dalam & Luar Kota</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h5>Hubungi Kami</h5>
                <ul>
                    <li><a href="tel:+62812345678"><i class="fas fa-phone"></i> 085888212282</a></li>
                    <li><a href="mailto:info@kalyarentcar.com"><i class="fas fa-envelope"></i> info@kalyarentcar.com</a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</a></li>
                    <li style="margin-top: 1rem;">
                        <a href="#" style="color: #FFD700; margin-right: 1rem;"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/kalyarentcar/" style="color: #FFD700; margin-right: 1rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color: #FFD700;"><i class="fab fa-twitter"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Kalya Rentcar. Semua hak dilindungi. | Design dengan <span style="color: #FFD700;">❤</span> untuk perjalanan Anda.</p>
        </div>
    </footer>

    <script src="/js/gallery.js"></script>
</body>
</html>
