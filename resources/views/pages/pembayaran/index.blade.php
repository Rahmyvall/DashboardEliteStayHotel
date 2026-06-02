@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Data Pembayaran</h3>
                <small class="text-muted">
                    Kelola seluruh transaksi pembayaran hotel
                </small>
            </div>

            <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Pembayaran
            </a>
        </div>

        {{-- Statistik --}}
        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Pembayaran</h6>
                        <h3 class="fw-bold">
                            {{ $pembayaran->total() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Paid</h6>
                        <h3 class="fw-bold text-success">
                            {{ \App\Models\Pembayaran::where('status_pembayaran', 'paid')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Pending</h6>
                        <h3 class="fw-bold text-warning">
                            {{ \App\Models\Pembayaran::where('status_pembayaran', 'pending')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Pendapatan</h6>
                        <h5 class="fw-bold text-primary">
                            Rp
                            {{ number_format(\App\Models\Pembayaran::where('status_pembayaran', 'paid')->sum('jumlah_bayar'), 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>

        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Card Table --}}
        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">
                <div class="row">

                    <div class="col-md-6">
                        <h5 class="mb-0">
                            Daftar Pembayaran
                        </h5>
                    </div>

                    <div class="col-md-6">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari pembayaran...">
                    </div>

                </div>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0" id="paymentTable">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kode Reservasi</th>
                                <th>Tanggal Bayar</th>
                                <th>Metode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Bukti</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($pembayaran as $item)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $item->reservasi->kode_reservasi ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') : '-' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-info">
                                            {{ strtoupper($item->metode_pembayaran) }}
                                        </span>
                                    </td>

                                    <td class="fw-bold">
                                        Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                                    </td>

                                    <td>

                                        @switch($item->status_pembayaran)
                                            @case('paid')
                                                <span class="badge bg-success">
                                                    Paid
                                                </span>
                                            @break

                                            @case('pending')
                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>
                                            @break

                                            @case('failed')
                                                <span class="badge bg-danger">
                                                    Failed
                                                </span>
                                            @break

                                            @case('refund')
                                                <span class="badge bg-secondary">
                                                    Refund
                                                </span>
                                            @break
                                        @endswitch

                                    </td>

                                    <td>

                                        @if ($item->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank">

                                                <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}" width="50"
                                                    class="rounded border">
                                            </a>
                                        @else
                                            -
                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('pembayaran.show', $item->id_pembayaran) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('pembayaran.edit', $item->id_pembayaran) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('pembayaran.destroy', $item->id_pembayaran) }}"
                                            method="POST" class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Yakin hapus data?')"
                                                class="btn btn-sm btn-danger">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            Tidak ada data pembayaran
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card-footer bg-white">
                    {{ $pembayaran->links() }}
                </div>

            </div>

        </div>

        <script>
            document.getElementById('searchInput')
                .addEventListener('keyup', function() {

                    let value = this.value.toLowerCase();

                    let rows = document.querySelectorAll('#paymentTable tbody tr');

                    rows.forEach(row => {

                        row.style.display =
                            row.textContent.toLowerCase().includes(value) ?
                            '' :
                            'none';

                    });

                });
        </script>
    @endsection
