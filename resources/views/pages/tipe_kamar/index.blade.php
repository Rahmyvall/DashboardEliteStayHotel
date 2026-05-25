@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Tipe Kamar</h2>
            <small class="text-muted">Kelola semua tipe kamar hotel dengan mudah</small>
        </div>

        <a href="{{ route('tipe-kamar.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Tipe Kamar
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('tipe-kamar.index') }}" class="mb-4">
        <div class="input-group shadow-sm rounded-3 overflow-hidden">
            <span class="input-group-text bg-white border-0">
                🔍
            </span>

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control border-0"
                   placeholder="Cari tipe kamar, harga, kapasitas...">

            <button class="btn btn-dark px-4">
                Search
            </button>
        </div>
    </form>

    {{-- GRID --}}
    <div class="row g-4">

        @forelse ($tipeKamar as $item)
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">

                {{-- HEADER --}}
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center rounded-top-4">

                    <h5 class="mb-0 fw-bold text-primary">
                        {{ $item->nama_tipe }}
                    </h5>

                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                        👥 {{ $item->kapasitas }} orang
                    </span>

                </div>

                {{-- BODY --}}
                <div class="card-body">

                    <p class="text-muted small mb-3">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi tersedia untuk tipe kamar ini.' }}
                    </p>

                    {{-- PRICE --}}
                    <div class="mb-3 p-3 bg-light rounded-3">
                        <div class="text-muted small">Harga per malam</div>
                        <div class="fs-4 fw-bold text-success">
                            Rp {{ number_format($item->harga_per_malam, 0, ',', '.') }}
                        </div>
                    </div>

                    {{-- SIZE --}}
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Ukuran</span>
                        <span class="fw-semibold">
                            {{ $item->ukuran_kamar ?? '-' }}
                        </span>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer bg-white border-0 d-flex justify-content-between rounded-bottom-4">

                    <a href="{{ route('tipe-kamar.show', $item->id_tipe) }}"
                       class="btn btn-sm btn-outline-info rounded-pill px-3">
                        Detail
                    </a>

                    <div class="d-flex gap-2">

                        <a href="{{ route('tipe-kamar.edit', $item->id_tipe) }}"
                           class="btn btn-sm btn-warning rounded-pill px-3">
                            Edit
                        </a>

                        <form action="{{ route('tipe-kamar.destroy', $item->id_tipe) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger rounded-pill px-3"
                                    onclick="return confirm('Yakin ingin menghapus tipe kamar ini?')">
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
        @empty

        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <h5>Belum ada data tipe kamar</h5>
                <p>Silakan tambahkan tipe kamar terlebih dahulu</p>
            </div>
        </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $tipeKamar->links() }}
    </div>

</div>

{{-- STYLE HOVER MODERN --}}
<style>
.hover-card {
    transition: all 0.25s ease-in-out;
}

.hover-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}
</style>

@endsection