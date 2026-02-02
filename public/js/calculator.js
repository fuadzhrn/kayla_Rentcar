// Vehicle data
const vehicleData = {
    'Honda Civic': {
        price: 450000,
        passengers: '5 Penumpang',
        transmission: 'Manual',
        ac: 'AC Dingin'
    },
    'Toyota Avanza': {
        price: 550000,
        passengers: '7 Penumpang',
        transmission: 'Otomatis',
        ac: 'AC Dingin'
    },
    'Toyota Innova': {
        price: 750000,
        passengers: '8 Penumpang',
        transmission: 'Otomatis',
        ac: 'AC Dingin'
    },
    'BMW X3': {
        price: 1200000,
        passengers: '5 Penumpang',
        transmission: 'Otomatis',
        ac: 'AC Dingin'
    }
};

let selectedVehicle = null;
let selectedPrice = 0;

// Initialize calculator
function initCalculator() {
    // Get vehicle from URL params or localStorage
    const urlParams = new URLSearchParams(window.location.search);
    const vehicleName = urlParams.get('vehicle') || localStorage.getItem('selectedVehicle');
    
    if (vehicleName && vehicleData[vehicleName]) {
        selectVehicle(vehicleName);
    }
}

function selectVehicle(vehicleName) {
    const vehicle = vehicleData[vehicleName];
    
    selectedVehicle = vehicleName;
    selectedPrice = vehicle.price;
    
    // Update display
    document.getElementById('vehicleName').textContent = vehicleName;
    document.getElementById('vehiclePrice').textContent = `Rp ${formatCurrency(vehicle.price)}/hari`;
    document.getElementById('vehiclePassengers').textContent = `<i class="fas fa-users"></i> ${vehicle.passengers}`;
    document.getElementById('vehicleTransmission').textContent = `<i class="fas fa-gear"></i> ${vehicle.transmission}`;
    document.getElementById('vehicleAC').textContent = `<i class="fas fa-snowflake"></i> ${vehicle.ac}`;
    document.getElementById('pricePerDay').textContent = `Rp ${formatCurrency(vehicle.price)}`;
    
    // Update breakdown
    document.getElementById('breakdownPricePerDay').textContent = formatCurrency(vehicle.price);
    
    // Store for later
    localStorage.setItem('selectedVehicle', vehicleName);
    
    // Recalculate if dates are set
    calculateTotal();
}

function calculateTotal() {
    if (!selectedVehicle) {
        alert('Silakan pilih kendaraan terlebih dahulu');
        window.location.href = '/#vehicles';
        return;
    }
    
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    
    if (!startDate || !endDate) {
        document.getElementById('durationDays').textContent = '0';
        document.getElementById('totalPrice').textContent = 'Rp -';
        document.getElementById('breakdownSubtotal').textContent = 'Rp 0';
        document.getElementById('breakdownTotal').textContent = 'Rp 0';
        return;
    }
    
    // Calculate days
    const start = new Date(startDate);
    const end = new Date(endDate);
    const timeDiff = end - start;
    const dayDiff = timeDiff / (1000 * 60 * 60 * 24);
    
    if (dayDiff < 0) {
        alert('Tanggal akhir harus lebih besar dari tanggal mulai');
        document.getElementById('endDate').value = '';
        return;
    }
    
    const days = Math.max(1, Math.ceil(dayDiff));
    const total = selectedPrice * days;
    
    // Update display
    document.getElementById('durationDays').textContent = days;
    document.getElementById('totalPrice').textContent = `Rp ${formatCurrency(total)}`;
    document.getElementById('breakdownDays').textContent = days;
    document.getElementById('breakdownSubtotal').textContent = `Rp ${formatCurrency(total)}`;
    document.getElementById('breakdownTotal').textContent = `Rp ${formatCurrency(total)}`;
}

function formatCurrency(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function resetCalculator() {
    document.getElementById('startDate').value = '';
    document.getElementById('endDate').value = '';
    calculateTotal();
}

function bookNow() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    
    if (!startDate || !endDate) {
        alert('Silakan isi tanggal mulai dan akhir sewa');
        return;
    }
    
    if (!selectedVehicle) {
        alert('Silakan pilih kendaraan');
        return;
    }
    
    const days = Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24));
    const total = selectedPrice * Math.max(1, days);
    
    // Store booking data
    const bookingData = {
        vehicle: selectedVehicle,
        price: selectedPrice,
        startDate: startDate,
        endDate: endDate,
        days: Math.max(1, days),
        total: total
    };
    
    localStorage.setItem('bookingData', JSON.stringify(bookingData));
    
    // Show confirmation (in production, redirect to checkout)
    alert(`Pesanan berhasil!\n\nKendaraan: ${selectedVehicle}\nTanggal: ${startDate} s/d ${endDate}\nTotal: Rp ${formatCurrency(total)}\n\nMencoba menghubungi customer service...`);
    
    // In production, you would redirect to checkout page
    // window.location.href = '/checkout';
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initCalculator);

// Navigation
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
