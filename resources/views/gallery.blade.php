<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Kayla Rentcar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/gallery.css">
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

    <!-- GALLERY HEADER -->
    <div class="gallery-header">
        <h1>Gallery <span>Kayla Rentcar</span></h1>
        <p>Dokumentasi lengkap armada dan layanan kami</p>
    </div>

    <!-- GALLERY FILTERS -->
    <div class="gallery-container">
        <div class="gallery-filters">
            <button class="filter-btn active" data-filter="all">
                <i class="fas fa-th"></i> Semua
            </button>
            <button class="filter-btn" data-filter="interior">
                <i class="fas fa-chair"></i> Interior
            </button>
            <button class="filter-btn" data-filter="exterior">
                <i class="fas fa-car"></i> Exterior
            </button>
            <button class="filter-btn" data-filter="event">
                <i class="fas fa-camera"></i> Event
            </button>
            <button class="filter-btn" data-filter="fasilitas">
                <i class="fas fa-cogs"></i> Fasilitas
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
                <i class="fas fa-chevron-left"></i> Sebelumnya
            </button>
            <span class="pagination-info">
                Halaman <span id="currentPage">1</span> dari <span id="totalPages">2</span>
            </span>
            <button class="pagination-btn" id="nextBtn" onclick="nextPage()">
                Berikutnya <i class="fas fa-chevron-right"></i>
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

    <script src="/js/gallery.js"></script>
</body>
</html>
