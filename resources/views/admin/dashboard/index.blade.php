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
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
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
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
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
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
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
                    More info <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title fw-semibold">
                        <i class="fas fa-bullhorn me-2"></i>
                        Pengumuman
                    </h3>
                </div>

                <div class="card-body">
                    <div class="announcement-label mb-3">
                        <span class="badge text-bg-success">
                            Pengumuman Terakhir
                        </span>
                    </div>

                    @forelse ($pengumumans as $item)
                        <div class="announcement-item d-flex gap-3 mb-3">
                            <div class="announcement-icon">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between flex-wrap mb-1">
                                    <strong class="text-primary">
                                        {{ $item->user->name ?? '-' }}
                                    </strong>

                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $item->created_at }}
                                    </small>
                                </div>

                                <h6 class="fw-bold mb-2">
                                    {{ $item->judul }}
                                </h6>

                                <div class="announcement-content">
                                    {!! $item->isi !!}
                                </div>
                            </div>
                        </div>

                        @if (!$loop->last)
                            <hr>
                        @endif
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada pengumuman.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header text-bg-info">
                    <h3 class="card-title fw-semibold">
                        <i class="fas fa-school me-2"></i>
                        Informasi Sekolah
                    </h3>
                </div>

                <div class="card-body">
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

    .card {
        border-radius: 8px;
        overflow: hidden;
        border: none;
    }

    .card-header {
        padding: 12px 16px;
        border-bottom: none;
    }

    .card-title {
        font-size: 17px;
        margin-bottom: 0;
    }

    .card-body {
        background: #fff;
    }

    .small-box {
        border-radius: 8px;
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

    .announcement-label {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
    }

    .announcement-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 50%;
        background: #0d6efd;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .announcement-content {
        font-size: 14px;
        color: #495057;
        overflow-wrap: anywhere;
    }
</style>
@stop

@section('js')
<script>
    console.log('Dashboard AdminLTE 4');
</script>
@stop