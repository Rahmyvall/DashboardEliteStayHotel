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

                            <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#">

                                <img src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name ?? 'Admin') }}"
                                    alt="User" class="rounded-circle" width="35">

                                <span class="d-none d-md-inline-block ms-1">
                                    {{ Auth::user()->name ?? 'Administrator' }}
                                    <i class="mdi mdi-chevron-down"></i>
                                </span>

                            </a>

                            <div class="dropdown-menu dropdown-menu-end profile-dropdown">

                                <div class="dropdown-header">
                                    <h6 class="m-0">
                                        {{ Auth::user()->name ?? 'Administrator' }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ Auth::user()->email ?? '' }}
                                    </small>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a href="#" class="dropdown-item">
                                    <i class="mdi mdi-account-circle-outline me-1"></i>
                                    Profile
                                </a>

                                <a href="#" class="dropdown-item">
                                    <i class="mdi mdi-cog-outline me-1"></i>
                                    Settings
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                    onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">

                                    <i class="mdi mdi-logout me-1"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>

                        </li>

                    </ul>

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
