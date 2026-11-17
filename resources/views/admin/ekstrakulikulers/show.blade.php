@extends('adminlte::page')

@section('title', 'Detail Ekstrakulikuler')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="mb-0">Ekstrakulikuler: {{ $ekstrakulikuler->nama_ekstrakulikuler }}</h2>
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ekstrakulikuler.index') }}">Data Ekstrakulikuler</a></li>
        <li class="breadcrumb-item active">Detail Anggota</li>
    </ol>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0">
            <i class="bi bi-people-fill me-2"></i>Daftar Anggota Ekstrakulikuler <strong>{{ $ekstrakulikuler->nama_ekstrakulikuler }}</strong>
        </h3>
        <div class="card-tools ms-auto ml-auto">
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                <i class="fas fa-plus me-1"></i>
            </button>
        </div>
    </div>
        
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="tableAnggotaEskul" class="table table-bordered table-striped table-hover align-middle text-sm w-100">
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
                    @forelse($ekstrakulikuler->anggotaEskul as $item)
                        @php
                            $siswa = $item->anggotaKelas->siswa ?? null;
                            $kelas = $item->anggotaKelas->kelas ?? null;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nis ?? '-' }}</td>
                            <td>{{ $siswa->nisn ?? '-' }}</td>
                            <td>{{ $kelas->rombel ?? '-' }}</td>
                            <td>{{ $siswa->nama_siswa ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('ekstrakulikuler.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengeluarkan siswa ini dari ekstrakulikuler?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs px-2 rounded-2">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('ekstrakulikuler.update', $ekstrakulikuler->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Anggota Ekstrakulikuler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Siswa</label>
                        <select name="anggota_kelas_id" class="form-control select2-modal" required style="width: 100%;">
                            <option value="">-- Pilih Siswa & Kelas --</option>
                            @foreach($anggotaKelasList as $ak)
                                <option value="{{ $ak->id }}">
                                    NIS: {{ $ak->siswa->nis ?? '-' }} -{{ $ak->siswa->nama_siswa ?? $ak->siswa->nama ?? '-' }} Kelas: {{$ak->kelas->rombel ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    
    <style>
        .select2-container--bootstrap-5 .select2-selection--single {
            height: 38px !important;
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
            $('#tableAnggotaEskul').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "autoWidth": false,
                "columnDefs": [
                    { "orderable": false, "targets": 5 }
                ],
                "language": {
                    "emptyTable": "Belum ada anggota ekstrakulikuler."
                }
            });

            $('#modalTambahSiswa').on('shown.bs.modal', function () {
                $('.select2-modal').select2({
                    theme: 'bootstrap-5',
                    dropdownParent: $('#modalTambahSiswa'),
                    placeholder: 'Cari Nama Siswa atau Kelas...',
                    allowClear: true,
                    width: '100%'
                });
            });
        });
    </script>
@stop