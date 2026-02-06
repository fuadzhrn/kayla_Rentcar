<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OtpCode;
use App\Mail\OtpVerificationMail;
use App\Rules\NoScriptInjection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        // Check if user is trying to access admin without auth
        if (request()->has('redirect')) {
            session()->flash('error', 'Silakan login terlebih dahulu untuk mengakses area admin.');
        }
        return view('auth.login');
    }

    /**
     * Proses login user dengan keamanan
     */
    public function login(Request $request)
    {
        // Rate limiting - batasi 5 percobaan per 15 menit
        $this->ensureIsNotRateLimited($request);

        // Validasi input dengan ketat
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', new NoScriptInjection(), 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'string', 'min:6', 'max:255', new NoScriptInjection()]
        ], [
            'email.regex' => 'Format email tidak valid.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password terlalu panjang.'
        ]);

        // Sanitasi input - hapus tag HTML dan script
        $validated['email'] = trim(strip_tags($validated['email']));

        // Cek credentials
        if (Auth::attempt($validated, $request->boolean('remember'))) {
            // Hapus rate limit throttle jika berhasil
            RateLimiter::clear('login-attempts:' . $request->ip());
            
            // Login berhasil, regenerate session
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        // Login gagal - record attempt
        RateLimiter::hit('login-attempts:' . $request->ip(), 15 * 60); // 15 menit decay
        
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Check rate limiting
     */
    protected function ensureIsNotRateLimited($request)
    {
        $key = 'login-attempts:' . $request->ip();
        $maxAttempts = 5;
        $decaySeconds = 15 * 60; // 15 menit
        
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            
            throw ValidationException::withMessages([
                'email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.',
            ])->status(429);
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Anda berhasil logout.');
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi awal - generate OTP dan kirim ke email
     */
    public function register(Request $request)
    {
        // Rate limiting - batasi 3 pendaftaran per 60 menit per IP
        $key = 'register-attempts:' . $request->ip();
        $maxAttempts = 3;
        $decaySeconds = 60 * 60; // 60 menit
        
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => 'Terlalu banyak percobaan pendaftaran. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.',
            ])->status(429);
        }

        // Validasi input dengan ketat
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', new NoScriptInjection(), 'regex:/^[a-zA-Z\s\'-]+$/', 'not_regex:/[<>\"\'%&();]/i'],
            'email' => ['required', 'email', 'max:255', 'unique:users', new NoScriptInjection(), 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed', new NoScriptInjection(), 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}$/'],
        ], [
            'name.regex' => 'Nama hanya boleh mengandung huruf, spasi, tanda kutip, dan tanda hubung.',
            'name.not_regex' => 'Nama mengandung karakter yang tidak diizinkan.',
            'email.regex' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password terlalu panjang.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol (!@#$%^&*).',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Sanitasi input - hapus tag HTML dan script
        $validated['name'] = trim(strip_tags($validated['name']));
        $validated['email'] = trim(strip_tags($validated['email']));

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        try {
            // Generate OTP 6 digit
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Delete existing OTP code untuk email ini
            OtpCode::where('email', $validated['email'])->delete();

            // Create OTP record dengan user data
            OtpCode::create([
                'email' => $validated['email'],
                'code' => $otp,
                'user_data' => [
                    'name' => $validated['name'],
                    'password' => $validated['password'],
                ],
                'attempts' => 0,
                'max_attempts' => 5,
                'expires_at' => now()->addMinutes(10),
            ]);

            // Send OTP ke email admin
            $adminEmail = env('ADMIN_EMAIL', 'admin@kalyarentcar.com');
            Mail::to($adminEmail)->send(new OtpVerificationMail($otp, $validated['name']));

            // Record successful OTP generation
            RateLimiter::hit('register-attempts:' . $request->ip(), 60 * 60);

            return redirect()->route('auth.showVerifyOtp', ['email' => $validated['email']])
                ->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan verifikasi dalam 10 menit.');
        } catch (\Exception $e) {
            // Record attempt jika ada error
            RateLimiter::hit('register-attempts:' . $request->ip(), 60 * 60);
            return back()->withErrors(['email' => 'Terjadi kesalahan saat mengirim OTP. Silakan coba lagi.']);
        }
    }

    /**
     * Tampilkan halaman verifikasi OTP
     */
    public function showVerifyOtp(Request $request)
    {
        $email = $request->query('email') ?? session('email');
        
        if (!$email) {
            return redirect()->route('auth.register')
                ->withErrors(['email' => 'Silakan lakukan registrasi terlebih dahulu.']);
        }

        // Check if OTP record exists
        $otpRecord = OtpCode::where('email', $email)->first();
        if (!$otpRecord) {
            return redirect()->route('auth.register')
                ->withErrors(['email' => 'Sesi verifikasi telah kadaluarsa. Silakan daftar kembali.']);
        }

        return view('auth.verify-otp', ['email' => $email]);
    }

    /**
     * Verifikasi OTP dan create user account
     */
    public function verifyOtp(Request $request)
    {
        // Validasi input OTP
        $validated = $request->validate([
            'otp' => ['required', 'string', 'size:6', 'regex:/^[0-9]{6}$/'],
        ], [
            'otp.required' => 'Kode OTP diperlukan.',
            'otp.size' => 'Kode OTP harus 6 digit.',
            'otp.regex' => 'Kode OTP hanya boleh berisi angka.',
        ]);

        // Cek post request email
        $email = $request->input('email') ?? session('email');
        if (!$email) {
            return back()->withErrors(['email' => 'Email tidak ditemukan. Silakan daftar kembali.']);
        }

        // Find OTP record
        $otpRecord = OtpCode::where('email', $email)->first();
        
        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.']);
        }

        // Check if OTP has expired
        if (!$otpRecord->isValid()) {
            $otpRecord->delete();
            return redirect()->route('auth.register')
                ->withErrors(['email' => 'Kode OTP telah kadaluarsa. Silakan daftar kembali.']);
        }

        // Check if still has attempts
        if (!$otpRecord->hasAttempts()) {
            $otpRecord->delete();
            return redirect()->route('auth.register')
                ->withErrors(['otp' => 'Terlalu banyak percobaan verifikasi yang gagal. Silakan daftar kembali.']);
        }

        // Verify OTP code
        if ($otpRecord->code !== $validated['otp']) {
            $otpRecord->incrementAttempts();
            $remaining = $otpRecord->max_attempts - $otpRecord->attempts;
            
            return back()->withErrors([
                'otp' => "Kode OTP salah. Tersisa $remaining percobaan."
            ]);
        }

        // OTP verified! Create user account
        try {
            $userData = $otpRecord->user_data;
            
            User::create([
                'name' => $userData['name'],
                'email' => $email,
                'password' => $userData['password'],
            ]);

            // Delete OTP record after successful verification
            $otpRecord->delete();

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Akun Anda telah dibuat. Silakan login.');
        } catch (\Exception $e) {
            return back()->withErrors(['otp' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.']);
        }
    }

    /**
     * Resend OTP ke email
     */
    public function resendOtp(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect()->route('auth.showRegister')
                ->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Rate limit resend - max 3 times per 10 minutes
        $key = 'resend-otp:' . $email;
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'otp' => 'Terlalu banyak permintaan pengiriman ulang. Coba lagi dalam ' . ceil($seconds / 60) . ' menit.'
            ]);
        }

        // Find OTP record
        $otpRecord = OtpCode::where('email', $email)->first();

        if (!$otpRecord) {
            return redirect()->route('auth.register')
                ->withErrors(['email' => 'Sesi verifikasi tidak ditemukan. Silakan daftar kembali.']);
        }

        try {
            // Generate new OTP
            $newOtp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Update OTP record
            $otpRecord->update([
                'code' => $newOtp,
                'attempts' => 0, // Reset attempts
                'expires_at' => now()->addMinutes(10),
            ]);

            // Get user name from stored data
            $userData = $otpRecord->user_data;
            $userName = $userData['name'] ?? 'User';

            // Send new OTP ke email admin
            $adminEmail = env('ADMIN_EMAIL', 'admin@kalyarentcar.com');
            Mail::to($adminEmail)->send(new OtpVerificationMail($newOtp, $userName));

            // Record resend attempt
            RateLimiter::hit($key, 10 * 60); // 10 minutes decay

            return redirect()->route('auth.showVerifyOtp', ['email' => $email])
                ->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->withErrors(['otp' => 'Terjadi kesalahan saat mengirim ulang OTP. Silakan coba lagi.']);
        }
    }
}

