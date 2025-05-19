@extends('layouts.app')

@section('title', 'Create Video')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Create New Video</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('videos.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="video_link" class="form-label">Video Link</label>
                            <input type="url" class="form-control @error('video_link') is-invalid @enderror" id="video_link" name="video_link" value="{{ old('video_link') }}" required>
                            @error('video_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Paste the embed URL from YouTube or other video platforms</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create Video</button>
                        <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection