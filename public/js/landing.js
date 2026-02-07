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
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

document.querySelectorAll('.scroll-fade').forEach(el => {
    observer.observe(el);
});

// Counter animation
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

// Vehicle Slider
let vehicleCurrentSlide = 0;
const vehicleCards = document.querySelectorAll('.vehicle-card');
const vehicleTotalSlides = vehicleCards.length;

function getItemsPerView() {
    if (window.innerWidth <= 767) return 1;
    if (window.innerWidth <= 1024) return 2;
    return 4;
}

function getItemWidth() {
    if (window.innerWidth <= 767) return 100;
    if (window.innerWidth <= 1024) return 50;
    return 25;
}

let itemsPerView = getItemsPerView();
let maxVehicleSlide = Math.max(0, vehicleTotalSlides - itemsPerView);

function initSlider() {
    const dotsContainer = document.getElementById('sliderDots');
    dotsContainer.innerHTML = ''; // Clear existing dots
    
    // Recalculate based on current window size
    itemsPerView = getItemsPerView();
    maxVehicleSlide = Math.max(0, vehicleTotalSlides - itemsPerView);
    
    for (let i = 0; i <= maxVehicleSlide; i++) {
        const dot = document.createElement('div');
        dot.className = `slider-dot ${i === 0 ? 'active' : ''}`;
        dot.onclick = () => goToVehicleSlide(i);
        dotsContainer.appendChild(dot);
    }
    vehicleCurrentSlide = 0;
    updateVehicleSlider();
}

function updateVehicleSlider() {
    const slider = document.querySelector('.vehicles-slider');
    const container = document.querySelector('.vehicles-slider-container');
    
    if (!container || !slider) return;
    
    // Calculate gap in pixels
    let gapPx;
    if (window.innerWidth <= 767) {
        gapPx = 16; // 1rem
    } else if (window.innerWidth <= 1024) {
        gapPx = 24; // 1.5rem
    } else {
        gapPx = 32; // 2rem
    }
    
    // Get actual card width from DOM (most reliable method)
    const firstCard = document.querySelector('.vehicle-card');
    if (!firstCard) return;
    
    const cardWidthPx = firstCard.offsetWidth;
    
    // Offset = current slide number * (card width + gap between cards)
    const offsetPx = -(vehicleCurrentSlide * (cardWidthPx + gapPx));
    slider.style.transform = `translateX(${offsetPx}px)`;
    
    document.querySelectorAll('.slider-dot').forEach((dot, index) => {
        dot.classList.toggle('active', index === vehicleCurrentSlide);
    });
}

function nextVehicle() {
    vehicleCurrentSlide = (vehicleCurrentSlide + 1) % (maxVehicleSlide + 1);
    updateVehicleSlider();
}

function prevVehicle() {
    vehicleCurrentSlide = (vehicleCurrentSlide - 1 + (maxVehicleSlide + 1)) % (maxVehicleSlide + 1);
    updateVehicleSlider();
}

function goToVehicleSlide(index) {
    vehicleCurrentSlide = index;
    updateVehicleSlider();
}

// Touch/Swipe functionality for mobile
let touchStartX = 0;
let touchEndX = 0;
const swipeThreshold = 50; // Minimum swipe distance in pixels

function handleSwipe() {
    const difference = touchStartX - touchEndX;
    
    if (Math.abs(difference) > swipeThreshold) {
        if (difference > 0) {
            // Swiped left - show next vehicle
            nextVehicle();
        } else {
            // Swiped right - show previous vehicle
            prevVehicle();
        }
    }
}

// Initialize slider when page loads
document.addEventListener('DOMContentLoaded', function() {
    initSlider();
    
    // Add touch listeners to slider container
    const sliderContainer = document.querySelector('.vehicles-slider-container');
    if (sliderContainer) {
        sliderContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);
        
        sliderContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);
    }
});

// Re-initialize slider on window resize
window.addEventListener('resize', () => {
    const newItemsPerView = getItemsPerView();
    if (newItemsPerView !== itemsPerView) {
        initSlider();
    }
});

// Rental Slider

// Grid layout for rental types (no slider needed)
document.addEventListener('DOMContentLoaded', () => {
    initSlider();
    
    // Initialize hardware acceleration for vehicle cards
    const vehicleCards = document.querySelectorAll('.vehicle-card');
    vehicleCards.forEach(card => {
        card.style.willChange = 'transform';
        card.style.backfaceVisibility = 'hidden';
        card.style.transform = 'translateZ(0)';
        card.style.perspective = '1000px';
    });
    
    const vehicleSlider = document.querySelector('.vehicles-slider');
    if (vehicleSlider) {
        vehicleSlider.style.willChange = 'transform';
        vehicleSlider.style.backfaceVisibility = 'hidden';
    }
});

// Re-initialize slider on window resize
window.addEventListener('resize', () => {
    const newItemsPerView = getItemsPerView();
    if (newItemsPerView !== itemsPerView) {
        initSlider();
    }
});
