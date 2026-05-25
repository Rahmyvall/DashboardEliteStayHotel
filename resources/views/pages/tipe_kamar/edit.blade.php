@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h3 class="fw-bold">Edit Tipe Kamar</h3>
        <small class="text-muted">Perbarui data tipe kamar</small>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('tipe-kamar.update', $tipeKamar->id_tipe) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Tipe</label>
                        <input type="text" name="nama_tipe"
                               value="{{ $tipeKamar->nama_tipe }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" name="kapasitas"
                               value="{{ $tipeKamar->kapasitas }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga Per Malam</label>
                        <input type="number" name="harga_per_malam"
                               value="{{ $tipeKamar->harga_per_malam }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ukuran Kamar</label>
                        <input type="text" name="ukuran_kamar"
                               value="{{ $tipeKamar->ukuran_kamar }}"
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="form-control">{{ $tipeKamar->deskripsi }}</textarea>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">

                    <a href="{{ route('tipe-kamar.index') }}" class="btn btn-light">
                        Cancel
                    </a>

                    <button class="btn btn-warning px-4">
                        Update
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection