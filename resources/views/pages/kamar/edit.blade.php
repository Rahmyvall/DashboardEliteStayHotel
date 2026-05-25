@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-dark mb-1">
                    <i class="bi bi-pencil-square me-3 text-warning"></i>Edit Kamar
                </h2>
                <p class="text-muted mb-0">Update informasi kamar hotel</p>
            </div>
            <a href="{{ route('kamar.index') }}" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">

                <!-- MAIN CARD -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    <!-- Card Header -->
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                                <i class="bi bi-pencil-square fs-3"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-semibold">Form Edit Kamar</h5>
                                <small class="text-muted">Nomor kamar tidak dapat diubah</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        <form action="{{ route('kamar.update', $kamar->id_kamar) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <!-- NOMOR KAMAR (Readonly) -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">
                                            <i class="bi bi-door-open me-1"></i> Nomor Kamar
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">🛏</span>
                                            <input type="text" class="form-control form-control-lg bg-light"
                                                value="{{ $kamar->nomor_kamar }}" readonly>
                                        </div>
                                        <small class="text-muted mt-1 d-block">
                                            Nomor kamar tidak dapat diubah untuk menjaga sistem auto-generate
                                        </small>
                                    </div>
                                </div>

                                <!-- TIPE KAMAR -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">
                                            <i class="bi bi-tag me-1"></i> Tipe Kamar
                                        </label>
                                        <select name="id_tipe" class="form-select form-select-lg border-0 bg-light"
                                            required>
                                            @foreach ($tipeKamar as $tipe)
                                                <option value="{{ $tipe->id_tipe }}"
                                                    {{ $kamar->id_tipe == $tipe->id_tipe ? 'selected' : '' }}>
                                                    {{ $tipe->nama_tipe }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- LANTAI -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">
                                            <i class="bi bi-layers me-1"></i> Lantai
                                        </label>
                                        <select name="lantai" class="form-select form-select-lg border-0 bg-light"
                                            required>
                                            @for ($i = 1; $i <= 45; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $kamar->lantai == $i ? 'selected' : '' }}>
                                                    Lantai {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!-- STATUS -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">
                                            <i class="bi bi-toggle-on me-1"></i> Status Kamar
                                        </label>
                                        <select name="status_kamar" class="form-select form-select-lg border-0 bg-light"
                                            required>
                                            <option value="tersedia"
                                                {{ $kamar->status_kamar == 'tersedia' ? 'selected' : '' }}>
                                                🟢 Tersedia
                                            </option>
                                            <option value="dipesan"
                                                {{ $kamar->status_kamar == 'dipesan' ? 'selected' : '' }}>
                                                🟡 Dipesan
                                            </option>
                                            <option value="terisi"
                                                {{ $kamar->status_kamar == 'terisi' ? 'selected' : '' }}>
                                                🔴 Terisi
                                            </option>
                                            <option value="maintenance"
                                                {{ $kamar->status_kamar == 'maintenance' ? 'selected' : '' }}>
                                                ⚙️ Maintenance
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="d-flex justify-content-end gap-3 mt-5">
                                <a href="{{ route('kamar.index') }}" class="btn btn-light border px-5 py-2">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-success px-5 py-2 shadow-sm">
                                    <i class="bi bi-check-circle me-2"></i>Update Kamar
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
