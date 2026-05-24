@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Data Pelanggan
            </h2>

            <p class="text-muted mb-0">
                Kelola seluruh data pelanggan dengan mudah
            </p>
        </div>

        <a href="{{ route('resepsionis.pelanggan.create') }}"
           class="btn btn-primary rounded-pill px-4 mt-3 mt-md-0 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Pelanggan
        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Total Pelanggan
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $pelanggan->total() }}
                            </h3>
                        </div>

                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

    {{-- Card Table --}}
    <div class="card border-0 shadow-sm rounded-4">

        {{-- Card Header --}}
        <div class="card-header bg-white border-0 rounded-top-4 p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

                <h5 class="fw-semibold mb-3 mb-md-0">
                    Daftar Pelanggan
                </h5>

                {{-- Search UI --}}
                <div style="max-width: 300px; width:100%;">
                    <input type="text"
                           class="form-control rounded-pill"
                           placeholder="Cari pelanggan...">
                </div>

            </div>

        </div>

        {{-- Table --}}
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th class="ps-4">#</th>
                            <th>Pelanggan</th>
                            <th>Kontak</th>
                            <th>NIK</th>
                            <th>Gender</th>
                            <th>Kota</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pelanggan as $item)

                            <tr class="border-top">

                                {{-- No --}}
                                <td class="ps-4 fw-semibold text-muted">
                                    {{ $loop->iteration + ($pelanggan->currentPage() - 1) * $pelanggan->perPage() }}
                                </td>

                                {{-- Profile --}}
                                <td>

                                    <div class="d-flex align-items-center">

                                        {{-- Foto --}}
                                        @if($item->foto_profile)

                                            <img src="{{ asset('storage/' . $item->foto_profile) }}"
                                                 class="rounded-circle shadow-sm me-3"
                                                 width="55"
                                                 height="55"
                                                 style="object-fit: cover;">

                                        @else

                                            <div class="rounded-circle bg-secondary bg-opacity-10
                                                        d-flex align-items-center justify-content-center me-3"
                                                 style="width:55px; height:55px;">

                                                <i class="bi bi-person-fill text-secondary"></i>

                                            </div>

                                        @endif

                                        {{-- Nama --}}
                                        <div>

                                            <div class="fw-semibold">
                                                {{ $item->nama_lengkap }}
                                            </div>

                                            <small class="text-muted">
                                                ID: {{ $item->id_user }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                {{-- Kontak --}}
                                <td>

                                    <div class="small">

                                        <div class="mb-1">
                                            <i class="bi bi-envelope me-1 text-muted"></i>
                                            {{ $item->email }}
                                        </div>

                                        <div class="text-muted">
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $item->no_hp ?? '-' }}
                                        </div>

                                    </div>

                                </td>

                                {{-- NIK --}}
                                <td>
                                    {{ $item->pelanggan->nik ?? '-' }}
                                </td>

                                {{-- Gender --}}
                                <td>

                                    @if(($item->pelanggan->jenis_kelamin ?? null) == 'L')

                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-3 py-2">
                                            Laki-laki
                                        </span>

                                    @elseif(($item->pelanggan->jenis_kelamin ?? null) == 'P')

                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                            Perempuan
                                        </span>

                                    @else

                                        -

                                    @endif

                                </td>

                                {{-- Kota --}}
                                <td>
                                    {{ $item->pelanggan->kota ?? '-' }}
                                </td>

                                {{-- Status --}}
                                <td>

                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                        {{ ucfirst($item->status) }}
                                    </span>

                                </td>

                                {{-- Action --}}
                                <td class="text-center pe-4">

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- Delete --}}
                                        <form action="{{ route('resepsionis.pelanggan.destroy', $item) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-circle shadow-sm"
                                                    title="Hapus"
                                                    style="width:38px; height:38px;">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-5">

                                    <div class="d-flex flex-column align-items-center">

                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                             style="width:90px; height:90px;">

                                            <i class="bi bi-people text-secondary fs-1"></i>

                                        </div>

                                        <h5 class="fw-semibold">
                                            Data pelanggan kosong
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Belum ada pelanggan yang ditambahkan
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 rounded-bottom-4 p-4">

            <div class="d-flex justify-content-center">
                {{ $pelanggan->links() }}
            </div>

        </div>

    </div>

</div>

@endsection