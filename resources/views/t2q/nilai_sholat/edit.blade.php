@extends('adminlte::page')

@section('title', 'Nilai Sholat')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Sholat - Kelas {{ preg_replace('/[^0-9]/', '', $kelas->rombel) }}</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('nilai_sholat.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Sholat</li>
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
    <form action="{{ route('nilai_sholat.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list-ol mr-2 me-2"></i> Form Input Nilai Sholat Kelas {{ preg_replace('/[^0-9]/', '', $kelas->rombel) }}
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
                                <th colspan="{{ $mapels->count() }}" class="align-middle">Kompetensi Dasar / Indikator Nilai Sholat</th>
                            </tr>
                            <tr>
                                @foreach($mapels as $mp)
                                    <th class="text-center align-middle" style="min-width: 100px;">
                                        <span data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ $mp->mapel }}"
                                            style="cursor: pointer; display: inline-block; width: 100%; padding: 4px 0;">
                                            {{ $mp->ringkas }}
                                        </span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $index => $s)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-start fw-bold">
                                        {{ $s->siswa->nama_siswa ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle fw-bold">
                                        {{ $s->kelas->rombel ?? $kelas->rombel }}
                                    </td>

                                    @foreach($mapels as $mp)
                                        @php
                                            $nilaiExisting = $s->nilaiSholat->firstWhere('mapel_id', $mp->id)?->nilai;
                                            $selectedValue = old('nilai.' . $s->id . '.' . $mp->id, $nilaiExisting);
                                        @endphp
                                        <td class="align-middle p-2">
                                            <input type="number" 
                                                name="nilai[{{ $s->id }}][{{ $mp->id }}]" 
                                                value="{{ $selectedValue }}" 
                                                class="form-control text-center mx-auto input-nilai-sholat" 
                                                min="0" 
                                                max="100">
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 3 + max(1, $mapels->count()) }}" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-1"></i> Belum ada siswa yang terdaftar dalam kelompok T2Q ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($siswas) > 0)
            <div class="card-footer bg-white d-flex justify-content-end py-3 px-4">
                <button type="submit" class="btn btn-primary text-white px-4">
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

    .input-nilai-sholat {
        text-align: center !important;
        max-width: 90px !important;
        margin: 0 auto !important;
        padding-left: 1.2rem !important;
        padding-right: 0.3rem !important;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@stop