@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

        <div class="card-body p-4 bg-warning-subtle">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">

                <div>

                    <div class="d-flex align-items-center mb-2">

                        <div class="bg-warning text-dark rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:55px; height:55px;">

                            <i class="ti ti-edit fs-3"></i>

                        </div>

                        <div>

                            <h3 class="fw-bold mb-1">
                                Edit User
                            </h3>

                            <p class="text-muted mb-0">
                                Update data pengguna aplikasi
                            </p>

                        </div>

                    </div>

                </div>

                <div class="mt-3 mt-lg-0">

                    <a href="{{ route('users.index') }}"
                        class="btn btn-dark rounded-3 px-4 py-2 shadow-sm">

                        <i class="ti ti-arrow-left me-1"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

    <div class="alert alert-danger border-0 shadow-sm rounded-4 alert-dismissible fade show mb-4">

        <div class="d-flex">

            <div class="me-3">

                <i class="ti ti-alert-circle fs-2"></i>

            </div>

            <div>

                <h6 class="fw-bold mb-2">
                    Terjadi Kesalahan
                </h6>

                <ul class="mb-0 ps-3">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

        <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

    @endif


    {{-- FORM --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('users.update', $user->id_user) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- PROFILE --}}
                    <div class="col-lg-4">

                        <div class="border rounded-4 p-4 text-center bg-light h-100">

                            @if($user->foto_profile)

                            <img src="{{ asset('storage/' . $user->foto_profile) }}"
                                class="rounded-circle shadow-sm border border-3 border-white mb-3"
                                width="140"
                                height="140"
                                style="object-fit: cover;">

                            @else

                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold mx-auto shadow-sm mb-3"
                                style="width:140px; height:140px; font-size:50px;">

                                {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}

                            </div>

                            @endif

                            <h5 class="fw-bold mb-1">
                                {{ $user->nama_lengkap }}
                            </h5>

                            <p class="text-muted mb-3">
                                {{ $user->email }}
                            </p>

                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">

                                <i class="ti ti-user-check me-1"></i>

                                {{ ucfirst($user->role) }}

                            </span>

                        </div>

                    </div>


                    {{-- FORM INPUT --}}
                    <div class="col-lg-8">

                        <div class="row">

                            {{-- NAMA --}}
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">

                                        <i class="ti ti-user"></i>

                                    </span>

                                    <input type="text"
                                        name="nama_lengkap"
                                        class="form-control bg-light border-0 py-3"
                                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                                        placeholder="Masukkan nama lengkap">

                                </div>

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">

                                        <i class="ti ti-mail"></i>

                                    </span>

                                    <input type="email"
                                        name="email"
                                        class="form-control bg-light border-0 py-3"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="Masukkan email">

                                </div>

                            </div>


                            {{-- PASSWORD --}}
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Password Baru
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">

                                        <i class="ti ti-lock"></i>

                                    </span>

                                    <input type="password"
                                        name="password"
                                        class="form-control bg-light border-0 py-3"
                                        placeholder="Kosongkan jika tidak diubah">

                                </div>

                                <small class="text-muted">
                                    Minimal 6 karakter
                                </small>

                            </div>


                            {{-- NO HP --}}
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    No HP
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">

                                        <i class="ti ti-phone"></i>

                                    </span>

                                    <input type="text"
                                        name="no_hp"
                                        class="form-control bg-light border-0 py-3"
                                        value="{{ old('no_hp', $user->no_hp) }}"
                                        placeholder="Masukkan nomor HP">

                                </div>

                            </div>


                            {{-- ROLE --}}
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Role
                                </label>

                                <select name="role"
                                    class="form-select bg-light border-0 py-3">

                                    <option value="admin"
                                        {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="resepsionis"
                                        {{ old('role', $user->role) == 'resepsionis' ? 'selected' : '' }}>
                                        Resepsionis
                                    </option>

                                    <option value="pelanggan"
                                        {{ old('role', $user->role) == 'pelanggan' ? 'selected' : '' }}>
                                        Pelanggan
                                    </option>

                                </select>

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status"
                                    class="form-select bg-light border-0 py-3">

                                    <option value="aktif"
                                        {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>

                                    <option value="nonaktif"
                                        {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>

                                </select>

                            </div>


                            {{-- FOTO --}}
                            <div class="col-12 mb-4">

                                <label class="form-label fw-semibold">
                                    Foto Profile
                                </label>

                                <input type="file"
                                    name="foto_profile"
                                    class="form-control py-3">

                                <small class="text-muted">
                                    Format: JPG, JPEG, PNG
                                </small>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2 mt-2">

                            <a href="{{ route('users.index') }}"
                                class="btn btn-light border rounded-3 px-4 py-2">

                                Batal

                            </a>

                            <button type="submit"
                                class="btn btn-warning rounded-3 px-4 py-2 shadow-sm fw-semibold">

                                <i class="ti ti-device-floppy me-1"></i>
                                Update User

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
