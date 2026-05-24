@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 overflow-hidden">

        <div class="card-body p-4 bg-warning text-dark">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">

                <div>

                    <h2 class="fw-bold mb-2">
                        Edit Pelanggan
                    </h2>

                    <p class="mb-0 opacity-75">
                        Update data pelanggan aplikasi
                    </p>

                </div>

                <div class="mt-4 mt-lg-0">

                    <a href="{{ route('pelanggan1.index') }}"
                        class="btn btn-dark px-4 py-2 rounded-3 fw-semibold shadow-sm">

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

            <form action="{{ route('pelanggan1.update', $pelanggan->id_pelanggan) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    {{-- USER --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label fw-semibold">
                            User
                        </label>

                        <select name="id_user"
                            class="form-select border-0 bg-light"
                            required>

                            @foreach($users as $user)

                            <option value="{{ $user->id_user }}"
                                {{ $pelanggan->id_user == $user->id_user ? 'selected' : '' }}>

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

                        <input type="text"
                            name="nik"
                            class="form-control border-0 bg-light"
                            value="{{ old('nik', $pelanggan->nik) }}">

                    </div>


                    {{-- JENIS KELAMIN --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Jenis Kelamin
                        </label>

                        <select name="jenis_kelamin"
                            class="form-select border-0 bg-light"
                            required>

                            <option value="L"
                                {{ $pelanggan->jenis_kelamin == 'L' ? 'selected' : '' }}>

                                Laki-laki

                            </option>

                            <option value="P"
                                {{ $pelanggan->jenis_kelamin == 'P' ? 'selected' : '' }}>

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
                            class="form-control border-0 bg-light">{{ old('alamat', $pelanggan->alamat) }}</textarea>

                    </div>


                    {{-- KOTA --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Kota
                        </label>

                        <input type="text"
                            name="kota"
                            class="form-control border-0 bg-light"
                            value="{{ old('kota', $pelanggan->kota) }}">

                    </div>


                    {{-- NEGARA --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Negara
                        </label>

                        <input type="text"
                            name="negara"
                            class="form-control border-0 bg-light"
                            value="{{ old('negara', $pelanggan->negara) }}">

                    </div>


                    {{-- TANGGAL LAHIR --}}
<div class="col-md-6 mb-4">

    <label class="form-label fw-semibold">
        Tanggal Lahir
    </label>

    <input type="date"
        name="tanggal_lahir"
        class="form-control border-0 bg-light"
        value="{{ old('tanggal_lahir', optional($pelanggan->tanggal_lahir)->format('Y-m-d')) }}">

</div>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-3">

                    <a href="{{ route('pelanggan1.index') }}"
                        class="btn btn-light border px-4 rounded-3">

                        Batal

                    </a>

                    <button type="submit"
                        class="btn btn-warning px-4 rounded-3 shadow-sm fw-semibold">

                        <i class="ti ti-device-floppy me-1"></i>
                        Update Pelanggan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection