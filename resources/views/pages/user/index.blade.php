@extends('layouts.app')

@section('title', 'Data User')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

        <div class="card-body p-4 bg-primary bg-gradient text-white">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <div class="d-flex align-items-center">

                        <div class="bg-white bg-opacity-25 rounded-4 d-flex align-items-center justify-content-center me-3"
                            style="width:70px; height:70px;">

                            <i class="ti ti-users fs-1 text-white"></i>

                        </div>

                        <div>

                            <h2 class="fw-bold mb-1">
                                User Management
                            </h2>

                            <p class="mb-0 text-white-50">
                                Kelola seluruh data pengguna aplikasi dengan modern dashboard
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                    <a href="{{ route('users.create') }}"
                        class="btn btn-light px-4 py-3 rounded-4 fw-semibold shadow-sm">

                        <i class="ti ti-plus me-1"></i>
                        Tambah User

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- STATISTIC --}}
    <div class="row mb-4">

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Total User
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $users->total() }}
                            </h3>

                        </div>

                        <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-flex align-items-center justify-content-center"
                            style="width:60px; height:60px;">

                            <i class="ti ti-users fs-2"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                User Aktif
                            </p>

                            <h3 class="fw-bold mb-0 text-success">
                                {{ $users->where('status', 'aktif')->count() }}
                            </h3>

                        </div>

                        <div class="bg-success bg-opacity-10 text-success rounded-4 d-flex align-items-center justify-content-center"
                            style="width:60px; height:60px;">

                            <i class="ti ti-user-check fs-2"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                User Nonaktif
                            </p>

                            <h3 class="fw-bold mb-0 text-danger">
                                {{ $users->where('status', 'nonaktif')->count() }}
                            </h3>

                        </div>

                        <div class="bg-danger bg-opacity-10 text-danger rounded-4 d-flex align-items-center justify-content-center"
                            style="width:60px; height:60px;">

                            <i class="ti ti-user-off fs-2"></i>

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
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        {{-- HEADER --}}
        <div class="card-header bg-white border-0 p-4">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <h5 class="fw-bold mb-1">
                        List User
                    </h5>

                    <p class="text-muted mb-0 small">
                        Menampilkan seluruh data pengguna aplikasi
                    </p>

                </div>

                <div class="col-lg-6 mt-3 mt-lg-0">

                    {{-- SEARCH --}}
                    <form action="{{ route('users.index') }}"
                        method="GET">

                        <div class="input-group shadow-sm rounded-4 overflow-hidden">

                            <span class="input-group-text border-0 bg-light px-3">

                                <i class="ti ti-search text-muted"></i>

                            </span>

                            <input type="text"
                                name="search"
                                class="form-control border-0 bg-light py-3"
                                placeholder="Cari nama, email, role..."
                                value="{{ request('search') }}">

                            @if(request('search'))

                            <a href="{{ route('users.index') }}"
                                class="btn btn-light border-0">

                                <i class="ti ti-x"></i>

                            </a>

                            @endif

                            <button type="submit"
                                class="btn btn-primary px-4">

                                Cari

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="bg-light">

                    <tr>

                        <th class="border-0 ps-4 py-3 text-muted fw-semibold">
                            User
                        </th>

                        <th class="border-0 py-3 text-muted fw-semibold">
                            Role
                        </th>

                        <th class="border-0 py-3 text-muted fw-semibold">
                            Status
                        </th>

                        <th class="border-0 py-3 text-muted fw-semibold">
                            No HP
                        </th>

                        <th class="border-0 py-3 text-muted fw-semibold">
                            Dibuat
                        </th>

                        <th class="border-0 py-3 text-center pe-4 text-muted fw-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr>

                        {{-- USER --}}
                        <td class="ps-4 py-3">

                            <div class="d-flex align-items-center">

                                @if($user->foto_profile)

                                <img src="{{ asset('storage/' . $user->foto_profile) }}"
                                    class="rounded-circle border shadow-sm"
                                    width="58"
                                    height="58"
                                    style="object-fit: cover;">

                                @else

                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                    style="width:58px; height:58px; font-size:20px;">

                                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}

                                </div>

                                @endif

                                <div class="ms-3">

                                    <h6 class="mb-1 fw-bold text-dark">
                                        {{ $user->nama_lengkap }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $user->email }}
                                    </small>

                                </div>

                            </div>

                        </td>


                        {{-- ROLE --}}
                        <td>

                            @if($user->role == 'admin')

                            <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">
                                <i class="ti ti-shield-lock me-1"></i>
                                Admin
                            </span>

                            @elseif($user->role == 'resepsionis')

                            <span class="badge rounded-pill bg-warning-subtle text-warning px-3 py-2">
                                <i class="ti ti-user-star me-1"></i>
                                Resepsionis
                            </span>

                            @else

                            <span class="badge rounded-pill bg-info-subtle text-info px-3 py-2">
                                <i class="ti ti-users me-1"></i>
                                Pelanggan
                            </span>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if($user->status == 'aktif')

                            <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">

                                <i class="ti ti-check me-1"></i>

                                Aktif

                            </span>

                            @else

                            <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">

                                <i class="ti ti-x me-1"></i>

                                Nonaktif

                            </span>

                            @endif

                        </td>


                        {{-- PHONE --}}
                        <td>

                            <span class="fw-medium text-dark">
                                {{ $user->no_hp }}
                            </span>

                        </td>


                        {{-- CREATED --}}
                        <td>

                            <small class="text-muted">

                                {{ date('d M Y', strtotime($user->created_at)) }}

                                <br>

                                {{ date('H:i', strtotime($user->created_at)) }}

                            </small>

                        </td>


                        {{-- ACTION --}}
                        <td class="text-center pe-4">

                            <div class="d-flex justify-content-center gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('users.edit', $user->id_user) }}"
                                    class="btn btn-warning btn-sm rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                    style="width:40px; height:40px;">

                                    <i class="ti ti-edit"></i>

                                </a>


                                {{-- DELETE --}}
                                <form action="{{ route('users.destroy', $user->id_user) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-danger btn-sm rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                        style="width:40px; height:40px;"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">

                                        <i class="ti ti-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    {{-- EMPTY --}}
                    <tr>

                        <td colspan="6"
                            class="text-center py-5">

                            <div class="py-5">

                                <div class="mb-3">

                                    <i class="ti ti-users text-muted"
                                        style="font-size:80px;"></i>

                                </div>

                                <h4 class="fw-bold mb-2">
                                    Data User Tidak Ditemukan
                                </h4>

                                <p class="text-muted mb-0">
                                    Belum ada data user tersedia saat ini
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- FOOTER --}}
        @if($users->hasPages())

        <div class="card-footer bg-white border-0 px-4 py-3">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

                <div class="text-muted small">

                    Menampilkan
                    <strong>{{ $users->firstItem() }}</strong>
                    -
                    <strong>{{ $users->lastItem() }}</strong>

                    dari

                    <strong>{{ $users->total() }}</strong>
                    data user

                </div>

                <div>
                    {{ $users->withQueryString()->links() }}
                </div>

            </div>

        </div>

        @endif

    </div>

</div>

@endsection
