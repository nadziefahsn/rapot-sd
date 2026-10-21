@extends('adminlte::page')

@section('title', 'Data Guru')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0">Data Guru</h1>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Guru</li>
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
            <i class="fas fa-chalkboard-teacher mr-2 me-2"></i>Data Guru
        </h3>

        <div class="card-tools ms-auto ml-auto">
            <button type="button" class="btn btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#modalImportGuru">
                <i class="fas fa-upload mr-1"></i>
            </button>
            <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
        
    <div class="card-body p-3">
        <table id="tableGuru" class="table table-bordered table-striped table-hover text-sm w-100">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Nama Guru</th>
                    <th>NIPY</th>
                    <th>Jabatan</th>
                    <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gurus as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_guru }}</td>
                        <td>{{ $item->nip ?? '-' }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td class="text-center">
                            <nobr>
                                <button type="button" 
                                        class="btn btn-xs btn-default text-warning mx-1 shadow" 
                                        title="Reset Password"
                                        onclick="bukaModalReset('{{ route('guru.update-password', $item->id) }}')">
                                    <i class="fa fa-lg fa-fw fa-user-cog"></i>
                                </button>

                                <button type="button" 
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" 
                                        title="Edit"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>

                                <form action="{{ route('guru.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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

@include('admin.gurus.create')
@include('admin.gurus.edit')
@include('admin.gurus.import')
@include('admin.gurus.reset-password')

@stop

@include('layouts.footer')


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables
            $('#tableGuru').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "columnDefs": [
                    { "orderable": false, "targets": 4 }
                ]
            });

            bsCustomFileInput.init();

            @if ($errors->any())
                @if(session('reset_id'))
                    $('#modalResetPassword{{ session('reset_id') }}').modal('show');
                @elseif(session('edit_id'))
                    $('#editModal{{ session('edit_id') }}').modal('show');
                @elseif($errors->has('file'))
                    $('#modalImportGuru').modal('show');
                @else
                    $('#modalTambahGuru').modal('show');
                @endif
            @endif
        });

        function bukaModalReset(actionUrl) {
            var form = document.getElementById('formResetPassword');
            if (form) form.setAttribute('action', actionUrl);

            var modal = document.getElementById('modalResetPassword');
            if (modal) {
                modal.style.display = 'block';
                document.body.classList.add('modal-open');
                
                setTimeout(function () {
                    modal.classList.add('show');
                }, 20);
            }
        }

        function tutupModalReset() {
            var modal = document.getElementById('modalResetPassword');
            if (modal) {
                modal.classList.remove('show');
                
                setTimeout(function () {
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }, 300);
            }
        }
    </script> 
@stop