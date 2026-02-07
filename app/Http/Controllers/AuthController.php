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
            return redirect()->route('admin.dashboard');
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
     * Tampilkan halaman ubah password
     */
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    /**
     * Update password dengan verifikasi password lama
     */
    public function updatePassword(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'current_password.min' => 'Password lama minimal 6 karakter.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        // Verifikasi password lama
        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password lama salah.',
            ]);
        }

        // Cek apakah password baru berbeda dengan password lama
        if (Hash::check($validated['new_password'], $user->password)) {
            throw ValidationException::withMessages([
                'new_password' => 'Password baru harus berbeda dengan password lama.',
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Password berhasil diubah!');
    }

}
