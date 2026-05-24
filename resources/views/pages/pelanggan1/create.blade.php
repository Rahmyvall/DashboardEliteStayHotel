@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 overflow-hidden">

        <div class="card-body p-4 bg-primary text-white">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">

                <div>

                    <h2 class="fw-bold mb-2">
                        Tambah Pelanggan
                    </h2>

                    <p class="mb-0 opacity-75">
                        Tambahkan data pelanggan baru ke dalam sistem
                    </p>

                </div>

                <div class="mt-4 mt-lg-0">

                    <a href="{{ route('pelanggan1.index') }}"
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

            <form action="{{ route('pelanggan1.store') }}" method="POST">

                @csrf

                <div class="row">

                    {{-- LEFT --}}
                    <div class="col-lg-4 mb-4">

                        <div class="text-center">

                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold mx-auto mb-3 shadow-sm"
                                style="width:140px; height:140px; font-size:50px;">

                                <i class="ti ti-users"></i>

                            </div>

                            <h5 class="fw-bold mb-1">
                                Pelanggan Baru
                            </h5>

                            <p class="text-muted small">
                                Lengkapi data pelanggan dengan benar
                            </p>

                        </div>

                    </div>


                    {{-- RIGHT --}}
                    <div class="col-lg-8">

                        <div class="row">

                            {{-- USER --}}
                            <div class="col-md-12 mb-3">

                                <label class="form-label fw-semibold">
                                    User
                                </label>

                                <select name="id_user"
                                    class="form-select border-0 bg-light"
                                    required>

                                    <option value="">
                                        -- Pilih User --
                                    </option>

                                    @foreach($users as $user)

                                    <option value="{{ $user->id_user }}"
                                        {{ old('id_user') == $user->id_user ? 'selected' : '' }}>

                                        {{ $user->nama_lengkap }} - {{ $user->email }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- NIK --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    NIK
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-id"></i>
                                    </span>

                                    <input type="text"
                                        name="nik"
                                        class="form-control border-0 bg-light"
                                        placeholder="Masukkan NIK"
                                        value="{{ old('nik') }}">

                                </div>

                            </div>


                            {{-- JENIS KELAMIN --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Jenis Kelamin
                                </label>

                                <select name="jenis_kelamin"
                                    class="form-select border-0 bg-light"
                                    required>

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

                            </div>


                            {{-- ALAMAT --}}
                            <div class="col-12 mb-3">

                                <label class="form-label fw-semibold">
                                    Alamat
                                </label>

                                <textarea name="alamat"
                                    rows="4"
                                    class="form-control border-0 bg-light"
                                    placeholder="Masukkan alamat pelanggan">{{ old('alamat') }}</textarea>

                            </div>


                            {{-- KOTA --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Kota
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-building"></i>
                                    </span>

                                    <input type="text"
                                        name="kota"
                                        class="form-control border-0 bg-light"
                                        placeholder="Masukkan kota"
                                        value="{{ old('kota') }}">

                                </div>

                            </div>


                            {{-- NEGARA --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Negara
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-world"></i>
                                    </span>

                                    <input type="text"
                                        name="negara"
                                        class="form-control border-0 bg-light"
                                        placeholder="Masukkan negara"
                                        value="{{ old('negara') }}">

                                </div>

                            </div>


                            {{-- TANGGAL LAHIR --}}
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Tanggal Lahir
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-0">
                                        <i class="ti ti-calendar"></i>
                                    </span>

                                    <input type="date"
                                        name="tanggal_lahir"
                                        class="form-control border-0 bg-light"
                                        value="{{ old('tanggal_lahir') }}">

                                </div>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2 mt-3">

                            <a href="{{ route('pelanggan1.index') }}"
                                class="btn btn-light border px-4 rounded-3">

                                Batal

                            </a>

                            <button type="submit"
                                class="btn btn-primary px-4 rounded-3 shadow-sm fw-semibold">

                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Pelanggan

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection