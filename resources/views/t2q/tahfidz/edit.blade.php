@extends('adminlte::page')

@section('title', 'Edit Nilai Tahfidz')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Tahfidz - Tingkat {{ $tingkat }}</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('nilai-tahfidz.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai tahfidz</li>
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
    <form action="{{ route('nilai-tahfidz.update', $tingkat) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-book-reader mr-2 me-2"></i> Form Input Nilai Tahfidz Tingkat {{ $tingkat }}
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
                        <thead class="bg-primary text-white text-center align-middle">
                            <tr>
                                <th rowspan="2" class="align-middle" style="width: 5%;">No</th>
                                <th rowspan="2" class="align-middle" style="width: 20%;">Nama Siswa</th>
                                <th rowspan="2" class="align-middle" style="width: 8%;">Kelas</th>
                                <th colspan="4" class="text-center">Tahfidz</th>
                            </tr>
                            <tr>
                                <th style="width: 15%;">Surah</th>
                                <th style="width: 15%;">Kekurangan</th>
                                <th style="width: 15%;">Kelebihan</th>
                                <th style="width: 10%;">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $listSurah = $listSurah ?? [
                                    'al-Insiqaq', 'al-Buruj', 'at-Tariq', 'al-A\'la',
                                    'al-Ghashiyah', 'al-Fajr', 'al-Balad', 'as-Syams', 'al-Lail'
                                ];
                                $listCatatan = $listCatatan ?? [
                                    'makhroj', 'mad', 'dengung', 'qolqolah', 'kelancaran', 'tanafus (terputus)'
                                ];
                            @endphp

                            @forelse($siswas as $index => $s)
                                @php
                                    $tahfidz = $s->tahfidz->first();
                                    $surahVal = old('nilai.'.$s->id.'.surah', is_array($tahfidz?->surah) ? $tahfidz->surah : (json_decode($tahfidz?->surah ?? '[]', true)));
                                    $kekuranganVal = old('nilai.'.$s->id.'.kekurangan', is_array($tahfidz?->kekurangan) ? $tahfidz->kekurangan : (json_decode($tahfidz?->kekurangan ?? '[]', true)));
                                    $kelebihanVal = old('nilai.'.$s->id.'.kelebihan', is_array($tahfidz?->kelebihan) ? $tahfidz->kelebihan : (json_decode($tahfidz?->kelebihan ?? '[]', true)));
                                    $nilaiVal = old('nilai.'.$s->id.'.nilai', $tahfidz?->nilai);
                                @endphp
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-start ps-3 fw-bold">
                                        {{ $s->siswa->nama_lengkap ?? $s->siswa->nama ?? $s->siswa->nama_siswa ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle fw-bold">
                                        {{ $s->kelas->rombel ?? '-' }}
                                    </td>

                                    <td class="align-middle p-2 text-start">
                                        <select name="nilai[{{ $s->id }}][surah][]" class="select2-tahfidz" multiple="multiple">
                                            @foreach($listSurah as $item)
                                                <option value="{{ $item }}" {{ in_array($item, $surahVal ?? []) ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="align-middle p-2 text-start">
                                        <select name="nilai[{{ $s->id }}][kekurangan][]" class="select2-tahfidz" multiple="multiple">
                                            @foreach($listCatatan as $item)
                                                <option value="{{ $item }}" {{ in_array($item, $kekuranganVal ?? []) ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="align-middle p-2 text-start">
                                        <select name="nilai[{{ $s->id }}][kelebihan][]" class="select2-tahfidz" multiple="multiple">
                                            @foreach($listCatatan as $item)
                                                <option value="{{ $item }}" {{ in_array($item, $kelebihanVal ?? []) ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="align-middle p-2">
                                        <input type="number" name="nilai[{{ $s->id }}][nilai]" value="{{ old('nilai.'.$s->id.'.nilai', $nilaiVal) }}" class="form-control form-control-sm text-center" min="0" max="100">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-1"></i> Tidak ada siswa pada tingkat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($siswas) > 0)
                <div class="card-footer bg-white d-flex justify-content-end py-3 px-4">
                    <button type="submit" class="btn btn-primary text-white px-4" style="background-color: #17a2b8; border-color: #17a2b8;">
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

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

    .input-nilai-tahfidz {
        text-align: center !important;
        max-width: 90px !important;
        margin: 0 auto !important;
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }

    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
        font-size: 0.8rem;
        padding: 2px 6px;
        margin-top: 2px;
        margin-bottom: 2px;
    }
</style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2-tahfidz').select2({
            theme: 'bootstrap-5',
            width: '100%',
            allowClear: true,
            placeholder: 'Pilih opsi...',
            closeOnSelect: false
        });

        if (typeof bootstrap !== 'undefined') {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
</script>
@stop