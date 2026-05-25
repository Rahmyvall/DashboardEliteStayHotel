@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold">Tambah Tipe Kamar</h3>
        <small class="text-muted">Isi data tipe kamar dengan lengkap</small>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('tipe-kamar.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    {{-- NAMA TIPE --}}
                    <div class="col-md-6">
                        <label class="form-label">Nama Tipe</label>
                        <input type="text" name="nama_tipe" class="form-control" placeholder="Deluxe Room" required>
                    </div>

                    {{-- KAPASITAS --}}
                    <div class="col-md-6">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control" placeholder="2" required>
                    </div>

                    {{-- HARGA --}}
                    <div class="col-md-6">
                        <label class="form-label">Harga Per Malam</label>
                        <input type="number" name="harga_per_malam" class="form-control" placeholder="500000" required>
                    </div>

                    {{-- UKURAN --}}
                    <div class="col-md-6">
                        <label class="form-label">Ukuran Kamar</label>
                        <input type="text" name="ukuran_kamar" class="form-control" placeholder="25 m²">
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="form-control" placeholder="Deskripsi kamar..."></textarea>
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="mt-4 d-flex justify-content-end gap-2">

                    <a href="{{ route('tipe-kamar.index') }}" class="btn btn-light">
                        Cancel
                    </a>

                    <button class="btn btn-primary px-4">
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection