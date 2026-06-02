<!-- ========== Left Sidebar ========== -->
<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <a href="{{ route('dashboard') }}" class="logo-light">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo.png') }}" alt="logo" class="logo-lg"
                height="50">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo.png') }}" alt="small logo" class="logo-sm"
                height="50">
        </a>

        <a href="{{ route('dashboard') }}" class="logo-dark">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo3.png') }}" alt="logo" class="logo-lg"
                height="32">
            <img src="{{ asset('dashtrap/admin/dist/assets/images/logo3.png') }}" alt="small logo" class="logo-sm"
                height="32">
        </a>
    </div>

    <!-- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <!-- Dashboard (Semua Role) -->
            <li class="menu-item">
                <a href="{{ route('dashboard') }}"
                    class="menu-link waves-effect waves-light {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="bx bx-home-smile"></i>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            {{-- ====================== ADMIN ====================== --}}
            @if (auth()->user()->role == 'admin')
                <li class="menu-title">Data Master</li>

                <li class="menu-item">
                    <a href="#menuMaster" data-bs-toggle="collapse"
                        class="menu-link waves-effect waves-light {{ request()->routeIs('users.*', 'pelanggan1.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="bx bx-data"></i></span>
                        <span class="menu-text">Master Data</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse {{ request()->routeIs('users.*', 'pelanggan1.*') ? 'show' : '' }}"
                        id="menuMaster">
                        <ul class="sub-menu">

                            <li>
                                <a href="{{ route('users.index') }}" class="menu-link">
                                    <i class="bx bx-user me-1"></i> Users
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pelanggan1.index') }}" class="menu-link">
                                    <i class="bx bx-group me-1"></i> Pelanggan
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('tipe-kamar.index') }}" class="menu-link">
                                    <i class="bx bx-bed me-1"></i> Tipe Kamar
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('kamar.index') }}" class="menu-link">
                                    <i class="bx bx-building-house me-1"></i> Kamar
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('fasilitas.index') }}" class="menu-link">
                                    <i class="bx bx-wifi me-1"></i> Fasilitas
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('tipe-kamar-fasilitas.index') }}" class="menu-link">
                                    <i class="bx bx-category-alt me-1"></i>
                                    <span>Tipe Kamar Fasilitas</span>
                                </a>
                            </li>

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

                            <li>
                                <a href="{{ route('reservasi.index') }}" class="menu-link">
                                    <i class="bx bx-list-ul me-1"></i>
                                    <span>Daftar Reservasi</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('reservasi.create') }}" class="menu-link">
                                    <i class="bx bx-detail me-1"></i>
                                    <span>Tambah Reservasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pembayaran.index') }}" class="menu-link">
                                    <i class="bx bx-credit-card me-1"></i> Pembayaran
                                </a>
                            </li>

                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-log-in-circle me-1"></i> Check-in & Check-out
                                </a>
                            </li>

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

                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-star me-1"></i> Review
                                </a>
                            </li>

                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-purchase-tag me-1"></i> Promo
                                </a>
                            </li>

                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-gift me-1"></i> Reservasi Promo
                                </a>
                            </li>

                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-history me-1"></i> Log Aktivitas
                                </a>
                            </li>

                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-bell me-1"></i> Notifikasi
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                {{-- ====================== RESEPSIONIS ====================== --}}
            @elseif(auth()->user()->role == 'resepsionis')
                <li class="menu-title">Transaksi</li>
                <li class="menu-item">
                    <a href="#menuTransaksiResep" data-bs-toggle="collapse"
                        class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-cart-alt"></i></span>
                        <span class="menu-text">Reservasi</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="menuTransaksiResep">
                        <ul class="sub-menu">
                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-list-ul me-2"></i> Daftar Reservasi
                                </a>
                            </li>
                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-transfer-alt me-2"></i> Check-in & Check-out
                                </a>
                            </li>
                            <li>
                                <a href="#" class="menu-link">
                                    <i class="bx bx-credit-card me-2"></i> Pembayaran
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Data</li>
                <li class="menu-item">
                    <a href="#menuDataResepsionis" data-bs-toggle="collapse"
                        class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-data"></i></span>
                        <span class="menu-text">Data</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="menuDataResepsionis">
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('resepsionis.pelanggan.index') }}" class="menu-link">
                                    <i class="bx bx-user me-2"></i> Pelanggan
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('resepsionis.kamar.index') }}" class="menu-link">
                                    <i class="bx bx-bed me-2"></i> Kamar Tersedia
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ====================== PELANGGAN ====================== --}}
            @elseif(auth()->user()->role == 'pelanggan')
                <li class="menu-title">Layanan Saya</li>

                <li class="menu-item">
                    <a href="#" class="menu-link active">
                        <span class="menu-icon text-primary">
                            <i class="bx bx-calendar-check"></i>
                        </span>
                        <span class="menu-text">Reservasi Saya</span>
                        <span class="badge bg-primary ms-auto">New</span>
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
