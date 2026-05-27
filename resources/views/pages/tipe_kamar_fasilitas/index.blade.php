@extends('layouts.app')

@section('title', 'Tipe Kamar Fasilitas')

@section('content')

    <div class="container-p-y">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    <div class="icon-box bg-primary-subtle text-primary">
                        <i class="bx bx-category-alt"></i>
                    </div>

                    Tipe Kamar Fasilitas
                </h3>

                <p class="text-muted mb-0">
                    Kelola relasi fasilitas untuk setiap tipe kamar hotel
                </p>
            </div>

            <a href="{{ route('tipe-kamar-fasilitas.create') }}" class="btn btn-primary px-4 shadow-sm rounded-pill">

                <i class="bx bx-plus-circle me-1"></i>
                Tambah Data

            </a>

        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">

                <i class="bx bx-check-circle me-1"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">

                <i class="bx bx-error-circle me-1"></i>
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        {{-- STATISTIC --}}
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card border-0 shadow-sm stat-card">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="stat-icon bg-primary-subtle text-primary">
                                <i class="bx bx-link-alt"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Total Relasi
                                </small>

                                <h3 class="fw-bold mb-0">
                                    {{ $tipeKamarFasilitas->total() }}
                                </h3>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm stat-card">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="bx bx-bed"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Total Tipe Kamar
                                </small>

                                <h3 class="fw-bold mb-0">
                                    {{ $tipeKamarFasilitas->pluck('id_tipe')->unique()->count() }}
                                </h3>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm stat-card">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="stat-icon bg-info-subtle text-info">
                                <i class="bx bx-star"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Total Fasilitas
                                </small>

                                <h3 class="fw-bold mb-0">
                                    {{ $tipeKamarFasilitas->pluck('id_fasilitas')->unique()->count() }}
                                </h3>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- SEARCH --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <form method="GET">

                    <div class="row g-3">

                        <div class="col-md-10">

                            <div class="input-group input-group-merge search-box">

                                <span class="input-group-text border-0 bg-transparent">
                                    <i class="bx bx-search"></i>
                                </span>

                                <input type="text" name="search" class="form-control border-0"
                                    placeholder="Cari tipe kamar atau fasilitas..." value="{{ request('search') }}">

                            </div>

                        </div>

                        <div class="col-md-2 d-grid">

                            <button class="btn btn-primary rounded-pill">

                                <i class="bx bx-search-alt me-1"></i>
                                Search

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="card border-0 shadow-sm overflow-hidden">

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Data Tipe Kamar Fasilitas
                        </h5>

                        <small class="text-muted">
                            Menampilkan seluruh relasi fasilitas hotel
                        </small>
                    </div>

                    <span class="badge bg-primary rounded-pill px-3 py-2">
                        {{ $tipeKamarFasilitas->total() }} Data
                    </span>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table align-middle table-hover mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Tipe Kamar</th>
                            <th>Fasilitas</th>
                            <th>Dibuat</th>
                            <th class="text-center" width="180">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($tipeKamarFasilitas as $item)
                            <tr>
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="avatar avatar-md bg-label-primary">
                                            <i class="bx bx-bed"></i>
                                        </div>

                                        <div>

                                            <h6 class="mb-0 fw-semibold">
                                                {{ $item->tipeKamar->nama_tipe }}
                                            </h6>

                                            <small class="text-muted">
                                                ID : {{ $item->id_tipe }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2">

                                        <i class="bx bx-check-circle me-1"></i>

                                        {{ $item->fasilitas->nama_fasilitas }}

                                    </span>

                                </td>

                                <td>

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $item->created_at->format('d M Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $item->created_at->format('H:i') }}
                                        </small>

                                    </div>

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('tipe-kamar-fasilitas.show', $item->id) }}"
                                            class="btn btn-icon btn-info btn-sm rounded-circle">

                                            <i class="bx bx-show"></i>

                                        </a>

                                        <a href="{{ route('tipe-kamar-fasilitas.edit', $item->id) }}"
                                            class="btn btn-icon btn-warning btn-sm rounded-circle">

                                            <i class="bx bx-edit"></i>

                                        </a>

                                        <form action="{{ route('tipe-kamar-fasilitas.destroy', $item->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Yakin hapus data ini ?')"
                                                class="btn btn-icon btn-danger btn-sm rounded-circle">

                                                <i class="bx bx-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5">

                                    <div class="text-center py-5">

                                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png" width="110"
                                            class="mb-3 opacity-75">

                                        <h5 class="fw-bold mb-1">
                                            Data Tidak Ditemukan
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Belum ada relasi tipe kamar fasilitas.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- FOOTER --}}
            <div class="card-footer bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <small class="text-muted">

                        Menampilkan
                        {{ $tipeKamarFasilitas->firstItem() ?? 0 }}
                        -
                        {{ $tipeKamarFasilitas->lastItem() ?? 0 }}

                        dari
                        {{ $tipeKamarFasilitas->total() }}
                        data

                    </small>

                    {{ $tipeKamarFasilitas->links() }}

                </div>

            </div>

        </div>

    </div>

    {{-- STYLE --}}
    <style>
        .icon-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-card {
            transition: .3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }

        .search-box {
            background: #f8f9fa;
            border-radius: 14px;
            padding: 4px 10px;
        }

        .table tbody tr {
            transition: .2s ease;
        }

        .table tbody tr:hover {
            background: #f8fbff;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

@endsection
