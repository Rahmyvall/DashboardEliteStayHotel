@extends('layouts.app')

@section('title', 'Data Fasilitas')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>
                <h3 class="fw-bold mb-1">
                    Data Fasilitas Hotel
                </h3>

                <p class="text-muted mb-0">
                    Kelola seluruh fasilitas hotel dengan tampilan modern dan elegan.
                </p>
            </div>

        </div>

        {{-- Statistik --}}
        <div class="row mb-4">

            <div class="col-lg-3 col-md-6">

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    <div class="card-body position-relative p-4">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">
                            <i class="bi bi-building" style="font-size: 70px;"></i>
                        </div>

                        <div class="d-flex align-items-center">

                            <div class="bg-primary bg-opacity-10 rounded-4 p-3 me-3">
                                <i class="bi bi-grid text-primary fs-3"></i>
                            </div>

                            <div>
                                <p class="text-muted small mb-1">
                                    Total Fasilitas
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ $stats['total'] }}
                                </h3>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show">

                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        {{-- Card --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            {{-- Header --}}
            <div class="card-header bg-white border-0 p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Daftar Fasilitas
                        </h5>

                        <p class="text-muted small mb-0">
                            Menampilkan semua fasilitas hotel yang tersedia.
                        </p>

                    </div>

                    {{-- Search --}}
                    <form action="{{ route('fasilitas.index') }}" method="GET">

                        <div class="input-group shadow-sm rounded-3 overflow-hidden">

                            <span class="input-group-text bg-light border-0 px-3">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text" name="search" class="form-control border-0 bg-light"
                                placeholder="Cari fasilitas..." value="{{ request('search') }}">

                            <button type="submit" class="btn btn-primary px-4">

                                Cari

                            </button>

                        </div>

                    </form>

                </div>

            </div>

            {{-- Body --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle table-hover mb-0">

                        <thead class="bg-light">

                            <tr>
                                <th class="ps-4 py-3 text-muted fw-semibold">#</th>
                                <th class="py-3 text-muted fw-semibold">Fasilitas</th>
                                <th class="py-3 text-muted fw-semibold">Deskripsi</th>
                                <th class="py-3 text-muted fw-semibold">Tanggal</th>
                                <th class="text-center py-3 pe-4 text-muted fw-semibold">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($fasilitas as $item)
                                <tr>

                                    {{-- Nomor --}}
                                    <td class="ps-4 fw-semibold text-secondary">
                                        {{ $loop->iteration + ($fasilitas->firstItem() - 1) }}
                                    </td>

                                    {{-- Fasilitas --}}
                                    <td>

                                        <div class="d-flex align-items-center">

                                            {{-- Image --}}
                                            <div class="position-relative me-3">

                                                <div class="rounded-4 overflow-hidden shadow-sm border bg-light"
                                                    style="width: 75px; height: 75px; min-width:75px;">

                                                    @if (!empty($item->icon) && file_exists(public_path('storage/' . $item->icon)))
                                                        <img src="{{ asset('storage/' . $item->icon) }}"
                                                            alt="{{ $item->nama_fasilitas }}" class="w-100 h-100"
                                                            style="object-fit: cover;">
                                                    @else
                                                        <div
                                                            class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">

                                                            <i class="bi bi-image fs-2 opacity-50"></i>

                                                        </div>
                                                    @endif

                                                </div>

                                            </div>

                                            {{-- Nama --}}
                                            <div>

                                                <h6 class="fw-bold mb-1">
                                                    {{ $item->nama_fasilitas }}
                                                </h6>

                                                <small class="text-muted">

                                                    @if ($item->icon)
                                                        {{ basename($item->icon) }}
                                                    @else
                                                        Tidak ada gambar
                                                    @endif

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Deskripsi --}}
                                    <td style="max-width: 350px;">

                                        <p class="text-muted mb-0 small">

                                            {{ Str::limit($item->deskripsi, 90, '...') ?: '-' }}

                                        </p>

                                    </td>

                                    {{-- Tanggal --}}
                                    <td>

                                        <div class="d-flex flex-column">

                                            <span class="fw-semibold text-dark">
                                                {{ $item->created_at->format('d M Y') }}
                                            </span>

                                            <small class="text-muted">
                                                {{ $item->created_at->format('H:i') }}
                                            </small>

                                        </div>

                                    </td>

                                    {{-- Aksi --}}
                                    <td class="text-center pe-4">

                                        <div class="d-flex justify-content-center align-items-center gap-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('fasilitas.edit', $item->id_fasilitas) }}"
                                                class="btn btn-warning btn-sm rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;" data-bs-toggle="tooltip" title="Edit">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('fasilitas.destroy', $item->id_fasilitas) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;" data-bs-toggle="tooltip"
                                                    title="Hapus">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-5">

                                        <div class="py-5">

                                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                                style="width: 110px; height: 110px;">

                                                <i class="bi bi-building text-secondary opacity-50"
                                                    style="font-size: 55px;"></i>

                                            </div>

                                            <h5 class="fw-bold">
                                                Belum Ada Data Fasilitas
                                            </h5>

                                            <p class="text-muted mb-0">
                                                Silakan tambahkan fasilitas hotel terlebih dahulu.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Footer --}}
            <div class="card-footer bg-white border-0 py-3 px-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <small class="text-muted">
                        Menampilkan {{ $fasilitas->firstItem() ?? 0 }}
                        sampai {{ $fasilitas->lastItem() ?? 0 }}
                        dari {{ $fasilitas->total() }} data
                    </small>

                    {{ $fasilitas->links() }}

                </div>

            </div>

        </div>

    </div>
@endsection
