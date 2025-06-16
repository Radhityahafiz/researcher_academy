@extends('layouts.participant')

@section('title', $category->name)

@section('content')
<a href="{{ route('welcome') }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali</a>

<div class="category-show-container py-4">
    <div class="container">
        <!-- Category Header -->
        <div class="category-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        @if($category->thumbnail)
                        <div class="category-thumbnail mb-3 mb-md-0 me-md-4">
                            <img src="{{ $category->thumbnail_url }}" alt="{{ $category->name }}" 
                                 class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        @endif
                        <div class="text-center text-md-start">
                            <h1 class="fw-bold mb-2">{{ $category->name }}</h1>
                            @if($category->description)
                            <p class="lead text-muted mb-0">{{ $category->description }}</p>
                            @endif
                        </div>
                    </div>
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
                <button class="nav-link" id="assignments-tab" data-bs-toggle="pill" data-bs-target="#assignments" type="button" role="tab">
                    <i class="fas fa-tasks me-2"></i>Tugas ({{ $category->assignments->count() }})
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
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 animate__animated animate__fadeIn">
                        <div class="card material-card h-100">
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
                                <h5 class="card-title fw-bold">{{ Str::limit($material->title, 50) }}</h5>
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
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 animate__animated animate__fadeIn">
                        <div class="card video-card h-100">
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
                                <h5 class="card-title fw-bold">{{ Str::limit($video->title, 50) }}</h5>
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

            <!-- Assignments Tab -->
            <div class="tab-pane fade" id="assignments" role="tabpanel">
                @if($category->assignments->count() > 0)
                <div class="row g-4">
                    @foreach($category->assignments as $assignment)
                    @php
                        $submission = $assignment->submissions->where('user_id', auth()->id())->first();
                    @endphp
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 animate__animated animate__fadeIn">
                        <div class="card assignment-card h-100">
                            <div class="card-body">
                                <div class="assignment-icon mb-3 text-center">
                                    <i class="fas fa-tasks fa-3x text-primary opacity-75"></i>
                                </div>
                                <h5 class="card-title fw-bold">{{ Str::limit($assignment->title, 50) }}</h5>
                               
                                <div class="assignment-meta mb-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-clock me-1"></i> {{ $assignment->due_date->format('d M Y') }}
                                    </span>
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-star me-1"></i> {{ $assignment->max_score }} Poin
                                    </span>
                                </div>
                                
                                <div class="mt-auto pt-3">
                                    @if($submission)
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-{{ $submission->passed() ? 'success' : ($submission->score !== null ? 'danger' : 'info') }} bg-opacity-10 text-{{ $submission->passed() ? 'success' : ($submission->score !== null ? 'danger' : 'info') }}">
                                                <i class="fas fa-{{ $submission->passed() ? 'trophy' : ($submission->score !== null ? 'times' : 'check') }} me-1"></i> 
                                                @if($submission->score !== null)
                                                    {{ $submission->score }}%
                                                @else
                                                    Terkumpul
                                                @endif
                                            </span>
                                            <a href="{{ route('participant.assignments.show', $assignment) }}" class="btn btn-outline-primary btn-sm">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    @else
                                        <a href="{{ route('participant.assignments.show', $assignment) }}" class="btn btn-primary w-100">
                                            <i class="fas fa-eye me-2"></i> Lihat Tugas
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
                        <i class="fas fa-tasks fa-4x text-muted opacity-25"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Belum ada tugas tersedia</h4>
                    <p class="text-muted mb-4">Tugas untuk kategori ini sedang dalam pengembangan</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection