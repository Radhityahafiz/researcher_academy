@extends('layouts.app')

@section('title', $video->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('videos.index') }}">Videos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $video->title }}</li>
                </ol>
            </nav>
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $video->title }}</h4>
                        <div>
                            <a href="{{ route('videos.edit', $video) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Details</h5>
                        <ul class="list-unstyled">
                            <li><strong>Created By:</strong> {{ $video->creator->full_name }}</li>
                            <li><strong>Created At:</strong> {{ $video->created_at->format('d M Y, H:i') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>{{ $video->description ?? 'No description provided.' }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Video</h5>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $video->video_link }}" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection