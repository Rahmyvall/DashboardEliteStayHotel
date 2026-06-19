<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Check In / Check Out</title>

    <style>
    @page {
        size: A4 portrait;
        margin: 12mm;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', 'Helvetica', sans-serif;
        font-size: 11.5px;
        color: #333;
        line-height: 1.5;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px solid #0d6efd;
        padding-bottom: 12px;
        margin-bottom: 18px;
    }

    .header-left h1 {
        font-size: 22px;
        font-weight: bold;
        color: #0d6efd;
        margin: 0;
    }

    .header-left p {
        font-size: 11px;
        color: #555;
        margin-top: 4px;
    }

    .date {
        text-align: right;
        font-size: 10.5px;
        color: #666;
    }

    .barcode {
        text-align: center;
        margin: 18px 0 22px 0;
    }

    .barcode-text {
        font-size: 11px;
        font-weight: bold;
        color: #222;
        margin-top: 6px;
        letter-spacing: 1px;
    }

    .summary {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background: #f8f9fa;
    }

    .summary td {
        padding: 10px 8px;
        text-align: center;
        border: 1px solid #dee2e6;
    }

    .summary small {
        display: block;
        font-size: 9.5px;
        color: #666;
        margin-bottom: 4px;
    }

    .summary strong {
        font-size: 13.5px;
        color: #222;
    }

    .status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 9.5px;
        font-weight: bold;
        color: white;
        display: inline-block;
    }

    .section-title {
        background: linear-gradient(90deg, #0d6efd, #0b5ed7);
        color: white;
        padding: 7px 12px;
        margin: 18px 0 8px 0;
        font-size: 12px;
        font-weight: bold;
        border-radius: 4px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    .table td {
        padding: 8px 10px;
        border-bottom: 1px solid #eee;
    }

    .table td:first-child {
        width: 38%;
        background: #f8f9fa;
        font-weight: 600;
        color: #444;
    }

    .total-row {
        background: #e7f0ff;
        font-weight: bold;
        font-size: 13px;
    }

    .note {
        border: 1px solid #ddd;
        padding: 12px;
        min-height: 60px;
        background: #fdfdfd;
    }

    .signature {
        margin-top: 35px;
        display: flex;
        justify-content: space-between;
    }

    .sign {
        width: 45%;
        text-align: center;
    }

    .sign-space {
        height: 65px;
        margin: 8px 0;
    }

    .line {
        border-top: 1px solid #333;
        padding-top: 4px;
        font-size: 10px;
    }

    .footer {
        margin-top: 30px;
        text-align: center;
        font-size: 9.5px;
        color: #888;
    }
    </style>
</head>

<body>

    @php
    $statusColor = match($checkin->status) {
    'checked_in' => '#198754',
    'checked_out' => '#6c757d',
    'late_checkout' => '#ffc107',
    'cancelled' => '#dc3545',
    default => '#0d6efd'
    };
    @endphp

    <div class="header">
        <div class="header-left">
            <h1>BUKTI CHECK IN / CHECK OUT</h1>
            <p>Sistem Manajemen Hotel</p>
        </div>
        <div class="date">
            Dicetak pada<br>
            <strong>{{ now()->format('d F Y H:i') }}</strong>
        </div>
    </div>

    {{-- BARCODE --}}
    <div class="barcode">
        {!! DNS1D::getBarcodeHTML(
        $checkin->reservasi->kode_reservasi ?? '000000',
        'C128',
        1.8,
        48
        ) !!}
        <div class="barcode-text">
            {{ $checkin->reservasi->kode_reservasi ?? '-' }}
        </div>
    </div>

    {{-- SUMMARY --}}
    <table class="summary">
        <tr>
            <td>
                <small>No Kamar</small>
                <strong>{{ $checkin->reservasi->kamar->nomor_kamar ?? '-' }}</strong>
            </td>
            <td>
                <small>Jumlah Tamu</small>
                <strong>{{ $checkin->jumlah_tamu_aktual ?? 0 }} Orang</strong>
            </td>
            <td>
                <small>Total Bayar</small>
                <strong>Rp {{ number_format($checkin->total_bayar ?? 0, 0, ',', '.') }}</strong>
            </td>
            <td>
                <small>Status</small><br>
                <span class="status" style="background: {{ $statusColor }};">
                    {{ strtoupper(str_replace('_', ' ', $checkin->status)) }}
                </span>
            </td>
        </tr>
    </table>

    <div class="section-title">INFORMASI RESERVASI</div>

    <table class="table">
        <tr>
            <td>Kode Reservasi</td>
            <td><strong>{{ $checkin->reservasi->kode_reservasi ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td>Nama Tamu</td>
            <td>{{ $checkin->reservasi->pelanggan->nama_lengkap ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tipe Kamar</td>
            <td>{{ $checkin->reservasi->kamar->tipe_kamar->nama_tipe ?? '-' }}</td>
        </tr>
        <tr>
            <td>Check In</td>
            <td>
                {{ $checkin->waktu_checkin_aktual
                    ? \Carbon\Carbon::parse($checkin->waktu_checkin_aktual)->format('d/m/Y H:i')
                    : '-' }}
            </td>
        </tr>
        <tr>
            <td>Check Out</td>
            <td>
                {{ $checkin->waktu_checkout_aktual
                    ? \Carbon\Carbon::parse($checkin->waktu_checkout_aktual)->format('d/m/Y H:i')
                    : '-' }}
            </td>
        </tr>
        <tr>
            <td>Kondisi Kamar</td>
            <td>{{ $checkin->kondisi_kamar ?? '-' }}</td>
        </tr>
        <tr>
            <td>Deposit</td>
            <td>Rp {{ number_format($checkin->deposit ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Biaya Tambahan</td>
            <td>Rp {{ number_format($checkin->biaya_tambahan ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Denda Late Checkout</td>
            <td>Rp {{ number_format($checkin->denda_late_checkout ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr class="total-row">
            <td>TOTAL BAYAR</td>
            <td>Rp {{ number_format($checkin->total_bayar ?? 0, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="section-title">CATATAN</div>
    <div class="note">
        <strong>Check In:</strong> {{ $checkin->catatan ?: '-' }}<br><br>
        <strong>Check Out:</strong> {{ $checkin->catatan_checkout ?: '-' }}
    </div>

    <div class="signature">
        <div class="sign">
            Petugas Hotel<br>
            <div class="sign-space"></div>
            <div class="line">( ........................................ )</div>
        </div>

        <div class="sign">
            Tamu / Perwakilan<br>
            <div class="sign-space"></div>
            <div class="line">( ........................................ )</div>
        </div>
    </div>

    <div class="footer">
        Dokumen ini dibuat secara otomatis oleh Sistem Manajemen Hotel<br>
        Harap simpan sebagai bukti resmi
    </div>

    <script>
    window.onload = () => window.print();
    </script>

</body>

</html>
