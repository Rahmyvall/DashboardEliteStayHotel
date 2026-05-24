<!-- ========== Left Sidebar ========== -->
<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <a href="{{ route('dashboard') }}" class="logo-light">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo.png') }}" 
                 alt="logo" class="logo-lg" height="50">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo.png') }}" 
                 alt="small logo" class="logo-sm" height="50">
        </a>

        <a href="{{ route('dashboard') }}" class="logo-dark">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo3.png') }}" 
                 alt="logo" class="logo-lg" height="32">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo3.png') }}" 
                 alt="small logo" class="logo-sm" height="32">
        </a>
    </div>

    <!-- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <!-- Dashboard (Semua Role) -->
            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link waves-effect waves-light {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="bx bx-home-smile"></i>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            {{-- ====================== ADMIN ====================== --}}
            @if(auth()->user()->role == 'admin')
                
                <li class="menu-title">Data Master</li>
                
                <li class="menu-item">
                    <a href="#menuMaster" data-bs-toggle="collapse" 
                       class="menu-link waves-effect waves-light {{ request()->routeIs('users.*', 'pelanggan1.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="bx bx-data"></i></span>
                        <span class="menu-text">Master Data</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('users.*', 'pelanggan1.*') ? 'show' : '' }}" id="menuMaster">
                        <ul class="sub-menu">
                            <li><a href="{{ route('users.index') }}" class="menu-link">Users</a></li>
                            <li><a href="{{ route('pelanggan1.index') }}" class="menu-link">Pelanggan</a></li>
                            <li><a href="#" class="menu-link">Tipe Kamar</a></li>
                            <li><a href="#" class="menu-link">Kamar</a></li>
                            <li><a href="#" class="menu-link">Fasilitas</a></li>
                            <li><a href="#" class="menu-link">Tipe Kamar Fasilitas</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Transaksi</li>
                <li class="menu-item">
                    <a href="#menuTransaksi" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-cart-alt"></i></span>
                        <span class="menu-text">Reservasi</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuTransaksi">
                        <ul class="sub-menu">
                            <li><a href="#" class="menu-link">Daftar Reservasi</a></li>
                            <li><a href="#" class="menu-link">Detail Reservasi</a></li>
                            <li><a href="#" class="menu-link">Pembayaran</a></li>
                            <li><a href="#" class="menu-link">Check-in & Check-out</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Lainnya</li>
                <li class="menu-item">
                    <a href="#menuLainnya" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-cog"></i></span>
                        <span class="menu-text">Fitur Lainnya</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuLainnya">
                        <ul class="sub-menu">
                            <li><a href="#" class="menu-link">Review</a></li>
                            <li><a href="#" class="menu-link">Promo</a></li>
                            <li><a href="#" class="menu-link">Reservasi Promo</a></li>
                            <li><a href="#" class="menu-link">Log Aktivitas</a></li>
                            <li><a href="#" class="menu-link">Notifikasi</a></li>
                        </ul>
                    </div>
                </li>

            {{-- ====================== RESEPSIONIS ====================== --}}
            @elseif(auth()->user()->role == 'resepsionis')

                <li class="menu-title">Transaksi</li>
                <li class="menu-item">
                    <a href="#menuTransaksiResep" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-cart-alt"></i></span>
                        <span class="menu-text">Reservasi</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuTransaksiResep">
                        <ul class="sub-menu">
                            <li><a href="#" class="menu-link">Daftar Reservasi</a></li>
                            <li><a href="#" class="menu-link">Check-in & Check-out</a></li>
                            <li><a href="#" class="menu-link">Pembayaran</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Data</li>
                <li class="menu-item">
                    <a href="#menuDataResepsionis" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-data"></i></span>
                        <span class="menu-text">Data</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuDataResepsionis">
                        <ul class="sub-menu">
                           <li>
    <a href="{{ route('resepsionis.pelanggan.index') }}" class="menu-link">
        Pelanggan
    </a>
</li>
                            <li><a href="#" class="menu-link">Kamar Tersedia</a></li>
                        </ul>
                    </div>
                </li>

            {{-- ====================== PELANGGAN ====================== --}}
            @elseif(auth()->user()->role == 'pelanggan')

                <li class="menu-title">Layanan Saya</li>
                
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon"><i class="bx bx-calendar-check"></i></span>
                        <span class="menu-text">Reservasi Saya</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon"><i class="bx bx-credit-card"></i></span>
                        <span class="menu-text">Riwayat Pembayaran</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon"><i class="bx bx-star"></i></span>
                        <span class="menu-text">Review Saya</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon"><i class="bx bx-gift"></i></span>
                        <span class="menu-text">Promo Tersedia</span>
                    </a>
                </li>

            @endif

        </ul>
    </div>
</div>