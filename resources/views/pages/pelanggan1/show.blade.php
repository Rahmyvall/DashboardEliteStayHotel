@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4 no-print">

        <div class="card-body p-4 bg-info bg-gradient text-white">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

                <div class="d-flex align-items-center">

                    <div class="header-icon me-3">

                        <i class="ti ti-user-circle"></i>

                    </div>

                    <div>

                        <h2 class="fw-bold mb-1">
                            Detail Pelanggan
                        </h2>

                        <p class="mb-0 text-white-50">
                            Informasi lengkap data pelanggan
                        </p>

                    </div>

                </div>

                <div class="d-flex gap-2">

                    {{-- PRINT --}}
                    <button onclick="window.print()"
                        class="btn btn-dark px-4 py-2 rounded-4 fw-semibold shadow-sm">

                        <i class="ti ti-printer me-1"></i>
                        Print

                    </button>

                    {{-- BACK --}}
                    <a href="{{ route('pelanggan1.index') }}"
                        class="btn btn-light px-4 py-2 rounded-4 fw-semibold shadow-sm">

                        <i class="ti ti-arrow-left me-1"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- PRINT AREA --}}
    <div class="print-area">

        <div class="card border-0 shadow-lg rounded-5 overflow-hidden detail-card">

            {{-- PROFILE --}}
            <div class="profile-section text-center text-white position-relative">

                <div class="profile-overlay"></div>

                <div class="position-relative z-1">

                    <div class="profile-avatar mx-auto mb-3 shadow-lg">

                        {{ strtoupper(substr($pelanggan->user->nama_lengkap ?? 'P', 0, 1)) }}

                    </div>

                    <h2 class="fw-bold mb-1">
                        {{ $pelanggan->user->nama_lengkap ?? '-' }}
                    </h2>

                    <p class="mb-0 opacity-75">
                        {{ $pelanggan->user->email ?? '-' }}
                    </p>

                </div>

            </div>


            {{-- CONTENT --}}
            <div class="card-body p-5">

                {{-- PRINT HEADER --}}
                <div class="print-header text-center mb-5">

                    <h3 class="fw-bold mb-1">
                        DATA DETAIL PELANGGAN
                    </h3>

                    <p class="text-muted mb-2">
                        Sistem Informasi Pelanggan
                    </p>

                    <hr>

                </div>


                {{-- DETAIL --}}
                <div class="row g-4">

                    {{-- NIK --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <div class="detail-icon bg-primary-subtle text-primary">

                                <i class="ti ti-id"></i>

                            </div>

                            <div>

                                <small class="detail-label">
                                    NIK
                                </small>

                                <h6 class="detail-value">
                                    {{ $pelanggan->nik ?? '-' }}
                                </h6>

                            </div>

                        </div>

                    </div>


                    {{-- GENDER --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <div class="detail-icon bg-danger-subtle text-danger">

                                <i class="ti ti-gender-bigender"></i>

                            </div>

                            <div>

                                <small class="detail-label">
                                    Jenis Kelamin
                                </small>

                                <h6 class="detail-value">

                                    {{ $pelanggan->jenis_kelamin == 'L'
                                        ? 'Laki-laki'
                                        : 'Perempuan' }}

                                </h6>

                            </div>

                        </div>

                    </div>


                    {{-- KOTA --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <div class="detail-icon bg-success-subtle text-success">

                                <i class="ti ti-building-community"></i>

                            </div>

                            <div>

                                <small class="detail-label">
                                    Kota
                                </small>

                                <h6 class="detail-value">
                                    {{ $pelanggan->kota ?? '-' }}
                                </h6>

                            </div>

                        </div>

                    </div>


                    {{-- NEGARA --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <div class="detail-icon bg-warning-subtle text-warning">

                                <i class="ti ti-world"></i>

                            </div>

                            <div>

                                <small class="detail-label">
                                    Negara
                                </small>

                                <h6 class="detail-value">
                                    {{ $pelanggan->negara ?? '-' }}
                                </h6>

                            </div>

                        </div>

                    </div>


                    {{-- TANGGAL LAHIR --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <div class="detail-icon bg-info-subtle text-info">

                                <i class="ti ti-calendar"></i>

                            </div>

                            <div>

                                <small class="detail-label">
                                    Tanggal Lahir
                                </small>

                                <h6 class="detail-value">

                                    {{ $pelanggan->tanggal_lahir
                                        ? \Carbon\Carbon::parse($pelanggan->tanggal_lahir)->translatedFormat('d F Y')
                                        : '-' }}

                                </h6>

                            </div>

                        </div>

                    </div>


                    {{-- ALAMAT --}}
                    <div class="col-12">

                        <div class="alamat-wrapper">

                            <small class="detail-label d-block mb-3">
                                Alamat
                            </small>

                            <div class="alamat-box">

                                {{ $pelanggan->alamat ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SIGNATURE --}}
                <div class="row mt-5 pt-5 signature-section">

                    <div class="col-6 text-center">

                        <p class="text-muted mb-5">
                            Mengetahui,
                        </p>

                        <h6 class="fw-bold">
                            ____________________
                        </h6>

                    </div>

                    <div class="col-6 text-center">

                        <p class="text-muted mb-5">

                            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

                        </p>

                        <h6 class="fw-bold">
                            ____________________
                        </h6>

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end mt-5 no-print">

                    <a href="{{ route('pelanggan1.edit', $pelanggan->id_pelanggan) }}"
                        class="btn btn-warning px-4 py-2 rounded-4 shadow-sm fw-semibold">

                        <i class="ti ti-edit me-1"></i>
                        Edit Pelanggan

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- STYLE --}}
<style>

:root{
    --primary-color: #0d6efd;
}

/*
|--------------------------------------------------------------------------
| GLOBAL
|--------------------------------------------------------------------------
*/

.a4-paper,
.print-area{
    width: 100%;
}

.detail-card{
    max-width: 210mm;
    margin: auto;
    background: #fff;
}

/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

.header-icon{
    width: 70px;
    height: 70px;
    border-radius: 20px;
    background: rgba(255,255,255,.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
}

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

.profile-section{
    background: linear-gradient(135deg, #0d6efd, #0dcaf0);
    padding: 60px 30px;
    overflow: hidden;
}

.profile-overlay{
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,.05);
}

.profile-avatar{
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: rgba(255,255,255,.2);
    border: 4px solid rgba(255,255,255,.4);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    font-weight: bold;
    backdrop-filter: blur(5px);
}

/*
|--------------------------------------------------------------------------
| DETAIL BOX
|--------------------------------------------------------------------------
*/

.detail-box{
    background: #f8fafc;
    border: 1px solid #edf2f7;
    border-radius: 20px;
    padding: 22px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    transition: .3s ease;
    height: 100%;
}

.detail-box:hover{
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,.06);
}

.detail-icon{
    width: 55px;
    height: 55px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.detail-label{
    font-size: 12px;
    font-weight: 700;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.detail-value{
    margin-top: 6px;
    margin-bottom: 0;
    font-weight: 700;
    color: #212529;
}

/*
|--------------------------------------------------------------------------
| ALAMAT
|--------------------------------------------------------------------------
*/

.alamat-wrapper{
    background: #f8fafc;
    border: 1px solid #edf2f7;
    border-radius: 20px;
    padding: 24px;
}

.alamat-box{
    line-height: 1.9;
    color: #212529;
    min-height: 110px;
}

/*
|--------------------------------------------------------------------------
| PRINT HEADER
|--------------------------------------------------------------------------
*/

.print-header{
    display: none;
}

/*
|--------------------------------------------------------------------------
| PRINT STYLE
|--------------------------------------------------------------------------
*/

@media print {

    @page{
        size: A4 portrait;
        margin: 10mm;
    }

    html,
    body{
        width: 210mm;
        min-height: 297mm;
        background: #fff !important;
    }

    body{
        margin: 0 !important;
        padding: 0 !important;
    }

    /*
    |--------------------------------------------------------------------------
    | HIDE WEBSITE UI
    |--------------------------------------------------------------------------
    */

    .sidebar,
    .navbar,
    footer,
    .btn,
    .table,
    table,
    .dataTables_wrapper,
    .pagination,
    .no-print{
        display: none !important;
    }

    /*
    |--------------------------------------------------------------------------
    | RESET LAYOUT
    |--------------------------------------------------------------------------
    */

    .container-fluid{
        width: 100% !important;
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .print-area{
        width: 100% !important;
        margin: 0 auto !important;
        padding: 0 !important;
    }

    .detail-card{
        width: 190mm !important;
        min-height: 277mm !important;
        margin: 0 auto !important;
        border: none !important;
        box-shadow: none !important;
    }

    .card,
    .card-body{
        box-shadow: none !important;
        border: none !important;
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW PRINT HEADER
    |--------------------------------------------------------------------------
    */

    .print-header{
        display: block !important;
    }

    /*
    |--------------------------------------------------------------------------
    | COLOR FIX
    |--------------------------------------------------------------------------
    */

    .profile-section,
    .detail-box,
    .alamat-wrapper,
    .badge{
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    /*
    |--------------------------------------------------------------------------
    | GRID FIX
    |--------------------------------------------------------------------------
    */

    .row{
        display: flex !important;
        flex-wrap: wrap !important;
    }

    .col-md-6{
        width: 50% !important;
    }

    .col-12{
        width: 100% !important;
    }

    /*
    |--------------------------------------------------------------------------
    | PREVENT BREAK
    |--------------------------------------------------------------------------
    */

    .detail-box,
    .alamat-wrapper,
    .signature-section{
        break-inside: avoid;
        page-break-inside: avoid;
    }

}

</style>

@endsection