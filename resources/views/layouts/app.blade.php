<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>EliteStayHotel | Sistem Reservasi Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('dashtrap/admin/dist/assets/images/logo3.png')}}">

    <!-- App css -->
    <link href="{{asset('dashtrap/admin/dist/assets/css/style.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashtrap/admin/dist/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('dashtrap/admin/dist/assets/js/config.js')}}"></script>
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        <div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="index.html" class="logo-light">
                    <img src="{{asset('dashtrap/admin/dist/assets/images/logo.png')}}" alt="logo" class="logo-lg"
                        height="50">
                    <img src="{{asset('dashtrap/admin/dist/assets/images/logo.png')}}" alt="small logo" class="logo-sm"
                        height="50">
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <img src="{{asset('dashtrap/admin/dist/assets/images/logo3.png')}}" alt="dark logo" class="logo-lg"
                        height="30">
                    <img src="{{asset('dashtrap/admin/dist/assets/images/logo3.png')}}" alt="small logo" class="logo-sm"
                        height="30">
                </a>
            </div>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">

                    <li class="menu-title">Menu</li>

                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="dashboard.html" class="menu-link waves-effect waves-light">
                            <span class="menu-icon">
                                <i class="bx bx-home-smile"></i>
                            </span>

                            <span class="menu-text" data-key="dashboard">
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <!-- Data Master -->
                    <li class="menu-title">Data Master</li>

                    <li class="menu-item">
                        <a href="#menuMaster" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">

                            <span class="menu-icon">
                                <i class="bx bx-data"></i>
                            </span>

                            <span class="menu-text" data-key="data_master">
                                Master Data
                            </span>

                            <span class="menu-arrow"></span>
                        </a>

                        <div class="collapse" id="menuMaster">
                            <ul class="sub-menu">

                                <li class="menu-item">
                                    <a href="users.html" class="menu-link">
                                        <span class="menu-text" data-key="users">
                                            Users
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="pelanggan.html" class="menu-link">
                                        <span class="menu-text" data-key="pelanggan">
                                            Pelanggan
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="tipe_kamar.html" class="menu-link">
                                        <span class="menu-text" data-key="tipe_kamar">
                                            Tipe Kamar
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="kamar.html" class="menu-link">
                                        <span class="menu-text" data-key="kamar">
                                            Kamar
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="fasilitas.html" class="menu-link">
                                        <span class="menu-text" data-key="fasilitas">
                                            Fasilitas
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="tipe_kamar_fasilitas.html" class="menu-link">
                                        <span class="menu-text" data-key="tipe_kamar_fasilitas">
                                            Tipe Kamar Fasilitas
                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!-- Transaksi -->
                    <li class="menu-title">Transaksi</li>

                    <li class="menu-item">
                        <a href="#menuTransaksi" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">

                            <span class="menu-icon">
                                <i class="bx bx-cart"></i>
                            </span>

                            <span class="menu-text" data-key="transaksi">
                                Reservasi
                            </span>

                            <span class="menu-arrow"></span>
                        </a>

                        <div class="collapse" id="menuTransaksi">
                            <ul class="sub-menu">

                                <li class="menu-item">
                                    <a href="reservasi.html" class="menu-link">
                                        <span class="menu-text" data-key="reservasi">
                                            Reservasi
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="detail_reservasi.html" class="menu-link">
                                        <span class="menu-text" data-key="detail_reservasi">
                                            Detail Reservasi
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="pembayaran.html" class="menu-link">
                                        <span class="menu-text" data-key="pembayaran">
                                            Pembayaran
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="checkin_checkout.html" class="menu-link">
                                        <span class="menu-text" data-key="checkin_checkout">
                                            Checkin Checkout
                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!-- Lainnya -->
                    <li class="menu-title">Lainnya</li>

                    <li class="menu-item">
                        <a href="#menuLainnya" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">

                            <span class="menu-icon">
                                <i class="bx bx-cog"></i>
                            </span>

                            <span class="menu-text" data-key="fitur_lainnya">
                                Fitur Lainnya
                            </span>

                            <span class="menu-arrow"></span>
                        </a>

                        <div class="collapse" id="menuLainnya">
                            <ul class="sub-menu">

                                <li class="menu-item">
                                    <a href="review.html" class="menu-link">
                                        <span class="menu-text" data-key="review">
                                            Review
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="promo.html" class="menu-link">
                                        <span class="menu-text" data-key="promo">
                                            Promo
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="reservasi_promo.html" class="menu-link">
                                        <span class="menu-text" data-key="reservasi_promo">
                                            Reservasi Promo
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="log_aktivitas.html" class="menu-link">
                                        <span class="menu-text" data-key="log_aktivitas">
                                            Log Aktivitas
                                        </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="notifikasi.html" class="menu-link">
                                        <span class="menu-text" data-key="notifikasi">
                                            Notifikasi
                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>



        <!-- Start Page Content here -->
        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            <div class="navbar-custom">
                <div class="topbar">
                    <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                        <!-- Brand Logo -->
                        <div class="logo-box">
                            <!-- Brand Logo Light -->
                            <a href="index.html" class="logo-light">
                                <img src="{{asset('dashtrap/admin/dist/assets/images/logo-light.png')}}" alt="logo"
                                    class="logo-lg" height="22">
                                <img src="{{asset('dashtrap/admin/dist/assets/images/logo-sm.png')}}" alt="small logo"
                                    class="logo-sm" height="22">
                            </a>

                            <!-- Brand Logo Dark -->
                            <a href="index.html" class="logo-dark">
                                <img src="{{asset('dashtrap/admin/dist/assets/images/logo-dark.png')}}" alt="dark logo"
                                    class="logo-lg" height="22">
                                <img src="{{asset('dashtrap/admin/dist/assets/images/logo-sm.png')}}" alt="small logo"
                                    class="logo-sm" height="22">
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-4">

                        <li class="d-none d-md-inline-block">
                            <a class="nav-link" href="" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen font-size-24"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="mdi mdi-magnify font-size-24"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="search" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>

                        <li class="dropdown d-none d-md-inline-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button">

                                <img id="current-language-flag"
                                    src="{{ asset('dashtrap/admin/dist/assets/images/flags/us.jpg') }}" class="me-1"
                                    height="18">

                                <span id="current-language-text" class="align-middle">
                                    English
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                                <!-- Indonesia -->
                                <a href="javascript:void(0);" class="dropdown-item change-language" data-lang="id"
                                    data-text="Indonesia"
                                    data-flag="{{ asset('dashtrap/admin/dist/assets/images/flags/indonesia.png') }}">

                                    <img src="{{ asset('dashtrap/admin/dist/assets/images/flags/indonesia.png') }}"
                                        alt="Indonesia" class="me-2 rounded" width="20" height="14">

                                    <span class="align-middle">Indonesia</span>
                                </a>

                                <!-- English -->
                                <a href="javascript:void(0);" class="dropdown-item change-language" data-lang="en"
                                    data-text="English"
                                    data-flag="{{ asset('dashtrap/admin/dist/assets/images/flags/us.jpg') }}">

                                    <img src="{{ asset('dashtrap/admin/dist/assets/images/flags/us.jpg') }}"
                                        class="me-1" height="12">

                                    <span class="align-middle">English</span>
                                </a>

                                <!-- German -->
                                <a href="javascript:void(0);" class="dropdown-item change-language" data-lang="de"
                                    data-text="German"
                                    data-flag="{{ asset('dashtrap/admin/dist/assets/images/flags/germany.jpg') }}">

                                    <img src="{{ asset('dashtrap/admin/dist/assets/images/flags/germany.jpg') }}"
                                        class="me-1" height="12">

                                    <span class="align-middle">German</span>
                                </a>

                                <!-- Spanish -->
                                <a href="javascript:void(0);" class="dropdown-item change-language" data-lang="es"
                                    data-text="Spanish"
                                    data-flag="{{ asset('dashtrap/admin/dist/assets/images/flags/spain.jpg') }}">

                                    <img src="{{ asset('dashtrap/admin/dist/assets/images/flags/spain.jpg') }}"
                                        class="me-1" height="12">

                                    <span class="align-middle">Spanish</span>
                                </a>

                                <!-- Italian -->
                                <a href="javascript:void(0);" class="dropdown-item change-language" data-lang="it"
                                    data-text="Italian"
                                    data-flag="{{ asset('dashtrap/admin/dist/assets/images/flags/italy.jpg') }}">

                                    <img src="{{ asset('dashtrap/admin/dist/assets/images/flags/italy.jpg') }}"
                                        class="me-1" height="12">

                                    <span class="align-middle">Italian</span>
                                </a>

                                <!-- Russian -->
                                <a href="javascript:void(0);" class="dropdown-item change-language" data-lang="ru"
                                    data-text="Russian"
                                    data-flag="{{ asset('dashtrap/admin/dist/assets/images/flags/russia.jpg') }}">

                                    <img src="{{ asset('dashtrap/admin/dist/assets/images/flags/russia.jpg') }}"
                                        class="me-1" height="12">

                                    <span class="align-middle">Russian</span>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="mdi mdi-bell font-size-24"></i>
                                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                                <small>Clear All</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-1" style="max-height: 300px;" data-simplebar>

                                    <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                                    <!-- item-->

                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Datacorp <small
                                                            class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar
                                                        commented on Admin</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-info">
                                                        <i class="mdi mdi-account-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Admin <small
                                                            class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                                    <small class="noti-item-subtitle text-muted">New user
                                                        registered</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <h5 class="text-muted font-size-13 fw-normal mt-0">Yesterday</h5>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon">
                                                        <img src="{{asset('dashtrap/admin/dist/assets/images/users/avatar-2.jpg')}}"
                                                            class="img-fluid rounded-circle" alt="" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Cristina Pride
                                                        <small class="fw-normal text-muted ms-1">1 day ago</small>
                                                    </h5>
                                                    <small class="noti-item-subtitle text-muted">Hi, How are you? What
                                                        about our next meeting</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <h5 class="text-muted font-size-13 fw-normal mt-0">30 Dec 2021</h5>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Datacorp</h5>
                                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar
                                                        commented on Admin</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon">
                                                        <img src="{{asset('dashtrap/admin/dist/assets/images/users/avatar-4.jpg')}}"
                                                            class="img-fluid rounded-circle" alt="" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Karen Robinson
                                                    </h5>
                                                    <small class="noti-item-subtitle text-muted">Wow ! this admin looks
                                                        good and awesome design</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="text-center">
                                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="nav-link" id="theme-mode">
                            <i class="bx bx-moon font-size-24"></i>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">

                                {{-- Foto Profile --}}
                                @if(Auth::user()->foto_profile)

                                <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" alt="user-image"
                                    class="rounded-circle">

                                @else

                                <img src="{{ asset('dashtrap/admin/dist/assets/images/users/avatar-4.jpg') }}"
                                    alt="user-image" class="rounded-circle">

                                @endif

                                <span class="ms-1 d-none d-md-inline-block">

                                    {{-- Nama User --}}
                                    {{ Auth::user()->nama_lengkap }}

                                    {{-- Role --}}
                                    <small class="text-muted">
                                        ({{ ucfirst(Auth::user()->role) }})
                                    </small>

                                    <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                    <i class="fe-lock"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <!-- Loading Logout -->
                                <div id="logoutLoading" class="loading-overlay d-none">
                                    <div class="text-center text-white">

                                        <div class="spinner-border loading-spinner mb-3" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>

                                        <h5 class="fw-bold mb-1">
                                            Sedang Logout...
                                        </h5>

                                        <p class="opacity-75 mb-0">
                                            Sampai jumpa kembali 👋
                                        </p>

                                    </div>
                                </div>

                                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="button" id="btnLogout" class="dropdown-item">

                                        Logout
                                    </button>
                                </form>

                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="py-3 py-lg-4">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                            {{-- CONTENT TITLE / AREA --}}
                            <div class="flex-grow-1">
                                @yield('content')
                            </div>


                        </div>

                    </div>

                </div>

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer bg-light border-top py-3">
                <div class="container-fluid">
                    <div class="row align-items-center">

                        <!-- Copyright -->
                        <div class="col-md-6 text-center text-md-start">
                            <p class="mb-0 text-muted">
                                &copy; <script>
                                document.write(new Date().getFullYear())
                                </script>
                                <strong>EliteStayHotel</strong>. All Rights Reserved.
                            </p>
                        </div>

                        <!-- Developer Info -->
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center justify-content-md-end">
                                <p class="mb-0 text-muted">
                                    Designed & Developed by
                                    <a href="https://github.com/Rahmyvall" target="_blank"
                                        class="text-decoration-none fw-semibold">
                                        GitHub
                                    </a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- End Page content -->


    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ asset('dashtrap/admin/dist/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('dashtrap/admin/dist/assets/js/app.js') }}"></script>

    <!-- Knob charts js -->
    <script src="{{ asset('dashtrap/admin/dist/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- Sparkline Js-->
    <script src="{{ asset('dashtrap/admin/dist/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('dashtrap/admin/dist/assets/libs/morris.js/morris.min.js') }}"></script>

    <script src="{{ asset('dashtrap/admin/dist/assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('dashtrap/admin/dist/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

    <!-- Demo js -->
    <script src="{{ asset('dashtrap/admin/dist/assets/js/pages/apexcharts.js') }}"></script>

    <!-- Dashboard init-->
    <script src="{{ asset('dashtrap/admin/dist/assets/js/pages/dashboard.js') }}"></script>

    <!-- OPTIONAL: Bootstrap only jika vendor.min.js belum include bootstrap -->
    {{--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
--}}
    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const languageButtons = document.querySelectorAll(".change-language");
        const currentFlag = document.getElementById("current-language-flag");
        const currentText = document.getElementById("current-language-text");

        // =========================
        // TRANSLATIONS
        // =========================
        const translations = {

            // ENGLISH
            en: {
                menu: "Menu",
                data_master: "Master Data",
                transaksi: "Transactions",
                lainnya: "Others",
                fitur_lainnya: "Other Features",

                dashboard: "Dashboard",
                users: "Users",
                pelanggan: "Customers",
                tipe_kamar: "Room Types",
                kamar: "Rooms",
                fasilitas: "Facilities",
                tipe_kamar_fasilitas: "Room Type Facilities",

                reservasi: "Reservations",
                detail_reservasi: "Reservation Details",
                pembayaran: "Payments",
                checkin_checkout: "Check In / Check Out",

                review: "Reviews",
                promo: "Promos",
                reservasi_promo: "Promo Reservations",
                log_aktivitas: "Activity Logs",
                notifikasi: "Notifications"
            },

            // INDONESIA
            id: {
                menu: "Menu",
                data_master: "Data Master",
                transaksi: "Transaksi",
                lainnya: "Lainnya",
                fitur_lainnya: "Fitur Lainnya",

                dashboard: "Dashboard",
                users: "Users",
                pelanggan: "Pelanggan",
                tipe_kamar: "Tipe Kamar",
                kamar: "Kamar",
                fasilitas: "Fasilitas",
                tipe_kamar_fasilitas: "Tipe Kamar Fasilitas",

                reservasi: "Reservasi",
                detail_reservasi: "Detail Reservasi",
                pembayaran: "Pembayaran",
                checkin_checkout: "Check In / Check Out",

                review: "Review",
                promo: "Promo",
                reservasi_promo: "Reservasi Promo",
                log_aktivitas: "Log Aktivitas",
                notifikasi: "Notifikasi"
            },

            // GERMAN
            de: {
                menu: "Menü",
                data_master: "Masterdaten",
                transaksi: "Transaktionen",
                lainnya: "Andere",
                fitur_lainnya: "Weitere Funktionen",

                dashboard: "Instrumententafel",
                users: "Benutzer",
                pelanggan: "Kunden",
                tipe_kamar: "Zimmertypen",
                kamar: "Zimmer",
                fasilitas: "Einrichtungen",
                tipe_kamar_fasilitas: "Zimmertyp Einrichtungen",

                reservasi: "Reservierungen",
                detail_reservasi: "Reservierungsdetails",
                pembayaran: "Zahlungen",
                checkin_checkout: "Check-In / Check-Out",

                review: "Bewertungen",
                promo: "Promo",
                reservasi_promo: "Promo Reservierungen",
                log_aktivitas: "Aktivitätsprotokoll",
                notifikasi: "Benachrichtigungen"
            },

            // SPANISH
            es: {
                menu: "Menú",
                data_master: "Datos Maestros",
                transaksi: "Transacciones",
                lainnya: "Otros",
                fitur_lainnya: "Otras Funciones",

                dashboard: "Panel",
                users: "Usuarios",
                pelanggan: "Clientes",
                tipe_kamar: "Tipos de Habitación",
                kamar: "Habitaciones",
                fasilitas: "Instalaciones",
                tipe_kamar_fasilitas: "Instalaciones del Tipo de Habitación",

                reservasi: "Reservas",
                detail_reservasi: "Detalles de Reserva",
                pembayaran: "Pagos",
                checkin_checkout: "Check In / Check Out",

                review: "Reseñas",
                promo: "Promociones",
                reservasi_promo: "Reservas Promocionales",
                log_aktivitas: "Registro de Actividades",
                notifikasi: "Notificaciones"
            },

            // ITALIAN
            it: {
                menu: "Menu",
                data_master: "Dati Principali",
                transaksi: "Transazioni",
                lainnya: "Altro",
                fitur_lainnya: "Altre Funzioni",

                dashboard: "Dashboard",
                users: "Utenti",
                pelanggan: "Clienti",
                tipe_kamar: "Tipi di Camera",
                kamar: "Camere",
                fasilitas: "Servizi",
                tipe_kamar_fasilitas: "Servizi Tipo Camera",

                reservasi: "Prenotazioni",
                detail_reservasi: "Dettagli Prenotazione",
                pembayaran: "Pagamenti",
                checkin_checkout: "Check In / Check Out",

                review: "Recensioni",
                promo: "Promozioni",
                reservasi_promo: "Prenotazioni Promo",
                log_aktivitas: "Registro Attività",
                notifikasi: "Notifiche"
            },

            // RUSSIAN
            ru: {
                menu: "Меню",
                data_master: "Основные Данные",
                transaksi: "Транзакции",
                lainnya: "Другое",
                fitur_lainnya: "Другие Функции",

                dashboard: "Панель",
                users: "Пользователи",
                pelanggan: "Клиенты",
                tipe_kamar: "Типы Комнат",
                kamar: "Комнаты",
                fasilitas: "Удобства",
                tipe_kamar_fasilitas: "Удобства Типа Комнаты",

                reservasi: "Бронирования",
                detail_reservasi: "Детали Бронирования",
                pembayaran: "Платежи",
                checkin_checkout: "Заезд / Выезд",

                review: "Отзывы",
                promo: "Акции",
                reservasi_promo: "Акционные Бронирования",
                log_aktivitas: "Журнал Активности",
                notifikasi: "Уведомления"
            }

        };

        // =========================
        // DEFAULT LANGUAGE
        // =========================
        const savedLang = localStorage.getItem("dashboard_language") || "en";

        applyLanguage(savedLang);

        // =========================
        // CLICK LANGUAGE
        // =========================
        languageButtons.forEach(button => {

            button.addEventListener("click", function() {

                const lang = this.dataset.lang;

                localStorage.setItem("dashboard_language", lang);

                applyLanguage(lang);

            });

        });

        // =========================
        // APPLY LANGUAGE
        // =========================
        function applyLanguage(lang) {

            const t = translations[lang];

            if (!t) return;

            // FLAG & TEXT
            const selected = document.querySelector(`[data-lang="${lang}"]`);

            currentFlag.src = selected.dataset.flag;
            currentText.innerText = selected.dataset.text;

            // MENU TITLE
            const menuTitles = document.querySelectorAll(".menu-title");

            if (menuTitles[0]) menuTitles[0].innerText = t.menu;
            if (menuTitles[1]) menuTitles[1].innerText = t.data_master;
            if (menuTitles[2]) menuTitles[2].innerText = t.transaksi;
            if (menuTitles[3]) menuTitles[3].innerText = t.lainnya;

            // MENU TEXT
            document.querySelectorAll(".menu-text").forEach(el => {

                const key = el.dataset.key;

                if (key && t[key]) {
                    el.innerText = t[key];
                }

            });

        }

    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const translations = {
            en: {
                dashboard: "Dashboard",
                users: "Users"
            },
            id: {
                dashboard: "Dashboard",
                users: "Pengguna"
            }
        };

        function applyLanguage(lang) {
            const t = translations[lang];
            if (!t) return;

            document.querySelectorAll(".menu-text").forEach(el => {
                const key = el.dataset.key;
                if (t[key]) el.innerText = t[key];
            });
        }

        const saved = localStorage.getItem("lang") || "en";
        applyLanguage(saved);

        document.querySelectorAll(".change-language").forEach(btn => {
            btn.addEventListener("click", function() {
                const lang = this.dataset.lang;
                localStorage.setItem("lang", lang);
                applyLanguage(lang);
            });
        });

    });
    </script>
    <script>
    document.getElementById('btnLogout')
        .addEventListener('click', function() {

            // tampilkan loading
            document.getElementById('logoutLoading')
                .classList.remove('d-none');

            // disable tombol
            this.disabled = true;

            this.innerHTML = 'Logging out...';

            // delay sedikit agar loading terlihat
            setTimeout(() => {

                document.getElementById('logoutForm')
                    .submit();

            }, 500);
        });
    </script>
</body>

</html>
