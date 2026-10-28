@extends('adminlte::page')

@section('title', 'Input Nilai Intrakulikuler')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Input Nilai Intrakulikuler</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Intrakulikuler</li>
    </ol>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon fas fa-check mr-1"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="icon fas fa-ban mr-1"></i> {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="icon fas fa-ban mr-1"></i> Terjadi kesalahan input. Pastikan nilai berupa angka antara 0 sampai 100.
        </div>
    @endif

    <form action="{{ route('intrakulikuler.update', 1) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="card-title mb-1">
                    <i class="fas fa-edit mr-2"></i> Form Input Nilai Siswa
                </h5>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-center" style="background-color: #17a2b8;">
                                <th class="text-white" style="width: 5%; background-color: #17a2b8;">No</th>
                                <th class="text-white text-left" style="background-color: #17a2b8;">Nama Siswa</th>
                                <th class="text-white" style="width: 15%; background-color: #17a2b8;">Kelas</th>
                                
                                @php
                                    $allMapels = $deskripsis->unique('mapel_id');
                                @endphp

                                @foreach ($allMapels as $deskripsiHeader)
                                    <th class="text-white" style="background-color: #17a2b8;">
                                        {{ $deskripsiHeader->mapel->mapel ?? '-' }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anggotaKelas as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <td class="text-center">{{ $item->kelas->rombel ?? '-' }}</td>
                                
                                @foreach ($allMapels as $deskripsiHeader)
                                    @php
                                        $matchedDeskripsi = $deskripsis->first(function ($deskripsi) use ($item, $deskripsiHeader) {
                                            return $deskripsi->mapel_id == $deskripsiHeader->mapel_id && $deskripsi->kelas_id == $item->kelas_id;
                                        });

                                        $existingNilai = null;
                                        if ($matchedDeskripsi && $item->intrakulikuler) {
                                            $existingNilai = $item->intrakulikuler->firstWhere('deskripsi_id', $matchedDeskripsi->id);
                                        }
                                    @endphp
                                    
                                    <td class="text-center">
                                        @if ($matchedDeskripsi)
                                            <input type="number" name="nilai[{{ $item->id }}][{{ $matchedDeskripsi->id }}]" value="{{ old('nilai.' . $item->id . '.' . $matchedDeskripsi->id, $existingNilai->nilai ?? '') }}" 
                                            min="0" max="100" class="form-control text-center" placeholder="0">
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ count($allMapels) + 3 }}" class="text-center py-4 text-muted">
                                    Data anggota kelas belum tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white d-flex justify-content-end text-right py-3 px-4">
                <button type="submit" class="btn btn-primary text-white px-4">
                    <i class="fas fa-save mr-1"></i> Simpan Semua Nilai
                </button>
            </div>
        </div>
    </form>
</div>
@stop

@include('layouts.footer')

@section('css')
<style>
    .table tbody td {
        font-weight: normal !important;
        vertical-align: middle;
    }
    
    .table thead th {
        font-weight: normal !important;
        vertical-align: middle;
    }
</style>
@stop

@section('js')
@stop