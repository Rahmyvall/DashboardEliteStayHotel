@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="mb-4">
        <div class="p-4 rounded-3 text-white shadow-sm"
             style="background: linear-gradient(135deg,#198754,#20c997);">

            <h3 class="fw-bold mb-1">🛏 Detail Kamar</h3>
            <small>Informasi lengkap kamar hotel</small>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="row justify-content-center">

        <div class="col-lg-12">

            <div class="card border-0 shadow-sm rounded-3">

                <div class="card-body p-4">

                    <!-- ROOM TITLE + BARCODE -->
                    <div class="text-center mb-4">

                        <h2 class="fw-bold text-primary">
                            🛏 {{ $kamar->nomor_kamar }}
                        </h2>

                        <span class="badge bg-dark mb-3">
                            {{ $kamar->tipeKamar->nama_tipe ?? '-' }}
                        </span>

                        <!-- BARCODE -->
                        <div class="mt-3 d-flex justify-content-center">
                            <svg id="barcode"></svg>
                        </div>

                    </div>

                    <hr>

                    <!-- INFO -->
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 shadow-sm">
                                <small class="text-muted">Lantai</small>
                                <h5 class="mb-0">🏢 {{ $kamar->lantai }}</h5>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 shadow-sm">
                                <small class="text-muted">Status</small>
                                <h5 class="mb-0">

                                    @switch($kamar->status_kamar)

                                        @case('tersedia')
                                            <span class="badge bg-success">✔ Tersedia</span>
                                            @break

                                        @case('dipesan')
                                            <span class="badge bg-warning text-dark">⏳ Dipesan</span>
                                            @break

                                        @case('terisi')
                                            <span class="badge bg-danger">🔴 Terisi</span>
                                            @break

                                        @default
                                            <span class="badge bg-secondary">⚙ Maintenance</span>

                                    @endswitch

                                </h5>
                            </div>
                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="d-flex justify-content-between mt-4">

                        <a href="{{ route('kamar.index') }}" class="btn btn-light border">
                            ← Kembali
                        </a>

                        <a href="{{ route('kamar.edit', $kamar->id_kamar) }}"
                           class="btn btn-warning">
                            ✏ Edit Kamar
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- BARCODE SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>

<script>
    JsBarcode("#barcode", "{{ $kamar->nomor_kamar }}", {
        format: "CODE128",
        lineColor: "#198754",
        width: 2,
        height: 60,
        displayValue: true
    });
</script>

@endsection