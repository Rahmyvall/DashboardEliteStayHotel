@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- BACK --}}
    <a href="{{ route('tipe-kamar.index') }}" class="btn btn-light mb-3">
        ← Kembali
    </a>

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 p-4">
            <h3 class="fw-bold text-primary mb-0">
                {{ $tipeKamar->nama_tipe }}
            </h3>
            <small class="text-muted">Detail informasi tipe kamar</small>
        </div>

        <div class="card-body p-4">

            <div class="row g-4">

                {{-- INFO --}}
                <div class="col-md-8">

                    <p class="text-muted">
                        {{ $tipeKamar->deskripsi ?? 'Tidak ada deskripsi tersedia' }}
                    </p>

                    <hr>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="text-muted">Kapasitas</div>
                            <div class="fw-bold">{{ $tipeKamar->kapasitas }} orang</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="text-muted">Ukuran</div>
                            <div class="fw-bold">{{ $tipeKamar->ukuran_kamar ?? '-' }}</div>
                        </div>

                    </div>

                </div>

                {{-- PRICE CARD --}}
                <div class="col-md-4">

                    <div class="p-4 bg-light rounded-4 text-center">

                        <div class="text-muted">Harga per malam</div>

                        <h2 class="text-success fw-bold mt-2">
                            Rp {{ number_format($tipeKamar->harga_per_malam, 0, ',', '.') }}
                        </h2>

                        <small class="text-muted">/ malam</small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection