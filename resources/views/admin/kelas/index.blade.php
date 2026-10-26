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
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card">
    <div class="card-header d-flex align-items-center w-100">
        <h3 class="card-title mb-0"><i class="fas fa-calendar-alt mr-2 me-2"></i>Kelas dan Pembimbing</h3>
        <div class="card-tools ms-auto ml-auto">
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
    </div>
    
    @php
    $heads = [
        ['label' => 'No', 'width' => 5],
        'Rombel / Kelas',
        'Wali Kelas',
        'Pendamping',
        'Tahun Ajaran',
        ['label' => 'Aksi', 'no-export' => true, 'width' => 10, 'className' => 'text-center'],
    ];

    $config = [
        'order' => [[0, 'asc']],
        'searching' => true,    
        'lengthChange' => true, 
        'columns' => [
            null, null, null, null, null,
            ['orderable' => false] 
        ],
    ];
    @endphp

    <div class="card-body p-3">
        <x-adminlte-datatable id="tableKelas" :heads="$heads" :config="$config" stripe hoverable buffered text-sm>
            @forelse($kelas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->rombel }}</td>
                    <td>{{ $item->waliKelas->nama_guru ?? '-' }}</td>
                    <td>{{ $item->pendamping->nama_guru ?? '-' }}</td>
                    <td>{{ $item->tahunAjaran->tahun_ajaran ?? '-' }} {{ $item->tahunAjaran?->semester == 'Ganjil' ? 'Ganjil' : 'Genap' }}</td>
                    <td class="text-center">
                        <nobr>
                            <button type="button" class="btn btn-xs btn-default text-primary mx-1 shadow"
                                title="Edit" data-toggle="modal" data-target="#editModal{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                    title="Delete" onclick="return confirm('Hapus kelas ini?')">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </nobr>
                    </td>
                </tr>
            @empty
            @endforelse
        </x-adminlte-datatable>
    </div>
</div>

@include('admin.kelas.create')
@include('admin.kelas.edit')

@stop

@include('layouts.footer')

@section('css')
<style>
    .table tbody td {
        font-weight: normal !important;
    }
    .table thead th {
        font-weight: 600 !important;
    }
</style>
@stop

@section('js')
@stop