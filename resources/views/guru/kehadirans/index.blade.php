@extends('adminlte::page')

@section('title', 'Kehadiran')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Rekap Kehadiran</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Rekap Kehadiran Siswa</li>
    </ol>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon fas fa-check mr-1"></i> {{ session('success') }}
        </div>
    @endif

        <form action="{{ route('kehadiran.update', 1) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="guru_id" value="{{ request('guru_id') }}">

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="card-title mb-1">
                    <i class="fas fa-user-check mr-2"></i> Input Kehadiran Siswa
                </h5>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-center" style="background-color: #17a2b8;">
                                <th class="text-white" style="width: 5%; background-color: #17a2b8;">No</th>
                                <th class="text-white" style="background-color: #17a2b8;">Nama Siswa</th>
                                <th class="text-white" style="width: 12%; background-color: #17a2b8;">Sakit</th>
                                <th class="text-white" style="width: 12%; background-color: #17a2b8;">Izin</th>
                                <th class="text-white" style="width: 15%; background-color: #17a2b8;">Tanpa Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_anggota_kelas as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <input type="hidden" name="anggota_kelas_id[]" value="{{ $item->id }}">

                                <td>
                                    <input type="number" name="sakit[]" value="{{ $item->kehadiran->sakit ?? 0 }}" min="0" class="form-control text-center">
                                </td>
                                <td>
                                    <input type="number" name="izin[]" value="{{ $item->kehadiran->izin ?? 0 }}" min="0" class="form-control text-center">
                                </td>
                                <td>
                                    <input type="number" name="tanpa_keterangan[]" value="{{ $item->kehadiran->tanpa_keterangan ?? 0 }}" min="0" class="form-control text-center">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Data anggota kelas belum tersedia.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white d-flex justify-content-end text-right py-3 px-4">
                <button type="submit" class="btn btn-primary text-white px-4">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
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
        font-weight: normal !important;
    }
</style>
@stop

@section('js')
@stop