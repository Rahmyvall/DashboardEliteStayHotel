@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 overflow-hidden">

        <div class="card-body p-4 bg-primary text-white">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">

                <div>

                    <h2 class="fw-bold mb-2">
                        Tambah User
                    </h2>

                    <p class="mb-0 opacity-75">
                        Tambahkan data pengguna baru ke dalam sistem
                    </p>

                </div>

                <div class="mt-4 mt-lg-0">

                    <a href="{{ route('users.index') }}"
                        class="btn btn-light px-4 py-2 rounded-3 fw-semibold shadow-sm">

                        <i class="ti ti-arrow-left me-1"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

    <div class="alert alert-danger border-0 shadow-sm rounded-3">

        <div class="d-flex align-items-center mb-2">

            <i class="ti ti-alert-circle me-2 fs-5"></i>

            <strong>Terjadi Kesalahan</strong>

        </div>

        <ul class="mb-0 ps-3">

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif


    {{-- FORM --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- FOTO PROFILE --}}
                    <div class="col-lg-4 mb-4">

                        <div class="text-center">

                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold mx-auto mb-3 shadow-sm"
                                style="width:140px; height:140px; font-size:50px;">

                                <i class="ti ti-user"></i>

                            </div>

                            <h5 class="fw-bold mb-1">
                                User Baru
                            </h5>

                            <p class="text-muted small">
                                Upload foto profile pengguna
                            </p>

                        </div>

                    </div>


                    {{-- FORM INPUT --}}
                    <div class="col-lg-8">

                        <div class="row">

                            {{-- NAMA --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-user"></i>
                                    </span>

                                    <input type="text" name="nama_lengkap" class="form-control border-0 bg-light"
                                        placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>

                                </div>

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-mail"></i>
                                    </span>

                                    <input type="email" name="email" class="form-control border-0 bg-light"
                                        placeholder="Masukkan email" value="{{ old('email') }}" required>

                                </div>

                            </div>


                            {{-- PASSWORD --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Password
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-lock"></i>
                                    </span>

                                    <input type="password" name="password" class="form-control border-0 bg-light"
                                        placeholder="Masukkan password" required>

                                </div>

                            </div>


                            {{-- NO HP --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    No HP
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-phone"></i>
                                    </span>

                                    <input type="text" name="no_hp" class="form-control border-0 bg-light"
                                        placeholder="Masukkan nomor HP" value="{{ old('no_hp') }}" required>

                                </div>

                            </div>


                            {{-- ROLE --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Role
                                </label>

                                <select name="role" class="form-select border-0 bg-light" required>

                                    <option value="">
                                        -- Pilih Role --
                                    </option>

                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="resepsionis" {{ old('role') == 'resepsionis' ? 'selected' : '' }}>
                                        Resepsionis
                                    </option>

                                    <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>
                                        Pelanggan
                                    </option>

                                </select>

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status" class="form-select border-0 bg-light" required>

                                    <option value="">
                                        -- Pilih Status --
                                    </option>

                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>

                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>

                                </select>

                            </div>


                            {{-- FOTO --}}
                            <div class="col-12 mb-4">

                                <label class="form-label fw-semibold">
                                    Foto Profile
                                </label>

                                <input type="file" name="foto_profile" class="form-control" accept=".jpg,.jpeg,.png">

                                <small class="text-muted">
                                    Format: JPG, JPEG, PNG (Max 5MB)
                                </small>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2 mt-3">

                            <a href="{{ route('users.index') }}" class="btn btn-light border px-4 rounded-3">

                                Batal

                            </a>

                            <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm fw-semibold">

                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan User

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection