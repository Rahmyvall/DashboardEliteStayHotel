@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">

        {{-- TITLE --}}
        <div class="d-flex align-items-center justify-content-between mb-4">

            <div>

                <h3 class="fw-semibold mb-1">
                    {{ $title ?? 'Dashboard' }}
                </h3>

                <small class="text-muted">
                    Overview dashboard terbaru
                </small>

            </div>

        </div>

        {{-- CARDS --}}
        <div class="row g-4">

            @php
                use App\Models\User;
                use App\Models\TipeKamar;
                use App\Models\Kamar;
                use App\Models\TipeKamarFasilitas;

                $cards = [
                    /*
                |--------------------------------------------------------------------------
                | USERS
                |--------------------------------------------------------------------------
                */
                    [
                        'title' => 'Total Users',
                        'value' => User::count(),
                        'badge' => 'Semua User',
                        'progress' => 100,
                        'trend' => '+100%',
                        'icon' => 'people',
                        'color' => 'primary',
                        'link' => route('users.index'),
                    ],

                    [
                        'title' => 'Admin',
                        'value' => User::where('role', 'admin')->count(),
                        'badge' => 'Role Admin',
                        'progress' => 60,
                        'trend' => '+5%',
                        'icon' => 'shield-lock',
                        'color' => 'danger',
                        'link' => route('users.index', ['role' => 'admin']),
                    ],

                    [
                        'title' => 'Resepsionis',
                        'value' => User::where('role', 'resepsionis')->count(),
                        'badge' => 'Front Office',
                        'progress' => 40,
                        'trend' => '+3%',
                        'icon' => 'person-badge',
                        'color' => 'warning',
                        'link' => route('users.index', ['role' => 'resepsionis']),
                    ],

                    [
                        'title' => 'Pelanggan',
                        'value' => User::where('role', 'pelanggan')->count(),
                        'badge' => 'Customer',
                        'progress' => 80,
                        'trend' => '+12%',
                        'icon' => 'person-lines-fill',
                        'color' => 'info',
                        'link' => route('users.index', ['role' => 'pelanggan']),
                    ],

                    [
                        'title' => 'User Aktif',
                        'value' => User::where('status', 'aktif')->count(),
                        'badge' => 'Aktif Sekarang',
                        'progress' => 90,
                        'trend' => '+8%',
                        'icon' => 'check-circle-fill',
                        'color' => 'success',
                        'link' => route('users.index', ['status' => 'aktif']),
                    ],

                    /*
                |--------------------------------------------------------------------------
                | TIPE KAMAR
                |--------------------------------------------------------------------------
                */
                    [
                        'title' => 'Tipe Kamar',
                        'value' => TipeKamar::count(),
                        'badge' => 'Jenis Kamar Hotel',
                        'progress' => 75,
                        'trend' => '+9%',
                        'icon' => 'grid-3x3-gap',
                        'color' => 'primary',
                        'link' => route('tipe-kamar.index'),
                    ],

                    /*
                |--------------------------------------------------------------------------
                | TIPE KAMAR FASILITAS
                |--------------------------------------------------------------------------
                */
                    [
                        'title' => 'Tipe Kamar Fasilitas',
                        'value' => TipeKamarFasilitas::count(),
                        'badge' => 'Relasi Fasilitas Hotel',
                        'progress' => 85,
                        'trend' => '+11%',
                        'icon' => 'diagram-3-fill',
                        'color' => 'secondary',
                        'link' => route('tipe-kamar-fasilitas.index'),
                    ],

                    [
                        'title' => 'Relasi Hari Ini',
                        'value' => TipeKamarFasilitas::whereDate('created_at', today())->count(),
                        'badge' => 'Data Baru',
                        'progress' => 70,
                        'trend' => '+7%',
                        'icon' => 'plus-circle-fill',
                        'color' => 'info',
                        'link' => route('tipe-kamar-fasilitas.index'),
                    ],

                    /*
                |--------------------------------------------------------------------------
                | KAMAR
                |--------------------------------------------------------------------------
                */
                    [
                        'title' => 'Total Kamar',
                        'value' => Kamar::count(),
                        'badge' => 'Semua Kamar Hotel',
                        'progress' => 100,
                        'trend' => '+100%',
                        'icon' => 'door-open',
                        'color' => 'primary',
                        'link' => route('kamar.index'),
                    ],

                    [
                        'title' => 'Kamar Tersedia',
                        'value' => Kamar::where('status_kamar', 'tersedia')->count(),
                        'badge' => 'Siap Dipesan',
                        'progress' => 85,
                        'trend' => '+6%',
                        'icon' => 'check2-circle',
                        'color' => 'success',
                        'link' => route('kamar.index', ['status' => 'tersedia']),
                    ],

                    [
                        'title' => 'Kamar Terisi',
                        'value' => Kamar::where('status_kamar', 'terisi')->count(),
                        'badge' => 'Sedang Dipakai',
                        'progress' => 60,
                        'trend' => '+4%',
                        'icon' => 'door-closed',
                        'color' => 'danger',
                        'link' => route('kamar.index', ['status' => 'terisi']),
                    ],

                    [
                        'title' => 'Kamar Dipesan',
                        'value' => Kamar::where('status_kamar', 'dipesan')->count(),
                        'badge' => 'Booking',
                        'progress' => 40,
                        'trend' => '+3%',
                        'icon' => 'clock',
                        'color' => 'warning',
                        'link' => route('kamar.index', ['status' => 'dipesan']),
                    ],
                ];
            @endphp

            @foreach ($cards as $c)
                <div class="col-md-6 col-xl-3">

                    <a href="{{ $c['link'] ?? '#' }}" class="text-decoration-none">

                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden card-clickable">

                            <div class="card-body p-4 pb-3">

                                <div class="d-flex justify-content-between align-items-start mb-4">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="rounded-3 bg-{{ $c['color'] }} bg-opacity-10 text-{{ $c['color'] }} d-flex align-items-center justify-content-center flex-shrink-0"
                                            style="width: 52px; height: 52px; font-size: 1.6rem;">

                                            <i class="bi bi-{{ $c['icon'] }}"></i>

                                        </div>

                                        <div>

                                            <div class="text-muted small fw-medium">
                                                {{ $c['title'] }}
                                            </div>

                                            <div class="fw-semibold text-dark">
                                                {{ $c['badge'] }}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <h3 class="fw-bold mb-1 text-dark" style="font-size: 2.1rem;">

                                    {{ $c['value'] }}

                                </h3>

                                <div class="d-flex justify-content-between align-items-end mt-3">

                                    <span
                                        class="text-{{ str_starts_with($c['trend'], '+') ? 'success' : 'danger' }} fw-semibold">

                                        {{ $c['trend'] }}

                                    </span>

                                    <small class="text-muted">
                                        Progress {{ $c['progress'] }}%
                                    </small>

                                </div>

                                <div class="progress mt-2" style="height: 7px;">

                                    <div class="progress-bar bg-{{ $c['color'] }}" style="width: {{ $c['progress'] }}%">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>
            @endforeach

        </div>
        {{-- CHART SECTION --}}
        <div class="row mt-4 g-4">

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold mb-0">
                                Tren Reservasi
                            </h6>
                            <select id="periode-reservasi" class="form-select form-select-sm w-auto">
                                <option value="monthly">Bulanan</option>
                                <option value="daily">Harian (7 Hari Terakhir)</option>
                            </select>
                        </div>

                        <div id="apex-line-reservasi" class="apex-charts"></div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-semibold mb-0">Distribusi Pelanggan</h6>

                            <span class="badge bg-primary fs-6">
                                Total: <span id="total-pelanggan" class="fw-bold">0</span>
                            </span>
                        </div>

                        <!-- Chart (IMPORTANT: kasih height fix + centering) -->
                        <div id="apex-pie-pelanggan"
                            style="min-height: 280px; display:flex; align-items:center; justify-content:center;">
                        </div>

                        <!-- Legend -->
                        <div class="row text-center mt-4">

                            <div class="col-6">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="text-primary fs-4">●</span>
                                    <span class="text-muted">Laki-laki</span>
                                </div>
                                <h5 id="count-laki" class="fw-bold text-primary mb-0">0</h5>
                            </div>

                            <div class="col-6">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="text-danger fs-4">●</span>
                                    <span class="text-muted">Perempuan</span>
                                </div>
                                <h5 id="count-perempuan" class="fw-bold text-danger mb-0">0</h5>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-3">Candlestick</h6>
                        <div id="apex-candlestick-1" class="apex-charts"></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- TABLE + REVENUE --}}
        <div class="row mt-4 g-4">

            {{-- CHART --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-semibold mb-1">Total Revenue</h6>
                                <small class="text-muted">Overview performance</small>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm"
                                    style="width:38px;height:38px;" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another</a></li>
                                </ul>
                            </div>
                        </div>

                        <div id="morris-line-example" style="height:280px;"></div>

                    </div>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-semibold mb-1">Top 5 Customers</h6>
                                <small class="text-muted">Latest registered users</small>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle table-hover modern-table mb-0">

                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Contact</th>
                                        <th>Location</th>
                                        <th class="text-end">Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-semibold">
                                                        U{{ $i }}
                                                    </div>
                                                    <div class="fw-medium">User {{ $i }}</div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    <div>+62 xxx</div>
                                                    <div class="text-muted">user@email.com</div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge bg-light text-dark rounded-pill">
                                                    Indonesia
                                                </span>
                                            </td>

                                            <td class="text-end text-muted small">
                                                2026-05-21
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
