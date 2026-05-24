@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Tambah Pelanggan
            </h2>

            <p class="text-muted mb-0">
                Tambahkan data pelanggan baru ke dalam sistem
            </p>
        </div>

        <a href="{{ route('resepsionis.pelanggan.index') }}"
           class="btn btn-light border rounded-pill px-4 mt-3 mt-md-0 shadow-sm">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

    </div>

    {{-- Error Alert --}}
    @if ($errors->any())

        <div class="alert alert-danger border-0 shadow-sm rounded-4">

            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Terjadi kesalahan:
            </div>

            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form action="{{ route('resepsionis.pelanggan.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row">

            {{-- Left --}}
            <div class="col-lg-8">

                {{-- Informasi Akun --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-person-circle text-primary me-2"></i>
                            Informasi Akun
                        </h5>

                    </div>

                    <div class="card-body p-4">

                        <div class="row">

                            {{-- Nama --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap
                                </label>

                                <input type="text"
                                       name="nama_lengkap"
                                       value="{{ old('nama_lengkap') }}"
                                       class="form-control form-control-lg rounded-3 @error('nama_lengkap') is-invalid @enderror"
                                       placeholder="Masukkan nama lengkap">

                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                       placeholder="Masukkan email">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- No HP --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    No HP
                                </label>

                                <input type="text"
                                       name="no_hp"
                                       value="{{ old('no_hp') }}"
                                       class="form-control form-control-lg rounded-3 @error('no_hp') is-invalid @enderror"
                                       placeholder="08xxxxxxxxxx">

                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- NIK --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    NIK
                                </label>

                                <input type="text"
                                       name="nik"
                                       value="{{ old('nik') }}"
                                       class="form-control form-control-lg rounded-3 @error('nik') is-invalid @enderror"
                                       placeholder="Masukkan NIK">

                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Informasi Personal --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-person-vcard text-success me-2"></i>
                            Informasi Personal
                        </h5>

                    </div>

                    <div class="card-body p-4">

                        <div class="row">

                            {{-- Jenis Kelamin --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Jenis Kelamin
                                </label>

                                <select name="jenis_kelamin"
                                        class="form-select form-select-lg rounded-3 @error('jenis_kelamin') is-invalid @enderror">

                                    <option value="">
                                        -- Pilih Jenis Kelamin --
                                    </option>

                                    <option value="L"
                                        {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>

                                    <option value="P"
                                        {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>

                                </select>

                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Tanggal Lahir
                                </label>

                                <input type="date"
                                       name="tanggal_lahir"
                                       value="{{ old('tanggal_lahir') }}"
                                       class="form-control form-control-lg rounded-3 @error('tanggal_lahir') is-invalid @enderror">

                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Kota --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Kota
                                </label>

                                <input type="text"
                                       name="kota"
                                       value="{{ old('kota') }}"
                                       class="form-control form-control-lg rounded-3 @error('kota') is-invalid @enderror"
                                       placeholder="Masukkan kota">

                                @error('kota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Negara --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Negara
                                </label>

                                <input type="text"
                                       name="negara"
                                       value="{{ old('negara', 'Indonesia') }}"
                                       class="form-control form-control-lg rounded-3 @error('negara') is-invalid @enderror"
                                       placeholder="Masukkan negara">

                                @error('negara')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Alamat --}}
                            <div class="col-12 mb-3">

                                <label class="form-label fw-semibold">
                                    Alamat
                                </label>

                                <textarea name="alamat"
                                          rows="4"
                                          class="form-control rounded-3 @error('alamat') is-invalid @enderror"
                                          placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>

                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Right --}}
            <div class="col-lg-4">

                {{-- Foto Profile --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-image text-warning me-2"></i>
                            Foto Profile
                        </h5>

                    </div>

                    <div class="card-body p-4 text-center">

                        <div class="mb-4">

                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                 style="width:140px; height:140px;">

                                <i class="bi bi-person fs-1 text-secondary"></i>

                            </div>

                        </div>

                        <input type="file"
                               name="foto_profile"
                               class="form-control @error('foto_profile') is-invalid @enderror">

                        <small class="text-muted mt-2 d-block">
                            JPG, PNG, JPEG maksimal 2MB
                        </small>

                        @error('foto_profile')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- Security --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-shield-lock text-danger me-2"></i>
                            Keamanan Akun
                        </h5>

                    </div>

                    <div class="card-body p-4">

                        {{-- Password --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                   placeholder="Masukkan password">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Konfirmasi Password
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control form-control-lg rounded-3"
                                   placeholder="Konfirmasi password">

                        </div>

                    </div>

                </div>

                {{-- Button --}}
                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <div class="d-grid gap-2">

                            <button type="submit"
                                    class="btn btn-primary btn-lg rounded-3 shadow-sm">

                                <i class="bi bi-check-circle me-1"></i>
                                Simpan Pelanggan

                            </button>

                            <a href="{{ route('resepsionis.pelanggan.index') }}"
                               class="btn btn-light border btn-lg rounded-3">

                                Batal

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection