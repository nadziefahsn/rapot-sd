@extends('adminlte::page')

@section('title', 'Tahun Pelajaran')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Tahun Pelajaran</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Tahun Pelajaran</li>
    </ol>
</div>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fas fa-check mr-1 me-1"></i> {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header d-flex align-items-center w-100">
        <h3 class="card-title mb-0">
            <i class="fas fa-calendar-alt mr-2 me-2"></i>Data Tahun Pelajaran
        </h3>
        <div class="card-tools ms-auto ml-auto">
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-3">
        <table id="tableTahunAjaran" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Tahun Pelajaran</th>
                    <th>Semester</th>
                    <th>Kepala Sekolah</th>
                    <th>NUPTK</th>
                    <th>Titimangsa</th>
                    <th style="width: 10%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tahun_ajarans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tahun_ajaran }}</td>
                        <td>{{ $item->semester == 'Ganjil' ? 'Semester Ganjil' : 'Semester Genap' }}</td>
                        <td>{{ $item->kepala_sekolah }}</td>
                        <td>{{ $item->nuptk }}</td>
                        <td>{{ $item->titimangsa ? \Carbon\Carbon::parse($item->titimangsa)->format('d-M-Y') : '-' }}</td>
                        <td class="text-center">
                            <nobr>
                                <button type="button" 
                                        class="btn btn-xs btn-default text-primary mx-1 shadow"
                                        title="Edit" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                                <form action="{{ route('tahun_ajaran.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus tahun pelajaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </nobr>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('admin.tahun.create')
@include('admin.tahun.edit')

@stop

@include('layouts.footer')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .table tbody td { font-weight: normal !important; }
        .table thead th { font-weight: 600 !important; }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tableTahunAjaran').DataTable({
                "order": [[0, 'asc']],
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 6 }
                ]
            });
        });
    </script>
@stop