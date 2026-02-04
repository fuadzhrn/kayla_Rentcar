// ========== BURGER MENU TOGGLE ==========
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

// ========== SERVICE DESCRIPTIONS ==========
const serviceDescriptions = {
    'lepas-kunci': 'Sewa mobil tanpa pengemudi. Anda bisa langsung membawa mobil pulang setelah proses pemesanan.',
    'mobil-driver': 'Sewa mobil dengan pengemudi profesional yang berpengalaman. Anda tinggal duduk dan santai.',
    'driver-only': 'Layanan pengemudi saja. Anda bisa menggunakan kendaraan pribadi atau rental dengan driver kami.',
    'antar-jemput': 'Layanan khusus antar-jemput ke bandara dengan pengemudi profesional yang terpercaya.'
};

// ========== INITIALIZE ==========
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('checkin').setAttribute('min', today);
    document.getElementById('checkout').setAttribute('min', today);
    
    // Add event listeners
    document.getElementById('vehicle').addEventListener('change', updateCalculator);
    document.getElementById('checkin').addEventListener('change', calculateDays);
    document.getElementById('checkout').addEventListener('change', calculateDays);
    document.getElementById('rentalForm').addEventListener('submit', handleFormSubmit);
});

// ========== SERVICE INFO UPDATE ==========
function updateServiceInfo() {
    const service = document.getElementById('service').value;
    const serviceInfo = document.getElementById('serviceInfo');
    const description = document.getElementById('serviceDescription');
    
    if (service && serviceDescriptions[service]) {
        description.textContent = serviceDescriptions[service];
        serviceInfo.style.display = 'block';
    } else {
        serviceInfo.style.display = 'none';
    }
}

// ========== CALCULATE DAYS ==========
function calculateDays() {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const daysInput = document.getElementById('days');
    
    if (checkinInput.value && checkoutInput.value) {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        
        // Calculate difference in milliseconds and convert to days
        const diffTime = checkout - checkin;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays > 0) {
            daysInput.value = diffDays;
            updateCalculator();
        } else if (diffDays === 0) {
            daysInput.value = 1;
            updateCalculator();
        }
    }
}

// ========== UPDATE CALCULATOR ==========
function updateCalculator() {
    const vehicleSelect = document.getElementById('vehicle');
    const daysInput = document.getElementById('days');
    
    // Get selected vehicle
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
    const vehicleName = selectedOption.text.split(' - ')[0];
    const pricePerDay = parseInt(selectedOption.getAttribute('data-price')) || 0;
    const days = parseInt(daysInput.value) || 1;
    
    // Update calculator display
    document.getElementById('calcVehicle').textContent = vehicleName || '-';
    document.getElementById('calcPrice').textContent = formatCurrency(pricePerDay);
    document.getElementById('calcDays').textContent = days + ' hari';
    
    // Calculate values
    const subtotal = pricePerDay * days;
    const insurance = Math.ceil(subtotal * 0.1); // 10% insurance
    const adminFee = 25000;
    const total = subtotal + insurance + adminFee;
    
    // Update breakdown
    document.getElementById('calcSubtotal').textContent = formatCurrency(subtotal);
    document.getElementById('calcInsurance').textContent = formatCurrency(insurance);
    document.getElementById('calcAdmin').textContent = formatCurrency(adminFee);
    document.getElementById('calcTotal').textContent = formatCurrency(total);
}

// ========== FORMAT CURRENCY ==========
function formatCurrency(value) {
    if (value === 0) return 'Rp 0';
    return 'Rp ' + value.toLocaleString('id-ID');
}

// ========== HANDLE FORM SUBMIT ==========
function handleFormSubmit(e) {
    e.preventDefault();
    
    // Get form values
    const nama = document.getElementById('nama').value;
    const whatsapp = document.getElementById('whatsapp').value;
    const email = document.getElementById('email').value;
    const service = document.getElementById('service').value;
    const vehicle = document.getElementById('vehicle').value;
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    const days = document.getElementById('days').value;
    
    // Validate required fields
    if (!nama || !whatsapp || !service || !vehicle || !checkin || !checkout) {
        alert('Mohon lengkapi semua data yang required');
        return;
    }
    
    // Get calculator values
    const total = document.getElementById('calcTotal').textContent;
    
    // Build WhatsApp message
    const message = `
*PERMINTAAN SEWA MOBIL - KALYA RENTCAR*

*DATA PEMESAN:*
Nama: ${nama}
WhatsApp: ${whatsapp}
Email: ${email || '-'}

*DETAIL SEWA:*
Layanan: ${service}
Kendaraan: ${document.getElementById('vehicle').options[document.getElementById('vehicle').selectedIndex].text}
Tanggal Sewa: ${formatDate(checkin)}
Tanggal Kembali: ${formatDate(checkout)}
Durasi: ${days} hari

*TOTAL BIAYA:* ${total}

Mohon konfirmasi ketersediaan kendaraan dan proses lebih lanjut.
`.trim();
    
    // Get admin WhatsApp number
    const adminNumber = '628123456789'; // Change this to actual admin number
    
    // Create WhatsApp link
    const whatsappLink = `https://wa.me/${adminNumber}?text=${encodeURIComponent(message)}`;
    
    // Open WhatsApp
    window.open(whatsappLink, '_blank');
}

// ========== FORMAT DATE ==========
function formatDate(dateString) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}
