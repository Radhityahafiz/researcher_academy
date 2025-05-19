@extends('peserta.layouts.app')

@section('title', 'Learning Materials')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">Learning Materials</h2>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">All Categories</a></li>
                        @foreach(\App\Models\Category::all() as $category)
                        <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($materials as $material)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary">{{ $material->category->name }}</span>
                        <span class="badge bg-secondary">{{ ucfirst($material->content_type) }}</span>
                    </div>
                    <h5 class="card-title">{{ $material->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($material->description, 150) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">By: {{ $material->creator->full_name }}</small>
                        <a href="{{ route('peserta.materials.show', $material) }}" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            {{ $materials->links() }}
        </div>
    </div>
</div>
@endsection