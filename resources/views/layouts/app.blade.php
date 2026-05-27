@include('layouts.header')

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        @include('layouts.sidebar')



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
                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-light.png') }}" alt="logo"
                                    class="logo-lg" height="22">
                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-sm.png') }}" alt="small logo"
                                    class="logo-sm" height="22">
                            </a>

                            <!-- Brand Logo Dark -->
                            <a href="index.html" class="logo-dark">
                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-dark.png') }}"
                                    alt="dark logo" class="logo-lg" height="22">
                                <img src="{{ asset('dashtrap/admin/dist/assets/images/logo-sm.png') }}" alt="small logo"
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
                                            <a href="javascript: void(0);"
                                                class="text-dark text-decoration-underline">
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
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Datacorp
                                                        <small class="fw-normal text-muted ms-1">1 min ago</small>
                                                    </h5>
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
                                                        <img src="{{ asset('dashtrap/admin/dist/assets/images/users/avatar-2.jpg') }}"
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
                                                        <img src="{{ asset('dashtrap/admin/dist/assets/images/users/avatar-4.jpg') }}"
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
                                @if (Auth::user()->foto_profile)
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

            @include('layouts.footer')
            @include('layouts.script')
        </div>
        <!-- End Page content -->


    </div>
    <!-- END wrapper -->

</body>

</html>
