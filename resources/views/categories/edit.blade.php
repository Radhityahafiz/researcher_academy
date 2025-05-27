@extends('layouts.app')

@section('title', 'Edit Category: ' . $category->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Category: {{ $category->name }}</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            @if($category->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ $category->thumbnail_url }}" alt="Current thumbnail" class="img-thumbnail" style="max-height: 150px;">
                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="document.getElementById('delete-thumbnail').value = '1'">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                    <input type="hidden" name="delete_thumbnail" id="delete-thumbnail" value="0">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Recommended size: 400x300px, Max size: 2MB</small>
                        </div>
                        
                        <button type="submit" class="btn btn-teal">Update Category</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-teal {
        background: linear-gradient(to right, #2980b9, #1abc9c);
        color: white;
        border: none;
    }

    .btn-teal:hover {
        background: linear-gradient(to right, #1abc9c, #2980b9);
        color: white;
    }
</style>
@endsection