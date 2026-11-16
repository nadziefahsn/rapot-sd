@extends('adminlte::page')

@section('title', 'Anggota Kelas')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Anggota Kelas</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Anggota Kelas</li>
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
        <div class="card-tools ms-auto ml-auto">
            @hasrole('admin')
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahAnggotaKelas">
                <i class="fas fa-plus"></i>
            </button>
            @endhasrole
        </div>
    </div>

    <div class="card-body p-3">
        <table id="tableAnggotaKelas" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 15%">NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas / Rombel</th>
                    <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggotaKelas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nis_id ?? '-' }}</td>
                        <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                        <td>{{ $item->kelas->rombel ?? '-' }}</td>
                        <td class="text-center">
                            <nobr>
                                <button type="button" 
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" 
                                        title="Edit"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                                <form action="{{ route('admin.anggota-kelas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus siswa ini dari anggota kelas?')">
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

@include('admin.anggota_kelas.create')
@include('admin.anggota_kelas.edit')

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
            $('#tableAnggotaKelas').DataTable({
                "order": [[0, 'asc']],
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 4 }
                ]
            });
        });
    </script>
@stop