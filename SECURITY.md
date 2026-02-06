# Dokumentasi Keamanan Login & Register

## Fitur Keamanan yang Diimplementasikan

### 1. **Server-Side Security (Backend)**

#### A. Input Validation & Sanitization
- **Email Validation:**
  - Format regex: `/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/`
  - Max length: 255 karakter
  - Hapus tag HTML otomatis dengan `strip_tags()`

- **Password Validation (Login):**
  - Minimal 6 karakter
  - Max length: 255 karakter
  - Tidak boleh mengandung script injection

- **Password Validation (Register):**
  - Minimal 8 karakter
  - Max length: 255 karakter
  - Harus mengandung: huruf besar, huruf kecil, angka, dan simbol (@$!%*?&)
  - Contoh password valid: `MyPassword123@`
  - Harus dikonfirmasi (confirm password harus sama)

- **Name Validation:**
  - Hanya huruf (A-Z, a-z), spasi, tanda kutip ('), tanda hubung (-)
  - Max length: 255 karakter
  - Format regex: `/^[a-zA-Z\s\'-]+$/`
  - Tidak boleh mengandung: `< > " ' % & ( ) ;`

#### B. Script Injection Prevention
- Custom validation rule `NoScriptInjection` yang mendeteksi dan mencegah:
  - `<script>` tags
  - JavaScript event handlers (`onclick=`, `onerror=`, dll)
  - `javascript:` protocol
  - `<iframe>`, `<object>`, `<embed>` tags
  - SQL injection attempts (`UNION SELECT`, `DROP TABLE`, dll)

#### C. Rate Limiting
- **Login:** Maximum 5 percobaan per 15 menit dari 1 IP address
  - Error message: "Terlalu banyak percobaan login. Silakan coba lagi dalam X detik."
- **Register:** Maximum 3 pendaftaran per 60 menit dari 1 IP address
  - Error message: "Terlalu banyak percobaan pendaftaran. Silakan coba lagi dalam X menit."

#### D. Password Hashing
- Menggunakan bcrypt algorithm (Laravel default)
- Password tidak pernah disimpan dalam plain text
- Method: `Hash::make($password)`

#### E. Session Security
- Session regeneration setelah login berhasil: `$request->session()->regenerate()`
- Session invalidation saat logout: `$request->session()->invalidate()`
- CSRF token regeneration otomatis

### 2. **Client-Side Security (Frontend)**

#### A. HTML5 Input Attributes
```html
<!-- Email Input -->
<input type="email" maxlength="255" required autocomplete="email" />

<!-- Password Input -->
<input type="password" maxlength="255" required autocomplete="current-password" />

<!-- Name Input (Register) -->
<input type="text" maxlength="255" pattern="^[a-zA-Z\s\'-]+$" required />
```

#### B. Form Validation
- Email: HTML5 email validation + maxlength + autocomplete
- Password: Maxlength + required
- Name: Pattern validation + maxlength
- Password confirmation matching (client-side display hint)

#### C. CSP (Content Security Policy)
Header yang ditambahkan untuk mencegah inline script execution:
```
Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net
```

### 3. **HTTP Security Headers**

Middleware `SecurityHeaders` menambahkan headers berikut:

| Header | Value | Tujuan |
|--------|-------|--------|
| X-Frame-Options | DENY | Prevent clickjacking (prevent embedding dalam iframe) |
| X-Content-Type-Options | nosniff | Prevent MIME type sniffing |
| X-XSS-Protection | 1; mode=block | Enable XSS filter di browser |
| Content-Security-Policy | (custom) | Prevent script injection |
| Referrer-Policy | strict-origin-when-cross-origin | Control referrer information |
| Permissions-Policy | geolocation=(), microphone=(), camera=() | Disable browser APIs |

### 4. **CSRF Protection**

- Laravel built-in CSRF protection dengan `@csrf` token di setiap form
- Token divalidasi sebelum memproses POST request
- Token otomatis di-regenerate setelah login/logout

## Skenario Serangan yang Dicegah

### 1. **XSS (Cross-Site Scripting) Injection**
```html
<!-- Input berbahaya -->
<img src=x onerror="alert('XSS')">
<script>alert('XSS')</script>

<!-- Ditolak oleh -->
1. NoScriptInjection validation rule
2. HTML5 email input type
3. Pattern validation untuk name
4. X-XSS-Protection header
```

### 2. **SQL Injection**
```sql
-- Input berbahaya
admin@test.com'; DROP TABLE users; --

-- Ditolak oleh -->
1. Eloquent ORM (parameterized queries)
2. NoScriptInjection rule (detect SQL keywords)
3. Email format validation
```

### 3. **Brute Force Attack**
```
-- Percobaan login berulang
POST /login (5x dalam 15 menit)

-- Ditolak oleh -->
1. Rate limiting (maksimal 5 percobaan)
2. Error message yang sama untuk email tidak ada/password salah
3. IP-based throttling
```

### 4. **Weak Password**
```
-- Password lemah
password
123456
admin123

-- Ditolak oleh -->
1. Password strength validation
2. Regex pattern requirement (besar, kecil, angka, simbol)
3. Minimal 8 karakter untuk register
```

## Testing Security

### Test 1: Script Injection pada Login
```bash
Email: <script>alert('xss')</script>@test.com
Password: 123456

# Result: DITOLAK ✓
# Error: "Field email mengandung karakter atau pola yang tidak diizinkan."
```

### Test 2: SQL Injection pada Name (Register)
```bash
Name: John'; DROP TABLE users; --
Email: john@test.com
Password: MyPassword123@

# Result: DITOLAK ✓
# Error: "Nama mengandung karakter atau pola yang tidak diizinkan."
```

### Test 3: Weak Password (Register)
```bash
Name: John Doe
Email: john@test.com
Password: password123

# Result: DITOLAK ✓
# Error: "Password harus mengandung huruf besar, huruf kecil, angka, dan simbol (!@#$%^&*)."
```

### Test 4: Rate Limiting
```bash
# Percobaan login 6x dalam 15 menit dari IP yang sama
POST /login attempt 1-5: Normal attempt
POST /login attempt 6: THROTTLED ✓
# Error: "Terlalu banyak percobaan login. Silakan coba lagi dalam X detik."
```

## Best Practices untuk Admin

1. **Gunakan Password Kuat**
   - Minimal 8 karakter
   - Campuran: huruf besar, kecil, angka, simbol
   - Contoh: `MyRentcar2024!@#`

2. **Jangan Bagikan Credentials**
   - Password hanya untuk admin pribadi
   - Jangan simpan di file tidak aman

3. **Logout Setelah Selesai**
   - Selalu klik logout sebelum menutup browser
   - Apalagi di komputer publik

4. **Monitor Login Attempts**
   - Perhatikan jika ada percobaan login gagal berulang
   - Ubah password jika mencurigai akses tidak sah

## Referensi

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security](https://laravel.com/docs/security)
- [Content Security Policy](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP)
