@extends('peserta.layouts.app')

@section('title', 'Dashboard Peserta')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold">Welcome, {{ auth()->user()->full_name }}</h2>
            <p class="text-muted">Track your learning progress and access materials</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Materials</h6>
                            <h3 class="mb-0">{{ \App\Models\Material::count() }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-book text-primary fs-4"></i>
                        </div>
                    </div>
                    <a href="{{ route('peserta.materials.index') }}" class="small text-primary text-decoration-none mt-3 d-block">
                        View all <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Videos</h6>
                            <h3 class="mb-0">{{ \App\Models\Video::count() }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-play-circle text-success fs-4"></i>
                        </div>
                    </div>
                    <a href="{{ route('peserta.videos.index') }}" class="small text-success text-decoration-none mt-3 d-block">
                        View all <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Quizzes</h6>
                            <h3 class="mb-0">{{ \App\Models\Quiz::count() }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-question-circle text-info fs-4"></i>
                        </div>
                    </div>
                    <a href="{{ route('peserta.quizzes.index') }}" class="small text-info text-decoration-none mt-3 d-block">
                        View all <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Materials -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="card-title">Recent Materials</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($materials as $material)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $material->title }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($material->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">{{ $material->category->name }}</span>
                                        <a href="{{ route('peserta.materials.show', $material) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Videos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="card-title">Recent Videos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($videos as $video)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $video->title }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($video->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success">Video</span>
                                        <a href="{{ route('peserta.videos.show', $video) }}" class="btn btn-sm btn-outline-success">Watch</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Quizzes -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="card-title">Recent Quizzes</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($quizzes as $quiz)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $quiz->title }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($quiz->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-info">{{ $quiz->questions_count }} Questions</span>
                                        @if($quiz->attempts()->where('user_id', auth()->id())->exists())
                                            <span class="badge bg-secondary">Completed</span>
                                        @else
                                            <a href="{{ route('peserta.quizzes.start', $quiz) }}" class="btn btn-sm btn-outline-info">Start</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection