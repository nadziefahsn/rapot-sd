@extends('adminlte::page')

@section('title', 'Nilai Ekstrakurikuler')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Ekstrakurikuler - {{ $eskul->nama_ekstrakulikuler }}</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('nilai-eskul.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Ekstrakurikuler</li>
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
    <form action="{{ route('nilai-eskul.update', $eskul->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-dark">
                    <i class="fas fa-list-ol me-2"></i> Form Input Nilai: {{ $eskul->nama_ekstrakulikuler }}
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
                                <th style="width: 5%;">No</th>
                                <th style="min-width: 250px;">Nama Siswa</th>
                                <th style="width: 20%;">Kelas</th>
                                <th style="width: 30%;">Predikat / Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $index => $s)
                                @php
                                    $existingNilai = $s->nilaiEkstrakulikuler;
                                    $predikatVal = old('nilai.' . $s->id, $existingNilai?->nilai);
                                @endphp
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-start fw-bold">
                                        {{ $s->anggotaKelas->siswa->nama_lengkap ?? $s->anggotaKelas->siswa->nama_siswa ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle fw-bold">
                                        {{ $s->anggotaKelas->kelas->rombel ?? '-' }}
                                    </td>
                                    <td class="align-middle p-2">
                                        <input type="text" 
                                               name="nilai[{{ $s->id }}]" 
                                               value="{{ $predikatVal }}" 
                                               class="form-control form-control-sm text-center fw-bold w-50 mx-auto" 
                                               placeholder="">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-1"></i> Belum ada siswa yang terdaftar dalam ekstrakurikuler ini.
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
                    <i class="fas fa-save me-1"></i> Simpan
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