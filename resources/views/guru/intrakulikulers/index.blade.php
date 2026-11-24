@extends('adminlte::page')

@section('title', 'Input Nilai Intrakulikuler')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">
        Nilai Intrakulikuler 
        @if($kelas) - Kelas {{$kelas->rombel}} @endif
    </h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Intrakulikuler</li>
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
    @if($kelas)
    <form action="{{ route('intrakulikuler.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit mr-2 me-2"></i> Form Input Nilai Intrakulikuler Kelas {{$kelas->rombel}}
                </h5>
                <div class="ms-auto">
                    @if(isset($sudahAdaNilai) && $sudahAdaNilai)
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
                                <th colspan="{{ max(1, $mapels->count()) }}" class="align-middle">Mata Pelajaran</th>
                            </tr>
                            <tr>
                                @foreach($mapels as $mp)
                                    <th class="text-center align-middle" style="min-width: 100px;">
                                        <span data-bs-toggle="tooltip" title="{{ $mp->mapel }}" style="cursor: pointer; display: inline-block; width: 100%; padding: 4px 0;">
                                            {{ $mp->mapel }}
                                        </span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anggotaKelas as $index => $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-start fw-bold">
                                        {{ $item->siswa->nama_siswa ?? $item->siswa->nama ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle fw-bold">
                                        {{$item->kelas->rombel ?? $kelas->rombel}}
                                    </td>

                                    @foreach($mapels as $mp)
                                        @php
                                            $nilaiExisting = $item->intrakulikuler?->firstWhere('mapel_id', $mp->id)?->nilai;
                                            $selectedValue = old('nilai.' . $item->id . '.' . $mp->id, $nilaiExisting);
                                        @endphp
                                        <td class="align-middle p-2">
                                            <input type="number" 
                                                name="nilai[{{ $item->id }}][{{ $mp->id }}]" 
                                                value="{{ $selectedValue }}" 
                                                class="form-control text-center mx-auto input-nilai-intrakulikuler" 
                                                min="0" 
                                                max="100">
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 3 + max(1, $mapels->count()) }}" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-1"></i> Belum ada siswa terdaftar dalam kelas ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($anggotaKelas) > 0)
            <div class="card-footer bg-white d-flex justify-content-end py-3 px-4">
                <button type="submit" class="btn btn-primary text-white px-4">
                    <i class="fas fa-save me-1"></i> Simpan Semua Nilai
                </button>
            </div>
            @endif
        </div>
    </form>
    @else
    <div class="alert alert-warning text-center py-4">
        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
        Anda belum terdaftar sebagai Wali Kelas atau Pendamping di Tahun Ajaran Aktif.
    </div>
    @endif
</div>
@stop

@include('layouts.footer')

@section('css')
<style>
    .table tbody td { font-weight: normal !important; }
    .table thead th {
        background-color: #17a2b8 !important;
        color: #ffffff !important;
        font-weight: normal !important;
        vertical-align: middle !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
    }
    .input-nilai-intrakulikuler {
        text-align: center !important;
        max-width: 90px !important;
        margin: 0 auto !important;
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }
</style>
@stop