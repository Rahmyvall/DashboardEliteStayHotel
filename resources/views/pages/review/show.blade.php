@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="card-header bg-white border-0 py-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-eye text-primary me-2"></i>
                        Detail Review
                    </h4>
                    <small class="text-muted">
                        Informasi lengkap review pelanggan
                    </small>
                </div>

                <div class="card-body px-4 py-4">

                    <!-- Info Reservasi -->
                    <div class="mb-3">
                        <label class="text-muted">Kode Reservasi</label>
                        <div class="fw-semibold">
                            {{ $review->reservasi->kode_reservasi }}
                        </div>
                    </div>

                    <!-- Nama Pelanggan -->
                    <div class="mb-3">
                        <label class="text-muted">Pelanggan</label>
                        <div class="fw-semibold">
                            {{ optional($review->reservasi->pelanggan)->nama_lengkap }}
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="mb-3">
                        <label class="text-muted">Rating</label>
                        <div class="fs-5 text-warning">
                            {{ str_repeat('⭐', $review->rating) }}
                            <span class="text-dark fw-semibold ms-2">
                                ({{ $review->rating }}/5)
                            </span>
                        </div>
                    </div>

                    <!-- Komentar -->
                    <div class="mb-4">
                        <label class="text-muted">Komentar</label>

                        <div class="p-3 bg-light rounded-3 shadow-sm">
                            {{ $review->komentar ?? '-' }}
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="d-flex justify-content-end">

                        <a href="{{ route('review.index') }}" class="btn btn-outline-secondary px-4 rounded-3">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection