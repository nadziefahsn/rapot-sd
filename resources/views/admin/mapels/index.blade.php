@extends('adminlte::page')

@section('title', 'Mata Pelajaran')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0">Mata Pelajaran</h1>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Mata Pelajaran</li>
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
            <i class="fas fa-book mr-2 me-2"></i>Data Mata Pelajaran
        </h3>

        <div class="card-tools ms-auto ml-auto">
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahMapel">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-3">
        <table id="tableMapel" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Kategori</th>
                    <th>Mata Pelajaran</th>
                    <th>Ringkas</th>
                    <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mapels as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->mapel }}</td>
                        <td>{{ $item->ringkas ?? '-' }}</td>
                        <td class="text-center">
                            <nobr>
                                <button type="button" 
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" 
                                        title="Edit"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>

                                <form action="{{ route('mapel.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data mata pelajaran ini?')">
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

@include('admin.mapels.create')
@include('admin.mapels.edit')

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
            $('#tableMapel').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 4 }
                ]
            });

            @if ($errors->any())
                @if(session('edit_id'))
                    $('#editModal{{ session('edit_id') }}').modal('show');
                @else
                    $('#modalTambahMapel').modal('show');
                @endif
            @endif
        });
    </script>
@stop