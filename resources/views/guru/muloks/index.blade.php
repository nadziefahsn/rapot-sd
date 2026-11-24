@extends('adminlte::page')

@section('title', 'Nilai Mulok Khas PI')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Mulok Khas PI</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai Mulok Khas PI</li>
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
    <div class="card-header d-flex align-items-center w-100 bg-white">
        <h3 class="card-title mb-0 font-weight-normal">
            <i class="fas fa-list-ol mr-2 me-2"></i>Nilai Mulok Khas PI
        </h3>
    </div>
        
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="tableMulok" class="table table-bordered table-hover text-sm w-100">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center" style="width: 8%">No</th>
                        <th rowspan="2" class="align-middle text-center" style="width: 35%">Mata Pelajaran</th>
                        <th rowspan="2" class="align-middle text-center" style="width: 15%">Kelas</th>
                        <th colspan="2" class="align-middle text-center">Jumlah</th>
                        <th rowspan="2" class="align-middle text-center" style="width: 15%">Input Nilai</th>
                    </tr>
                    <tr>
                        <th class="align-middle text-center" style="width: 11%">Rencana<br>Penilaian</th>
                        <th class="align-middle text-center" style="width: 11%">Telah<br>Dinilai</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($mapels as $index => $m)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $m->nama ?? $m->nama_mapel ?? $m->mapel ?? '-' }}</td>
                        <td class="text-center align-middle">{{ $kelas->rombel ?? '-' }}</td>
                        <td class="text-center align-middle font-weight-bold text-blue-custom">
                            {{ $m->rencana_penilaian }}
                        </td>
                        <td class="text-center align-middle font-weight-bold text-blue-custom">
                            {{ $m->telah_dinilai }}
                        </td>
                        <td class="text-center align-middle">
                            <a href="{{ route('mulok.edit', $m->id) }}" 
                            class="btn btn-sm btn-primary shadow-sm" 
                            title="Input / Edit Nilai">
                                <i class="fas fa-plus"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@include('layouts.footer')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .text-blue-custom {
            color: #17a2b8 !important;
        }

        #tableMulok thead th {
            background-color: #17a2b8 !important;
            color: #ffffff !important;
            border-color: #138496 !important;
            vertical-align: middle !important;
            text-align: center !important;
            font-weight: normal !important;
        }

        #tableMulok thead th.sorting, 
        #tableMulok thead th.sorting_asc, 
        #tableMulok thead th.sorting_desc {
            text-align: center !important;
            padding-right: 10px !important;
        }

        #tableMulok thead th.sorting::after, 
        #tableMulok thead th.sorting_asc::after, 
        #tableMulok thead th.sorting_desc::after {
            right: 5px !important;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tableMulok').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "language": {
                    "emptyTable": "Belum ada data mata pelajaran atau kelas tidak ditemukan."
                },
                "columnDefs": [
                    { "orderable": false, "targets": 5 } 
                ]
            });
        });
    </script>
@stop