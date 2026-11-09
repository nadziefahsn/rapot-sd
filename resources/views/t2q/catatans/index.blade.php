@extends('adminlte::page')

@section('title', 'Catatan T2Q Siswa')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Input Catatan T2Q Siswa</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Catatan T2Q</li>
    </ol>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fas fa-check mr-1"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="icon fas fa-ban mr-1"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container-fluid">
    <form action="{{ route('guru_t2q.catatan.store') }}" method="POST">
        @csrf

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="card-title mb-0 font-weight-bold text-dark">
                    <i class="fas fa-journal-whills text-success mr-2"></i> Form Catatan Perkembangan T2Q
                </h5>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="text-white text-center align-middle">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 30%;">Nama Siswa</th>
                                <th style="width: 8%;">Kelas</th>
                                <th style="width: 65%;">Catatan Perkembangan / Hafalan</th>
                            </tr>
                        </thead>       
                        <tbody>
                            @forelse ($catatans as $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle font-weight-bold">
                                        {{ $item->siswa->nama_siswa ?? $item->anggotaKelas->siswa->nama_siswa ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle font-weight-bold">
                                        {{ $item->kelas->rombel ?? $item->kelas->rombel ?? '-' }}
                                    </td>
                                    <td>
                                        <textarea name="catatan[{{ $item->id }}]" class="form-control" rows="3" 
                                            placeholder="Tuliskan perkembangan hafalan/bacaan T2Q siswa di sini..."
                                        >{{ old('catatan.' . $item->id, $item->catatanT2q->catatan ?? $item->catatan ?? '') }}</textarea>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle mr-1"></i> Belum ada siswa yang terdaftar dalam kelompok T2Q kamu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($catatans) > 0)
            <div class="card-footer bg-white d-flex justify-content-end py-3 px-4">
                <button type="submit" class="btn btn-primary text-white px-4">
                    <i class="fas fa-save mr-1"></i> Simpan Catatan
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
    }
</style>
@stop

@section('js')
@stop