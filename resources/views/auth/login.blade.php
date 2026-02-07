<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kalya Rentcar Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    
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

        /* Animated shapes background in hero */
        .hero-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border: 2px solid #1a1a1a;
        }

        .shape-circle1 {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: rotate 20s linear infinite;
        }

        .shape-circle2 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            animation: rotate 15s linear infinite reverse;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Right Side - Login Form */
        .login-form-section {
            flex: 1;
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements in form section */
        .form-bg-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.05;
        }

        .form-shape {
            position: absolute;
            background: #FFD700;
            filter: blur(50px);
        }

        .form-shape1 {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float1 8s ease-in-out infinite;
        }

        .form-shape2 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            animation: float2 10s ease-in-out infinite;
        }

        @keyframes float1 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 30px); }
        }

        @keyframes float2 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-30px, -30px); }
        }

        .login-form-container {
            width: 100%;
            max-width: 320px;
            z-index: 10;
            position: relative;
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

        /* Header */
        .form-header {
            margin-bottom: 20px;
        }

        .form-logo {
            display: inline-block;
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            animation: popIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes popIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .form-logo i {
            color: #1a1a1a;
            font-size: 22px;
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
            font-weight: 500;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 12px;
        }

        .form-label {
            color: #fff;
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 11px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            background: rgba(26, 26, 26, 0.7);
            border: 1px solid rgba(255, 215, 0, 0.2);
            color: #fff;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 12px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .form-control:focus {
            background: rgba(26, 26, 26, 0.8);
            border-color: #FFD700;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        /* Error Messages */
        .invalid-feedback {
            display: block;
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 5px;
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

        /* Checkbox */
        .form-check {
            margin-bottom: 12px;
        }

        .form-check-input {
            width: 15px;
            height: 15px;
            border: 1.5px solid rgba(255, 215, 0, 0.3);
            background: transparent;
            cursor: pointer;
            margin-right: 5px;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background: #FFD700;
            border-color: #FFD700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
        }

        .form-check-label {
            color: #aaa;
            font-size: 11px;
            cursor: pointer;
            user-select: none;
        }

        /* Login Button */
        .btn-login {
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

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 10px 0;
            color: #555;
            font-size: 10px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 215, 0, 0.1);
        }

        .divider span {
            margin: 0 6px;
        }

        /* Register Link */
        .register-link {
            text-align: center;
            color: #aaa;
            font-size: 11px;
        }

        .register-link a {
            color: #FFD700;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: #FFC700;
            text-decoration: underline;
        }

        /* Back Home */
        .change-password-section {
            margin-top: 8px;
            margin-bottom: 10px;
        }

        .btn-change-password {
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
            text-transform: uppercase;
            letter-spacing: 0.7px;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-change-password::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-change-password:hover::before {
            left: 100%;
        }

        .btn-change-password:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
            color: #1a1a1a;
        }

        .btn-change-password:active {
            transform: translateY(0);
        }

        .back-home {
            text-align: center;
            margin-top: 10px;
        }

        .back-home a {
            color: #FFD700;
            text-decoration: none;
            font-size: 11px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-home a:hover {
            color: #FFC700;
            gap: 8px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .login-hero {
                padding: 30px;
            }

            .hero-title {
                font-size: 36px;
            }

            .form-label {
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-hero {
                min-height: 40vh;
                padding: 30px 20px;
                border-radius: 0 0 40px 40px;
            }

            .login-form-section {
                min-height: 60vh;
                padding: 30px 20px;
            }

            .hero-title {
                font-size: 28px;
            }

            .hero-icon {
                font-size: 80px;
                margin-bottom: 20px;
            }

            .form-title {
                font-size: 22px;
            }

            .login-form-card {
                padding: 35px 25px;
            }
        }

        @media (max-width: 480px) {
            .login-hero {
                min-height: 35vh;
            }

            .login-form-section {
                min-height: 65vh;
            }

            .hero-title {
                font-size: 24px;
            }

            .form-title {
                font-size: 20px;
            }

            .login-form-card {
                padding: 30px 20px;
            }

            .hero-feature {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <!-- Split Layout -->
    <div class="login-wrapper">
        <!-- Left Side - Hero -->
        <div class="login-hero">
            <div class="hero-shapes">
                <div class="shape shape-circle1"></div>
                <div class="shape shape-circle2"></div>
            </div>

            <div class="hero-content">
                <div class="hero-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h1 class="hero-title">Kalya<br>Rentcar</h1>
                <p class="hero-subtitle">Admin Portal</p>

                <div class="hero-features">
                    <div class="hero-feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Aman & Terpercaya</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-bolt"></i>
                        <span>Cepat & Efisien</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-users"></i>
                        <span>Dukungan 24/7</span>
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
                            <i class="fas fa-lock"></i>
                        </div>
                        <h2 class="form-title">Masuk</h2>
                        <p class="form-subtitle">Akses Dashboard Admin</p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-lock"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email"
                                placeholder="admin@kalyarentcar.com"
                                value="{{ old('email') }}"
                                maxlength="255"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <div style="position: relative;">
                                <input 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password"
                                    placeholder="••••••••"
                                    maxlength="255"
                                    required
                                    autocomplete="current-password"
                                >
                                <button 
                                    type="button" 
                                    class="btn btn-link" 
                                    id="togglePassword"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; color: #FFD700; cursor: pointer; padding: 0; background: none;"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn-login" id="loginBtn">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </button>
                    </form>

                    <!-- Change Password Button -->
                    <div class="change-password-section">
                        <a href="{{ route('admin.change-password') }}" class="btn-change-password">
                            <i class="fas fa-key"></i> Ubah Password
                        </a>
                    </div>

                    <!-- Back to Home -->
                    <div class="back-home">
                        <a href="/">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Prevent double submit
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.disabled = true;
            btn.classList.add('loading');
        });
    </script>
</body>
</html>
