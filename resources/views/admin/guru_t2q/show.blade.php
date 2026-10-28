@extends('adminlte::page')

@section('title', 'Kelompok T2Q')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="mb-0">Kelompok T2Q</h2>
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('guru-t2q.index') }}">Guru T2Q</a></li>
        <li class="breadcrumb-item active">Kelompok T2Q</li>
    </ol>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0">
            <i class="bi bi-people-fill me-2"></i>Kelompok T2Q <strong>{{ $guru->nama_guru }}</strong>
        </h3>
        <div class="card-tools ms-auto ml-auto">
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
        
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="tableKelompokT2q" class="table table-bordered table-striped table-hover align-middle text-sm w-100">
                <thead>
                    <tr>
                        <th style="width: 4%" class="text-center">No</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Nama Siswa</th>
                        <th style="width: 10%" class="text-center">Hapus Anggota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guru->siswaHalaqah as $sh)
                        @php
                            $siswa = $sh->anggotaKelas->siswa ?? null;
                            $kelas = $sh->anggotaKelas->kelas ?? null;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nis ?? '-' }}</td>
                            <td>{{ $siswa->nisn ?? '-' }}</td>
                            <td>{{ $kelas->rombel ?? $kelas->nama ?? '-' }}</td>
                            <td>{{ $siswa->nama ?? $siswa->nama_siswa ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('guru-t2q.destroy', $sh->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini dari kelompok T2Q?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs px-2 rounded-2">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.guru_t2q.create')

@stop

@include('layouts.footer')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    
    <style>
        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd !important;
            color: #fff !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 2px 8px !important;
        }
        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
            margin-right: 5px !important;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tableKelompokT2q').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "autoWidth": false,
                "columnDefs": [
                    { "orderable": false, "targets": 5 }
                ],
                "language": {
                    "emptyTable": "Belum ada anggota kelompok T2Q."
                }
            });

            $('#modalTambahAnggota').on('shown.bs.modal', function () {
                $('.select2-modal').select2({
                    theme: 'bootstrap-5',
                    dropdownParent: $('#modalTambahAnggota'),
                    placeholder: 'Cari Nama Siswa atau Kelas...',
                    allowClear: true,
                    width: '100%'
                });
            });
        });
    </script>
@stop