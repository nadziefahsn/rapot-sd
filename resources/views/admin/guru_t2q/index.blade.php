@extends('adminlte::page')

@section('title', 'Data Guru T2Q')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Data Guru T2Q</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Guru T2Q</li>
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
            <i class="fas fa-quran mr-2 me-2"></i>Data Guru T2Q
        </h3>
    </div>
        
    <div class="card-body p-3">
        <table id="tableGuruT2q" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Guru T2Q</th>
                    <th style="width: 20%" class="text-center">Jumlah Anggota</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guruT2q as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_guru }}</td>
                        <td class="text-center">
                            <a href="{{ route('guru-t2q.show', $item->id) }}" class="btn btn-primary btn-sm rounded-3">
                                <i class="bi bi-list-ul me-1"></i> {{ $item->siswa_halaqah_count }} Siswa
                            </a>
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
            $('#tableGuruT2q').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            });
        });
    </script> 
@stop