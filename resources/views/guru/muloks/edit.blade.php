@extends('adminlte::page')

@section('title', 'Edit Nilai ' . ( $m->nama_mapel ?? $m->mapel ?? '-'  ) )

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Edit Nilai {{ $mapel->nama ?? $mapel->nama_mapel }}</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('mulok.index') }}">Nilai Mulok Khas PI</a></li>
        <li class="breadcrumb-item active">Edit Nilai {{ $mapel->nama ?? $mapel->nama_mapel }}</li>
    </ol>
</div>
@stop

@section('content')
<form action="{{ route('mulok.update', $mapel->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <i class="fas fa-edit mr-2"></i> Edit Nilai {{ $mapel->nama ?? $mapel->nama_mapel }}
            </h3>
        </div>
        
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="tableEditMulok" class="table table-bordered table-hover text-sm w-100">
                    <thead>
                        <tr>
                            <th class="align-middle text-center" style="width: 10%">No</th>
                            <th class="align-middle text-center" style="width: 40%">Nama Siswa</th>
                            <th class="align-middle text-center" style="width: 15%">PH</th>
                            <th class="align-middle text-center" style="width: 15%">NPTS</th>
                            <th class="align-middle text-center" style="width: 20%">Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggotaKelas as $index => $item)
                            @php
                                $existingNilai = $item->muloks->first();
                                $valPh = old('nilai_ph.' . $item->id, $existingNilai->nilai_ph ?? '');
                                $valPts = old('nilai_npts.' . $item->id, $existingNilai->nilai_npts ?? '');
                                $valAkhir = $existingNilai->nilai_akhir ?? '-';
                            @endphp
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <td class="text-center align-middle">
                                    <input type="number" step="0.01" min="0" max="100" 
                                           name="nilai_ph[{{ $item->id }}]" 
                                           value="{{ $valPh }}" 
                                           class="form-control form-control-sm text-center">
                                </td>
                                <td class="text-center align-middle">
                                    <input type="number" step="0.01" min="0" max="100" 
                                           name="nilai_npts[{{ $item->id }}]" 
                                           value="{{ $valPts }}" 
                                           class="form-control form-control-sm text-center">
                                </td>
                                <td class="text-center align-middle font-weight-bold text-blue-custom">
                                    {{ $valAkhir }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            <div class="card-footer bg-white d-flex justify-content-end text-right py-3 px-4">
                <button type="submit" class="btn btn-primary text-white px-4">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
    </div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .text-blue-custom {
            color: #17a2b8 !important;
        }

        #tableEditMulok thead th {
            background-color: #17a2b8 !important;
            color: #ffffff !important;
            border-color: #138496 !important;
            vertical-align: middle !important;
            text-align: center !important;
            font-weight: normal !important;
        }

        #tableEditMulok thead th.sorting, 
        #tableEditMulok thead th.sorting_asc, 
        #tableEditMulok thead th.sorting_desc {
            text-align: center !important;
            padding-right: 10px !important;
        }

        #tableEditMulok thead th.sorting::after, 
        #tableEditMulok thead th.sorting_asc::after, 
        #tableEditMulok thead th.sorting_desc::after {
            right: 5px !important;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tableEditMulok').DataTable({
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "language": {
                    "emptyTable": "Belum ada data siswa di kelas ini."
                },
                "columnDefs": [
                    { "orderable": false, "targets": [2, 3] } 
                ]
            });
        });
    </script>
@stop