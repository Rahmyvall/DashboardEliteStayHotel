@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;

        $total = $reservasi->total();

        $confirmed = $reservasi->getCollection()->where('status_reservasi', 'confirmed')->count();

        $pending = $reservasi->getCollection()->where('status_reservasi', 'pending')->count();

        $unpaid = $reservasi->getCollection()->where('status_pembayaran', 'unpaid')->count();

        function statusBadge($status)
        {
            return match ($status) {
                'pending' => 'warning',
                'confirmed' => 'success',
                'checkin' => 'primary',
                'checkout' => 'secondary',
                'cancelled' => 'danger',
                'no_show' => 'dark',
                default => 'secondary',
            };
        }

        function paymentBadge($status)
        {
            return match ($status) {
                'paid' => 'success',
                'partial' => 'warning',
                'unpaid' => 'danger',
                'refunded' => 'dark',
                default => 'secondary',
            };
        }
    @endphp

    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">🏨 Reservasi Hotel</h2>
                <small class="text-muted">Manajemen booking tamu real-time</small>
            </div>

            <a href="{{ route('reservasi.create') }}" class="btn btn-primary shadow-sm px-4 rounded-3">
                + Tambah Reservasi
            </a>
        </div>

        {{-- STATS --}}
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <small class="text-muted">Total Reservasi</small>
                        <h3 class="fw-bold">{{ $total }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <small class="text-muted">Confirmed</small>
                        <h3 class="fw-bold text-success">{{ $confirmed }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <small class="text-muted">Pending</small>
                        <h3 class="fw-bold text-warning">{{ $pending }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <small class="text-muted">Belum Bayar</small>
                        <h3 class="fw-bold text-danger">{{ $unpaid }}</h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-header bg-white border-0">
                <h5 class="mb-0 fw-bold">Daftar Reservasi</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr class="text-muted">
                            <th>#</th>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Kamar</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($reservasi as $item)
                            <tr class="align-middle">

                                <td>{{ $loop->iteration }}</td>

                                <td class="fw-bold text-primary">
                                    {{ $item->kode_reservasi }}
                                </td>

                                {{-- PELANGGAN --}}
                                <td>
                                    {{ optional($item->pelanggan)->nama_lengkap ?? '-' }}
                                </td>

                                {{-- KAMAR --}}
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ optional($item->kamar)->nomor_kamar ?? '-' }}
                                    </span>
                                </td>

                                {{-- CHECK IN --}}
                                <td>
                                    {{ $item->check_in ? Carbon::parse($item->check_in)->format('d M Y') : '-' }}
                                </td>

                                {{-- CHECK OUT --}}
                                <td>
                                    {{ $item->check_out ? Carbon::parse($item->check_out)->format('d M Y') : '-' }}
                                </td>

                                {{-- STATUS RESERVASI --}}
                                <td>
                                    <span class="badge bg-{{ statusBadge($item->status_reservasi) }}">
                                        {{ ucfirst($item->status_reservasi) }}
                                    </span>
                                </td>

                                {{-- STATUS PEMBAYARAN --}}
                                <td>
                                    <span class="badge bg-{{ paymentBadge($item->status_pembayaran) }}">
                                        {{ ucfirst($item->status_pembayaran) }}
                                    </span>
                                </td>

                                {{-- TOTAL --}}
                                <td class="fw-bold text-success">
                                    Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                                </td>

                                {{-- ACTION --}}
                                <td class="text-center">

                                    <a href="{{ route('reservasi.show', $item->id_reservasi) }}"
                                        class="btn btn-sm btn-outline-primary rounded-3">
                                        👁
                                    </a>

                                    <a href="{{ route('reservasi.edit', $item->id_reservasi) }}"
                                        class="btn btn-sm btn-outline-warning rounded-3">
                                        ✏
                                    </a>

                                    <form action="{{ route('reservasi.destroy', $item->id_reservasi) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger rounded-3"
                                            onclick="return confirm('Hapus data ini?')">
                                            🗑
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">
                                    Tidak ada data reservasi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="card-footer bg-white border-0">
                {{ $reservasi->links() }}
            </div>

        </div>

    </div>
@endsection
