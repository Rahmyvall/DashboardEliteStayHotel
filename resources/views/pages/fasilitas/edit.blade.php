@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-1">
                    Edit Fasilitas
                </h3>

                <p class="text-muted mb-0">
                    Perbarui data fasilitas hotel dengan mudah.
                </p>
            </div>

            <a href="{{ route('fasilitas.index') }}" class="btn btn-light border rounded-3 shadow-sm">

                <i class="bi bi-arrow-left me-1"></i>
                Kembali

            </a>

        </div>

        {{-- Card --}}
        <div class="card border-0 shadow-sm rounded-4">

            {{-- Header --}}
            <div class="card-header bg-white border-0 p-4">

                <h5 class="fw-bold mb-1">
                    Form Edit Fasilitas
                </h5>

                <p class="text-muted small mb-0">
                    Lengkapi informasi fasilitas hotel.
                </p>

            </div>

            {{-- Body --}}
            <div class="card-body p-4">

                <form action="{{ route('fasilitas.update', $fasilitas->id_fasilitas) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- Nama Fasilitas --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Nama Fasilitas
                            </label>

                            <input type="text" name="nama_fasilitas"
                                class="form-control rounded-3 @error('nama_fasilitas') is-invalid @enderror"
                                placeholder="Masukkan nama fasilitas"
                                value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}">

                            @error('nama_fasilitas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Upload Gambar --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Gambar Fasilitas
                            </label>

                            <input type="file" name="icon"
                                class="form-control rounded-3 @error('icon') is-invalid @enderror" accept="image/*">

                            @error('icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted">
                                Format: JPG, PNG, JPEG
                            </small>

                        </div>

                        {{-- Preview Gambar --}}
                        <div class="col-12 mb-4">

                            <label class="form-label fw-semibold">
                                Preview Gambar
                            </label>

                            <div class="border rounded-4 overflow-hidden bg-light d-flex align-items-center justify-content-center"
                                style="width: 140px; height: 140px;">

                                @if ($fasilitas->icon)
                                    <img src="{{ asset('storage/' . $fasilitas->icon) }}"
                                        alt="{{ $fasilitas->nama_fasilitas }}" class="img-fluid w-100 h-100"
                                        style="object-fit: cover;">
                                @else
                                    <div class="text-center text-muted">
                                        <i class="bi bi-image" style="font-size: 40px;"></i>

                                        <div class="small mt-2">
                                            Tidak ada gambar
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12 mb-4">

                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea name="deskripsi" rows="5" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror"
                                placeholder="Masukkan deskripsi fasilitas">{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- Button --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('fasilitas.index') }}" class="btn btn-light border rounded-3 px-4">

                            Batal

                        </a>

                        <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">

                            <i class="bi bi-save me-1"></i>
                            Update Fasilitas

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
