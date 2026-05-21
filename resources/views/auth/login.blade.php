<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <title>Login | EliteStay Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
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
        border-radius: 32px;
        max-width: 440px;
        width: 100%;
        overflow: hidden;
        box-shadow: 0 30px 70px -15px rgba(0, 0, 0, 0.6);
    }

    .auth-header {
        background: linear-gradient(135deg, #1e40af 0%, #0284c8 100%);
        padding: 2.8rem 2rem 2rem;
        text-align: center;
    }

    .logo {
        width: 82px;
        height: 82px;
        background: white;
        border-radius: 20px;
        padding: 12px;
        margin-bottom: 1rem;
    }

    .form-control {
        background: var(--input-bg);
        border-radius: 16px;
        padding: 15px 20px 15px 54px;
        border: 2px solid var(--input-border);
        color: var(--text);
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 6px rgba(14, 165, 233, 0.2);
    }

    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        z-index: 10;
    }

    .role-badge {
        border-radius: 18px;
        padding: 14px 8px;
        border: 2px solid transparent;
        background: var(--card-bg);
        color: var(--text);
        transition: 0.3s;
    }

    .btn-check:checked + .role-badge {
        background: linear-gradient(135deg, #0ea5e9, #22d3ee);
        color: white;
        border-color: #bae6fd;
    }

    .btn-login {
        border-radius: 16px;
        padding: 16px;
        font-weight: 700;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #0284c8, #22d3ee);
        border: none;
        transition: 0.3s;
    }

    .btn-login:hover {
        transform: translateY(-3px);
    }

    .theme-toggle {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
    }

    .alert-custom {
        border-radius: 14px;
        padding: 12px 16px;
        font-size: 14px;
    }

    /* Loading Overlay */
    .loading-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.82);
        backdrop-filter: blur(10px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        animation: fadeIn 0.3s ease;
    }

    .loading-spinner {
        width: 4rem;
        height: 4rem;
        border-width: 5px;
        color: #22d3ee;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
    </style>
</head>

<body>

    <!-- Loading -->
    <div id="loadingOverlay" class="loading-overlay d-none">
        <div class="text-center text-white">

            <div class="spinner-border loading-spinner mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            <h5 class="fw-bold mb-1">
                Sedang Masuk...
            </h5>

            <p class="opacity-75 mb-0">
                Menyiapkan Dashboard EliteStay
            </p>

        </div>
    </div>

    <div class="login-card position-relative">

        <!-- Toggle Theme -->
        <button class="theme-toggle" id="themeToggle">
            <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
        </button>

        <!-- Header -->
        <div class="auth-header text-white">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo3.png') }}" alt="Logo" class="logo">

            <h3 class="fw-bold mb-1">
                Selamat Datang Kembali
            </h3>

            <p class="mb-0 opacity-75">
                EliteStay Hotel Management
            </p>
        </div>

        <!-- Body -->
        <div class="card-body p-5">

            @if(session('error'))
            <div class="alert alert-danger alert-custom">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-custom">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Login -->
            <form id="loginForm" action="{{ route('login.process') }}" method="POST">
                @csrf

                <!-- Role -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted mb-3">
                        Pilih Role
                    </label>

                    <div class="row g-3">

                        <!-- Admin -->
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="role" id="role-admin" value="admin"
                                {{ old('role', 'admin') == 'admin' ? 'checked' : '' }}>

                            <label class="btn btn-outline-primary w-100 role-badge d-flex flex-column align-items-center gap-2"
                                for="role-admin">

                                <span class="fs-2">👑</span>
                                <span class="small fw-medium">Admin</span>
                            </label>
                        </div>

                        <!-- Resepsionis -->
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="role" id="role-resepsionis" value="resepsionis"
                                {{ old('role') == 'resepsionis' ? 'checked' : '' }}>

                            <label class="btn btn-outline-primary w-100 role-badge d-flex flex-column align-items-center gap-2"
                                for="role-resepsionis">

                                <span class="fs-2">🏨</span>
                                <span class="small fw-medium">Resepsionis</span>
                            </label>
                        </div>

                        <!-- Pelanggan -->
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="role" id="role-pelanggan" value="pelanggan"
                                {{ old('role') == 'pelanggan' ? 'checked' : '' }}>

                            <label class="btn btn-outline-primary w-100 role-badge d-flex flex-column align-items-center gap-2"
                                for="role-pelanggan">

                                <span class="fs-2">👤</span>
                                <span class="small fw-medium">Pelanggan</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">

                    <label class="form-label fw-medium">
                        Email
                    </label>

                    <div class="input-group position-relative">

                        <i class="bi bi-envelope input-icon"></i>

                        <input type="email" name="email" class="form-control"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            required>

                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">

                    <div class="d-flex justify-content-between">

                        <label class="form-label fw-medium">
                            Password
                        </label>

                        <a href="#" class="text-decoration-none small"
                            style="color: var(--muted);">

                            Lupa Password?
                        </a>
                    </div>

                    <div class="input-group position-relative">

                        <i class="bi bi-lock input-icon"></i>

                        <input type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="••••••••"
                            required>

                        <button type="button"
                            class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-3 text-muted"
                            onclick="togglePassword()">

                            <i class="bi bi-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 btn-login">
                    MASUK SEKARANG
                </button>

            </form>
        </div>
    </div>

   <script>
    // Toggle Password
    function togglePassword() {

        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            password.type = 'password';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    // APPLY THEME (LIGHT / DARK / AUTO)
    function applyTheme(theme) {

        const root = document.documentElement;

        let finalTheme = theme;

        // AUTO ikut sistem device
        if (theme === 'auto') {
            finalTheme = window.matchMedia('(prefers-color-scheme: dark)').matches
                ? 'dark'
                : 'light';
        }

        root.setAttribute('data-bs-theme', finalTheme);
        localStorage.setItem('theme', theme);

        const icon = document.getElementById('themeIcon');

        if (theme === 'dark') {
            icon.className = 'bi bi-moon-stars-fill';
        }
        else if (theme === 'light') {
            icon.className = 'bi bi-sun-fill';
        }
        else {
            icon.className = 'bi bi-circle-half';
        }
    }

    // INIT THEME
    function initTheme() {

        const savedTheme = localStorage.getItem('theme') || 'auto';
        applyTheme(savedTheme);
    }

    // TOGGLE 3 MODE: light → dark → auto
    document.getElementById('themeToggle')
        .addEventListener('click', function () {

            const current = localStorage.getItem('theme') || 'auto';

            let next;

            if (current === 'light') {
                next = 'dark';
            }
            else if (current === 'dark') {
                next = 'auto';
            }
            else {
                next = 'light';
            }

            applyTheme(next);
        });

    // UPDATE AUTO MODE kalau system berubah
    window.matchMedia('(prefers-color-scheme: dark)')
        .addEventListener('change', () => {
            const theme = localStorage.getItem('theme');
            if (theme === 'auto') {
                applyTheme('auto');
            }
        });

    // Loading Login
    document.getElementById('loginForm')
        .addEventListener('submit', function() {

            document.getElementById('loadingOverlay')
                .classList.remove('d-none');

            document.querySelector('.btn-login')
                .disabled = true;
        });

    // Load
    window.addEventListener('load', function() {

        initTheme();

        document.querySelector('input[name="email"]').focus();
    });
</script>
</body>

</html>
