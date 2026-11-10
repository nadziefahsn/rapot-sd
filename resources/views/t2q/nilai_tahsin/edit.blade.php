@extends('adminlte::page')

@section('title', 'Nilai Tahsin')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="m-0">Nilai Tahsin - Kelas {{ preg_replace('/[^0-9]/', '', $kelas->rombel) }}</h2>
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('nilai_tahsin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Nilai tahsin</li>
    </ol>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check me-1"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-ban me-1"></i> {{ session('error') }}
    </div>
@endif

<div class="container-fluid">
    <form action="{{ route('nilai_tahsin.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if(isset($mapelTahsin))
            <input type="hidden" name="mapel_id" value="{{ $mapelTahsin->id }}">
        @endif

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-quran mr-2 me-2"></i> Form Input Nilai Tahsin Kelas {{ preg_replace('/[^0-9]/', '', $kelas->rombel) }}
                </h5>
                <div class="ms-auto">
                    @if($sudahAdaNilai)
                        <span class="badge bg-success text-white px-3 py-2 fw-normal" style="font-size: 0.85rem;">
                            Data Sudah Tersimpan Sebelumnya
                        </span>
                    @endif
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive rounded-3 border">
                    <table class="table table-bordered table-hover align-middle mb-0 text-center">
                        <thead class="bg-primary text-white text-center align-middle">
                            <tr>
                                <th rowspan="2" class="align-middle" style="width: 5%;">No</th>
                                <th rowspan="2" class="align-middle" style="width: 20%;">Nama Siswa</th>
                                <th rowspan="2" class="align-middle" style="width: 8%;">Kelas</th>
                                <th colspan="5" class="text-center">Tahsin</th>
                            </tr>
                            <tr>
                                <th style="width: 12%;">Jilid</th>
                                <th style="width: 15%;">Halaman/Surah</th>
                                <th style="width: 8%;">Nilai</th>
                                <th style="width: 16%;">Kekurangan</th>
                                <th style="width: 16%;">Kelebihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $index => $s)
                                @php
                                    $dataExisting = $s->nilaiTahsin->first();
                                    $jilidSelected = old('tahsin.'.$s->id.'.jilid', $dataExisting?->jilid);
                                    $halamanVal    = old('tahsin.'.$s->id.'.halaman', $dataExisting?->halaman);
                                    $nilaiVal      = old('tahsin.'.$s->id.'.nilai', $dataExisting?->nilai);
                                    
                                    $kekuranganVal = old('tahsin.'.$s->id.'.kekurangan', 
                                        is_array($dataExisting?->kekurangan) 
                                            ? $dataExisting?->kekurangan 
                                            : json_decode($dataExisting?->kekurangan ?? '[]', true)
                                    );
                                    
                                    $kelebihanVal  = old('tahsin.'.$s->id.'.kelebihan', 
                                        is_array($dataExisting?->kelebihan) 
                                            ? $dataExisting?->kelebihan 
                                            : json_decode($dataExisting?->kelebihan ?? '[]', true)
                                    );

                                    $opsiList = $opsiCatatan ?? [
                                        'hukum mad', 
                                        'hukum nun sukun atau tanwin', 
                                        'hukum alif lam', 
                                        'makhraj huruf', 
                                        'sifat huruf', 
                                        'gunnah'
                                    ];
                                @endphp
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-start ps-3 fw-bold">
                                        {{ $s->siswa->nama_siswa ?? '-' }}
                                    </td>
                                    <td class="text-center align-middle fw-bold">
                                        {{ $s->kelas->rombel ?? $kelas->rombel }}
                                    </td>

                                    <td class="align-middle p-2">
                                        <select name="tahsin[{{ $s->id }}][jilid]" class="form-select form-select-sm text-center">
                                            <option value="">-- Jilid --</option>
                                            <option value="Jilid 1" {{ $jilidSelected == 'Jilid 1' ? 'selected' : '' }}>Jilid 1</option>
                                            <option value="Jilid 2" {{ $jilidSelected == 'Jilid 2' ? 'selected' : '' }}>Jilid 2</option>
                                            <option value="Jilid 3" {{ $jilidSelected == 'Jilid 3' ? 'selected' : '' }}>Jilid 3</option>
                                            <option value="Jilid 4" {{ $jilidSelected == 'Jilid 4' ? 'selected' : '' }}>Jilid 4</option>
                                            <option value="Tajwid 1" {{ $jilidSelected == 'Tajwid 1' ? 'selected' : '' }}>Tajwid 1</option>
                                            <option value="Tajwid 2" {{ $jilidSelected == 'Tajwid 2' ? 'selected' : '' }}>Tajwid 2</option>
                                            <option value="Talaqqi Juz 1-5" {{ $jilidSelected == 'Talaqqi Juz 1-5' ? 'selected' : '' }}>Talaqqi Juz 1-5</option>
                                            <option value="Talaqqi Juz 30" {{ $jilidSelected == 'Talaqqi Juz 30' ? 'selected' : '' }}>Talaqqi Juz 30</option>
                                            <option value="Gharib 1" {{ $jilidSelected == 'Gharib 1' ? 'selected' : '' }}>Gharib 1</option>
                                            <option value="Gharib 2" {{ $jilidSelected == 'Gharib 2' ? 'selected' : '' }}>Gharib 2</option>
                                            <option value="Tilawah" {{ $jilidSelected == 'Tilawah' ? 'selected' : '' }}>Tilawah</option>
                                        </select>
                                    </td>

                                    <td class="align-middle p-2">
                                        <input type="text" 
                                               name="tahsin[{{ $s->id }}][halaman]" 
                                               value="{{ $halamanVal }}" 
                                               class="form-control form-control-sm text-center" >
                                    </td>

                                    <td class="align-middle p-2">
                                        <input type="number" 
                                               name="tahsin[{{ $s->id }}][nilai]" 
                                               value="{{ $nilaiVal }}" 
                                               class="form-control form-control-sm text-center input-nilai-tahsin" 
                                               min="0" 
                                               max="100">
                                    </td>

                                    <td class="align-middle p-2 text-start">
                                        <select name="tahsin[{{ $s->id }}][kekurangan][]" 
                                                class="select2-tahsin" 
                                                multiple="multiple">
                                            @foreach($opsiList as $opsi)
                                                <option value="{{ $opsi }}" {{ in_array($opsi, $kekuranganVal ?? []) ? 'selected' : '' }}>
                                                    {{ $opsi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="align-middle p-2 text-start">
                                        <select name="tahsin[{{ $s->id }}][kelebihan][]" 
                                                class="select2-tahsin" 
                                                multiple="multiple">
                                            @foreach($opsiList as $opsi)
                                                <option value="{{ $opsi }}" {{ in_array($opsi, $kelebihanVal ?? []) ? 'selected' : '' }}>
                                                    {{ $opsi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-1"></i> Belum ada siswa yang terdaftar dalam kelompok T2Q ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($siswas) > 0)
            <div class="card-footer bg-white d-flex justify-content-end py-3 px-4">
                <button type="submit" class="btn btn-primary text-white px-4">
                    <i class="fas fa-save me-1"></i> Simpan Nilai
                </button>
            </div>
            @endif
        </div>
    </form>
</div>
@stop

@include('layouts.footer')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
    .table tbody td {
        font-weight: normal !important;
    }
    
    .table thead th {
        background-color: #17a2b8 !important;
        color: #ffffff !important;
        font-weight: normal !important;
        vertical-align: middle !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
    }

    .input-nilai-tahsin {
        text-align: center !important;
        max-width: 90px !important;
        margin: 0 auto !important;
        padding-left: 1.2rem !important;
        padding-right: 0.3rem !important;
    }

    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
        font-size: 0.8rem;
        padding: 2px 6px;
        margin-top: 2px;
        margin-bottom: 2px;
    }
</style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2-tahsin').select2({
            theme: 'bootstrap-5',
            width: '100%',
            allowClear: true,
            placeholder: 'Pilih opsi...',
            closeOnSelect: false
        });

        if (typeof bootstrap !== 'undefined') {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
</script>
@stop