@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Banner Selamat Datang / Nama Sekolah --}}
    <div class="card border-0 border-start border-4 border-success shadow-sm mb-4">
        <div class="card-body">
            <h4 class="fw-bold mb-1">{{ $sekolah->nama_sekolah ?? 'SD GIS PRIMA INSANI' }}</h4>
            <p class="text-muted mb-0">Tahun Pelajaran 2025/2026 Semester Genap</p>
        </div>
    </div>

    {{-- 4 Widget Angka Statistik --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Rombel --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>0</h3>
                    <p>Rombel</p>
                </div>
                <div class="icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Card 2: Peserta Didik --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0</h3>
                    <p>Peserta Didik</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Card 3: Guru dan Tendik --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>0</h3>
                    <p>Guru dan Tendik</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- Card 4: Ruang Kelas --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>0</h3>
                    <p>Ruang Kelas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-school"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Section Bawah: Placeholder Pengumuman & Informasi Sekolah --}}
    <div class="row">
        
        {{-- Kolom Kiri: Pengumuman (Tempat Kosong) --}}
        <div class="col-lg-7">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bullhorn mr-1"></i> Pengumuman
                    </h3>
                </div>
                <div class="card-body text-center text-muted py-5" style="min-height: 200px;">
                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                    <span>Belum ada pengumuman terbaru</span>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Informasi Sekolah Dinamis --}}
        <div class="col-lg-5">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-building mr-1"></i> Informasi Sekolah
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <tr>
                            <td class="font-weight-bold" style="width: 140px;">NPSN</td>
                            <td>: {{ $sekolah->npsn ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Sekolah</td>
                            <td>: {{ $sekolah->nama_sekolah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Alamat</td>
                            <td>: {{ $sekolah->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Telepon</td>
                            <td>: {{ $sekolah->telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Kecamatan</td>
                            <td>: {{ $sekolah->kecamatan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@stop