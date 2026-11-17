@extends('adminlte::page')

@section('title', 'Nilai Amalan Ibadah')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Amalan Ibadah - Tingkat {{ $tingkat }}</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('amalan-ibadah.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Amalan Ibadah</li>
    </ol>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check me-1"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-ban me-1"></i> {{ session('error') }}
    </div>
@endif

<div class="container-fluid">
    <form action="{{ route('amalan-ibadah.update', $tingkat) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-dark">
                    <i class="fas fa-list-ol me-2"></i> Form Input Nilai Amalan Ibadah - Tingkat {{ $tingkat }}
                </h5>
                <div class="ms-auto">
                    @if($sudahAdaNilai)
                        <span class="badge bg-success text-white px-3 py-2 fw-normal" style="font-size: 0.85rem;">
                            Data Sudah Tersimpan Sebelumnya
                        </span>
                    @endif
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive rounded-3 border">
                    <table class="table table-bordered table-hover align-middle mb-0 text-center">
                        <thead class="text-white text-center align-middle">
                            <tr>
                                <th rowspan="2" class="align-middle" style="width: 5%;">No</th>
                                <th rowspan="2" class="align-middle text-start" style="min-width: 220px;">Nama Siswa</th>
                                <th rowspan="2" class="align-middle" style="width: 10%;">Kelas</th>
                                <th colspan="{{ $mapels->count() }}" class="align-middle">Kompetensi Dasar / Indikator Nilai Amalan Ibadah</th>
                            </tr>
                            <tr>
                                @foreach($mapels as $mp)
                                    <th class="text-center align-middle" style="min-width: 120px;">
                                        {{ $mp->nama_mapel ?? $mp->mapel }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $index => $s)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-start fw-bold">
                                        {{ $s->siswa->nama_lengkap ?? $s->siswa->nama_siswa ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle fw-bold">
                                        {{ $s->kelas->rombel ?? '-' }}
                                    </td>

                                    @foreach($mapels as $mp)
                                        @php
                                            $nilaiExisting = $s->amalanIbadahs->firstWhere('mapel_id', $mp->id)?->nilai;
                                            $selectedValue = old('nilai.' . $s->id . '.' . $mp->id, $nilaiExisting);
                                        @endphp
                                        <td class="align-middle p-2">
                                            <select name="nilai[{{ $s->id }}][{{ $mp->id }}]" class="form-control form-control-sm text-center mx-auto">
                                                <option value=""></option>
                                                <option value="BSH" {{ $selectedValue == 'BSH' ? 'selected' : '' }}>BSH</option>
                                                <option value="SAB" {{ $selectedValue == 'SAB' ? 'selected' : '' }}>SAB</option>
                                                <option value="MB" {{ $selectedValue == 'MB' ? 'selected' : '' }}>MB</option>
                                                <option value="SB" {{ $selectedValue == 'SB' ? 'selected' : '' }}>SB</option>
                                            </select>
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 3 + max(1, $mapels->count()) }}" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-1"></i> Belum ada siswa yang terdaftar dalam tingkat kelas ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($siswas) > 0)
            <div class="card-footer bg-white d-flex justify-content-end py-3 px-4">
                <button type="submit" class="btn btn-info text-white px-4">
                    <i class="fas fa-save me-1"></i> Simpan Nilai
                </button>
            </div>
            @endif
        </div>
    </form>
</div>
@stop

@include('layouts.footer')

@section('css')
<style>
    .table tbody td {
        font-weight: normal !important;
    }
    
    .table thead th {
        background-color: #17a2b8 !important;
        color: #ffffff !important;
        font-weight: normal !important;
        vertical-align: middle !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
    }
</style>
@stop