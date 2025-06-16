@extends('layouts.app')

@section('title', 'Edit Kategori: ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kategori: {{ $category->name }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            @if($category->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ $category->thumbnail_url }}" alt="Current thumbnail" class="img-thumbnail" style="max-height: 150px;">
                                    
                                    <input type="hidden" name="delete_thumbnail" id="delete-thumbnail" value="0">
                                </div>
                            @endif
                            <input type="file" class="form-control-file @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Ukuran rekomendasi: 400x300px, Maksimal 2MB</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                         <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection