@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <!-- CSS Paksa Berjajar 4 Kolom -->
    <style>
        .kotak-statistik-wrapper {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 15px !important;
            width: 100% !important;
            margin-bottom: 20px !important;
        }
        @media (max-width: 768px) {
            .kotak-statistik-wrapper {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
    </style>

    <!-- Banner Sekolah -->
    <div class="card card-outline card-success mb-4">
        <div class="card-body">
            <h3 class="font-weight-bold">SD GIS PRIMA INSANI</h3>
            <p class="text-muted mb-0">Tahun Pelajaran 2025/2026 Semester Genap</p>
        </div>
    </div>

    <!-- 4 Kotak Statistik Ke Samping -->
    <div class="kotak-statistik-wrapper">
        
        <!-- Rombel -->
        <div class="small-box bg-info mb-0">
            <div class="inner">
                <h3>{{ $rombel ?? 17 }}</h3>
                <p>Rombel</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <a href="{{ url('/admin/sekolah') }}" class="small-box-footer">
                Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

        <!-- Peserta Didik -->
        <div class="small-box bg-success mb-0">
            <div class="inner">
                <h3>{{ $peserta_didik ?? 466 }}</h3>
                <p>Peserta Didik</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ url('/admin/sekolah') }}" class="small-box-footer">
                Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

        <!-- Guru dan Tendik -->
        <div class="small-box bg-warning mb-0">
            <div class="inner">
                <h3>{{ $guru_tendik ?? 79 }}</h3>
                <p>Guru dan Tendik</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <a href="{{ url('/admin/sekolah') }}" class="small-box-footer text-dark">
                Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

        <!-- Ruang Kelas -->
        <div class="small-box bg-danger mb-0">
            <div class="inner">
                <h3>{{ $ruang_kelas ?? 17 }}</h3>
                <p>Ruang Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <a href="{{ url('/admin/sekolah') }}" class="small-box-footer">
                Informasi selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <!-- Informasi Sekolah -->
    <div class="row mt-3">
        <div class="col-lg-6 col-12">
            <div class="card card-teal card-outline p-0">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title"><i class="fas fa-university mr-2"></i> Informasi Sekolah</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tr>
                            <th style="width: 35%;">NPSN</th>
                            <td>: {{ $npsn ?? '69956855' }}</td>
                        </tr>
                        <tr>
                            <th>Sekolah</th>
                            <td>: {{ $sekolah ?? 'SD GIS PRIMA INSANI' }}</td>
                        </tr>
                        <tr>
                            <th>Kepala Sekolah</th>
                            <td>: {{ $kepsek ?? 'PUJI FAUZIAH, S.Pd.SD.' }}</td>
                        </tr>
                        <tr>
                            <th>NRKS</th>
                            <td>: {{ $nrks ?? '19023L1040211212119042' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <span class="text-primary">{{ $email ?? 'gis@primainsani.sch.id' }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop