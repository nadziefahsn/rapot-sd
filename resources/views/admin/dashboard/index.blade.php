
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Dashboard</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
@stop

@section('content')

    <div class="card sekolah-card shadow-sm mb-4">
        <div class="card-body py-3">
            <h4 class="fw-bold mb-1">PG-TK PRIMA INSANI</h4>
            <p class="tahun-pelajaran mb-0">
                Tahun Pelajaran {{ $tahunAjaranAktif->tahun_ajaran ?? '-' }}
                Semester {{ $tahunAjaranAktif->semester ?? '-' }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-info shadow-sm">
                <div class="inner">
                    <h3>{{ $jumlahKelas }}</h3>
                    <p>Rombel</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <a href="{{ route('kelas.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success shadow-sm">
                <div class="inner">
                    <h3>{{ $jumlahSiswa }}</h3>
                    <p>Peserta Didik</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('siswa.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning shadow-sm">
                <div class="inner">
                    <h3>{{ $jumlahGuru }}</h3>
                    <p>Guru dan Tendik</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <a href="{{ route('guru.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger shadow-sm">
                <div class="inner">
                    <h3>{{ $jumlahKelas }}</h3>
                    <p>Ruang Kelas</p>
                </div>
                <div class="small-box-icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('kelas.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title fw-bold">
                        <i class="fas fa-bullhorn mr-2"></i>
                        Pengumuman
                    </h3>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge badge-success p-2" style="font-size: 15px;">
                            Pengumuman Terakhir
                        </span>
                    </div>

                    <div class="announcement-timeline">
                        @forelse ($pengumumans as $item)
                            <div class="timeline-item-custom">
                                <div class="timeline-icon-custom">
                                    <i class="fas fa-info"></i>
                                </div>

                                <div class="timeline-content-custom">
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <strong class="text-primary">
                                            {{ $item->user->name ?? '-' }}
                                        </strong>

                                        <small class="text-muted">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $item->created_at }}
                                        </small>
                                    </div>

                                    <h6 class="font-weight-bold">
                                        {{ $item->judul }}
                                    </h6>

                                    <div class="announcement-content">
                                        {!! $item->isi !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="timeline-item-custom">
                                <div class="timeline-icon-custom">
                                    <i class="fas fa-info"></i>
                                </div>

                                <div class="timeline-content-custom text-center text-muted">
                                    Belum ada pengumuman.
                                </div>
                            </div>
                        @endforelse

                        <div class="timeline-icon-custom timeline-clock">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header text-white header-info">
                    <h3 class="card-title fw-bold">
                        <i class="fas fa-school mr-2"></i>
                        Informasi Sekolah
                    </h3>
                </div>

                <div class="card-body school-info">
                    <div class="row mb-3">
                        <div class="col-4">Nama Sekolah</div>
                        <div class="col-1">:</div>
                        <div class="col">{{ $sekolah->nama_sekolah }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">NPSN</div>
                        <div class="col-1">:</div>
                        <div class="col">{{ $sekolah->npsn }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">Alamat</div>
                        <div class="col-1">:</div>
                        <div class="col">{{ $sekolah->alamat }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">Kode Pos</div>
                        <div class="col-1">:</div>
                        <div class="col">{{ $sekolah->kode }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">Telepon</div>
                        <div class="col-1">:</div>
                        <div class="col">{{ $sekolah->telepon }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">Kecamatan</div>
                        <div class="col-1">:</div>
                        <div class="col">{{ $sekolah->kecamatan }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">Kabupaten</div>
                        <div class="col-1">:</div>
                        <div class="col">{{ $sekolah->kabupaten }}</div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-4">Provinsi</div>
                        <div class="col-1">:</div>
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
    .sekolah-card {
        border-left: 4px solid #28a745;
        border-radius: 6px;
    }

    .sekolah-card h4 {
        font-size: 22px;
        font-weight: 700;
        color: #343a40;
    }

    .tahun-pelajaran {
        font-size: 15px;
        color: #6c757d;
    }

    .small-box {
        border-radius: 6px;
        overflow: hidden;
    }

    .small-box .inner h3 {
        font-size: 30px;
        font-weight: 700;
    }

    .small-box .small-box-icon {
        font-size: 65px;
        opacity: .2;
    }

    .card {
        border: none;
        border-radius: 6px;
        overflow: hidden;
    }

    .card-header {
        padding: 14px 18px;
        border-bottom: none;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0;
    }

    .header-info {
        background-color: #17324D;
    }

    .announcement-timeline {
        position: relative;
        padding-left: 56px;
        min-height: 180px;
    }

    .announcement-timeline::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 21px;
        bottom: 21px;
        width: 5px;
        background: #dee2e6;
    }

    .timeline-item-custom {
        position: relative;
        margin-bottom: 20px;
        min-height: 45px;
    }

    .timeline-icon-custom {
        position: absolute;
        left: -56px;
        top: 0;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #6c757d;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        z-index: 2;
    }

    .timeline-content-custom {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 7px;
        padding: 16px;
        box-shadow: 0 2px 5px rgba(0,0,0,.12);
        min-height: 62px;
    }

    .timeline-clock {
        position: absolute;
        left: 0;
        top: auto;
        bottom: 0;
    }

    .school-info {
        padding: 25px;
        font-size: 16px;
    }

    .school-info .row {
        align-items: start;
    }

    .school-info .col-1 {
        text-align: center;
    }

    .announcement-content {
        font-size: 14px;
        color: #495057;
        overflow-wrap: anywhere;
    }

    @media (max-width: 576px) {
        .school-info {
            padding: 15px;
            font-size: 13px;
        }

        .school-info .col-4 {
            width: 35%;
            flex: 0 0 35%;
        }

        .school-info .col-1 {
            width: 8%;
            flex: 0 0 8%;
        }

        .school-info .col {
            min-width: 0;
        }
    }
</style>
@stop

@section('js')
<script>
    console.log('Dashboard AdminLTE 4');
</script>
@stop
