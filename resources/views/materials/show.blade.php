@extends('layouts.app')

@section('title', $material->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $material->title }}</h6>
                    <div>
                        @can('update', $material)
                            <a href="{{ route('materials.edit', $material) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endcan 
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Detail</h5>
                            <ul class="list-unstyled">
                                <li><strong>Kategori:</strong> {{ $material->category->name }}</li>
                                <li><strong>Dibuat Oleh:</strong> {{ $material->creator->full_name }}</li>
                                <li><strong>Tanggal Dibuat:</strong> {{ $material->created_at->format('d M Y, H:i') }}</li>
                                <li><strong>Tipe Konten:</strong> {{ ucfirst($material->content_type) }}</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Deskripsi</h5>
                        <p>{{ $material->description ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Konten</h5>
                        @if($material->content_type === 'file')
                            <div class="alert alert-info">
                                @if($material->file_path)
                                    <i class="fas fa-file"></i> File: 
                                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-download"></i> Unduh File
                                    </a>
                                @else
                                    <i class="fas fa-exclamation-triangle"></i> File tidak ditemukan
                                @endif
                            </div>
                        @elseif($material->content_type === 'link')
                            <div class="alert alert-info">
                                <i class="fas fa-link"></i> Link Eksternal: 
                                <a href="{{ $material->external_link }}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-external-link-alt"></i> Buka Link
                                </a>
                            </div>
                        @else
                            <div class="border p-3 bg-light">
                                {!! nl2br(e($material->content)) !!}
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('materials.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection