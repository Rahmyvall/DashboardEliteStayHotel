@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-dark mb-1">
                    <i class="bi bi-plus-circle-fill me-3 text-primary"></i>Tambah Kamar Baru
                </h2>
                <p class="text-muted mb-0">Nomor kamar akan digenerate otomatis berdasarkan lantai</p>
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
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                                <i class="bi bi-door-open fs-3"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-semibold">Formulir Penambahan Kamar</h5>
                                <small class="text-muted">Silakan isi data kamar dengan lengkap</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        <form action="{{ route('kamar.store') }}" method="POST">
                            @csrf

                            <div class="row g-4">

                                <!-- TIPE KAMAR -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">
                                            <i class="bi bi-tag me-1"></i> Tipe Kamar
                                        </label>
                                        <select name="id_tipe" class="form-select form-select-lg border-0 bg-light"
                                            required>
                                            <option value="">-- Pilih Tipe Kamar --</option>
                                            @foreach ($tipeKamar as $tipe)
                                                <option value="{{ $tipe->id_tipe }}">
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
                                            <option value="">-- Pilih Lantai --</option>
                                            @for ($i = 1; $i <= 45; $i++)
                                                <option value="{{ $i }}">Lantai {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!-- STATUS -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">
                                            <i class="bi bi-toggle-on me-1"></i> Status Kamar
                                        </label>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <input type="radio" name="status_kamar" id="status1" value="tersedia"
                                                    checked>
                                                <label for="status1"
                                                    class="form-check-label d-block p-3 border rounded-3 text-center">
                                                    <span class="badge bg-success">🟢</span><br>
                                                    <small class="fw-medium">Tersedia</small>
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="radio" name="status_kamar" id="status2" value="dipesan">
                                                <label for="status2"
                                                    class="form-check-label d-block p-3 border rounded-3 text-center">
                                                    <span class="badge bg-warning text-dark">🟡</span><br>
                                                    <small class="fw-medium">Dipesan</small>
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="radio" name="status_kamar" id="status3" value="terisi">
                                                <label for="status3"
                                                    class="form-check-label d-block p-3 border rounded-3 text-center">
                                                    <span class="badge bg-danger">🔴</span><br>
                                                    <small class="fw-medium">Terisi</small>
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="radio" name="status_kamar" id="status4"
                                                    value="maintenance">
                                                <label for="status4"
                                                    class="form-check-label d-block p-3 border rounded-3 text-center">
                                                    <span class="badge bg-secondary">⚙️</span><br>
                                                    <small class="fw-medium">Maintenance</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- INFO BOX -->
                            <div class="alert alert-info border-0 bg-info bg-opacity-10 mt-4">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Nomor Kamar</strong> akan dibuat otomatis (contoh: Lantai 3 = 301, 302, dst)
                            </div>

                            <!-- SUBMIT BUTTONS -->
                            <div class="d-flex justify-content-end gap-3 mt-5">
                                <a href="{{ route('kamar.index') }}" class="btn btn-light border px-5 py-2">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm">
                                    <i class="bi bi-save me-2"></i>Simpan Kamar
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

                <!-- Optional: Help Card -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Pastikan tipe kamar dan lantai sudah benar sebelum menyimpan
                    </small>
                </div>

            </div>
        </div>
    </div>
@endsection
