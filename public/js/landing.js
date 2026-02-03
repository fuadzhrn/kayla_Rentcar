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
const itemsPerView = 4;
const maxVehicleSlide = Math.max(0, vehicleTotalSlides - itemsPerView);

function initSlider() {
    const dotsContainer = document.getElementById('sliderDots');
    for (let i = 0; i <= maxVehicleSlide; i++) {
        const dot = document.createElement('div');
        dot.className = `slider-dot ${i === 0 ? 'active' : ''}`;
        dot.onclick = () => goToVehicleSlide(i);
        dotsContainer.appendChild(dot);
    }
    updateVehicleSlider();
}

function updateVehicleSlider() {
    const slider = document.querySelector('.vehicles-slider');
    const offset = -vehicleCurrentSlide * (25 + 2/16) + '%';
    slider.style.transform = `translateX(${offset})`;
    
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

// Initialize slider when page loads
document.addEventListener('DOMContentLoaded', initSlider);
