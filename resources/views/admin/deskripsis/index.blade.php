@extends('adminlte::page')

@section('title', 'Deskripsi Mata Pelajaran')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Deskripsi Mata Pelajaran</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Deskripsi Mapel</li>
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
    <div class="card-header d-flex align-items-center justify-content-between w-100">
        <h3 class="card-title mb-0">
            <i class="fas fa-file-alt me-2"></i>Data Deskripsi Mapel per Kelas
        </h3>

        <div class="card-tools ms-auto d-flex align-items-center gap-2">
            <form action="{{ route('deskripsi.duplicate') }}" method="POST" class="d-inline mb-0" onsubmit="return confirm('Apakah Anda yakin ingin menyalin deskripsi dari tengah semester sebelumnya?')">
                @csrf
                <button type="submit" class="btn rounded-4 fw-bold" btn-sm">
                    <i class="fas fa-copy"></i>
                </button>
            </form>

            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahDeskripsi">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-3">
        <table id="tableDeskripsi" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Deskripsi Capaian</th>
                    <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deskripsis as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kelas?->rombel ?? $item->kelas?->nama_kelas ?? '-' }}</td>
                        <td>{{ $item->mapel?->mapel ?? '-' }}</td>
                        <td>{{ $item->deskripsi ?? '-' }}</td>
                        <td class="text-center">
                            <nobr>
                                <button type="button" 
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" 
                                        title="Edit"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>

                                <form action="{{ route('deskripsi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus deskripsi mata pelajaran ini?')">
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

@include('admin.deskripsis.create')
@include('admin.deskripsis.edit')

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
            $('#tableDeskripsi').DataTable({
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
                    $('#modalTambahDeskripsi').modal('show');
                @endif
            @endif
        });
    </script>
@stop