@extends('layouts.app')

@section('title', $material->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('materials.index') }}">Materials</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $material->title }}</li>
                </ol>
            </nav>
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $material->title }}</h4>
                        <div>
                            @can('update', $material)
                                <a href="{{ route('materials.edit', $material) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Details</h5>
                        <ul class="list-unstyled">
                            <li><strong>Category:</strong> {{ $material->category->name }}</li>
                            <li><strong>Created By:</strong> {{ $material->creator->full_name }}</li>
                            <li><strong>Created At:</strong> {{ $material->created_at->format('d M Y, H:i') }}</li>
                            <li><strong>Content Type:</strong> {{ ucfirst($material->content_type) }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>{{ $material->description ?? 'No description provided.' }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Content</h5>
                        @if($material->content_type === 'file')
                            <div class="alert alert-info">
                                @if($material->file_path)
                                    <i class="fas fa-file"></i> File: 
                                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-outline-primary">
                                        Download File
                                    </a>
                                @else
                                    <i class="fas fa-exclamation-triangle"></i> File tidak ditemukan
                                @endif
                            </div>
                        @elseif($material->content_type === 'link')
                            <div class="alert alert-info">
                                <i class="fas fa-link"></i> External Link: 
                                <a href="{{ $material->external_link }}" target="_blank" class="btn btn-outline-primary">
                                    Open Link
                                </a>
                            </div>
                        @else
                            <div class="border p-3 bg-light">
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
