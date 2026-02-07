<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Password - Kalya Rentcar Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            height: 100vh;
            overflow: hidden;
            position: fixed;
            width: 100%;
        }

        /* Split Layout Container */
        .login-wrapper {
            display: flex;
            width: 100%;
            height: 100vh;
            position: relative;
        }

        /* Left Side - Hero Section */
        .login-hero {
            flex: 1;
            background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 40px;
        }

        .hero-content {
            text-align: center;
            z-index: 10;
            position: relative;
        }

        .hero-icon {
            font-size: 100px;
            color: #1a1a1a;
            margin-bottom: 30px;
            text-shadow: 0 10px 30px rgba(26, 26, 26, 0.2);
        }

        .hero-title {
            font-size: 40px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 16px;
            color: rgba(26, 26, 26, 0.8);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .hero-features {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .hero-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            color: #1a1a1a;
            font-weight: 500;
        }

        .hero-feature i {
            font-size: 20px;
            background: rgba(26, 26, 26, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Right Side - Form */
        .login-form-section {
            flex: 1;
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .form-bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            opacity: 0.05;
        }

        .form-shape {
            position: absolute;
            border: 2px solid #FFD700;
        }

        .form-shape1 {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .form-shape2 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .login-form-container {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 10;
            animation: slideInUp 0.6s ease;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-form-card {
            background: rgba(26, 26, 26, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 215, 0, 0.15);
            border-radius: 25px;
            padding: 25px 20px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-logo {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 22px;
            color: #1a1a1a;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            animation: popIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes popIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .form-title {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .form-subtitle {
            color: #aaa;
            font-size: 11px;
            margin: 0;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
            font-weight: 500;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 10px;
            font-size: 12px;
            font-family: 'Poppins', sans-serif;
            background: rgba(26, 26, 26, 0.7);
            color: #fff;
            transition: all 0.3s ease;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-group input:focus {
            outline: none;
            border-color: #FFD700;
            background: rgba(26, 26, 26, 0.8);
            color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }

        .form-group input.is-invalid {
            border-color: #ff6b6b;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
            border: none;
            color: #1a1a1a;
            padding: 10px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-cancel {
            width: 100%;
            background: transparent;
            border: 2px solid #FFD700;
            color: #FFD700;
            padding: 10px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-cancel:hover {
            background: rgba(255, 215, 0, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-danger {
            background: rgba(255, 107, 107, 0.15);
            color: #ff9999;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.15);
            color: #7cd97c;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .invalid-feedback {
            display: block;
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 5px;
        }

        .password-note {
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-left: 4px solid #FFD700;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #fff;
        }

        .password-note strong {
            color: #FFD700;
        }

        .email-display {
            background: rgba(255, 215, 0, 0.08);
            border: 1px solid rgba(255, 215, 0, 0.3);
            border-left: 4px solid #FFD700;
            padding: 15px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .email-display-icon {
            color: #FFD700;
            font-size: 18px;
            flex-shrink: 0;
        }

        .email-display-content {
            flex: 1;
        }

        .email-display-label {
            font-size: 11px;
            color: #b0b0b0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .email-display-value {
            font-size: 14px;
            color: #fff;
            font-weight: 600;
        }

        .password-note ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .password-note li {
            margin: 4px 0;
            color: #aaa;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #FFD700;
            text-decoration: none;
            font-size: 12px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-link a:hover {
            gap: 8px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .login-hero {
                padding: 30px;
            }

            .hero-icon {
                font-size: 70px;
                margin-bottom: 20px;
            }

            .hero-title {
                font-size: 32px;
            }

            .hero-subtitle {
                font-size: 14px;
                margin-bottom: 30px;
            }

            .login-form-section {
                padding: 30px 15px;
            }
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-hero {
                padding: 40px 20px;
                min-height: auto;
                padding-bottom: 30px;
            }

            .hero-icon {
                font-size: 60px;
                margin-bottom: 20px;
            }

            .hero-title {
                font-size: 28px;
                margin-bottom: 10px;
            }

            .hero-subtitle {
                font-size: 14px;
                margin-bottom: 20px;
            }

            .login-form-section {
                padding: 30px 15px;
                min-height: auto;
            }

            .login-form-container {
                max-width: 100%;
            }

            body {
                position: static;
                height: auto;
                overflow-y: auto;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Side - Hero Section -->
        <div class="login-hero">
            <div class="hero-content">
                <div class="hero-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h1 class="hero-title">Ubah Password</h1>
                <p class="hero-subtitle">Amankan akun Anda dengan password baru</p>

                <div class="hero-features">
                    <div class="hero-feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Aman & Terpercaya</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-lock"></i>
                        <span>Enkripsi Kuat</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-check"></i>
                        <span>Verifikasi Password Lama</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="login-form-section">
            <div class="form-bg-shapes">
                <div class="form-shape form-shape1"></div>
                <div class="form-shape form-shape2"></div>
            </div>

            <div class="login-form-container">
                <div class="login-form-card">
                    <!-- Header -->
                    <div class="form-header">
                        <div class="form-logo">
                            <i class="fas fa-key"></i>
                        </div>
                        <h2 class="form-title">Ubah Password</h2>
                        <p class="form-subtitle">Perbarui password Anda dengan aman</p>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>Terjadi Kesalahan:</strong>
                        <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Email Confirmation Display -->
                    <div class="email-display">
                        <div class="email-display-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="email-display-content">
                            <div class="email-display-label">Mengubah Password Untuk Akun</div>
                            <div class="email-display-value">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <!-- Password Note -->
                    <div class="password-note">
                        <strong>Persyaratan Password:</strong>
                        <ul>
                            <li>Minimal 6 karakter</li>
                            <li>Berbeda dengan password lama</li>
                            <li>Konfirmasi harus sama</li>
                        </ul>
                    </div>

                    <!-- Change Password Form -->
                    <form method="POST" action="{{ route('admin.update-password') }}">
                        @csrf

                        <!-- Current Password -->
                        <div class="form-group">
                            <label for="current_password">
                                <i class="fas fa-keyboard"></i> Password Lama
                            </label>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                placeholder="Masukkan password lama Anda"
                                class="@error('current_password') is-invalid @enderror"
                                required
                            >
                            @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="new_password">
                                <i class="fas fa-lock"></i> Password Baru
                            </label>
                            <input 
                                type="password" 
                                id="new_password" 
                                name="new_password" 
                                placeholder="Masukkan password baru Anda"
                                class="@error('new_password') is-invalid @enderror"
                                required
                            >
                            @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="new_password_confirmation">
                                <i class="fas fa-check-circle"></i> Konfirmasi Password Baru
                            </label>
                            <input 
                                type="password" 
                                id="new_password_confirmation" 
                                name="new_password_confirmation" 
                                placeholder="Ketik ulang password baru Anda"
                                class="@error('new_password_confirmation') is-invalid @enderror"
                                required
                            >
                            @error('new_password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Password
                        </button>
                        <button type="button" onclick="performLogout()" class="btn-cancel">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </form>

                    <!-- Back Link -->
                    <div class="back-link">
                        <a href="#" onclick="performLogout(); return false;">
                            <i class="fas fa-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>

                    <!-- Logout Form (Hidden) -->
                    <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function performLogout() {
            // Submit logout form
            document.getElementById('logoutForm').submit();
        }
    </script>
</body>
</html>

