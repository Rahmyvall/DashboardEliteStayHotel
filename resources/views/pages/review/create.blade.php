@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="card-header bg-white border-0 py-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-comment-dots text-primary me-2"></i>
                        Tambah Review
                    </h4>
                    <small class="text-muted">
                        Berikan penilaian terhadap pengalaman pelanggan
                    </small>
                </div>

                <div class="card-body px-4 py-4">

                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf

                        <!-- Reservasi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-calendar-check me-1 text-secondary"></i>
                                Reservasi
                            </label>

                            <select name="id_reservasi" class="form-select form-select-lg shadow-sm rounded-3" required>

                                <option value="">-- Pilih Reservasi --</option>

                                @foreach($reservasi as $item)
                                <option value="{{ $item->id_reservasi }}">
                                    {{ $item->kode_reservasi }} - {{ optional($item->pelanggan)->nama_lengkap }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Rating -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-star me-1 text-warning"></i>
                                Rating
                            </label>

                            <select name="rating" class="form-select form-select-lg shadow-sm rounded-3" required>
                                <option value="5">⭐⭐⭐⭐⭐ - Sangat Puas</option>
                                <option value="4">⭐⭐⭐⭐ - Puas</option>
                                <option value="3">⭐⭐⭐ - Cukup</option>
                                <option value="2">⭐⭐ - Kurang</option>
                                <option value="1">⭐ - Buruk</option>
                            </select>
                        </div>

                        <!-- Komentar -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-comment me-1 text-info"></i>
                                Komentar
                            </label>

                            <textarea name="komentar" rows="5" class="form-control shadow-sm rounded-3"
                                placeholder="Tulis pengalaman pelanggan di sini..."></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">

                            <a href="{{ route('review.index') }}" class="btn btn-outline-secondary px-4 rounded-3">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm">
                                <i class="fas fa-save me-1"></i>
                                Simpan Review
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection
