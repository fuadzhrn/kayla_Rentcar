// ========== HANDLE RENTAL TYPE CLICK ==========
function handleRentalTypeClick(rentalType, rentalName) {
    // Types yang langsung ke WhatsApp
    const whatsappDirectTypes = [
        'driver-only',
        'antar-jemput-bandara',
        'wisata-tour-dalam-dan-luar-kota'
    ];
    
    // Check if this type should go directly to WhatsApp
    if (whatsappDirectTypes.includes(rentalType)) {
        sendWhatsAppDirectMessage(rentalType, rentalName);
    } else {
        // For other types (Lepas Kunci and Mobil + Driver), go to calculator
        window.location.href = 'calculator?service=' + rentalType;
    }
}

// ========== SEND WHATSAPP DIRECT MESSAGE ==========
function sendWhatsAppDirectMessage(rentalType, rentalName) {
    let message = '';
    
    // Template pesan sesuai tipe sewa
    if (rentalType === 'driver-only') {
        message = `
Halo Kalya Rentcar

Saya tertarik dengan layanan Driver Only.

Mohon informasi mengenai:
- Tarif per jam/hari
- Syarat dan ketentuan
- Ketersediaan pengemudi
- Proses booking

Terima kasih
        `.trim();
    } 
    else if (rentalType === 'antar-jemput-bandara') {
        message = `
Halo Kalya Rentcar

Saya ingin menggunakan layanan Antar Jemput Bandara.

Informasi yang saya butuhkan:
- Harga untuk perjalanan bandara
- Jadwal keberangkatan dan kedatangan
- Jenis kendaraan tersedia
- Proses booking dan pembayaran
- Area pelayanan

Terima kasih
        `.trim();
    } 
    else if (rentalType === 'wisata-tour-dalam-dan-luar-kota') {
        message = `
Halo Kalya Rentcar

Saya ingin mencari layanan Wisata Tour Dalam & Luar Kota.

Saya ingin bertanya tentang:
- Paket wisata yang tersedia
- Durasi dan destinasi pilihan
- Harga per paket
- Fasilitas yang disediakan
- Panduan lokal/tour guide

Mohon informasi selengkapnya
        `.trim();
    }
    
    // Get admin WhatsApp number
    const adminNumber = '6282156970588';
    
    // Create WhatsApp link
    const whatsappLink = `https://wa.me/${adminNumber}?text=${encodeURIComponent(message)}`;
    
    // Open WhatsApp
    window.open(whatsappLink, '_blank');
}
