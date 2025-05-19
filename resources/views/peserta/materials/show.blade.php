@extends('peserta.layouts.app')

@section('title', $material->title)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('peserta.materials.index') }}">Materials</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($material->title, 30) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ $material->title }}</h3>
                        <span class="badge bg-primary">{{ $material->category->name }}</span>
                    </div>
                    <div class="d-flex align-items-center mt-2">
                        <small class="text-muted me-3">
                            <i class="bi bi-person"></i> {{ $material->creator->full_name }}
                        </small>
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> {{ $material->created_at->format('d M Y') }}
                        </small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>{{ $material->description ?? 'No description available' }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Content</h5>
                        @if($material->content_type === 'file')
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="bi bi-file-earmark-text fs-4 me-3"></i>
                                <div>
                                    <p class="mb-1">File Material</p>
                                    <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bi bi-download"></i> Download File
                                    </a>
                                </div>
                            </div>
                        @elseif($material->content_type === 'link')
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="bi bi-link-45deg fs-4 me-3"></i>
                                <div>
                                    <p class="mb-1">External Link</p>
                                    <a href="{{ $material->external_link }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bi bi-box-arrow-up-right"></i> Open Link
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="border rounded p-4 bg-light">
                                {!! nl2br(e($material->content)) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection