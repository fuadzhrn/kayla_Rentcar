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
    
    // Check if vehicle is passed via URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const vehicleParam = urlParams.get('vehicle');
    
    if (vehicleParam) {
        // Find and select the vehicle option that matches
        const vehicleSelect = document.getElementById('vehicle');
        for (let i = 0; i < vehicleSelect.options.length; i++) {
            if (vehicleSelect.options[i].text.includes(vehicleParam)) {
                vehicleSelect.value = vehicleSelect.options[i].value;
                break;
            }
        }
    }
    
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
    const destinationGroup = document.getElementById('destinationGroup');
    
    if (service && serviceDescriptions[service]) {
        description.textContent = serviceDescriptions[service];
        serviceInfo.style.display = 'block';
    } else {
        serviceInfo.style.display = 'none';
    }
    
    // Show destination field only for "mobil-driver" service
    if (service === 'mobil-driver') {
        destinationGroup.style.display = 'block';
        document.getElementById('destination').required = true;
    } else {
        destinationGroup.style.display = 'none';
        document.getElementById('destination').required = false;
        document.getElementById('destination').value = '';
        updateCalculator();
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
    const service = document.getElementById('service').value;
    
    // Get selected vehicle
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
    const vehicleName = selectedOption.text.split(' - ')[0];
    const pricePerDay = parseInt(selectedOption.getAttribute('data-price')) || 0;
    const days = parseInt(daysInput.value) || 1;
    
    // Get destination fee if service is mobil-driver
    let additionalFeePerDay = 0;
    let destinationLabel = '';
    
    if (service === 'mobil-driver') {
        const destinationSelect = document.getElementById('destination');
        const selectedDestination = destinationSelect.options[destinationSelect.selectedIndex];
        additionalFeePerDay = parseInt(selectedDestination.getAttribute('data-fee')) || 0;
        destinationLabel = selectedDestination.text.split(' (')[0];
    }
    
    // Update calculator display
    document.getElementById('calcVehicle').textContent = vehicleName || '-';
    document.getElementById('calcPrice').textContent = formatCurrency(pricePerDay);
    document.getElementById('calcDays').textContent = days + ' hari';
    
    // Calculate total
    const vehicleTotal = pricePerDay * days;
    const additionalFeeTotal = additionalFeePerDay * days;
    const total = vehicleTotal + additionalFeeTotal;
    
    // Update display with additional fee if applicable
    let calcDisplay = formatCurrency(total);
    if (additionalFeePerDay > 0) {
        document.getElementById('calcBreakdown').innerHTML = `
            <div class="calc-item">
                <span class="calc-label">Harga Kendaraan</span>
                <span class="calc-value">${formatCurrency(vehicleTotal)}</span>
            </div>
            <div class="calc-item">
                <span class="calc-label">Biaya ${destinationLabel}</span>
                <span class="calc-value">${formatCurrency(additionalFeeTotal)}</span>
            </div>
            <div class="calc-divider"></div>
        `;
    } else {
        document.getElementById('calcBreakdown').innerHTML = '';
    }
    
    // Update display
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
    const nama = document.getElementById('nama').value.trim();
    const whatsapp = document.getElementById('whatsapp').value.trim();
    const email = document.getElementById('email').value.trim();
    const serviceCode = document.getElementById('service').value;
    const serviceLabel = document.getElementById('service').options[document.getElementById('service').selectedIndex].text;
    const vehicleSelect = document.getElementById('vehicle');
    const vehicleLabel = vehicleSelect.options[vehicleSelect.selectedIndex].text;
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    const days = document.getElementById('days').value;
    
    // Get destination if applicable
    let destinationLabel = '';
    let destinationInfo = '';
    if (serviceCode === 'mobil-driver') {
        const destinationSelect = document.getElementById('destination');
        destinationLabel = destinationSelect.options[destinationSelect.selectedIndex].text;
        destinationInfo = '\nTujuan Perjalanan: ' + destinationLabel;
    }
    
    // Validate required fields
    if (!nama) {
        alert('⚠️ Nama lengkap harus diisi!');
        document.getElementById('nama').focus();
        return;
    }
    
    if (!whatsapp) {
        alert('⚠️ Nomor WhatsApp harus diisi!');
        document.getElementById('whatsapp').focus();
        return;
    }
    
    if (!serviceCode) {
        alert('⚠️ Jenis layanan harus dipilih!');
        document.getElementById('service').focus();
        return;
    }
    
    // Validate destination is selected if service is mobil-driver
    if (serviceCode === 'mobil-driver') {
        const destination = document.getElementById('destination').value;
        if (!destination) {
            alert('⚠️ Tujuan perjalanan harus dipilih untuk layanan Mobil + Driver!');
            document.getElementById('destination').focus();
            return;
        }
    }
    
    if (!vehicleSelect.value) {
        alert('⚠️ Kendaraan harus dipilih!');
        document.getElementById('vehicle').focus();
        return;
    }
    
    if (!checkin) {
        alert('⚠️ Tanggal sewa harus dipilih!');
        document.getElementById('checkin').focus();
        return;
    }
    
    if (!checkout) {
        alert('⚠️ Tanggal kembali harus dipilih!');
        document.getElementById('checkout').focus();
        return;
    }
    
    // Get calculator values
    const totalText = document.getElementById('calcTotal').textContent;
    const pricePerDay = document.getElementById('calcPrice').textContent;
    
    // Map service code to friendly name
    const serviceNames = {
        'lepas-kunci': 'Lepas Kunci (Sewa tanpa pengemudi)',
        'mobil-driver': 'Mobil + Driver Profesional'
    };
    
    const serviceName = serviceNames[serviceCode] || serviceCode;
    
    // Build WhatsApp message with better formatting
    const message = `
════════════════════════════════════════
     FORMULIR SEWA MOBIL - KALYA RENTCAR
════════════════════════════════════════

DATA PEMESAN
Nama Lengkap: ${nama}
No WhatsApp: ${whatsapp}
Email: ${email ? email : '(tidak diisi)'}

DETAIL PEMESANAN
Jenis Layanan: ${serviceName}
Kendaraan: ${vehicleLabel}
Harga Per Hari: ${pricePerDay}${destinationInfo}
Tanggal Mulai: ${formatDate(checkin)}
Tanggal Kembali: ${formatDate(checkout)}
Durasi Sewa: ${days} hari

RINGKASAN BIAYA
Total Biaya: ${totalText}

════════════════════════════════════════

Terima kasih telah memilih Kalya Rentcar!
Kami akan segera mengkonfirmasi ketersediaan kendaraan dan menghubungi Anda.

Salam,
Admin Kalya Rentcar
`.trim();
    
    // Get admin WhatsApp number
    const adminNumber = '6282156970588'; // Nomor Kalya Rentcar
    
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
