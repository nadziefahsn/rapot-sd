@extends('adminlte::page')

@section('title', 'Pengumuman')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0">Pengumuman</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end bg-transparent p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active text-muted">
                    Pengumuman
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon fas fa-check me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border mb-4 shadow-none">
        <div class="card-header bg-white d-flex align-items-center py-3">
            <h3 class="card-title mb-0 fw-normal"><i class="fas fa-bullhorn me-2"></i>Pengumuman</h3>
            <div class="ms-auto">
                    <button type="button" class="btn rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahPengumuman">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body bg-white">
            <div class="timeline">
                <div class="time-label">
                    <span class="badge bg-success px-3 py-2 fw-normal" style="font-size: 0.9rem;">
                        Pengumuman Terakhir
                    </span>
                </div>
                
                @forelse ($pengumumans as $item)
                <div>
                    <div class="timeline-icon bg-primary text-white d-flex align-items-center justify-content-center">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="timeline-item border shadow-none">
                        <span class="time text-muted float-end">
                            <i class="fas fa-clock me-1"></i>
                            {{ $item->created_at->format('Y-m-d H:i:s') }}
                        </span>
                        <h3 class="timeline-header border-bottom-0">
                            <a href="#" class="fw-bold text-primary text-decoration-none">
                                {{ $item->user->name ?? 'Admin' }}
                            </a> 
                            <span class="text-secondary">{{ $item->judul }}</span>
                        </h3>
                        <div class="timeline-body">
                            {!! $item->isi !!}
                        </div>
                        <div class="timeline-footer bg-light border-top">
                            <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                <i class="fas fa-pen me-1"></i> Edit
                            </button>  
                            <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div> 
                @empty
                <div>
                    <div class="timeline-icon bg-secondary text-white d-flex align-items-center justify-content-center">
                        <i class="fas fa-info"></i>
                    </div>
                    <div class="timeline-item border shadow-none">
                        <div class="timeline-body text-muted text-center py-4">
                            Belum ada pengumuman.
                        </div>
                    </div>
                </div>
                @endforelse
                <div>
                    <div class="timeline-icon bg-secondary text-white d-flex align-items-center justify-content-center">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.pengumumans.create')
@include('admin.pengumumans.edit')
@stop

@section('css')
\<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>
<script>
    $(document).ready(function () {
\        $('#modalTambahPengumuman').on('shown.bs.modal', function () {
            $('#isi_pengumuman').summernote({
                height: 250,
                placeholder: 'Tulis isi pengumuman...'
            });
        });

        $('.modal').on('shown.bs.modal', function () {
            $(this).find('.summernote-edit').summernote({
                height: 200,
                placeholder: 'Edit isi pengumuman...'
            });
        });
    });
</script>
@stop