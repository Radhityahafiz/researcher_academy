@extends('layouts.app')

@section('title', 'Edit Material: ' . $material->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Material: {{ $material->title }}</h2>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('materials.update', $material) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $material->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $material->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $material->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="content_type" class="form-label">Content Type</label>
                            <select class="form-control @error('content_type') is-invalid @enderror" id="content_type" name="content_type" required>
                                <option value="">Select Content Type</option>
                                <option value="file" {{ old('content_type', $material->content_type) == 'file' ? 'selected' : '' }}>File Upload</option>
                                <option value="link" {{ old('content_type', $material->content_type) == 'link' ? 'selected' : '' }}>External Link</option>
                                <option value="text" {{ old('content_type', $material->content_type) == 'text' ? 'selected' : '' }}>Text Content</option>
                            </select>
                            @error('content_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3" id="file_upload_field" style="display: {{ old('content_type', $material->content_type) == 'file' ? 'block' : 'none' }};">
                            <label for="file" class="form-label">File Upload</label>
                            @if($material->file_path)
                                <div class="mb-2">
                                    <span class="badge bg-info">Current File: {{ basename($material->file_path) }}</span>
                                    <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View File</a>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Accepted formats: PDF, DOC, DOCX, PPT, PPTX, TXT</small>
                        </div>
                        
                        <div class="mb-3" id="external_link_field" style="display: {{ old('content_type', $material->content_type) == 'link' ? 'block' : 'none' }};">
                            <label for="external_link" class="form-label">External Link</label>
                            <input type="url" class="form-control @error('external_link') is-invalid @enderror" id="external_link" name="external_link" value="{{ old('external_link', $material->external_link) }}">
                            @error('external_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3" id="text_content_field" style="display: {{ old('content_type', $material->content_type) == 'text' ? 'block' : 'none' }};">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10">{{ old('content', $material->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-teal">Update Material</button>
                        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contentTypeSelect = document.getElementById('content_type');
        const fileUploadField = document.getElementById('file_upload_field');
        const externalLinkField = document.getElementById('external_link_field');
        const textContentField = document.getElementById('text_content_field');

        function toggleFields() {
            const type = contentTypeSelect.value;
            
            fileUploadField.style.display = 'none';
            externalLinkField.style.display = 'none';
            textContentField.style.display = 'none';
            
            if (type === 'file') {
                fileUploadField.style.display = 'block';
            } else if (type === 'link') {
                externalLinkField.style.display = 'block';
            } else if (type === 'text') {
                textContentField.style.display = 'block';
            }
        }

        // Inisialisasi awal
        toggleFields();

        // Event listener untuk perubahan
        contentTypeSelect.addEventListener('change', toggleFields);
    });
</script>

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