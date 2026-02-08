// Burger Menu Toggle
document.addEventListener('DOMContentLoaded', () => {
    const burgerMenu = document.getElementById('burgerMenu');
    const navLinks = document.getElementById('navLinks');

    if (burgerMenu && navLinks) {
        burgerMenu.addEventListener('click', () => {
            burgerMenu.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Close menu when clicking on a link
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                burgerMenu.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });
    }
});

// Loading Screen
document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen = document.getElementById('loadingScreen');
    
    // Hide loading screen after 3 seconds
    setTimeout(() => {
        loadingScreen.classList.add('hidden');
    }, 3000);
});

// Scroll fade animation
const observerOptions = {
    threshold: [0, 0.1, 0.25],
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.remove('lazy');
            entry.target.classList.add('visible');
        } else {
            entry.target.classList.add('lazy');
            entry.target.classList.remove('visible');
        }
    });
}, observerOptions);

function initializeScrollFade() {
    const scrollFadeElements = document.querySelectorAll('.scroll-fade');
    
    if (scrollFadeElements.length > 0) {
        scrollFadeElements.forEach((el) => {
            // Ensure element starts visible
            el.classList.add('visible');
            el.classList.remove('lazy');
            
            // Observe for future viewport changes
            observer.observe(el);
        });
    }
}

// Call on DOMContentLoaded
document.addEventListener('DOMContentLoaded', initializeScrollFade);

// Also call on window load as backup
window.addEventListener('load', initializeScrollFade);

// Call immediately if DOM is already loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeScrollFade);
} else {
    initializeScrollFade();
}

// Counter animation
function initializeCounterAnimation() {
    const counterObserverOptions = {
        threshold: 0.5
    };

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                entry.target.classList.add('visible');
                
                // Small delay to ensure visibility before animation
                setTimeout(() => {
                    const statNumbers = entry.target.querySelectorAll('.stat-number');
                    
                    statNumbers.forEach(el => {
                        const target = parseInt(el.getAttribute('data-value'));
                        let current = 0;
                        const increment = target / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                el.textContent = target + '+';
                                clearInterval(timer);
                            } else {
                                el.textContent = Math.floor(current) + '+';
                            }
                        }, 30);
                    });
                }, 100);
                
                counterObserver.unobserve(entry.target);
            }
        });
    }, counterObserverOptions);

    const statsSection = document.querySelector('.stats');
    if (statsSection) {
        counterObserver.observe(statsSection);
    }
}

// Initialize counter on load
document.addEventListener('DOMContentLoaded', initializeCounterAnimation);
window.addEventListener('load', initializeCounterAnimation);
if (document.readyState === 'complete') {
    initializeCounterAnimation();
}

// Smooth navigation
function initializeSmoothNavigation() {
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
}

document.addEventListener('DOMContentLoaded', initializeSmoothNavigation);
window.addEventListener('load', initializeSmoothNavigation);

// Nav scroll effect
window.addEventListener('scroll', () => {
    const nav = document.querySelector('nav');
    if (window.scrollY > 50) {
        nav.style.background = 'rgba(10, 10, 10, 0.98)';
    } else {
        nav.style.background = 'rgba(10, 10, 10, 0.95)';
    }
});

// ===== VEHICLE SLIDER =====
let vehicleCurrentSlide = 0;
let vehicleTotalSlides = 0;
let vehicleItemsPerView = 4;

function getVehicleItemsPerView() {
    const width = window.innerWidth;
    if (width <= 767) return 1;  // Mobile
    if (width <= 1024) return 2; // Tablet
    return 4;                     // Desktop
}

function initVehicleSlider() {
    const vehicleCards = document.querySelectorAll('.vehicle-card');
    const dotsContainer = document.getElementById('sliderDots');
    
    if (!vehicleCards.length || !dotsContainer) return;
    
    vehicleTotalSlides = vehicleCards.length;
    vehicleItemsPerView = getVehicleItemsPerView();
    vehicleCurrentSlide = 0;
    
    // Create dots
    dotsContainer.innerHTML = '';
    const maxDots = Math.max(0, vehicleTotalSlides - vehicleItemsPerView + 1);
    
    for (let i = 0; i < maxDots; i++) {
        const dot = document.createElement('div');
        dot.className = `slider-dot ${i === 0 ? 'active' : ''}`;
        dot.onclick = () => goToVehicleSlide(i);
        dotsContainer.appendChild(dot);
    }
    
    updateVehicleSlider();
}

function updateVehicleSlider() {
    const slider = document.querySelector('.vehicles-slider');
    if (!slider) return;
    
    const cards = slider.querySelectorAll('.vehicle-card');
    if (!cards.length) return;
    
    const gapValue = window.innerWidth <= 767 ? 16 : (window.innerWidth <= 1024 ? 19.2 : 24);
    
    // Calculate card width more reliably for iOS
    let cardWidth = 0;
    if (cards[0]) {
        const style = window.getComputedStyle(cards[0]);
        const paddingLeft = parseFloat(style.paddingLeft) || 0;
        const paddingRight = parseFloat(style.paddingRight) || 0;
        cardWidth = cards[0].offsetWidth || 0;
    }
    
    // Calculate offset with more precision
    const totalOffset = vehicleCurrentSlide * (cardWidth + gapValue);
    const offset = -totalOffset;
    
    // iOS fix: Apply transform with requestAnimationFrame
    requestAnimationFrame(() => {
        slider.style.transform = `translate3d(${offset}px, 0, 0)`;
    });
    
    // Update dots
    document.querySelectorAll('.slider-dot').forEach((dot, idx) => {
        dot.classList.toggle('active', idx === vehicleCurrentSlide);
    });
    
    // Update button states
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    const maxSlide = Math.max(0, vehicleTotalSlides - vehicleItemsPerView);
    
    if (prevBtn) prevBtn.disabled = vehicleCurrentSlide === 0;
    if (nextBtn) nextBtn.disabled = vehicleCurrentSlide >= maxSlide;
}

function nextVehicle() {
    const maxSlide = Math.max(0, vehicleTotalSlides - vehicleItemsPerView);
    if (vehicleCurrentSlide < maxSlide) {
        vehicleCurrentSlide++;
        updateVehicleSlider();
    }
}

function prevVehicle() {
    if (vehicleCurrentSlide > 0) {
        vehicleCurrentSlide--;
        updateVehicleSlider();
    }
}

function goToVehicleSlide(index) {
    const maxSlide = Math.max(0, vehicleTotalSlides - vehicleItemsPerView);
    vehicleCurrentSlide = Math.max(0, Math.min(index, maxSlide));
    updateVehicleSlider();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    initVehicleSlider();
    initSwipeListeners();
});

// Handle window resize for responsive slider
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        const newItemsPerView = getVehicleItemsPerView();
        if (newItemsPerView !== vehicleItemsPerView) {
            vehicleCurrentSlide = 0;
            initVehicleSlider();
            initSwipeListeners(); // Reinit swipe listeners for new breakpoint
        } else {
            updateVehicleSlider();
        }
    }, 250);
});

// ===== TOUCH/SWIPE FUNCTIONALITY =====
let touchStartX = 0;
let touchEndX = 0;
let isDragging = false;

function handleSwipe() {
    const swipeThreshold = 50; // Minimum distance untuk trigger swipe
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            // Swipe left - next slide
            nextVehicle();
        } else {
            // Swipe right - previous slide
            prevVehicle();
        }
    }
}

function initSwipeListeners() {
    const slider = document.querySelector('.vehicles-slider');
    if (!slider) return;
    
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        isDragging = true;
    }, false);
    
    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        isDragging = false;
        handleSwipe();
    }, false);
}
