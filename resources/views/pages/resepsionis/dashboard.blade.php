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
        <div class="col-md-4 col-lg-3 col-xl-2">
            <a href="{{ $c['link'] ?? '#' }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-3 h-100 card-clickable">
                    <div class="card-body p-3">

                        <div class="d-flex align-items-center gap-2 mb-2">

                            <div class="rounded-3 bg-{{ $c['color'] }} bg-opacity-10
                        text-{{ $c['color'] }} d-flex align-items-center justify-content-center"
                                style="width:40px;height:40px;font-size:1.1rem;">
                                <i class="bi bi-{{ $c['icon'] }}"></i>
                            </div>

                            <div>
                                <div class="text-muted small">
                                    {{ $c['title'] }}
                                </div>
                                <small class="fw-semibold text-dark">
                                    {{ $c['badge'] }}
                                </small>
                            </div>

                        </div>

                        <h5 class="fw-bold mb-1">
                            {{ $c['value'] }}
                        </h5>

                        <div class="d-flex justify-content-between">
                            <small class="text-success fw-semibold">
                                {{ $c['trend'] }}
                            </small>

                            <small class="text-muted">
                                {{ $c['progress'] }}%
                            </small>
                        </div>

                        <div class="progress mt-2" style="height:4px;">
                            <div class="progress-bar bg-{{ $c['color'] }}" style="width:{{ $c['progress'] }}%">
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        @endforeach

    </div>
    {{-- CHART SECTION --}}
    <div class="row mt-3 g-3">

        <!-- Tren Reservasi -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 h-100">

                <div class="card-header bg-white border-0 py-3 px-3">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;">
                                <i class="bi bi-graph-up"></i>
                            </div>

                            <div>
                                <h6 class="fw-semibold mb-0">
                                    Tren Reservasi
                                </h6>
                                <small class="text-muted">
                                    Perbandingan reservasi
                                </small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">

                            <select id="periode-reservasi" class="form-select form-select-sm shadow-sm"
                                style="width:140px;">
                                <option value="monthly">Bulanan</option>
                                <option value="daily">7 Hari</option>
                            </select>

                            <button onclick="refreshChart()" class="btn btn-light btn-sm" title="Refresh">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>

                        </div>

                    </div>
                </div>

                <div class="card-body p-3 pt-2">

                    <!-- Summary -->
                    <div class="row g-2 mb-3" id="reservation-summary">
                        <!-- Generate via JS -->
                    </div>

                    <!-- Grafik lebih kecil -->
                    <div id="apex-line-reservasi" class="apex-charts" style="height:220px;">
                    </div>

                </div>

                <div class="card-footer bg-white border-0 py-2 px-3 text-end">
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i>
                        Update otomatis 5 menit
                    </small>
                </div>

            </div>
        </div>

        <!-- Distribusi Pelanggan -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h6 class="fw-semibold mb-0">
                                Distribusi Pelanggan
                            </h6>
                            <small class="text-muted">
                                Berdasarkan gender
                            </small>
                        </div>

                        <span class="badge bg-primary">
                            <span id="total-pelanggan">0</span>
                        </span>

                    </div>

                    <!-- Pie Chart lebih kecil -->
                    <div id="apex-pie-pelanggan" class="d-flex justify-content-center align-items-center"
                        style="height:200px;">
                    </div>

                    <div class="row text-center mt-3">

                        <div class="col-6">

                            <small class="text-muted d-block">
                                <span class="text-primary">●</span>
                                Laki-laki
                            </small>

                            <h6 id="count-laki" class="fw-bold text-primary mb-0">
                                0
                            </h6>

                        </div>

                        <div class="col-6">

                            <small class="text-muted d-block">
                                <span class="text-danger">●</span>
                                Perempuan
                            </small>

                            <h6 id="count-perempuan" class="fw-bold text-danger mb-0">
                                0
                            </h6>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-12">

            <div class="card border-0 shadow-sm rounded-3">

                {{-- HEADER --}}
                <div class="card-header bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-currency-dollar text-primary fs-5"></i>
                            <div>
                                <h6 class="fw-semibold mb-0">Pendapatan Bulanan</h6>
                                <small class="text-muted">Grafik pendapatan hotel</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <select id="yearFilter" class="form-select form-select-sm" style="width: 110px;">
                                @for ($y = date('Y') - 2; $y <= date('Y'); $y++) <option value="{{ $y }}"
                                    {{ $y == date('Y') ? 'selected' : '' }}>
                                    {{ $y }}
                                    </option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                </div>

                {{-- CHART --}}
                <div class="card-body px-4 py-3">
                    <div style="height: 260px;">
                        <canvas id="pendapatanChart"></canvas>
                    </div>
                </div>

                {{-- FOOTER STATS --}}
                <div class="card-footer bg-light border-0 py-3 px-4">
                    <div class="row g-2 text-center text-md-start">

                        <div class="col-4">
                            <small class="text-muted d-block">Total Tahun</small>
                            <h6 class="fw-bold text-primary mb-0" id="totalTahun">
                                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                            </h6>
                        </div>

                        <div class="col-4">
                            <small class="text-muted d-block">Rata-rata</small>
                            <h6 class="fw-bold text-success mb-0" id="rataRata">
                                Rp {{ number_format(($totalPendapatan ?? 0) / 12, 0, ',', '.') }}
                            </h6>
                        </div>

                        <div class="col-4">
                            <small class="text-muted d-block">Transaksi</small>
                            <h6 class="fw-bold text-warning mb-0" id="totalTransaksi">
                                {{ $totalTransaksi ?? 0 }}
                            </h6>
                        </div>

                    </div>
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
                            <h6 class="fw-semibold mb-1">Latest Reviews</h6>
                            <small class="text-muted">Top 5 recent customer reviews</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-hover modern-table mb-0">

                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th class="text-end">Date</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($reviews ?? [] as $review)

                                <tr>
                                    <!-- Customer -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div
                                                class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-semibold">
                                                {{ strtoupper(substr(optional(optional($review->reservasi)->pelanggan)->nama_lengkap ?? 'U', 0, 1)) }}
                                            </div>

                                            <div class="fw-medium">
                                                {{ optional(optional($review->reservasi)->pelanggan)->nama_lengkap ?? 'Unknown' }}
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Rating -->
                                    <td>
                                        <span class="text-warning">
                                            {{ str_repeat('⭐', $review->rating ?? 0) }}
                                        </span>
                                        <small class="text-muted">({{ $review->rating ?? 0 }}/5)</small>
                                    </td>

                                    <!-- Comment -->
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;">
                                            {{ $review->komentar ?? '-' }}
                                        </div>
                                    </td>

                                    <!-- Date -->
                                    <td class="text-end text-muted small">
                                        {{ optional($review->created_at)->format('Y-m-d') }}
                                    </td>
                                </tr>

                                @empty

                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Belum ada review
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
