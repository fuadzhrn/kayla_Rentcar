# OTP Verification System - Implementation Summary

## Overview
Implemented comprehensive OTP (One-Time Password) verification system for secure admin account creation in Kalya Rentcar platform.

## System Flow

### Registration Flow (3 Steps)

**Step 1: Initial Registration**
- User fills form: Name, Email, Password, Confirm Password
- Form validates input with strict rules
- On successful validation: Generate 6-digit OTP and send to email
- Rate limit: Max 3 registration attempts per 60 minutes

**Step 2: OTP Verification**
- User receives email with OTP code
- User enters 6-digit OTP in verification form
- System verifies code (max 5 attempts, 10-minute expiration)
- On success: Account created with user data
- On failure: Attempts counter incremented

**Step 3: Login**
- User logs in with created email/password account

---

## Database Schema

### otp_codes Table
```
- id: Primary Key
- email: Unique, indexed (for quick lookup)
- code: 6-digit OTP string
- user_data: JSON (stores temporary name + hashed password)
- attempts: Failed verification attempt counter (starts at 0)
- max_attempts: Maximum allowed attempts (default: 5)
- expires_at: Expiration timestamp, indexed (default: now + 10 minutes)
- created_at, updated_at: Timestamps
```

**Indexes:**
- email (UNIQUE) - Quick OTP lookup by email
- expires_at - For cleaning expired records

---

## Models

### OtpCode Model
**Location:** `app/Models/OtpCode.php`

**Fillable Fields:**
- email
- code
- user_data
- attempts
- max_attempts
- expires_at

**Casts:**
- user_data → json
- expires_at → datetime

**Methods:**
```php
isValid(): bool          // Check if OTP not expired
hasAttempts(): bool      // Check if attempts remaining
incrementAttempts(): void // Increment failed attempts
```

---

## Controllers

### AuthController
**Location:** `app/Http/Controllers/AuthController.php`

**New Methods:**

#### `register(Request $request)`
- Validates registration input with strict rules
- Generates 6-digit OTP: `str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT)`
- Creates OtpCode record with 10-minute expiration
- Sends OTP email via Mail::send()
- Stores user data (name + hashed password) in JSON
- Rate limited: 3 attempts per 60 minutes

**Validation Rules:**
- Name: Required, string, max 255, regex `/^[a-zA-Z\s\'-]+$/`, no script injection
- Email: Required, email, max 255, unique in users table, regex `/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/`
- Password: Required, 8+ chars, confirmed, regex `/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/` (must contain uppercase, lowercase, digit, symbol)

#### `showVerifyOtp(Request $request)`
- Displays OTP verification form
- Validates email exists in otp_codes table
- Returns email for form pre-fill
- Redirects to register if OTP record not found

#### `verifyOtp(Request $request)`
- Validates OTP is 6-digit number
- Finds OtpCode by email
- Checks if OTP not expired
- Checks if attempts remaining
- Compares provided code with stored code
- On success:
  - Creates User account from stored data
  - Deletes OtpCode record
  - Redirects to login with success message
- On failure:
  - Increments attempts
  - Returns error with remaining attempts

#### `resendOtp(Request $request)`
- Resends OTP to email
- Rate limited: Max 3 resend attempts per 10 minutes
- Generates new 6-digit OTP
- Resets attempt counter to 0
- Extends expiration to 10 minutes from now
- Sends OTP email via Mail::send()

---

## Mail Classes

### OtpVerificationMail
**Location:** `app/Mail/OtpVerificationMail.php`

**Constructor Parameters:**
- $otp: 6-digit OTP code
- $userName: User's full name for greeting

**Email Properties:**
- Subject: "Kode OTP Verifikasi Registrasi - Kalya Rentcar"
- View: `emails.otp-verification`
- Language: Indonesian

---

## Views

### Email Template
**Location:** `resources/views/emails/otp-verification.blade.php`

**Content:**
- Header with Kalya Rentcar branding (gold gradient)
- Personalized greeting with user name
- Explanation of registration process
- OTP prominently displayed in large monospace font
- Expiration time (10 minutes)
- Security warning about not sharing OTP
- Footer with contact information
- Responsive HTML email design

### Verification Form
**Location:** `resources/views/auth/verify-otp.blade.php`

**Features:**
- Email field (read-only, pre-filled)
- OTP input field (6-digit number only)
- Show/Hide toggle for OTP (eye icon)
- Countdown timer (10:00 → 0:00)
- Form auto-disables when timer reaches 0
- Resend OTP link (appears when expired)
- Error messages with remaining attempts
- Info alert about OTP delivery
- Back to login link
- Responsive design with AdminLTE styling

**JavaScript Features:**
- OTP auto-focus
- Number-only input validation
- Show/hide toggle with icon change
- Countdown timer with minute:second format
- Form submission validation
- Auto-disable form on expiration

---

## Routes

### Authentication Routes
```php
GET    /login                    → AuthController@showLogin (auth.login)
POST   /login                    → AuthController@login
GET    /register                 → AuthController@showRegister (auth.register)
POST   /register                 → AuthController@register (auth.register.post)
GET    /register/verify-otp      → AuthController@showVerifyOtp (auth.showVerifyOtp)
POST   /register/verify-otp      → AuthController@verifyOtp (auth.verifyOtp)
GET    /register/resend-otp      → AuthController@resendOtp (auth.resendOtp)
POST   /logout                   → AuthController@logout (auth.logout)
```

---

## Security Features

### Input Validation
- Name: Alphabets, spaces, quotes, hyphens only (no special chars)
- Email: Standard RFC email format with regex
- Password: 8+ characters with uppercase, lowercase, digit, symbol

### Rate Limiting
- Registration: 3 attempts per 60 minutes (per IP)
- Login: 5 attempts per 15 minutes (per IP)
- Resend OTP: 3 attempts per 10 minutes (per email)

### OTP Security
- 6-digit random codes (0-999999)
- Unique per email
- 10-minute expiration window
- Max 5 verification attempts before timeout
- Automatic cleanup of expired records
- User data stored as JSON (not yet in user table)
- Password hashed immediately using bcrypt

### XSS Prevention
- Input sanitization with strip_tags()
- NoScriptInjection validation rule
- HTML escaping in email templates
- Form input maxlength and pattern attributes

---

## Installation Steps

### 1. Run Migration
```bash
php artisan migrate
```
Creates otp_codes table with proper schema and indexes.

### 2. Configure Mail
Update `.env` file:
```
MAIL_DRIVER=smtp (or sendmail, mailtrap, etc.)
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=admin@kalyarentcar.com
MAIL_FROM_NAME="Kalya Rentcar"
```

### 3. Clear Cache
```bash
php artisan view:clear
php artisan config:clear
php artisan cache:clear
```

---

## Testing Checklist

- [ ] Register with valid data → OTP email received
- [ ] Verify OTP with correct code → Account created, redirect to login
- [ ] Verify OTP with wrong code → Error message with remaining attempts
- [ ] Wait 10 minutes → Timer expires, form disables
- [ ] Click "Resend OTP" → New code received, timer resets
- [ ] Try 5+ wrong codes → Account locked, must register again
- [ ] Rate limit: 3 registrations in 60 minutes → 4th blocked
- [ ] Rate limit: 5 login attempts in 15 minutes → 6th blocked
- [ ] Verify email with script tags → Rejected by validation
- [ ] Password without symbol → Rejected by validation
- [ ] Email already used → "Email sudah terdaftar" error

---

## File Changes Summary

| File | Change | Status |
|------|--------|--------|
| app/Models/OtpCode.php | Create | ✅ Complete |
| app/Mail/OtpVerificationMail.php | Create | ✅ Complete |
| app/Http/Controllers/AuthController.php | Update (add OTP methods) | ✅ Complete |
| routes/web.php | Add OTP routes | ✅ Complete |
| resources/views/emails/otp-verification.blade.php | Create | ✅ Complete |
| resources/views/auth/verify-otp.blade.php | Create | ✅ Complete |
| database/migrations/2026_02_06_052931_create_otp_codes_table.php | Create | ✅ Complete |

---

## API Reference

### OtpCode Methods

```php
// Create OTP record
OtpCode::create([
    'email' => 'user@example.com',
    'code' => '123456',
    'user_data' => ['name' => 'John Doe', 'password' => 'hashed_password'],
    'attempts' => 0,
    'max_attempts' => 5,
    'expires_at' => now()->addMinutes(10),
]);

// Find by email
$otp = OtpCode::where('email', 'user@example.com')->first();

// Check validity
if ($otp->isValid()) { /* not expired */ }

// Check attempts
if ($otp->hasAttempts()) { /* has remaining attempts */ }

// Increment attempts
$otp->incrementAttempts();

// Delete after success
$otp->delete();
```

### Email Sending

```php
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Mail;

Mail::to($email)->send(new OtpVerificationMail($otp, $userName));
```

---

## Known Limitations & Future Improvements

### Current Limitations
- OTP only via email (SMS not implemented)
- No auto-cleanup of expired OTP records (should add scheduled task)
- No admin approval required after OTP verification
- Password stored in JSON temporarily (minimal security risk due to 10-min window)

### Recommended Future Enhancements
1. Add scheduled task to delete expired OTP records
2. Implement SMS OTP as alternative delivery method
3. Add admin notification/approval workflow
4. Implement 2FA after login (additional security)
5. Add OTP resend cooldown timer
6. Implement IP-based additional verification
7. Add audit log for registration attempts

---

## Related Documentation

- [Laravel Mailable Documentation](https://laravel.com/docs/mail)
- [Laravel Validation Documentation](https://laravel.com/docs/validation)
- [Laravel Rate Limiting](https://laravel.com/docs/rate-limiting)
- [Laravel Migrations](https://laravel.com/docs/migrations)

---

**Implementation Date:** February 6, 2026
**Framework Version:** Laravel 11
**Database:** MySQL
**Status:** ✅ Ready for Testing
