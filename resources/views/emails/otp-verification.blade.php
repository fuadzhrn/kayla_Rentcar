<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Verifikasi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
            color: #1a1a1a;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        .greeting strong {
            color: #FFD700;
        }
        .message {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .otp-box {
            background-color: #f9f9f9;
            border: 2px solid #FFD700;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 700;
            color: #FFD700;
            letter-spacing: 5px;
            font-family: 'Courier New', monospace;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            font-size: 13px;
            margin: 20px 0;
            line-height: 1.5;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #FFD700;
            color: #1a1a1a;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin-top: 20px;
        }
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Kalya Rentcar</h1>
            <p style="margin: 10px 0 0 0; font-size: 13px; opacity: 0.9;">Verifikasi Registrasi Akun Admin</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Halo <strong>{{ $userName }}</strong>,
            </div>

            <div class="message">
                Anda telah melakukan registrasi akun admin di platform Kalya Rentcar. Untuk menyelesaikan proses registrasi, silakan verifikasi email Anda dengan menggunakan kode OTP di bawah ini.
            </div>

            <!-- OTP Box -->
            <div class="otp-box">
                <div class="otp-label">Kode OTP Anda (Berlaku 10 Menit)</div>
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <!-- Warning -->
            <div class="warning">
                ⚠️ <strong>Penting:</strong> Jangan bagikan kode OTP ini kepada siapa pun. Tim Kalya Rentcar tidak akan pernah meminta OTP Anda melalui email atau WhatsApp.
            </div>

            <div class="message">
                Jika Anda tidak melakukan registrasi, abaikan email ini dan hubungi tim support kami.
            </div>

            <div class="divider"></div>

            <div style="text-align: center; margin: 30px 0;">
                <p style="margin: 0 0 15px 0; font-size: 13px; color: #666;">Atau masukkan kode OTP secara manual di form verifikasi</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 10px 0;">
                <strong>Kalya Rentcar - Admin Dashboard</strong>
            </p>
            <p style="margin: 0;">
                Email ini adalah otomatis. Jangan balas email ini.
            </p>
            <p style="margin: 10px 0 0 0; color: #bbb;">
                &copy; 2026 Kalya Rentcar. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
