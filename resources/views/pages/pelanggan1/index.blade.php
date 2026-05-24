{{-- resources/views/pages/pelanggan/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-lg rounded-5 overflow-hidden mb-4">

        <div class="card-body p-4 hero-header text-white">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <div class="d-flex align-items-center">

                        <div class="hero-icon me-3">

                            <i class="ti ti-users"></i>

                        </div>

                        <div>

                            <h2 class="fw-bold mb-1">
                                Data Pelanggan
                            </h2>

                            <p class="mb-0 text-white-50">
                                Kelola seluruh data pelanggan aplikasi dengan dashboard modern
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                    <a href="{{ route('pelanggan1.create') }}"
                        class="btn btn-light btn-modern px-4 py-3 fw-semibold shadow-sm">

                        <i class="ti ti-plus me-1"></i>
                        Tambah Pelanggan

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- STATISTIC --}}
    <div class="row mb-4">

        {{-- TOTAL --}}
        <div class="col-md-4 mb-3">

            <div class="card stat-card total-card border-0 shadow-sm rounded-5 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label mb-1">
                                Total Pelanggan
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $pelanggan->total() }}
                            </h2>

                        </div>

                        <div class="stat-icon bg-primary-subtle text-primary">

                            <i class="ti ti-users"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- MALE --}}
        <div class="col-md-4 mb-3">

            <div class="card stat-card male-card border-0 shadow-sm rounded-5 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label mb-1">
                                Laki-laki
                            </p>

                            <h2 class="fw-bold mb-0 text-primary">

                                {{ $pelanggan->where('jenis_kelamin', 'L')->count() }}

                            </h2>

                        </div>

                        <div class="stat-icon bg-info-subtle text-info">

                            <i class="ti ti-gender-male"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- FEMALE --}}
        <div class="col-md-4 mb-3">

            <div class="card stat-card female-card border-0 shadow-sm rounded-5 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label mb-1">
                                Perempuan
                            </p>

                            <h2 class="fw-bold mb-0 text-danger">

                                {{ $pelanggan->where('jenis_kelamin', 'P')->count() }}

                            </h2>

                        </div>

                        <div class="stat-icon bg-danger-subtle text-danger">

                            <i class="ti ti-gender-female"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ALERT --}}
    @if(session('success'))

    <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show">

        <div class="d-flex align-items-center">

            <i class="ti ti-circle-check fs-4 me-2"></i>

            <span class="fw-semibold">
                {{ session('success') }}
            </span>

        </div>

        <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

    @endif


    {{-- TABLE CARD --}}
    <div class="card border-0 shadow-lg rounded-5 overflow-hidden table-card">

        {{-- HEADER --}}
        <div class="card-header bg-white border-0 p-4">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <h5 class="fw-bold mb-1">
                        List Pelanggan
                    </h5>

                    <p class="text-muted mb-0 small">
                        Menampilkan seluruh data pelanggan aplikasi
                    </p>

                </div>

                <div class="col-lg-6 mt-3 mt-lg-0">

                    {{-- SEARCH --}}
                    <form action="{{ route('pelanggan1.index') }}"
                        method="GET">

                        <div class="search-box">

                            <span class="search-icon">

                                <i class="ti ti-search"></i>

                            </span>

                            <input type="text"
                                name="search"
                                class="form-control border-0"
                                placeholder="Cari pelanggan..."
                                value="{{ request('search') }}">

                            @if(request('search'))

                            <a href="{{ route('pelanggan1.index') }}"
                                class="btn btn-light border-0">

                                <i class="ti ti-x"></i>

                            </a>

                            @endif

                            <button type="submit"
                                class="btn btn-primary rounded-4 px-4">

                                Cari

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-modern align-middle mb-0">

                <thead>

                    <tr>

                        <th class="ps-4">Pelanggan</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Negara</th>
                        <th>Tanggal Lahir</th>
                        <th class="text-center pe-4">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pelanggan as $item)

                    <tr>

                        {{-- USER --}}
                        <td class="ps-4 py-4">

                            <div class="d-flex align-items-center">

                                <div class="user-avatar">

                                    {{ strtoupper(substr($item->user->nama_lengkap ?? 'P', 0, 1)) }}

                                </div>

                                <div class="ms-3">

                                    <h6 class="mb-1 fw-bold text-dark">

                                        {{ $item->user->nama_lengkap ?? '-' }}

                                    </h6>

                                    <small class="text-muted">

                                        {{ $item->user->email ?? '-' }}

                                    </small>

                                </div>

                            </div>

                        </td>


                        {{-- NIK --}}
                        <td>

                            <span class="fw-semibold text-dark">

                                {{ $item->nik ?? '-' }}

                            </span>

                        </td>


                        {{-- GENDER --}}
                        <td>

                            @if($item->jenis_kelamin == 'L')

                            <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">

                                <i class="ti ti-gender-male me-1"></i>
                                Laki-laki

                            </span>

                            @else

                            <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">

                                <i class="ti ti-gender-female me-1"></i>
                                Perempuan

                            </span>

                            @endif

                        </td>


                        {{-- ALAMAT --}}
                        <td>

                            <span class="text-muted">

                                {{ Str::limit($item->alamat ?? '-', 40) }}

                            </span>

                        </td>


                        {{-- KOTA --}}
                        <td>

                            <span class="fw-medium">

                                {{ $item->kota ?? '-' }}

                            </span>

                        </td>


                        {{-- NEGARA --}}
                        <td>

                            <span class="fw-medium">

                                {{ $item->negara ?? '-' }}

                            </span>

                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            <small class="text-muted">

                                {{ $item->tanggal_lahir
                                    ? \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y')
                                    : '-' }}

                            </small>

                        </td>


                        {{-- ACTION --}}
                        <td class="text-center pe-4">

                            <div class="d-flex justify-content-center gap-2">

                                {{-- DETAIL --}}
                                <a href="{{ route('pelanggan1.show', $item->id_pelanggan) }}"
                                    class="action-btn btn-info">

                                    <i class="ti ti-eye"></i>

                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('pelanggan1.edit', $item->id_pelanggan) }}"
                                    class="action-btn btn-warning">

                                    <i class="ti ti-edit"></i>

                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('pelanggan1.destroy', $item->id_pelanggan) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="action-btn btn-danger border-0"
                                        onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">

                                        <i class="ti ti-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    {{-- EMPTY --}}
                    <tr>

                        <td colspan="8"
                            class="text-center py-5">

                            <div class="py-5">

                                <div class="empty-icon mb-3">

                                    <i class="ti ti-users"></i>

                                </div>

                                <h4 class="fw-bold mb-2">
                                    Data Pelanggan Tidak Ditemukan
                                </h4>

                                <p class="text-muted mb-0">
                                    Belum ada data pelanggan tersedia saat ini
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- FOOTER --}}
        @if($pelanggan->hasPages())

        <div class="card-footer bg-white border-0 px-4 py-3">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

                <div class="text-muted small">

                    Menampilkan
                    <strong>{{ $pelanggan->firstItem() }}</strong>
                    -
                    <strong>{{ $pelanggan->lastItem() }}</strong>

                    dari

                    <strong>{{ $pelanggan->total() }}</strong>
                    data pelanggan

                </div>

                <div>
                    {{ $pelanggan->withQueryString()->links() }}
                </div>

            </div>

        </div>

        @endif

    </div>

</div>


{{-- STYLE --}}
<style>

:root{
    --primary-gradient: linear-gradient(135deg, #4f46e5, #7c3aed);
}

/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

.hero-header{
    background: var(--primary-gradient);
}

.hero-icon{
    width: 70px;
    height: 70px;
    border-radius: 22px;
    background: rgba(255,255,255,.18);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    backdrop-filter: blur(10px);
}

.btn-modern{
    border-radius: 18px;
    transition: .3s ease;
}

.btn-modern:hover{
    transform: translateY(-2px);
}

/*
|--------------------------------------------------------------------------
| STATISTIC
|--------------------------------------------------------------------------
*/

.stat-card{
    transition: .3s ease;
    overflow: hidden;
    position: relative;
}

.stat-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 16px 35px rgba(0,0,0,.08) !important;
}

.total-card{
    background: linear-gradient(135deg, #eef2ff, #ffffff);
}

.male-card{
    background: linear-gradient(135deg, #eff6ff, #ffffff);
}

.female-card{
    background: linear-gradient(135deg, #fff1f2, #ffffff);
}

.stat-label{
    color: #6c757d;
    font-weight: 500;
}

.stat-icon{
    width: 65px;
    height: 65px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

.search-box{
    background: #b7ca9e;
    border-radius: 18px;
    padding: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-box .form-control{
    background: transparent;
    box-shadow: none !important;
}

.search-icon{
    padding-left: 10px;
    color: #6c757d;
}

/*
|--------------------------------------------------------------------------
| TABLE
|--------------------------------------------------------------------------
*/

.table-card{
    background: #fff;
}

.table-modern thead{
    background: #f8fafc;
}

.table-modern thead th{
    border: none;
    padding: 18px 16px;
    color: #6c757d;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.table-modern tbody tr{
    transition: .2s ease;
}

.table-modern tbody tr:hover{
    background: #4773ada2;
}

.table-modern tbody td{
    border-color: #7399be;
    vertical-align: middle;
}

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

.user-avatar{
    width: 58px;
    height: 58px;
    border-radius: 18px;
    background: var(--primary-gradient);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 20px;
    box-shadow: 0 10px 25px rgba(79,70,229,.25);
}

/*
|--------------------------------------------------------------------------
| ACTION BUTTON
|--------------------------------------------------------------------------
*/

.action-btn{
    width: 40px;
    height: 40px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    box-shadow: 0 8px 18px rgba(0,0,0,.08);
    transition: .2s ease;
}

.action-btn:hover{
    transform: translateY(-2px) scale(1.05);
    color: white;
}

.btn-info{
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.btn-warning{
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.btn-danger{
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

/*
|--------------------------------------------------------------------------
| EMPTY
|--------------------------------------------------------------------------
*/

.empty-icon{
    font-size: 80px;
    color: #cbd5e1;
}

</style>

@endsection