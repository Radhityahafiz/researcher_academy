@extends('layouts.participant')

@section('title', $category->name)

@section('content')
<div class="category-show-container">
    <div class="container">
        <!-- Category Header -->
        <div class="category-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        @if($category->thumbnail)
                        <div class="category-thumbnail me-4">
                            <img src="{{ $category->thumbnail_url }}" alt="{{ $category->name }}" 
                                 class="rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        @endif
                        <div>
                            <h1 class="fw-bold mb-2">{{ $category->name }}</h1>
                            @if($category->description)
                            <p class="lead text-muted mb-0">{{ $category->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('welcome') }}" class="btn btn-outline-primary px-4">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-pills mb-4" id="categoryTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="materials-tab" data-bs-toggle="pill" data-bs-target="#materials" type="button" role="tab">
                    <i class="fas fa-book-open me-2"></i>Materi ({{ $category->materials->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="videos-tab" data-bs-toggle="pill" data-bs-target="#videos" type="button" role="tab">
                    <i class="fas fa-video me-2"></i>Video ({{ $category->videos->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="quizzes-tab" data-bs-toggle="pill" data-bs-target="#quizzes" type="button" role="tab">
                    <i class="fas fa-question-circle me-2"></i>Quiz ({{ $category->quizzes->count() }})
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="categoryTabsContent">
            <!-- Materials Tab -->
            <div class="tab-pane fade show active" id="materials" role="tabpanel">
                @if($category->materials->count() > 0)
                <div class="row g-4">
                    @foreach($category->materials as $material)
                    <div class="col-md-6 col-lg-4 col-xl-3 animate__animated animate__fadeIn">
                        <div class="card material-card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="material-icon mb-3 text-center">
                                    @if($material->content_type === 'file')
                                    <i class="fas fa-file-alt fa-3x text-primary opacity-75"></i>
                                    @elseif($material->content_type === 'link')
                                    <i class="fas fa-link fa-3x text-primary opacity-75"></i>
                                    @else
                                    <i class="fas fa-align-left fa-3x text-primary opacity-75"></i>
                                    @endif
                                </div>
                                <h5 class="card-title fw-bold">{{ $material->title }}</h5>
                                @if($material->description)
                                <p class="card-text text-muted">{{ Str::limit($material->description, 100) }}</p>
                                @endif
                                <div class="mt-auto pt-3">
                                    <a href="{{ route('participant.materials.show', $material) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-book-reader me-2"></i> Buka Materi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-book-open fa-4x text-muted opacity-25"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Belum ada materi tersedia</h4>
                    <p class="text-muted mb-4">Materi untuk kategori ini sedang dalam pengembangan</p>
                </div>
                @endif
            </div>

            <!-- Videos Tab -->
            <div class="tab-pane fade" id="videos" role="tabpanel">
                @if($category->videos->count() > 0)
                <div class="row g-4">
                    @foreach($category->videos as $video)
                    <div class="col-md-6 col-lg-4 col-xl-3 animate__animated animate__fadeIn">
                        <div class="card video-card h-100 border-0 shadow-sm">
                            <div class="video-thumbnail position-relative">
                                @php
                                    $video_id = null;
                                    $platform = null;
                                    
                                    if (str_contains($video->video_link, 'youtube.com') || str_contains($video->video_link, 'youtu.be')) {
                                        $platform = 'youtube';
                                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->video_link, $matches);
                                        $video_id = $matches[1] ?? null;
                                    } elseif (str_contains($video->video_link, 'vimeo.com')) {
                                        $platform = 'vimeo';
                                        preg_match('/(?:vimeo\.com\/|player\.vimeo\.com\/video\/)(\d+)/', $video->video_link, $matches);
                                        $video_id = $matches[1] ?? null;
                                    }
                                @endphp

                                @if($video_id && $platform)
                                    <img src="@if($platform == 'youtube') https://img.youtube.com/vi/{{ $video_id }}/hqdefault.jpg @elseif($platform == 'vimeo') https://vumbnail.com/{{ $video_id }}.jpg @endif" 
                                         alt="{{ $video->title }}" 
                                         class="img-fluid w-100">
                                    <div class="play-button position-absolute top-50 start-50 translate-middle">
                                        <i class="fas fa-play-circle fa-3x text-white opacity-75"></i>
                                    </div>
                                @else
                                    <div class="invalid-thumbnail d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                                        <i class="fas fa-exclamation-triangle fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $video->title }}</h5>
                                @if($video->description)
                                <p class="card-text text-muted">{{ Str::limit($video->description, 100) }}</p>
                                @endif
                                <div class="mt-auto pt-3">
                                    <a href="{{ route('participant.videos.show', $video) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-play me-2"></i> Tonton Video
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-video-slash fa-4x text-muted opacity-25"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Belum ada video tersedia</h4>
                    <p class="text-muted mb-4">Video untuk kategori ini sedang dalam pengembangan</p>
                </div>
                @endif
            </div>

            <!-- Quizzes Tab -->
            <div class="tab-pane fade" id="quizzes" role="tabpanel">
                @if($category->quizzes->count() > 0)
                <div class="row g-4">
                    @foreach($category->quizzes as $quiz)
                    @php
                        $attempt = $quiz->attempts()->where('user_id', auth()->id())->first();
                    @endphp
                    <div class="col-md-6 col-lg-4 col-xl-3 animate__animated animate__fadeIn">
                        <div class="card quiz-card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="quiz-icon mb-3 text-center">
                                    <i class="fas fa-question-circle fa-3x text-primary opacity-75"></i>
                                </div>
                                <h5 class="card-title fw-bold">{{ $quiz->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($quiz->description, 100) }}</p>
                                
                                <div class="quiz-meta mb-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-question me-1"></i> {{ $quiz->questions_count }} Soal
                                    </span>
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-bullseye me-1"></i> {{ $quiz->passing_score }}% Kelulusan
                                    </span>
                                </div>
                                
                                <div class="mt-auto pt-3">
                                    @if($attempt)
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-{{ $attempt->passed() ? 'success' : 'danger' }} bg-opacity-10 text-{{ $attempt->passed() ? 'success' : 'danger' }}">
                                                <i class="fas fa-{{ $attempt->passed() ? 'trophy' : 'redo' }} me-1"></i> {{ $attempt->score }}%
                                            </span>
                                            <a href="{{ route('participant.quizzes.result', $attempt) }}" class="btn btn-outline-primary btn-sm">
                                                Lihat Hasil
                                            </a>
                                        </div>
                                    @else
                                        <a href="{{ route('participant.quizzes.start', $quiz) }}" class="btn btn-primary w-100">
                                            <i class="fas fa-play me-2"></i> Mulai Quiz
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-question-circle fa-4x text-muted opacity-25"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Belum ada quiz tersedia</h4>
                    <p class="text-muted mb-4">Quiz untuk kategori ini sedang dalam pengembangan</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .category-show-container {
        padding: 3rem 0;
    }
    
    .category-header {
        background-color: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .nav-pills {
        background-color: white;
        padding: 0.75rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .nav-pills .nav-link {
        color: #6c757d;
        font-weight: 500;
        border-radius: 8px;
        padding: 0.75rem 1.25rem;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link.active {
        color: white;
        background-color: var(--primary-color);
        box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
    }
    
    .nav-pills .nav-link:hover:not(.active) {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
    }
    
    .material-card,
    .video-card,
    .quiz-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
    }
    
    .material-card:hover,
    .video-card:hover,
    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .video-thumbnail {
        height: 180px;
        overflow: hidden;
        background-color: #000;
        border-radius: 12px 12px 0 0;
    }
    
    .video-thumbnail img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease;
    }
    
    .video-card:hover .video-thumbnail img {
        opacity: 0.8;
    }
    
    .play-button {
        transition: all 0.3s ease;
    }
    
    .video-card:hover .play-button i {
        opacity: 1;
        transform: scale(1.1);
    }
    
    .invalid-thumbnail {
        height: 180px;
        width: 100%;
    }
    
    .quiz-meta {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .quiz-meta .badge {
        font-weight: 400;
        padding: 0.35rem 0.75rem;
    }
    
    .empty-state {
        background-color: white;
        padding: 3rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .empty-state-icon i {
        opacity: 0.3;
    }
</style>
@endsection