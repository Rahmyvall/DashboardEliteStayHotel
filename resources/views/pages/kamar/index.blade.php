@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold text-dark mb-1">
                    <i class="bi bi-building-fill me-3 text-primary"></i>Manajemen Kamar
                </h1>
                <p class="text-muted fs-5 mb-0">Real-time overview status kamar hotel</p>
            </div>

            <a href="{{ route('kamar.create') }}"
                class="btn btn-primary btn-lg shadow-lg px-5 py-3 rounded-4 d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill fs-4"></i>
                <span>Tambah Kamar Baru</span>
            </a>
        </div>

        <!-- STATS CARDS -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-scale">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">TOTAL KAMAR</p>
                                <h2 class="fw-bold text-dark mb-0">{{ $stats['total'] }}</h2>
                            </div>
                            <div class="bg-primary bg-gradient text-white p-3 rounded-3 shadow-sm">
                                <i class="bi bi-door-open fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 py-3 text-center text-primary fw-medium small">
                        Semua Kamar
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-scale">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-success mb-1 small fw-medium">TERSEDIA</p>
                                <h2 class="fw-bold text-success mb-0">{{ $stats['tersedia'] }}</h2>
                            </div>
                            <div class="bg-success bg-gradient text-white p-3 rounded-3 shadow-sm">
                                <i class="bi bi-check-circle-fill fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 py-3 text-center text-success fw-medium small">
                        Siap Digunakan
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-scale">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-danger mb-1 small fw-medium">TERISI</p>
                                <h2 class="fw-bold text-danger mb-0">{{ $stats['terisi'] }}</h2>
                            </div>
                            <div class="bg-danger bg-gradient text-white p-3 rounded-3 shadow-sm">
                                <i class="bi bi-person-fill fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 py-3 text-center text-danger fw-medium small">
                        Sedang Ditempati
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-scale">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-warning mb-1 small fw-medium">DIPESAN</p>
                                <h2 class="fw-bold text-warning mb-0">{{ $stats['dipesan'] }}</h2>
                            </div>
                            <div class="bg-warning bg-gradient text-white p-3 rounded-3 shadow-sm">
                                <i class="bi bi-calendar-check-fill fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 py-3 text-center text-warning fw-medium small">
                        Menunggu Check-in
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-white border-0 pt-4 pb-3 px-4">
                <h5 class="mb-0 fw-semibold text-dark">Daftar Kamar</h5>
            </div>

            <div class="card-body p-4">

                <!-- SEARCH & FILTER -->
                <form method="GET" class="mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-5">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-0 rounded-start-4">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border-0 bg-light rounded-end-4"
                                    placeholder="Cari nomor kamar, tipe, atau lantai...">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select name="status" class="form-select form-select-lg border-0 bg-light rounded-4">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="dipesan" {{ request('status') == 'dipesan' ? 'selected' : '' }}>Dipesan
                                </option>
                                <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-dark w-100 btn-lg rounded-4 shadow-sm">
                                <i class="bi bi-search me-2"></i>Cari
                            </button>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('kamar.index') }}" class="btn btn-outline-secondary w-100 btn-lg rounded-4">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- TABLE -->
                <div class="table-responsive rounded-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nomor Kamar</th>
                                <th>Tipe Kamar</th>
                                <th>Lantai</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border-top">
                            @forelse ($kamar as $item)
                                <tr class="align-middle">
                                    <td class="fw-medium text-center">
                                        {{ $loop->iteration + ($kamar->currentPage() - 1) * $kamar->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="fw-bold fs-4 text-primary">🛌</div>
                                            <div>
                                                <div class="fw-bold fs-5">{{ $item->nomor_kamar }}</div>
                                                <small class="text-muted">ID:
                                                    #{{ str_pad($item->id_kamar, 4, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark fs-6 px-3 py-2 rounded-3">
                                            {{ $item->tipeKamar->nama_tipe ?? 'Standard' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary fs-6 px-3 py-2 rounded-3">Lantai
                                            {{ $item->lantai }}</span>
                                    </td>
                                    <td>
                                        @switch($item->status_kamar)
                                            @case('tersedia')
                                                <span class="badge bg-success px-3 py-2 fs-6 rounded-3">✔ Tersedia</span>
                                            @break

                                            @case('dipesan')
                                                <span class="badge bg-warning text-dark px-3 py-2 fs-6 rounded-3">⏳ Dipesan</span>
                                            @break

                                            @case('terisi')
                                                <span class="badge bg-danger px-3 py-2 fs-6 rounded-3">🔴 Terisi</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary px-3 py-2 fs-6 rounded-3">Maintenance</span>
                                        @endswitch
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group shadow-sm" role="group">
                                            <a href="{{ route('kamar.show', $item->id_kamar) }}"
                                                class="btn btn-outline-info btn-sm" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('kamar.edit', $item->id_kamar) }}"
                                                class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            @if ($item->status_kamar == 'dipesan')
                                                <form action="{{ route('kamar.konfirmasi', $item->id_kamar) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-success btn-sm"
                                                        onclick="return confirm('Konfirmasi check-in kamar ini?')">
                                                        <i class="bi bi-check2-circle"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('kamar.destroy', $item->id_kamar) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus kamar ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="bi bi-inbox display-1 text-muted opacity-75"></i>
                                            <p class="mt-3 text-muted fs-5">Tidak ada data kamar ditemukan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-between align-items-center mt-4 px-2">
                        <small class="text-muted">
                            Menampilkan {{ $kamar->firstItem() ?? 0 }} - {{ $kamar->lastItem() ?? 0 }}
                            dari total <strong>{{ $kamar->total() ?? 0 }}</strong> kamar
                        </small>
                        <div>
                            {{ $kamar->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <style>
            .hover-scale {
                transition: all 0.3s ease;
            }

            .hover-scale:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
            }
        </style>
    @endsection
