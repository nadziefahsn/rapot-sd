
@extends('adminlte::page')

@section('title', 'Input Nilai Mulok')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0">
        Nilai Mulok
        @if($kelas) - Kelas {{ $kelas->rombel }} @endif
    </h1>
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Mulok</li>
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
    <form action="{{ route('mulok.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-mulok shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit mr-2"></i>
                    Form Input Nilai Mulok Kelas {{ $kelas->rombel }}
                </h5>

                @if(isset($sudahAdaNilai) && $sudahAdaNilai)
                    <span class="badge bg-success text-white px-3 py-2 fw-normal badge-simpan">
                        Data Sudah Tersimpan Sebelumnya
                    </span>
                @endif
            </div>

            <div class="card-body p-4">
                <div class="table-responsive rounded-3">
                    <table class="table table-bordered table-hover align-middle mb-0 text-center tabel-mulok">
                        <thead class="text-white text-center align-middle">
                            <tr>
                                <th rowspan="2" class="align-middle" style="width: 5%;">No</th>
                                <th rowspan="2" class="align-middle text-start" style="min-width: 220px;">Nama Siswa</th>
                                <th rowspan="2" class="align-middle" style="width: 10%;">Kelas</th>
                                <th colspan="{{ max(1, $mapels->count()) }}" class="align-middle">Mulok</th>
                            </tr>
                            <tr>
                                @foreach($mapels as $mp)
                                    <th class="text-center align-middle" style="min-width: 150px;">
                                        <span data-bs-toggle="tooltip" title="{{ $mp->mapel }}">
                                            {{ $mp->mapel }}
                                        </span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($anggotaKelas as $item)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-start">
                                        {{ $item->siswa->nama_siswa ?? $item->siswa->nama ?? '-' }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $item->kelas->rombel ?? $kelas->rombel }}
                                    </td>

                                    @foreach($mapels as $mp)
                                        @php
                                            $nilaiExisting = $item->mulok?->firstWhere('mapel_id', $mp->id)?->nilai;
                                            $selectedValue = old('nilai.' . $item->id . '.' . $mp->id, $nilaiExisting);
                                        @endphp

                                        <td class="align-middle p-2">
                                            <input type="number"
                                                name="nilai[{{ $item->id }}][{{ $mp->id }}]"
                                                value="{{ $selectedValue }}"
                                                class="form-control text-center mx-auto input-nilai-mulok"
                                                min="0"
                                                max="100">
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 3 + max(1, $mapels->count()) }}" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Belum ada siswa terdaftar dalam kelas ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($anggotaKelas) > 0)
                <div class="card-footer bg-white d-flex justify-content-end py-3 px-4">
                    <button type="submit" class="btn btn-primary btn-simpan text-white px-4">
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
    .card-mulok {
        border-radius: 7px;
        overflow: hidden;
    }

    .card-mulok .card-header {
        min-height: 78px;
        border-bottom: 1px solid #dee2e6;
    }

    .card-mulok .card-title {
        font-size: 20px;
        font-weight: 400;
        color: #172b4d;
    }

    .card-mulok .card-title i {
        font-size: 20px;
    }

    .badge-simpan {
        font-size: 14px;
        font-weight: 400;
        padding: 10px 18px !important;
        border-radius: 7px;
    }

    .tabel-mulok {
        border-radius: 8px;
        overflow: hidden;
        border-color: #dee2e6;
    }

    .tabel-mulok thead th {
        background-color: #17a2b8 !important;
        color: #ffffff !important;
        font-weight: 400 !important;
        vertical-align: middle !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        padding: 13px 10px;
    }

    .tabel-mulok tbody td {
        font-weight: 400 !important;
        color: #111;
        padding: 10px;
        vertical-align: middle;
    }

    .input-nilai-mulok {
        text-align: center !important;
        max-width: 112px !important;
        height: 46px;
        margin: 0 auto !important;
        border-radius: 7px;
    }

    .btn-simpan {
        background-color: #0d6efd;
        border-color: #0d6efd;
        border-radius: 7px;
        font-size: 17px;
        padding: 10px 25px !important;
    }

    .btn-simpan:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .card-mulok .card-footer {
        border-top: 1px solid #dee2e6;
        min-height: 87px;
    }
</style>
@stop

@section('js')
<script>
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>
@stop
