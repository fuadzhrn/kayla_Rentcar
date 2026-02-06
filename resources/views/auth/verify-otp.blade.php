<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi OTP - Kalya Rentcar Admin</title>

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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 450px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo a {
            font-size: 28px;
            font-weight: 700;
            color: #FFD700;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .login-logo a b {
            color: #FFD700;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            background: #ffffff;
            overflow: hidden;
        }

        .login-card-body {
            padding: 40px 30px;
        }

        .login-box-msg {
            text-align: center;
            color: #333;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 25px;
            letter-spacing: -0.5px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #FFD700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            color: #333;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-control:read-only {
            background-color: #f5f5f5;
            cursor: not-allowed;
            color: #666;
        }

        .input-group-text {
            border: 1px solid #ddd;
            background: #f9f9f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-group:focus-within .input-group-text {
            border-color: #FFD700;
            background: #fff;
        }

        .input-group-text:hover {
            background: #f0f0f0;
        }

        .input-group-text i {
            color: #666;
        }

        .alert {
            border-radius: 4px;
            border: none;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #fee;
            color: #c00;
        }

        .alert-danger strong {
            color: #900;
        }

        .alert-success {
            background-color: #efe;
            color: #060;
        }

        .alert-info {
            background-color: #eef;
            color: #006;
            border-left: 4px solid #0066cc;
        }

        .invalid-feedback {
            color: #c00;
            font-size: 13px;
            margin-top: 5px;
        }

        .btn {
            font-weight: 600;
            border-radius: 4px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
            color: #1a1a1a;
            width: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #FFC700 0%, #FFB700 100%);
            color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }

        .btn-link {
            color: #FFD700;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-link:hover {
            color: #FFC700;
            text-decoration: underline;
        }

        .text-muted {
            color: #999 !important;
            font-size: 13px;
        }

        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 20px !important;
        }

        .mb-3 {
            margin-bottom: 15px !important;
        }

        .mb-2 {
            margin-bottom: 10px !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        small {
            font-size: 13px;
        }

        .close {
            opacity: 1;
            color: #999;
            font-weight: normal;
            font-size: 20px;
        }

        .close:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                <b>Kalya</b> Rentcar
            </a>
            <p style="font-size: 12px; color: #999; margin-top: 5px;">Verifikasi Kode OTP</p>
        </div>
        
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masukkan Kode OTP</p>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal Verifikasi!</strong>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                        <button type="button" class="close" data-bs-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-bs-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('auth.verifyOtp') }}" method="POST" id="otpForm">
                    @csrf
                    
                    <!-- Hidden email field -->
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- Email (Read-only) -->
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" value="{{ $email }}" readonly>
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>

                    <!-- OTP Code -->
                    <div class="input-group mb-2">
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Masukkan 6 digit OTP"
                               maxlength="6" pattern="[0-9]{6}" required autofocus
                               @error('otp') style="border-color: #c00;" @enderror>
                        <button type="button" class="input-group-text" id="toggleOtp" title="Tampilkan/Sembunyikan">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('otp')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Timer & Resend -->
                    <div class="mb-3">
                        <small class="text-muted">
                            Kode OTP berlaku selama <strong id="timer" style="color: #FFD700;">10:00</strong> menit
                        </small>
                        <div id="resendContainer" class="mt-2" style="display: none;">
                            <a href="{{ route('auth.resendOtp', ['email' => $email]) }}" class="btn btn-link p-0">
                                <i class="fas fa-redo-alt"></i> Kirim Ulang Kode OTP
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fas fa-check"></i> Verifikasi OTP
                    </button>
                </form>

                <!-- Info Box -->
                <div class="alert alert-info mt-3" role="alert">
                    <small>
                        <strong>💡 Informasi:</strong> Kode OTP telah dikirim ke email Anda. 
                        Jika tidak menerima email, periksa folder spam atau minta pengiriman ulang.
                    </small>
                </div>

                <!-- Back to Login -->
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-muted" style="font-size: 14px;">
                        <i class="fas fa-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle OTP visibility
        document.getElementById('toggleOtp').addEventListener('click', function() {
            const otpInput = document.getElementById('otp');
            const icon = this.querySelector('i');
            
            if (otpInput.type === 'password') {
                otpInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                otpInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // OTP input - accept only numbers
        document.getElementById('otp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
        });

        // Countdown timer (10 minutes = 600 seconds)
        let timeLeft = 600;
        const timerElement = document.getElementById('timer');
        const resendContainer = document.getElementById('resendContainer');

        const countdown = setInterval(() => {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerElement.textContent = 'Waktu Habis';
                timerElement.style.color = '#c00';
                resendContainer.style.display = 'block';
                document.querySelector('form').style.display = 'none';
            }
        }, 1000);

        // Prevent form submission with invalid OTP
        document.getElementById('otpForm').addEventListener('submit', function(e) {
            const otp = document.getElementById('otp').value;
            if (otp.length !== 6 || isNaN(otp)) {
                e.preventDefault();
                alert('Silakan masukkan 6 digit OTP yang valid');
            }
        });
    </script>
</body>
</html>
