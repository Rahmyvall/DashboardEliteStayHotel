@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1 text-dark">
                    <i class="fas fa-bed me-2 text-primary"></i> Manajemen Kamar
                </h2>
                <p class="text-muted mb-0">Real-time status kamar hotel</p>
            </div>

            <div class="d-flex gap-3">
                <a href="{{ route('resepsionis.kamar.create') }}" class="btn btn-primary px-4 rounded-3 shadow-sm">
                    <i class="fas fa-plus me-2"></i> Tambah Kamar
                </a>
            </div>
        </div>

        <!-- STATISTICS -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted small mb-1">Total Kamar</p>
                                <h3 class="fw-bold mb-0">{{ $kamar->count() }}</h3>
                            </div>
                            <div class="text-primary">
                                <i class="fas fa-hotel fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-success small mb-1">Tersedia</p>
                                <h3 class="fw-bold mb-0 text-success">
                                    {{ $kamar->where('status_kamar', 'tersedia')->count() }}
                                </h3>
                            </div>
                            <div class="text-success">
                                <i class="fas fa-door-open fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-danger bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-danger small mb-1">Terisi</p>
                                <h3 class="fw-bold mb-0 text-danger">
                                    {{ $kamar->where('status_kamar', 'terisi')->count() }}
                                </h3>
                            </div>
                            <div class="text-danger">
                                <i class="fas fa-user-check fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-warning bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-warning small mb-1">Dipesan</p>
                                <h3 class="fw-bold mb-0 text-warning">
                                    {{ $kamar->where('status_kamar', 'dipesan')->count() }}
                                </h3>
                            </div>
                            <div class="text-warning">
                                <i class="fas fa-calendar-check fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTERS -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <input type="text" id="searchKamar" class="form-control rounded-3"
                            placeholder="Cari nomor kamar atau tipe...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select rounded-3" id="filterStatus">
                            <option value="">Semua Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="terisi">Terisi</option>
                            <option value="dipesan">Dipesan</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select rounded-3" id="filterLantai">
                            <option value="">Semua Lantai</option>
                            @foreach (range(1, 10) as $l)
                                <option value="{{ $l }}">Lantai {{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-secondary w-100 rounded-3" onclick="resetFilter()">
                            <i class="fas fa-sync-alt me-2"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROOM GRID -->
        <div class="row g-4" id="roomGrid">

            @forelse ($kamar as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 room-card" data-status="{{ $item->status_kamar }}"
                    data-lantai="{{ $item->lantai }}"
                    data-search="{{ strtolower($item->nomor_kamar . ' ' . ($item->tipeKamar->nama_tipe ?? '')) }}">

                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                        <!-- Card Header with Status -->
                        <div
                            class="card-header border-0 py-3 {{ $item->status_kamar === 'tersedia' ? 'bg-success bg-opacity-10' : ($item->status_kamar === 'terisi' ? 'bg-danger bg-opacity-10' : 'bg-warning bg-opacity-10') }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0 text-dark">
                                    {{ $item->nomor_kamar }}
                                </h4>
                                @switch($item->status_kamar)
                                    @case('tersedia')
                                        <span class="badge bg-success rounded-pill px-3 py-2">Tersedia</span>
                                    @break

                                    @case('terisi')
                                        <span class="badge bg-danger rounded-pill px-3 py-2">Terisi</span>
                                    @break

                                    @case('dipesan')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Dipesan</span>
                                    @break

                                    @default
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">Maintenance</span>
                                @endswitch
                            </div>
                        </div>

                        <div class="card-body pt-4">
                            <div class="text-center mb-4">
                                <div class="text-muted small mb-1">Lantai {{ $item->lantai }}</div>
                                <div class="fw-medium">
                                    {{ $item->tipeKamar->nama_tipe ?? 'Tipe tidak diketahui' }}
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('resepsionis.kamar.show', $item->id_kamar) }}"
                                    class="btn btn-outline-primary rounded-3">
                                    <i class="fas fa-info-circle me-2"></i> Detail Kamar
                                </a>

                                @if ($item->status_kamar === 'tersedia')
                                    <form action="{{ route('resepsionis.kamar.pick', $item->id_kamar) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success rounded-3 w-100">
                                            <i class="fas fa-check me-2"></i> Pilih Kamar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="fas fa-bed fa-3x mb-3 opacity-50"></i>
                        <h5>Tidak ada data kamar</h5>
                    </div>
                @endforelse

            </div>
        </div>

        <style>
            .card {
                transition: all 0.3s ease;
            }

            .card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
            }

            .room-card {
                transition: all 0.3s ease;
            }

            .badge {
                font-weight: 500;
            }
        </style>

        <script>
            // Simple live filter
            document.getElementById('searchKamar').addEventListener('keyup', filterRooms);
            document.getElementById('filterStatus').addEventListener('change', filterRooms);
            document.getElementById('filterLantai').addEventListener('change', filterRooms);

            function filterRooms() {
                const search = document.getElementById('searchKamar').value.toLowerCase();
                const status = document.getElementById('filterStatus').value;
                const lantai = document.getElementById('filterLantai').value;

                document.querySelectorAll('.room-card').forEach(card => {
                    const cardSearch = card.dataset.search;
                    const cardStatus = card.dataset.status;
                    const cardLantai = card.dataset.lantai;

                    const matchSearch = !search || cardSearch.includes(search);
                    const matchStatus = !status || cardStatus === status;
                    const matchLantai = !lantai || cardLantai === lantai;

                    card.style.display = (matchSearch && matchStatus && matchLantai) ? '' : 'none';
                });
            }

            function resetFilter() {
                document.getElementById('searchKamar').value = '';
                document.getElementById('filterStatus').value = '';
                document.getElementById('filterLantai').value = '';
                filterRooms();
            }
        </script>
    @endsection
