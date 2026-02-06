# Panduan Login & Register - Kayla Rentcar Admin

## 🔑 Membuat Akun (Register)

### Langkah-Langkah:
1. Buka halaman register: `/register`
2. Isi form dengan informasi berikut:

#### **Nama Lengkap**
- Hanya boleh mengandung: huruf (A-Z, a-z), spasi, tanda kutip ('), tanda hubung (-)
- Contoh yang valid: `John Doe`, `Muhammad Ali`, `O'Brien`, `Mary-Jane`
- Contoh yang TIDAK valid: `John123`, `Admin@User`, `Test<script>`

#### **Email**
- Format harus valid: `nama@domain.com`
- Contoh: `admin@kalyarentcar.com`
- Email harus unik (belum pernah didaftar)
- Tidak boleh lebih dari 255 karakter

#### **Password**
Password harus kuat dengan syarat-syarat berikut:
- ✓ Minimal 8 karakter
- ✓ Mengandung minimal 1 huruf BESAR (A-Z)
- ✓ Mengandung minimal 1 huruf kecil (a-z)
- ✓ Mengandung minimal 1 angka (0-9)
- ✓ Mengandung minimal 1 simbol (@$!%*?&)

**Contoh Password VALID:**
- `MyPassword123@` ✓
- `Admin@2024Rental` ✓
- `SecurePass$99` ✓
- `Kayla@RentCar2024` ✓

**Contoh Password TIDAK VALID:**
- `password123` ❌ (tidak ada huruf besar, tidak ada simbol)
- `PASSWORD123@` ❌ (tidak ada huruf kecil)
- `MyPass@` ❌ (kurang dari 8 karakter)
- `MyPassword123` ❌ (tidak ada simbol)
- `12345678` ❌ (hanya angka)

#### **Konfirmasi Password**
- Harus sama persis dengan password yang Anda masukkan
- Gunakan eye icon untuk menampilkan/menyembunyikan password

### Petunjuk Membuat Password Kuat:
1. Pikirkan kata yang mudah diingat (contoh: nama mobil favorit)
2. Campurkan dengan angka (contoh: tahun)
3. Tambahkan simbol di awal atau akhir
4. Gunakan variasi huruf besar dan kecil

Contoh proses pembuatan:
```
Kata dasar: rentalcar
+ Huruf besar: RentalCar
+ Angka: RentalCar2024
+ Simbol: RentalCar2024!
Hasil: RentalCar2024! ✓
```

## 🔐 Masuk Akun (Login)

### Langkah-Langkah:
1. Buka halaman login: `/login`
2. Masukkan email yang sudah terdaftar
3. Masukkan password Anda
4. Klik tombol "Masuk"

### Tips Login:
- Jika login gagal, pastikan email dan password benar
- Gunakan "Show Password" (icon mata) untuk verifikasi password
- Checkbox "Ingat Saya" untuk tetap login di perangkat ini
- Jika lupa password, hubungi admin

## ⚠️ Pembatasan Keamanan

### Rate Limiting (Pembatasan Percobaan)

#### Login:
- **Maksimal 5 percobaan** dalam 15 menit
- Jika melampaui batas, akan muncul pesan: "Terlalu banyak percobaan login. Silakan coba lagi dalam X detik."
- Solusi: Tunggu 15 menit atau coba dari perangkat/koneksi lain

#### Register:
- **Maksimal 3 pendaftaran** dalam 60 menit dari 1 IP address
- Jika melampaui batas, akan muncul pesan: "Terlalu banyak percobaan pendaftaran. Silakan coba lagi dalam X menit."
- Solusi: Tunggu 60 menit sebelum mendaftar lagi

## 🛡️ Keamanan Input

### Input yang Ditolak:

Sistem secara otomatis akan menolak input yang mencurigakan:

#### Contoh Input Berbahaya (DITOLAK):
```
Email:
- <script>alert('xss')</script>@test.com
- admin@test.com'; DROP TABLE users; --
- admin@test

Name:
- John<script>alert('xss')</script>
- Admin'; DROP TABLE--
- Test<img src=x onerror="alert('xss')">

Password:
- admin123<script> (mengandung script tag)
- pass'; DROP-- (mengandung SQL keyword)
```

**Pesan Error:** "Mengandung karakter atau pola yang tidak diizinkan."

### Karakter yang Diizinkan:

#### Email:
- Huruf: a-z, A-Z
- Angka: 0-9
- Simbol: . (titik), _ (underscore), % (persen), + (plus), - (minus)
- Format: `nama.user+tag@domain.com`

#### Name:
- Huruf: a-z, A-Z
- Spasi
- Tanda kutip: ' (apostrophe)
- Tanda hubung: - (hyphen)
- Format: `John O'Brien-Smith`

#### Password:
- Huruf: a-z, A-Z
- Angka: 0-9
- Simbol: @ $ ! % * ? &
- Format: `MyPassword123@`

## 📱 Tips Keamanan untuk User

### ✓ LAKUKAN:
1. ✓ Gunakan password yang kuat dan unik
2. ✓ Jangan bagikan password dengan siapa pun
3. ✓ Logout setelah selesai (terutama di perangkat publik)
4. ✓ Gunakan password manager untuk menyimpan password
5. ✓ Perbarui password secara berkala (setidaknya 3 bulan sekali)
6. ✓ Verifikasi bahwa Anda di website yang benar sebelum login

### ✗ JANGAN:
1. ✗ Jangan gunakan password yang sama dengan akun lain
2. ✗ Jangan simpan password di file teks atau sticky note
3. ✗ Jangan login dari computer publik tanpa logout
4. ✗ Jangan bagikan link login dengan orang yang tidak perlu
5. ✗ Jangan klik link login dari email yang mencurigakan
6. ✗ Jangan gunakan password yang terlalu sederhana (nama/tanggal lahir)

## 🆘 Troubleshooting

### Error: "Email atau password salah"
**Penyebab:**
- Email tidak terdaftar
- Password yang dimasukkan salah
- Typo pada email/password

**Solusi:**
1. Verifikasi email Anda dengan benar
2. Gunakan "Show Password" untuk mengecek password
3. Pastikan Caps Lock tidak aktif
4. Cek apakah email sudah terdaftar dengan register

### Error: "Email ini sudah terdaftar"
**Penyebab:**
- Email sudah digunakan untuk mendaftar
- Mungkin Anda sudah memiliki akun

**Solusi:**
1. Gunakan email lain untuk mendaftar
2. Atau login dengan email yang sudah terdaftar
3. Hubungi admin jika lupa akun

### Error: "Password harus mengandung..."
**Penyebab:**
- Password tidak memenuhi syarat keamanan

**Solusi:**
1. Pastikan password mengandung huruf besar (A-Z)
2. Pastikan password mengandung huruf kecil (a-z)
3. Pastikan password mengandung angka (0-9)
4. Pastikan password mengandung simbol (@$!%*?&)
5. Pastikan password minimal 8 karakter

### Error: "Terlalu banyak percobaan..."
**Penyebab:**
- Anda sudah mencoba login/register lebih dari batas yang ditentukan

**Solusi:**
- **Untuk Login:** Tunggu 15 menit sebelum mencoba lagi
- **Untuk Register:** Tunggu 60 menit sebelum mencoba lagi
- Atau gunakan IP address/perangkat yang berbeda

### Error: "Nama mengandung karakter yang tidak diizinkan"
**Penyebab:**
- Nama mengandung simbol atau karakter khusus yang tidak diizinkan

**Solusi:**
1. Gunakan hanya: Huruf (A-Z, a-z), spasi, tanda kutip ('), tanda hubung (-)
2. Contoh: `John Doe`, `Mary Jane`, `O'Brien`
3. Jangan gunakan: angka, @, #, $, !, dll

## 📞 Hubungi Admin

Jika mengalami masalah yang tidak terselesaikan:
- **WhatsApp:** 0821 5697 0588
- **Email:** admin@kalyarentcar.com
- **Jam Kerja:** Senin-Jumat, 08:00-17:00 WIB

---
**Terakhir Diperbarui:** February 6, 2026
**Versi:** 1.0
