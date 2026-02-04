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

    <!-- GALLERY FILTERS -->
    <div class="gallery-container">
        <div class="gallery-filters">
            <button class="filter-btn active" data-filter="all">
                <i class="fas fa-th"></i> Semua
            </button>
        </div>

        <!-- GALLERY GRID -->
        <div class="gallery-grid">
            <!-- Interior Photos -->
            <div class="gallery-item" data-category="interior">
                <img src="https://via.placeholder.com/400x300?text=Interior+1" alt="Interior 1">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="interior">
                <img src="https://via.placeholder.com/400x300?text=Interior+2" alt="Interior 2">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="interior">
                <img src="https://via.placeholder.com/400x300?text=Interior+3" alt="Interior 3">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="interior">
                <img src="https://via.placeholder.com/400x300?text=Interior+4" alt="Interior 4">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Exterior Photos -->
            <div class="gallery-item" data-category="exterior">
                <img src="https://via.placeholder.com/400x300?text=Exterior+1" alt="Exterior 1">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="exterior">
                <img src="https://via.placeholder.com/400x300?text=Exterior+2" alt="Exterior 2">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="exterior">
                <img src="https://via.placeholder.com/400x300?text=Exterior+3" alt="Exterior 3">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="exterior">
                <img src="https://via.placeholder.com/400x300?text=Exterior+4" alt="Exterior 4">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Event Photos -->
            <div class="gallery-item" data-category="event">
                <img src="https://via.placeholder.com/400x300?text=Event+1" alt="Event 1">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="event">
                <img src="https://via.placeholder.com/400x300?text=Event+2" alt="Event 2">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="event">
                <img src="https://via.placeholder.com/400x300?text=Event+3" alt="Event 3">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="event">
                <img src="https://via.placeholder.com/400x300?text=Event+4" alt="Event 4">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Fasilitas Photos -->
            <div class="gallery-item" data-category="fasilitas">
                <img src="https://via.placeholder.com/400x300?text=Fasilitas+1" alt="Fasilitas 1">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="fasilitas">
                <img src="https://via.placeholder.com/400x300?text=Fasilitas+2" alt="Fasilitas 2">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="fasilitas">
                <img src="https://via.placeholder.com/400x300?text=Fasilitas+3" alt="Fasilitas 3">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-item" data-category="fasilitas">
                <img src="https://via.placeholder.com/400x300?text=Fasilitas+4" alt="Fasilitas 4">
                <div class="gallery-overlay">
                    <button class="view-btn" onclick="openLightbox(this)">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>
            </div>
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

    <script src="/js/gallery.js"></script>
</body>
</html>
