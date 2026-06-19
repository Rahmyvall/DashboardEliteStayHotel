@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">


    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="fw-bold mb-1">
                        ⭐ Review Pelanggan
                    </h3>
                    <p class="text-muted mb-0">
                        Kelola ulasan dan penilaian pelanggan hotel
                    </p>
                </div>

                <a href="{{ route('review.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i>
                    Tambah Review
                </a>

            </div>

        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <small class="text-muted">
                        Total Review
                    </small>

                    <h2 class="fw-bold mb-0">
                        {{ $reviews->total() }}
                    </h2>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <small class="text-muted">
                        Rating Rata-rata
                    </small>

                    <h2 class="fw-bold text-warning mb-0">
                        {{ number_format($reviews->avg('rating'),1) }}
                        ⭐
                    </h2>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <small class="text-muted">
                        Rating 5 Bintang
                    </small>

                    <h2 class="fw-bold text-success mb-0">
                        {{ $reviews->where('rating',5)->count() }}
                    </h2>

                </div>
            </div>
        </div>

    </div>

    {{-- TABLE REVIEW --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="fw-bold mb-0">
                    Daftar Review
                </h5>

                <span class="badge bg-primary">
                    {{ $reviews->total() }} Data
                </span>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th width="60">No</th>
                        <th>Pelanggan</th>
                        <th>Kamar</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                        <th width="150" class="text-center">
                            Aksi
                        </th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($reviews as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        {{-- PELANGGAN --}}
                        <td>

                            <div class="fw-semibold">
                                {{ data_get($item,'reservasi.pelanggan.nama_lengkap','-') }}
                            </div>

                            <small class="text-muted">
                                {{ data_get($item,'reservasi.kode_reservasi','-') }}
                            </small>

                        </td>

                        {{-- KAMAR --}}
                        <td>

                            <span class="badge bg-info text-dark px-3 py-2">
                                🛏 Kamar
                                {{ data_get($item,'reservasi.kamar.nomor_kamar','-') }}
                            </span>

                        </td>

                        {{-- RATING --}}
                        <td>

                            <div class="d-flex align-items-center gap-2">

                                <div>

                                    @for($i = 1; $i <= 5; $i++) <i
                                        class="fas fa-star {{ $i <= $item->rating ? 'text-warning' : 'text-secondary opacity-25' }}">
                                        </i>
                                        @endfor

                                </div>

                                <span class="badge bg-warning text-dark">
                                    {{ $item->rating }}/5
                                </span>

                            </div>

                        </td>

                        {{-- KOMENTAR --}}
                        <td>

                            <span class="text-muted">
                                {{ \Illuminate\Support\Str::limit($item->komentar, 60) }}
                            </span>

                        </td>

                        {{-- TANGGAL --}}
                        <td>

                            {{ $item->created_at->format('d M Y') }}

                        </td>

                        {{-- AKSI --}}
                        <td>

                            <div class="d-flex justify-content-center gap-1">

                                <a href="{{ route('review.show',$item->id_review) }}"
                                    class="btn btn-sm btn-outline-primary" title="Detail">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('review.edit',$item->id_review) }}"
                                    class="btn btn-sm btn-outline-warning" title="Edit">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('review.destroy',$item->id_review) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus review ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-5">

                            <i class="fas fa-star fa-3x text-muted mb-3"></i>

                            <h5 class="text-muted">
                                Belum Ada Review
                            </h5>

                            <p class="text-muted mb-0">
                                Review pelanggan akan muncul setelah checkout.
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $reviews->links() }}
    </div>


</div>

@endsection
