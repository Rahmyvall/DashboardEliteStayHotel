@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fas fa-bed text-primary me-3"></i> Detail Kamar
                </h2>
                <p class="text-muted mb-0">Informasi lengkap dan status operasional kamar</p>
            </div>

            <a href="{{ route('resepsionis.kamar.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Kamar
            </a>
        </div>

        <div class="row g-4">

            <!-- LEFT PANEL - ROOM VISUAL -->
            <div class="col-lg-5 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                    <div
                        class="card-header border-0 py-4 text-center {{ $kamar->status_kamar === 'tersedia'
                            ? 'bg-success bg-opacity-10'
                            : ($kamar->status_kamar === 'terisi'
                                ? 'bg-danger bg-opacity-10'
                                : 'bg-warning bg-opacity-10') }}">

                        <div class="display-1 fw-bold text-dark mb-2">
                            {{ $kamar->nomor_kamar }}
                        </div>
                        <div class="text-muted">Lantai {{ $kamar->lantai }}</div>
                    </div>

                    <div class="card-body text-center p-5">

                        <div class="mb-4">
                            @switch($kamar->status_kamar)
                                @case('tersedia')
                                    <span class="badge bg-success px-5 py-3 rounded-pill fs-5">
                                        <i class="fas fa-check-circle me-2"></i> Tersedia
                                    </span>
                                @break

                                @case('terisi')
                                    <span class="badge bg-danger px-5 py-3 rounded-pill fs-5">
                                        <i class="fas fa-user-check me-2"></i> Terisi
                                    </span>
                                @break

                                @case('dipesan')
                                    <span class="badge bg-warning text-dark px-5 py-3 rounded-pill fs-5">
                                        <i class="fas fa-calendar-alt me-2"></i> Dipesan
                                    </span>
                                @break

                                @default
                                    <span class="badge bg-secondary px-5 py-3 rounded-pill fs-5">
                                        <i class="fas fa-tools me-2"></i> Maintenance
                                    </span>
                            @endswitch
                        </div>

                        <hr class="my-4">

                        <div class="text-muted small mb-2">Tipe Kamar</div>
                        <h4 class="fw-bold text-dark">
                            {{ $kamar->tipeKamar->nama_tipe ?? 'Tidak Diketahui' }}
                        </h4>

                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL - DETAILS -->
            <div class="col-lg-7 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-5">

                        <h5 class="fw-bold mb-4 border-bottom pb-3">
                            <i class="fas fa-info-circle me-2 text-primary"></i> Informasi Kamar
                        </h5>

                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <div class="text-muted small mb-2">Nomor Kamar</div>
                                    <h5 class="fw-bold mb-0">{{ $kamar->nomor_kamar }}</h5>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <div class="text-muted small mb-2">Lantai</div>
                                    <h5 class="fw-bold mb-0">Lantai {{ $kamar->lantai }}</h5>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <div class="text-muted small mb-2">Status Saat Ini</div>
                                    <h5 class="fw-bold mb-0 text-capitalize">
                                        {{ $kamar->status_kamar === 'tersedia'
                                            ? 'Tersedia'
                                            : ($kamar->status_kamar === 'terisi'
                                                ? 'Terisi'
                                                : ($kamar->status_kamar === 'dipesan'
                                                    ? 'Dipesan'
                                                    : 'Maintenance')) }}
                                    </h5>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <div class="text-muted small mb-2">Tipe Kamar</div>
                                    <h5 class="fw-bold mb-0">
                                        {{ $kamar->tipeKamar->nama_tipe ?? '-' }}
                                    </h5>
                                </div>
                            </div>

                        </div>

                        <hr class="my-5">

                        <!-- ACTION BUTTONS -->
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('resepsionis.kamar.index') }}"
                                class="btn btn-light border rounded-3 px-4 py-3">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>

                            @if ($kamar->status_kamar === 'tersedia')
                                <form action="{{ route('resepsionis.kamar.pick', $kamar->id_kamar) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success rounded-3 px-5 py-3">
                                        <i class="fas fa-check me-2"></i> Pilih Kamar Ini
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
@endsection
