@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Data Pembayaran</h3>
                <small class="text-muted">Kelola seluruh transaksi pembayaran hotel</small>
            </div>

            <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pembayaran
            </a>
        </div>

        {{-- STATISTIK --}}
        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6>Total</h6>
                        <h3>{{ $pembayaran->total() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6>Paid</h6>
                        <h3 class="text-success">
                            {{ \App\Models\Pembayaran::where('status_pembayaran', 'paid')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6>Pending</h6>
                        <h3 class="text-warning">
                            {{ \App\Models\Pembayaran::where('status_pembayaran', 'pending')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6>Pendapatan</h6>
                        <h5 class="text-primary">
                            Rp
                            {{ number_format(\App\Models\Pembayaran::where('status_pembayaran', 'paid')->sum('jumlah_bayar'), 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>

        </div>

        {{-- 📊 CHART LINE --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Grafik Pendapatan Bulanan</h5>
            </div>

            <div class="card-body">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- TABLE --}}
        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Daftar Pembayaran</h5>
                    </div>

                    <div class="col-md-6">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                    </div>
                </div>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0" id="paymentTable">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Metode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pembayaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $item->reservasi->kode_reservasi ?? '-' }}</td>

                                    <td>
                                        {{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') : '-' }}
                                    </td>

                                    <td>{{ strtoupper($item->metode_pembayaran) }}</td>

                                    <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>

                                    <td>
                                        @if ($item->status_pembayaran == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @elseif($item->status_pembayaran == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($item->status_pembayaran == 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @else
                                            <span class="badge bg-secondary">Refund</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->bukti_pembayaran)
                                            <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}"
                                                alt="Bukti Pembayaran" width="50" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">Tidak ada bukti</span>
                                        @endif
                                    </td>

                                    {{-- ACTION BUTTONS --}}
                                    <td class="d-flex gap-1">

                                        {{-- SHOW --}}
                                        <a href="{{ route('pembayaran.show', $item->id_pembayaran) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('pembayaran.edit', $item->id_pembayaran) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('pembayaran.destroy', $item->id_pembayaran) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-3">
                                        Tidak ada data
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

    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const canvas = document.getElementById('revenueChart');

            if (!canvas) {
                console.error("Canvas revenueChart tidak ditemukan");
                return;
            }

            const labels = @json($monthlyLabels ?? []);
            const data = @json($monthlyRevenue ?? []);

            // fallback kalau kosong
            const safeLabels = labels.length ? labels : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
            const safeData = data.length ? data : [0, 0, 0, 0, 0, 0];

            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: safeLabels,
                    datasets: [{
                        label: 'Pendapatan Bulanan',
                        data: safeData,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13,110,253,0.15)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });

        // SEARCH (SAFE)
        document.addEventListener("DOMContentLoaded", function() {

            const search = document.getElementById('searchInput');
            const table = document.getElementById('paymentTable');

            if (!search || !table) return;

            search.addEventListener('keyup', function() {
                let value = this.value.toLowerCase();

                table.querySelectorAll('tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(value) ?
                        '' :
                        'none';
                });
            });

        });
    </script>
@endsection
