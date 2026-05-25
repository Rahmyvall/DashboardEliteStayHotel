@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fas fa-door-open text-success me-3"></i> Pilih Kamar Kosong
                </h2>
                <p class="text-muted mb-0">Silakan pilih kamar yang tersedia untuk tamu</p>
            </div>

            <a href="{{ route('resepsionis.kamar.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Semua Kamar
            </a>
        </div>

        <!-- STATS -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 bg-success bg-opacity-10">
                    <div class="card-body text-center">
                        <h1 class="fw-bold text-success mb-0">{{ $kamarKosong->count() }}</h1>
                        <p class="text-success mb-0">Kamar Tersedia</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROOM GRID -->
        <div class="row g-4" id="roomGrid">

            @forelse ($kamarKosong as $item)
                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden room-card">

                        <!-- Card Header -->
                        <div class="card-header border-0 py-3 bg-success bg-opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">{{ $item->nomor_kamar }}</h4>
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Tersedia
                                </span>
                            </div>
                        </div>

                        <div class="card-body text-center pt-4">

                            <div class="mb-4">
                                <div class="text-muted small">Lantai {{ $item->lantai }}</div>
                                <div class="fw-medium mt-1">
                                    {{ $item->tipeKamar->nama_tipe ?? 'Tipe Kamar Tidak Diketahui' }}
                                </div>
                            </div>

                            <form action="{{ route('resepsionis.kamar.pick', $item->id_kamar) }}" method="POST">
                                @csrf
                                <button class="btn btn-success rounded-3 w-100 py-3 fw-medium">
                                    <i class="fas fa-check me-2"></i> Pilih Kamar Ini
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                        <i class="fas fa-bed fa-4x text-muted mb-4 opacity-25"></i>
                        <h5 class="text-muted">Tidak ada kamar kosong saat ini</h5>
                        <p class="text-muted">Semua kamar sedang terisi atau dalam maintenance</p>
                    </div>
                </div>
            @endforelse

        </div>
    </div>

    <style>
        .room-card {
            transition: all 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        }
    </style>
@endsection
