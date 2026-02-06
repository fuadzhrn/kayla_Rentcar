<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\NoScriptInjection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        // Login gagal
        RateLimiter::hit('login-attempts:' . $request->ip(), 60 * 15); // 15 menit throttle
        
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Check rate limiting
     */
    protected function ensureIsNotRateLimited($request)
    {
        if (!RateLimiter::attempt(
            'login-attempts:' . $request->ip(),
            $maxAttempts = 5,
            $decayMinutes = 15
        )) {
            $seconds = RateLimiter::availableIn('login-attempts:' . $request->ip());
            
            throw ValidationException::withMessages([
                'email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $seconds . ' detik.',
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
     * Proses registrasi user baru dengan keamanan
     */
    public function register(Request $request)
    {
        // Rate limiting - batasi 3 pendaftaran per 60 menit per IP
        if (!RateLimiter::attempt(
            'register-attempts:' . $request->ip(),
            $maxAttempts = 3,
            $decayMinutes = 60
        )) {
            $seconds = RateLimiter::availableIn('register-attempts:' . $request->ip());
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

        // Hash password dengan algoritma bcrypt
        $validated['password'] = Hash::make($validated['password']);

        // Buat user baru
        try {
            User::create($validated);
            
            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login dengan email dan password Anda.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.']);
        }
    }
}
