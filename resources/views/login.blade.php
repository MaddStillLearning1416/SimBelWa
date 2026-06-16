<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SimBelWa</title>
    <style>
        /* === RESET & GOOGLE FONTS === */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f1f5f9; display: flex; min-height: 100vh; color: #1e293b; }

        /* === LAYOUT SPLIT SCREEN === */
        .login-container { display: flex; width: 100%; height: 100vh; }

        /* SISI KIRI (BRANDING) */
        .left-side { flex: 1; background: linear-gradient(135deg, #1e3a8a 0%, #2b6cb0 100%); color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px; text-align: center; position: relative; overflow: hidden; }
        
        /* Efek Dekorasi Lingkaran di Background */
        .left-side::before { content: ''; position: absolute; top: -10%; left: -10%; width: 400px; height: 400px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; }
        .left-side::after { content: ''; position: absolute; bottom: -10%; right: -10%; width: 300px; height: 300px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; }

        .brand-logo { width: 100px; height: 100px; object-fit: contain; margin-bottom: 25px; z-index: 1; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2)); }
        .brand-title { font-size: 42px; font-weight: 800; letter-spacing: -1px; margin-bottom: 15px; z-index: 1; }
        .brand-subtitle { font-size: 16px; font-weight: 500; color: #bfdbfe; max-width: 80%; line-height: 1.6; z-index: 1; }

        /* SISI KANAN (FORM LOGIN) */
        .right-side { flex: 1; background-color: white; display: flex; justify-content: center; align-items: center; padding: 40px; }
        .form-wrapper { width: 100%; max-width: 420px; }
        
        .welcome-text { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 8px; }
        .instruction-text { font-size: 14px; color: #64748b; margin-bottom: 35px; }

        /* Form Input */
        .input-group { margin-bottom: 22px; display: flex; flex-direction: column; gap: 8px; }
        .input-group label { font-size: 13px; font-weight: 700; color: #334155; }
        .input-group input { width: 100%; padding: 14px 16px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 14px; color: #1e293b; outline: none; transition: all 0.2s ease; background-color: #f8fafc; }
        .input-group input:focus { border-color: #2b6cb0; background-color: white; box-shadow: 0 0 0 4px #dbeafe; }
        .input-group input::placeholder { color: #94a3b8; }

        /* Opsi Tambahan (Ingat Saya & Lupa Password) */
        .form-options { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; font-size: 13px; }
        .remember-me { display: flex; align-items: center; gap: 8px; color: #475569; font-weight: 500; cursor: pointer; }
        .forgot-password { color: #2b6cb0; font-weight: 700; text-decoration: none; transition: 0.2s; }
        .forgot-password:hover { color: #1e3a8a; text-decoration: underline; }

        /* Tombol Login */
        .btn-login { width: 100%; background-color: #2b6cb0; color: white; padding: 15px; border: none; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(43, 108, 176, 0.2); }
        .btn-login:hover { background-color: #1e3a8a; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(30, 58, 138, 0.3); }
        .btn-login:active { transform: translateY(0); }

        /* Footer Kanan */
        .login-footer { margin-top: 40px; text-align: center; font-size: 13px; color: #64748b; }
        .login-footer a { color: #2b6cb0; font-weight: 700; text-decoration: none; }

        /* Responsif untuk Layar HP */
        @media (max-width: 768px) {
            .login-container { flex-direction: column; }
            .left-side { display: none; /* Sembunyikan sisi kiri di HP agar fokus ke form */ }
            .right-side { padding: 30px 20px; }
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="left-side">
            <img src="{{ asset('logo-simbelwa.png') }}" alt="Logo SimBelWa" class="brand-logo">
            <h1 class="brand-title">SimBelWa</h1>
            <p class="brand-subtitle">Sistem Informasi Manajemen Belajar Mahasiswa.<br>Akses portal akademik Anda dengan mudah, cepat, dan aman.</p>
        </div>

        <div class="right-side">
            <div class="form-wrapper">
                <h2 class="welcome-text">Selamat Datang 👋</h2>
                <p class="instruction-text">Silakan masukkan NIM dan Password untuk mengakses akun akademik Anda.</p>
                @if ($errors->any())
                    <div style="background-color: #fef2f2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; font-weight: 600; border: 1.5px solid #fca5a5; text-align: center;">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf <div class="input-group">
                        <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" id="nim" name="nim" placeholder="Contoh: 2410511116" required autofocus>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember"> Ingat Saya
                        </label>
                        <a href="#" class="forgot-password">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-login">Masuk ke SimBelWa</button>
                </form>

                <div class="login-footer">
                    Belum punya akun? <a href="#">Hubungi Admin Akademik</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>