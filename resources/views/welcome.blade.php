<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <title>Login | EliteStay Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
    :root {
        --primary: #0ea5e9;
        --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
        --card-bg: rgba(255, 255, 255, 0.97);
        --text: #1e2937;
        --muted: #64748b;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
    }

    [data-bs-theme="dark"] {
        --bg-gradient: linear-gradient(135deg, #0a0f1c 0%, #1e2937 100%);
        --card-bg: rgba(15, 23, 42, 0.95);
        --text: #f1f5f9;
        --muted: #94a3b8;
        --input-bg: #1e2937;
        --input-border: #334155;
    }

    body {
        background: var(--bg-gradient);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', system-ui, sans-serif;
        overflow: hidden;
        position: relative;
        color: var(--text);
    }

    body::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945') center/cover no-repeat;
        opacity: 0.15;
        filter: brightness(0.7) contrast(1.15);
        z-index: -1;
    }

    .login-card {
        background: var(--card-bg);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 32px;
        box-shadow: 0 30px 70px -15px rgba(0, 0, 0, 0.6);
        max-width: 440px;
        width: 100%;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .auth-header {
        background: linear-gradient(135deg, #1e40af 0%, #0284c8 100%);
        padding: 2.8rem 2rem 2rem;
        text-align: center;
        position: relative;
    }

    .logo {
        width: 82px;
        height: 82px;
        background: white;
        border-radius: 20px;
        padding: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        margin-bottom: 1rem;
    }

    .form-control {
        background: var(--input-bg);
        border-radius: 16px;
        padding: 15px 20px 15px 54px;
        border: 2px solid var(--input-border);
        color: var(--text);
        font-size: 1.02rem;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 6px rgba(14, 165, 233, 0.2);
    }

    .input-icon {
        color: var(--muted);
    }

    .input-group:focus-within .input-icon {
        color: var(--primary);
    }

    .role-badge {
        border-radius: 18px;
        padding: 14px 8px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        background: var(--card-bg);
        color: var(--text);
    }

    .btn-check:checked + .role-badge {
        background: linear-gradient(135deg, #0ea5e9, #22d3ee);
        color: white;
        border-color: #bae6fd;
    }

    .btn-login {
        border-radius: 16px;
        padding: 16px;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        background: linear-gradient(135deg, #0284c8, #22d3ee);
        border: none;
        box-shadow: 0 12px 25px rgba(2, 132, 200, 0.35);
    }

    .btn-login:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px rgba(2, 132, 200, 0.45);
    }

    .theme-toggle {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        backdrop-filter: blur(10px);
    }
    </style>
</head>

<body>
    <div class="login-card position-relative">
        <!-- Theme Toggle -->
        <button class="theme-toggle" id="themeToggle" title="Ubah Tema">
            <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
        </button>

        <!-- Header -->
        <div class="auth-header text-white">
            <img src="{{asset('dashtrap/admin/dist/assets/images/logo3.png')}}" alt="EliteStay" class="logo">
            <h3 class="fw-bold mb-1">Selamat Datang Kembali</h3>
            <p class="mb-0 opacity-90">EliteStay Hotel Management</p>
        </div>

        <div class="card-body p-5">
            <form action="#" method="POST">
                @csrf

                <!-- Role Selection -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted mb-3">Pilih Peran Anda</label>
                    <div class="row g-3">
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="role" id="role-admin" value="admin" checked>
                            <label class="btn btn-outline-primary w-100 role-badge d-flex flex-column align-items-center gap-2" for="role-admin">
                                <span class="fs-2">👑</span>
                                <span class="small fw-medium">Admin</span>
                            </label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="role" id="role-resepsionis" value="resepsionis">
                            <label class="btn btn-outline-primary w-100 role-badge d-flex flex-column align-items-center gap-2" for="role-resepsionis">
                                <span class="fs-2">🏨</span>
                                <span class="small fw-medium">Resepsionis</span>
                            </label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="role" id="role-pelanggan" value="pelanggan">
                            <label class="btn btn-outline-primary w-100 role-badge d-flex flex-column align-items-center gap-2" for="role-pelanggan">
                                <span class="fs-2">👤</span>
                                <span class="small fw-medium">Pelanggan</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Email</label>
                    <div class="input-group">
                        <i class="bi bi-envelope input-icon position-absolute" style="left:20px; top:50%; transform:translateY(-50%);"></i>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <label class="form-label fw-medium">Password</label>
                        <a href="#" class="text-decoration-none" style="color: var(--muted); font-size:0.95rem;">Lupa Password?</a>
                    </div>
                    <div class="input-group position-relative">
                        <i class="bi bi-lock input-icon position-absolute" style="left:20px; top:50%; transform:translateY(-50%);"></i>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                        <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted me-3" type="button" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-login mt-2">
                    MASUK SEKARANG
                </button>
            </form>
        </div>
    </div>

    <script>
    // Toggle Password
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    // Dark Mode Handling
    function setTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);

        const icon = document.getElementById('themeIcon');
        icon.classList.toggle('bi-moon-stars-fill', theme === 'dark');
        icon.classList.toggle('bi-sun-fill', theme === 'light');
    }

    function initTheme() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme) {
            setTheme(savedTheme);
        } else if (prefersDark) {
            setTheme('dark');
        }
    }

    // Event Listeners
    document.getElementById('themeToggle').addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });

    // Initialize
    window.addEventListener('load', () => {
        initTheme();
        document.querySelector('input[name="email"]').focus();
    });

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            setTheme(e.matches ? 'dark' : 'light');
        }
    });
    </script>
</body>
</html>
