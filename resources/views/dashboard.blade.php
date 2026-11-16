@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <!-- Banner Sekolah -->
    <div class="card card-outline card-success mb-4">
        <div class="card-body">
            <h3 class="font-weight-bold">SD GIS PRIMA INSANI</h3>
            <p class="text-muted mb-0">Tahun Pelajaran 2025/2026 Semester Genap</p>
        </div>
    </div>

   <!-- Card Info / Stat Box -->
<div class="row">
    <!-- Rombel -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalRombel }}</h3>
                <p>Rombel</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Peserta Didik -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalSiswa }}</h3>
                <p>Peserta Didik</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-friends"></i>
            </div>
            <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Guru dan Tendik -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning text-white">
            <div class="inner">
                <h3>{{ $totalGuru }}</h3>
                <p>Guru dan Tendik</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Ruang Kelas -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalRuang }}</h3>
                <p>Ruang Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-th-large"></i>
            </div>
            <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Informasi Sekolah Card -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-building mr-2"></i>Informasi Sekolah</h3>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <td width="200"><strong>NPSN</strong></td>
                <td>: {{ $sekolah->npsn ?? '69956855' }}</td>
            </tr>
            <tr>
                <td><strong>Sekolah</strong></td>
                <td>: {{ $sekolah->nama_sekolah ?? 'SD GIS PRIMA INSANI' }}</td>
            </tr>
            <tr>
                <td><strong>Kepala Sekolah</strong></td>
                <td>: {{ $sekolah->kepala_sekolah ?? 'PUJI FAUZIAH, S.Pd.SD.' }}</td>
            </tr>
        </table>
    </div>
</div>