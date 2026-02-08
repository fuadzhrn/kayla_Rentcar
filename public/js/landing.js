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

// Vehicle Slider
let vehicleCurrentSlide = 0;
let vehicleTotalSlides = 0;
let itemsPerView = 4;
let maxVehicleSlide = 0;

function getItemsPerView() {
    const width = window.innerWidth;
    if (width <= 767) return 1;
    if (width <= 1024) return 2;
    return 4;
}

function initSlider() {
    const vehicleCards = document.querySelectorAll('.vehicle-card');
    vehicleTotalSlides = vehicleCards.length;
    
    const dotsContainer = document.getElementById('sliderDots');
    if (!dotsContainer) return;
    
    dotsContainer.innerHTML = '';
    itemsPerView = getItemsPerView();
    maxVehicleSlide = Math.max(0, vehicleTotalSlides - itemsPerView);
    
    // Debug log
    console.log(`Slider initialized: totalSlides=${vehicleTotalSlides}, itemsPerView=${itemsPerView}, maxVehicleSlide=${maxVehicleSlide}`);
    
    // Create one dot per vehicle (not per page)
    for (let i = 0; i < vehicleTotalSlides; i++) {
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
    if (!slider || !container) return;
    
    // Use container width for responsive offset calculation
    const containerWidth = container.offsetWidth;
    const offset = -(vehicleCurrentSlide * containerWidth);
    
    // Debug: Show calculation
    console.log(`📊 Offset Calc: currentSlide=${vehicleCurrentSlide}, containerWidth=${containerWidth}px, offset=${offset}px`);
    
    slider.style.transform = `translateX(${offset}px)`;
    
    // Update dots
    document.querySelectorAll('.slider-dot').forEach((dot, index) => {
        dot.classList.toggle('active', index === vehicleCurrentSlide);
    });
    
    // All buttons always active (infinite carousel)
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    
    if (prevBtn) {
        prevBtn.disabled = false;
        prevBtn.style.opacity = '1';
        prevBtn.style.cursor = 'pointer';
    }
    
    if (nextBtn) {
        nextBtn.disabled = false;
        nextBtn.style.opacity = '1';
        nextBtn.style.cursor = 'pointer';
    }
}

function nextVehicle() {
    // Move to next slide
    vehicleCurrentSlide++;
    
    // Wrap around to beginning if exceeding max
    if (vehicleCurrentSlide > maxVehicleSlide) {
        vehicleCurrentSlide = 0;
        console.log(`🔁 WRAPPING FORWARD: Reset to slide 0`);
    }
    
    console.log(`→ Next: currentSlide=${vehicleCurrentSlide}, maxSlide=${maxVehicleSlide}, totalSlides=${vehicleTotalSlides}`);
    updateVehicleSlider();
}

function prevVehicle() {
    // Move to previous slide
    vehicleCurrentSlide--;
    
    // Wrap around to end if going below 0
    if (vehicleCurrentSlide < 0) {
        vehicleCurrentSlide = maxVehicleSlide;
        console.log(`🔁 WRAPPING BACKWARD: Reset to slide ${maxVehicleSlide}`);
    }
    
    console.log(`← Prev: currentSlide=${vehicleCurrentSlide}, maxSlide=${maxVehicleSlide}, totalSlides=${vehicleTotalSlides}`);
    updateVehicleSlider();
}

function goToVehicleSlide(index) {
    // Allow infinite wrapping by allowing any index
    vehicleCurrentSlide = index;
    
    // Wrap if needed
    if (vehicleCurrentSlide > maxVehicleSlide) {
        vehicleCurrentSlide = vehicleCurrentSlide % (maxVehicleSlide + 1);
    }
    if (vehicleCurrentSlide < 0) {
        vehicleCurrentSlide = maxVehicleSlide;
    }
    
    updateVehicleSlider();
}

// Swipe/Touch/Mouse Drag handling
let touchStartX = 0;
let isDragging = false;

document.addEventListener('DOMContentLoaded', function() {
    initSlider();
    
    const container = document.querySelector('.vehicles-slider-container');
    if (container) {
        // Touch events
        container.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            isDragging = true;
        }, { passive: true });
        
        container.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            const touchEndX = e.changedTouches[0].clientX;
            const difference = touchStartX - touchEndX;
            
            if (Math.abs(difference) > 50) {
                if (difference > 0) {
                    nextVehicle();  // Will wrap around automatically
                } else {
                    prevVehicle();  // Will wrap around automatically
                }
            }
            isDragging = false;
        }, { passive: true });
        
        // Mouse drag events for desktop
        container.addEventListener('mousedown', (e) => {
            touchStartX = e.clientX;
            isDragging = true;
            container.style.cursor = 'grabbing';
        });
        
        container.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
        });
        
        container.addEventListener('mouseup', (e) => {
            if (!isDragging) return;
            const touchEndX = e.clientX;
            const difference = touchStartX - touchEndX;
            
            if (Math.abs(difference) > 50) {
                if (difference > 0) {
                    nextVehicle();  // Will wrap around automatically
                } else {
                    prevVehicle();  // Will wrap around automatically
                }
            }
            isDragging = false;
            container.style.cursor = 'grab';
        });
        
        container.addEventListener('mouseleave', () => {
            isDragging = false;
            container.style.cursor = 'grab';
        });
        
        // Initial cursor style
        container.style.cursor = 'grab';
    }
});

// Handle window resize for responsive slider
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        const newItemsPerView = getItemsPerView();
        if (newItemsPerView !== itemsPerView) {
            initSlider();
        } else {
            updateVehicleSlider();
        }
    }, 250);
});
