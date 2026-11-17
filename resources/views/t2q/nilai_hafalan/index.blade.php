@extends('adminlte::page')

@section('title', 'Nilai Hafalan')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Hafalan</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Hafalan</li>
    </ol>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fas fa-check mr-1 me-1"></i> {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header d-flex align-items-center w-100">
        <h3 class="card-title mb-0">
            <i class="fas fa-brain-alt mr-2 me-2"></i>Data Kelas Penilaian Hafalan
        </h3>
    </div>
        
    <div class="card-body p-3">
        <table id="tableNilaiHafalan" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Kelas</th>
                    <th>Status Penilaian</th>
                    <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelases as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>Kelas {{ preg_replace('/[^0-9]/', '', $k->rombel ?? $k->nama_kelas) }}</td>
                        <td>
                            @if($k->status_penilaian == 'Sudah Dinilai')
                                <span class="badge bg-success text-white px-2 py-1">Sudah Dinilai</span>
                            @else
                                <span class="badge bg-secondary text-white px-2 py-1">Belum Dinilai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <nobr>
                                <a href="{{ route('nilai_hafalan.edit', $k->id) }}" 
                                   class="btn btn-xs btn-default text-primary mx-1 shadow" 
                                   title="Input / Edit Nilai">
                                    <i class="fa fa-lg fa-fw fa-plus"></i>
                                </a>
                            </nobr>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
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

    <script>
        $(document).ready(function () {
            $('#tableNilaiHafalan').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 3 } 
                ]
            });
        });
    </script>
@stop