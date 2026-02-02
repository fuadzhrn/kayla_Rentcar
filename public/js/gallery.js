// Gallery Filter and Pagination
const filterBtns = document.querySelectorAll('.filter-btn');
const galleryItems = document.querySelectorAll('.gallery-item');
const itemsPerPage = 12;
let currentPage = 1;
let currentFilter = 'all';
let filteredItems = [];

function initGallery() {
    updateFilteredItems();
    updatePagination();
}

function updateFilteredItems() {
    if (currentFilter === 'all') {
        filteredItems = Array.from(galleryItems);
    } else {
        filteredItems = Array.from(galleryItems).filter(item => 
            item.getAttribute('data-category') === currentFilter
        );
    }
    currentPage = 1;
    displayPage(currentPage);
}

function displayPage(page) {
    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
    
    // Validate page number
    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;
    
    currentPage = page;
    
    // Hide all items
    galleryItems.forEach(item => item.classList.add('hide'));
    
    // Show items for current page
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    filteredItems.slice(startIndex, endIndex).forEach((item, index) => {
        item.classList.remove('hide');
        item.style.animation = `fadeInUp 0.6s ease-out ${index * 0.1}s both`;
    });
    
    // Update pagination controls
    updatePagination();
    
    // Scroll to gallery
    document.querySelector('.gallery-grid').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function updatePagination() {
    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
    document.getElementById('currentPage').textContent = currentPage;
    document.getElementById('totalPages').textContent = totalPages;
    document.getElementById('prevBtn').disabled = currentPage === 1;
    document.getElementById('nextBtn').disabled = currentPage === totalPages;
}

function nextPage() {
    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
    if (currentPage < totalPages) {
        displayPage(currentPage + 1);
    }
}

function previousPage() {
    if (currentPage > 1) {
        displayPage(currentPage - 1);
    }
}

// Filter button click handler
filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const filterValue = btn.getAttribute('data-filter');
        
        // Update active button
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        // Update filter and display
        currentFilter = filterValue;
        updateFilteredItems();
    });
});

// Lightbox functionality
let currentImageIndex = 0;
const allImages = [];

function initLightboxImages() {
    const visibleImages = Array.from(galleryItems).filter(item => !item.classList.contains('hide'));
    allImages.length = 0;
    visibleImages.forEach(item => {
        const img = item.querySelector('img');
        if (img) allImages.push(img.src);
    });
}

function openLightbox(button) {
    initLightboxImages();
    const gallery = button.closest('.gallery-item');
    const img = gallery.querySelector('img');
    currentImageIndex = allImages.indexOf(img.src);
    
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    lightboxImage.src = img.src;
    lightbox.classList.add('active');
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.remove('active');
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % allImages.length;
    document.getElementById('lightboxImage').src = allImages[currentImageIndex];
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + allImages.length) % allImages.length;
    document.getElementById('lightboxImage').src = allImages[currentImageIndex];
}

// Keyboard navigation for lightbox
document.addEventListener('keydown', (e) => {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('active')) return;
    
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
    if (e.key === 'Escape') closeLightbox();
});

// Close lightbox on background click
document.getElementById('lightbox').addEventListener('click', (e) => {
    if (e.target.id === 'lightbox') closeLightbox();
});

// Smooth navigation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            const target = document.querySelector(href);
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// Nav scroll effect
window.addEventListener('scroll', () => {
    const nav = document.querySelector('nav');
    if (window.scrollY > 50) {
        nav.style.background = 'rgba(10, 10, 10, 0.98)';
    } else {
        nav.style.background = 'rgba(10, 10, 10, 0.95)';
    }
});

// Initialize gallery on page load
document.addEventListener('DOMContentLoaded', initGallery);
