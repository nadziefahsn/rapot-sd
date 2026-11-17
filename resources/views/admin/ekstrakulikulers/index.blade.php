@extends('adminlte::page')

@section('title', 'Data Ekstrakulikuler')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Data Ekstrakulikuler</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Ekstrakulikuler</li>
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
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0">
            <i class="fas fa-futbol mr-2 me-2"></i>Data Ekstrakulikuler
        </h3>
        <div class="card-tools ms-auto ml-auto">
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahEskul">
                <i class="fas fa-plus mr-1"></i> 
            </button>
        </div>
    </div>
    
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="tableEkstrakulikuler" class="table table-bordered table-striped table-hover align-middle text-sm w-100">
                <thead>
                    <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th>Tahun Ajaran</th>
                        <th>Ekstrakulikuler</th>
                        <th>Pendamping</th>
                        <th style="width: 20%" class="text-center">Jumlah Anggota</th>
                        <th style="width: 10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ekstrakulikulers as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                            <td>{{ $item->nama_ekstrakulikuler ?? '-' }}</td>
                            <td>{{ $item->pendamping->nama_guru ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('ekstrakulikuler.show', $item->id) }}" class="btn btn-primary btn-sm rounded-3">
                                    <i class="bi bi-list-ul me-1"></i> {{ $item->anggota_eskul_count }} Siswa
                                </a>
                            </td>
                            <td class="text-center">
                            <nobr>
                                <button type="button" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" data-bs-toggle="modal" data-bs-target="#modalEditEkstrakulikuler{{ $item->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>

                                <form action="{{ route('ekstrakulikuler.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ekstrakulikuler ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Hapus">
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
</div>

@include('admin.ekstrakulikulers.create')
@include('admin.ekstrakulikulers.edit')

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#tableEkstrakulikuler').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "autoWidth": false,
                "columnDefs": [
                    { "orderable": false, "targets": [4, 5] }
                ]
            });
        });
    </script>
@stop