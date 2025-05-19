@extends('layouts.app')

@section('title', 'Edit Category: ' . $category->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Category: {{ $category->name }}</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
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