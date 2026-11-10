@extends('adminlte::page')

@section('title', 'Nilai Amalan Ibadah')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Amalan Ibadah</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Amalan Ibadah</li>
    </ol>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fas fa-check mr-1 me-1"></i> {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fas fa-list mr-2 me-2"></i>Daftar Tingkat Kelas Nilai Amalan Ibadah
        </h3>
    </div>
    
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle text-sm w-100">
                <thead>
                    <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th>Tingkat Kelas</th>
                        <th>Status Penilaian</th>
                        <th style="width: 10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataTingkat as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>Tingkat {{ $item->tingkat }}</td>
                            <td>
                                @if($item->status_penilaian == 'Sudah Dinilai')
                                    <span class="badge bg-success">Sudah Dinilai</span>
                                @else
                                    <span class="badge bg-danger">Belum Dinilai</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('amalan-ibadah.edit', $item->tingkat) }}" class="btn btn-primary btn-sm rounded-3" title="Kelola Penilaian">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data tingkat kelas untuk kelompok T2Q Anda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@include('layouts.footer')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
@stop