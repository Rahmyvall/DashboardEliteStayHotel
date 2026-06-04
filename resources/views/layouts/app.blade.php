<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Management System')</title>

    @include('layouts.header')
</head>

<body>

    <div class="layout-wrapper">

        @include('layouts.sidebar')

        <div class="page-content">

            <!-- Topbar -->
            <div class="navbar-custom">
                <div class="topbar">

                    <!-- Left Side -->
                    <div class="topbar-menu d-flex align-items-center gap-2">

                        <!-- Logo -->
                        <div class="logo-box">

                            <a href="{{ route('dashboard') }}" class="logo-light">
                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-light.png') }}"
                                    alt="Logo" class="logo-lg" height="22">

                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-sm.png') }}" alt="Logo"
                                    class="logo-sm" height="22">
                            </a>

                            <a href="{{ route('dashboard') }}" class="logo-dark">
                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-dark.png') }}" alt="Logo"
                                    class="logo-lg" height="22">

                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-sm.png') }}" alt="Logo"
                                    class="logo-sm" height="22">
                            </a>

                        </div>

                        <!-- Sidebar Toggle -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>

                    </div>

                    <!-- Right Side -->
                    <ul class="topbar-menu d-flex align-items-center gap-3">

                        <!-- Fullscreen -->
                        <li>
                            <a class="nav-link" href="#" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen font-size-24"></i>
                            </a>
                        </li>

                        <!-- Search -->
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#">

                                <i class="mdi mdi-magnify font-size-24"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-lg p-3">
                                <input type="search" class="form-control" placeholder="Search...">
                            </div>
                        </li>

                        <!-- Dark Mode -->
                        <li>
                            <a href="javascript:void(0)" id="theme-toggle" class="nav-link">

                                <i id="theme-icon" class="mdi mdi-weather-night font-size-24"></i>
                            </a>
                        </li>

                        <!-- User -->
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user d-flex align-items-center"
                                data-bs-toggle="dropdown" href="#">

                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ urlencode(Auth::user()->name ?? 'Admin') }}"
                                    alt="User" class="rounded-circle shadow-sm" width="38" height="38">

                                <div class="ms-2 d-none d-md-block text-start">
                                    <div class="fw-semibold">
                                        {{ Auth::user()->name ?? 'Administrator' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ ucfirst(Auth::user()->role ?? 'Admin') }}
                                    </small>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 profile-dropdown"
                                style="min-width: 280px;">

                                <!-- User Info -->
                                <div class="px-3 py-3">

                                    <div class="d-flex align-items-center">

                                        <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ urlencode(Auth::user()->name ?? 'Admin') }}"
                                            class="rounded-circle me-3" width="50">

                                        <div>
                                            <h6 class="mb-0">
                                                {{ Auth::user()->name ?? 'Administrator' }}
                                            </h6>

                                            <small class="text-muted">
                                                {{ Auth::user()->email ?? '' }}
                                            </small>

                                            <div class="mt-1">
                                                <span class="badge bg-primary">
                                                    {{ strtoupper(Auth::user()->role ?? 'ADMIN') }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="dropdown-divider"></div>

                                <a href="#" class="dropdown-item py-2">
                                    <i class="mdi mdi-account-outline me-2"></i>
                                    My Profile
                                </a>

                                <a href="#" class="dropdown-item py-2">
                                    <i class="mdi mdi-cog-outline me-2"></i>
                                    Settings
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="{{ route('logout') }}" class="dropdown-item text-danger py-2"
                                    onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">

                                    <i class="mdi mdi-logout me-2"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>

                </div>
            </div>
            <!-- End Topbar -->

            <!-- Content -->
            <div class="px-3">
                <div class="container-fluid">

                    <div class="py-3 py-lg-4">
                        @yield('content')
                    </div>

                </div>
            </div>

            @include('layouts.footer')
            @include('layouts.script')
            @stack('scripts')
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const html = document.documentElement;
            const btn = document.getElementById('theme-toggle');
            const icon = document.getElementById('theme-icon');

            function setTheme(theme) {
                html.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);

                if (theme === 'dark') {
                    icon.className = 'mdi mdi-white-balance-sunny font-size-24';
                } else {
                    icon.className = 'mdi mdi-weather-night font-size-24';
                }
            }

            // ambil theme awal
            const savedTheme = localStorage.getItem('theme') || 'light';
            setTheme(savedTheme);

            btn.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-bs-theme');

                if (currentTheme === 'dark') {
                    setTheme('light');
                } else {
                    setTheme('dark');
                }
            });

        });
    </script>
</body>

</html>
