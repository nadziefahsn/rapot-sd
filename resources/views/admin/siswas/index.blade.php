@extends('adminlte::page')

@section('title', 'Peserta Didik')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Peserta Didik</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Peserta Didik</li>
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
            <i class="fas fa-user-graduate mr-2 me-2"></i>Data Peserta Didik
        </h3>

        <div class="card-tools ms-auto ml-auto">
            <button type="button" class="btn btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#modalImportSiswa" title="Import Excel">
                <i class="fas fa-upload mr-1"></i>
            </button>
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-3">
        <table id="tableSiswa" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>NIS/NISN</th>
                    <th>Nama Siswa</th>
                    <th>Kelas Saat Ini</th>
                    <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nis }} / {{ $item->nisn ?? '-' }}</td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->kelas?->rombel ?? '-' }}</td>
                        <td class="text-center">
                            <nobr>
                                <button type="button" 
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" 
                                        title="Edit"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->nis }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>

                                <form action="{{ route('siswa.destroy', $item->nis) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data siswa ini?')">
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

@include('admin.siswas.create')
@include('admin.siswas.edit')
@include('admin.siswas.import')

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

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tableSiswa').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 4 }
                ]
            });

            bsCustomFileInput.init();

            @if ($errors->any())
                @if(session('edit_id'))
                    $('#editModal{{ session('edit_id') }}').modal('show');
                @elseif($errors->has('file'))
                    $('#modalImportSiswa').modal('show');
                @else
                    $('#modalTambahSiswa').modal('show');
                @endif
            @endif
        });
    </script>
@stop