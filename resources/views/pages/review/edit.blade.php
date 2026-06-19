@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="card-header bg-white border-0 py-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-edit text-warning me-2"></i>
                        Edit Review
                    </h4>
                    <small class="text-muted">
                        Perbarui data review pelanggan
                    </small>
                </div>

                <div class="card-body px-4 py-4">

                    <form action="{{ route('review.update', $review->id_review) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Reservasi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-calendar-check me-1 text-secondary"></i>
                                Reservasi
                            </label>

                            <select name="id_reservasi" class="form-select form-select-lg shadow-sm rounded-3" required>

                                @foreach($reservasi as $item)
                                <option value="{{ $item->id_reservasi }}"
                                    {{ $review->id_reservasi == $item->id_reservasi ? 'selected' : '' }}>
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

                                @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                    {{ str_repeat('⭐', $i) }} - {{ $i }}
                                </option>
                                @endfor

                            </select>
                        </div>

                        <!-- Komentar -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-comment me-1 text-info"></i>
                                Komentar
                            </label>

                            <textarea name="komentar" rows="5" class="form-control shadow-sm rounded-3"
                                placeholder="Tulis komentar...">{{ $review->komentar }}</textarea>
                        </div>

                        <!-- Button -->
                        <div class="d-flex justify-content-between mt-4">

                            <a href="{{ route('review.index') }}" class="btn btn-outline-secondary px-4 rounded-3">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-warning px-4 rounded-3 shadow-sm">
                                <i class="fas fa-save me-1"></i>
                                Update
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection