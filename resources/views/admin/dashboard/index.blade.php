@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Dashboard</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
        </ol>
    </div>
@stop

@section('content')

    {{-- Card Header Sekolah --}}
    <div class="card shadow-sm sekolah-card mb-3">
        <div class="card-body py-3">
            <h4 class="nama-sekolah mb-1">PG-TK PRIMA INSANI</h4>
            <p class="tahun-pelajaran mb-0">
                Tahun Pelajaran {{ $tahunAjaranAktif->tahun_ajaran ?? '-' }}
                Semester {{ $tahunAjaranAktif->semester ?? '-' }}
            </p>
        </div>
    </div>

    {{-- Row Small Box (Statistik) --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-info custom-info">
                <div class="inner">
                    <h3>{{ $jumlahKelas }}</h3>
                    <p>Rombel</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <a href="{{ route('kelas.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success custom-success">
                <div class="inner">
                    <h3>{{ $jumlahSiswa }}</h3>
                    <p>Peserta Didik</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('siswa.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning custom-warning">
                <div class="inner">
                    <h3>{{ $jumlahGuru }}</h3>
                    <p>Guru dan Tendik</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <a href="{{ route('guru.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger custom-danger">
                <div class="inner">
                    <h3>{{ $jumlahKelas }}</h3>
                    <p>Ruang Kelas</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('kelas.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Row Pengumuman & Informasi Sekolah --}}
    <div class="row">
        {{-- Kolom Kiri: Pengumuman --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header custom-bg-success text-white">
                    <h3 class="card-title">
                        <i class="fas fa-bullhorn me-2"></i>
                        Pengumuman
                    </h3>
                </div>

                <div class="card-body">
                    <div class="lte3-timeline">
                        {{-- Time Label --}}
                        <div class="lte3-time-label">
                            <span class="custom-bg-success text-white">
                                Pengumuman Terakhir
                            </span>
                        </div>

                        @forelse ($pengumumans as $item)
                            <div class="lte3-timeline-entry">
                                <i class="fas fa-envelope lte3-timeline-icon bg-primary text-white"></i>
                                <div class="lte3-timeline-item">
                                    <span class="lte3-time text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $item->created_at }}
                                    </span>
                                    <h3 class="lte3-timeline-header">
                                        <a href="#" class="fw-bold text-primary text-decoration-none">
                                            {{ $item->user->name ?? '-' }}
                                        </a>
                                        <span class="text-secondary ms-1">{{ $item->judul }}</span>
                                    </h3>
                                    <div class="lte3-timeline-body">
                                        {!! $item->isi !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="lte3-timeline-entry">
                                <i class="fas fa-info lte3-timeline-icon bg-secondary text-white"></i>
                                <div class="lte3-timeline-item">
                                    <div class="lte3-timeline-body text-muted text-center">
                                        Belum ada pengumuman.
                                    </div>
                                </div>
                            </div>
                        @endforelse

                        {{-- Ikon Jam Penutup Timeline --}}
                        <div class="lte3-timeline-entry mb-0">
                            <i class="fas fa-clock lte3-timeline-icon bg-secondary text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Informasi Sekolah --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header custom-bg-info text-white">
                    <h3 class="card-title">
                        <i class="fas fa-school me-2"></i>
                        Informasi Sekolah
                    </h3>
                </div>

                <div class="card-body school-info">
                    <div class="row mb-2">
                        <div class="col-3">Nama Sekolah</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->nama_sekolah }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">NPSN</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->npsn }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">Alamat</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->alamat }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">Kode Pos</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->kode }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">Telepon</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->telepon }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">Kecamatan</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->kecamatan }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-3">Kabupaten</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->kabupaten }}</div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-3">Provinsi</div>
                        <div class="col-auto">:</div>
                        <div class="col">{{ $sekolah->provinsi }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@include('layouts.footer')

@section('css')
<style>
    .card {
        border: 0;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.15), 0 3px 8px rgba(0, 0, 0, 0.15) !important;
    }

    .sekolah-card {
        border-left: 5px solid #198754 !important;
        border-radius: 6px;
    }

    .nama-sekolah {
        font-size: 24px;
        font-weight: 700;
        color: #343a40;
        line-height: 1.2;
    }

    .tahun-pelajaran {
        font-size: 16px;
        font-weight: 400;
        color: #6c757d;
        line-height: 1.4;
    }

    .card {
        border: 0;
        border-radius: 6px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 0;
        padding: .75rem 1.25rem;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 400;
        margin-bottom: 0;
    }

    .card-body {
        background: #fff;
    }

    .custom-bg-info {
        background-color: #17a2b8 !important;
    }

    .custom-bg-success {
        background-color: #28a745 !important;
    }

    .small-box.custom-info {
        background-color: #17a2b8 !important;
        color: #fff !important;
    }

    .small-box.custom-success {
        background-color: #28a745 !important;
        color: #fff !important;
    }

    .small-box.custom-warning {
        background-color: #ffc107 !important;
        color: #1f2d3d !important;
    }

    .small-box.custom-warning .small-box-footer {
        color: rgba(31, 45, 61, 0.8) !important;
    }

    .small-box.custom-danger {
        background-color: #dc3545 !important;
        color: #fff !important;
    }

    .small-box {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.15), 0 3px 8px rgba(0, 0, 0, 0.15) !important;
    }

    .small-box .inner h3 {
        font-size: 2.2rem;
        font-weight: 700;
    }

    .small-box .small-box-icon {
        font-size: 70px;
        top: 10px;
        right: 15px;
        color: rgba(0, 0, 0, 0.15);
    }

    .lte3-timeline {
        position: relative;
        margin: 0 0 15px 0;
        padding: 0;
    }

    .lte3-timeline::before {
        content: '';
        position: absolute;
        top: 15px;
        bottom: 15px;
        width: 4px;
        background: #dee2e6;
        left: 31px;
        margin: 0;
        border-radius: 2px;
        z-index: 1;
    }

    .lte3-time-label {
        position: relative;
        z-index: 2;
        margin-bottom: 15px;
    }

    .lte3-time-label > span {
        font-weight: 600;
        padding: 5px 10px;
        display: inline-block;
        border-radius: 4px;
        font-size: 14px;
    }

    .lte3-timeline-entry {
        position: relative;
        margin-bottom: 15px;
        min-height: 30px;
    }

    .lte3-timeline-icon {
        width: 30px;
        height: 30px;
        font-size: 14px;
        line-height: 30px;
        position: absolute;
        border-radius: 50%;
        text-align: center;
        left: 18px;
        top: 0;
        z-index: 2;
    }

    .lte3-timeline-item {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        border-radius: .25rem;
        background-color: #fff;
        color: #495057;
        margin-left: 60px;
        margin-right: 10px;
        padding: 0;
        position: relative;
        z-index: 2;
        border: 1px solid rgba(0,0,0,.08);
    }

    .lte3-time {
        float: right;
        padding: 10px;
        font-size: 12px;
    }

    .lte3-timeline-header {
        margin: 0;
        color: #495057;
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: 10px;
        font-size: 16px;
        line-height: 1.1;
    }

    .lte3-timeline-body {
        padding: 10px;
        font-size: 14px;
        overflow-wrap: anywhere;
    }

    .school-info {
        font-size: 15px;
    }

    @media (max-width: 576px) {
        .school-info .col-3 {
            width: 35%;
            flex: 0 0 35%;
        }
    }
</style>
@stop

@section('js')
<script>
    console.log('Dashboard AdminLTE 4');
</script>
@stop