@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-dark mb-1">
                    <i class="bi bi-building me-2 text-primary"></i>Manajemen Kamar
                </h2>
                <p class="text-muted mb-0">Overview real-time status kamar hotel</p>
            </div>

            <a href="{{ route('kamar.create') }}" class="btn btn-primary btn-lg shadow-sm px-4">
                <i class="bi bi-plus-circle-fill me-2"></i>Tambah Kamar Baru
            </a>
        </div>

        <!-- STATS CARDS -->
        <!-- STATS CARDS -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small">TOTAL KAMAR</p>
                                <h2 class="fw-bold mb-0">{{ $stats['total'] }}</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                                <i class="bi bi-door-open fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-success mb-1 small">TERSEDIA</p>
                                <h2 class="fw-bold text-success mb-0">{{ $stats['tersedia'] }}</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                                <i class="bi bi-check-circle fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-danger mb-1 small">TERISI</p>
                                <h2 class="fw-bold text-danger mb-0">{{ $stats['terisi'] }}</h2>
                            </div>
                            <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-3">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-warning mb-1 small">DIPESAN</p>
                                <h2 class="fw-bold text-warning mb-0">{{ $stats['dipesan'] }}</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                                <i class="bi bi-calendar-check fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN CARD -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="mb-0 fw-semibold">Daftar Kamar</h5>
            </div>

            <div class="card-body">

                <!-- SEARCH & FILTER -->
                <form method="GET" class="mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-5">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border-0 bg-light"
                                    placeholder="Cari nomor kamar, tipe, atau lantai...">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select name="status" class="form-select form-select-lg border-0 bg-light">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="dipesan" {{ request('status') == 'dipesan' ? 'selected' : '' }}>Dipesan
                                </option>
                                <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-dark w-100 btn-lg">
                                <i class="bi bi-search me-2"></i>Cari
                            </button>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('kamar.index') }}" class="btn btn-outline-secondary w-100 btn-lg">
                                Reset Filter
                            </a>
                        </div>
                    </div>
                </form>

                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
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
                        <tbody>
                            @forelse ($kamar as $item)
                                <tr>
                                    <td class="fw-medium">
                                        {{ $loop->iteration + ($kamar->currentPage() - 1) * $kamar->perPage() }}
                                    </td>
                                    <td>
                                        <div class="fw-bold fs-5 text-primary">🛌 {{ $item->nomor_kamar }}</div>
                                        <small class="text-muted">
                                            ID: #{{ str_pad($item->id_kamar, 4, '0', STR_PAD_LEFT) }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark fs-6 px-3 py-2">
                                            {{ $item->tipeKamar->nama_tipe ?? 'Standard' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary fs-6 px-3 py-2">Lantai {{ $item->lantai }}</span>
                                    </td>
                                    <td>
                                        @switch($item->status_kamar)
                                            @case('tersedia')
                                                <span class="badge bg-success px-3 py-2 fs-6">✔ Tersedia</span>
                                            @break

                                            @case('dipesan')
                                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">⏳ Dipesan</span>
                                            @break

                                            @case('terisi')
                                                <span class="badge bg-danger px-3 py-2 fs-6">🔴 Terisi</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary px-3 py-2 fs-6">Maintenance</span>
                                        @endswitch
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
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
                                            <i class="bi bi-inbox display-1 text-muted"></i>
                                            <p class="mt-3 text-muted">Tidak ada data kamar ditemukan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <small class="text-muted">
                            Menampilkan {{ $kamar->firstItem() ?? 0 }} - {{ $kamar->lastItem() ?? 0 }}
                            dari total {{ $kamar->total() ?? 0 }} kamar
                        </small>
                        <div>
                            {{ $kamar->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
