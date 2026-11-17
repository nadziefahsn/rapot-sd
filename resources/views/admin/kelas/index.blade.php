@extends('adminlte::page')

@section('title', 'Kelas & Wali')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Data Kelas dan Pembimbing</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Kelas & Wali</li>
    </ol>
</div>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fas fa-check mr-1 me-1"></i> {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header d-flex align-items-center w-100">
        <h3 class="card-title mb-0">
            <i class="fas fa-calendar-alt mr-2 me-2"></i>Kelas dan Pembimbing
        </h3>
        <div class="card-tools ms-auto ml-auto d-flex align-items-center">
            <form action="{{ route('kelas.duplicate') }}" method="POST" class="d-inline m-1" onsubmit="return confirm('Apakah Anda yakin ingin menyalin kelas dari semester sebelumnya?')">
                @csrf
                <button type="submit" class="btn rounded-4 fw-bold" title="Salin Kelas Semester Lalu">
                    <i class="fas fa-copy"></i> 
                </button>
            </form>
            
            <button type="button" class="btn rounded-4 fw-bold m-1" data-bs-toggle="modal" data-bs-target="#modalTambahKelas" title="Tambah Kelas">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-3">
        <table id="tableKelas" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Rombel / Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Pendamping</th>
                    <th>Tahun Ajaran</th>
                    <th style="width: 10%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->rombel }}</td>
                        <td>{{ $item->waliKelas->nama_guru ?? '-' }}</td>
                        <td>{{ $item->pendamping->nama_guru ?? '-' }}</td>
                        <td>{{ $item->tahunAjaran->tahun_ajaran ?? '-' }} {{ $item->tahunAjaran?->semester == 'Ganjil' ? 'Ganjil' : 'Genap' }}</td>
                        <td class="text-center">
                            <nobr>
                                <button type="button" 
                                        class="btn btn-xs btn-default text-primary mx-1 shadow"
                                        title="Edit" 
                                        data-toggle="modal" 
                                        data-target="#editModal{{ $item->id }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                                <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kelas ini?')">
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

@include('admin.kelas.create')
@include('admin.kelas.edit')

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
            $('#tableKelas').DataTable({
                "order": [[0, 'asc']],
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 5 }
                ]
            });
        });
    </script>
@stop