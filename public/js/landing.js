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
let currentSlide = 0;
const vehicleCards = document.querySelectorAll('.vehicle-card');
const totalSlides = vehicleCards.length;
const itemsPerView = 4;
const maxSlide = Math.max(0, totalSlides - itemsPerView);

function initSlider() {
    const dotsContainer = document.getElementById('sliderDots');
    for (let i = 0; i <= maxSlide; i++) {
        const dot = document.createElement('div');
        dot.className = `slider-dot ${i === 0 ? 'active' : ''}`;
        dot.onclick = () => goToSlide(i);
        dotsContainer.appendChild(dot);
    }
    updateSlider();
}

function updateSlider() {
    const slider = document.querySelector('.vehicles-slider');
    const offset = -currentSlide * (25 + 2/16) + '%';
    slider.style.transform = `translateX(${offset})`;
    
    document.querySelectorAll('.slider-dot').forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });
}

function nextVehicle() {
    currentSlide = (currentSlide + 1) % (maxSlide + 1);
    updateSlider();
}

function prevVehicle() {
    currentSlide = (currentSlide - 1 + (maxSlide + 1)) % (maxSlide + 1);
    updateSlider();
}

function goToSlide(index) {
    currentSlide = index;
    updateSlider();
}

// Initialize slider when page loads
document.addEventListener('DOMContentLoaded', initSlider);

// Card Stack Carousel with Fan Layout
let cardOrder = [0, 1, 2]; // Index dari card-back, card-front, card-middle

function updateCardPositions() {
    const cards = document.querySelectorAll('.card');
    
    const positions = [
        { class: 'card-back', rotation: -20, left: 20, opacity: 0.7, scale: 0.9, zIndex: 10 },
        { class: 'card-front', rotation: 0, left: 85, opacity: 1, scale: 1, zIndex: 30 },
        { class: 'card-middle', rotation: 20, left: 150, opacity: 0.85, scale: 0.95, zIndex: 20 }
    ];
    
    cards.forEach((card, index) => {
        card.classList.remove('card-front', 'card-middle', 'card-back');
        const pos = positions[cardOrder[index]];
        card.classList.add(pos.class);
        card.style.zIndex = pos.zIndex;
    });
}



function rotateCards(direction) {
    if (direction === 'left') {
        // Swipe ke kiri: back→front→middle→back
        cardOrder = [cardOrder[1], cardOrder[2], cardOrder[0]];
    } else {
        // Swipe ke kanan: front→back→middle→front
        cardOrder = [cardOrder[2], cardOrder[0], cardOrder[1]];
    }
    
    updateCardPositions();
}

// Mouse drag detection
let startX = 0;
let isDragging = false;

const cardStack = document.getElementById('cardStack');

cardStack.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.clientX;
});

document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    
    const currentX = e.clientX;
    const distance = currentX - startX;
    
    // Threshold: minimal 50px swipe
    if (Math.abs(distance) > 50) {
        isDragging = false;
        
        if (distance > 0) {
            // Swipe ke kanan
            rotateCards('right');
        } else {
            // Swipe ke kiri
            rotateCards('left');
        }
    }
});

document.addEventListener('mouseup', () => {
    isDragging = false;
});

// Initialize card stack on page load
document.addEventListener('DOMContentLoaded', () => {
    updateCardPositions();
});
