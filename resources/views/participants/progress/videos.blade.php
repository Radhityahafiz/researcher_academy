@extends('layouts.participant')

@section('title', 'Video Ditonton')

@section('content')
<a href="{{ route('welcome') }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali</a>

<div class="watched-videos-container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <h3 class="fw-bold mb-0"><i class="fas fa-video me-2"></i> Video Ditonton</h3>
                                <p class="mb-0 mt-1">Daftar video pembelajaran yang telah Anda tonton</p>
                            </div>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill">
                                {{ $completedVideos->count() }} Video
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @if($completedVideos->count() > 0)
                        <div class="row g-4">
                            @foreach($completedVideos as $video)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 animate__animated animate__fadeIn">
                                <div class="card h-100 video-card">
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
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="me-3">
                                                <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                                    <i class="fas fa-check-circle text-success"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-1">{{ Str::limit($video->title, 50) }}</h5>
                                                <p class="text-muted small mb-2">
                                                    <i class="fas fa-folder-open me-1"></i> 
                                                    {{ $video->category->name ?? 'Tanpa Kategori' }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="video-meta mb-3">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                <i class="far fa-clock me-1"></i>
                                                @if($video->pivot->completed_at)
                                                    Ditonton: {{ $video->pivot->completed_at->format('d M Y') }}
                                                @else
                                                    Tanggal tidak tersedia
                                                @endif
                                            </span>
                                        </div>

                                        <a href="{{ route('participant.videos.show', $video) }}" class="btn btn-primary w-100">
                                            <i class="fas fa-play me-2"></i> Tonton Kembali
                                        </a>
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
                            <h4 class="fw-bold mb-3">Belum ada video yang ditonton</h4>
                            <p class="text-muted mb-4">Mulai tonton video pembelajaran untuk melihat progres belajar Anda</p>
                            <a href="{{ route('welcome') }}" class="btn btn-primary px-4">
                                <i class="fas fa-video me-2"></i> Jelajahi Video
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    @if($completedVideos->count() > 0)
                    <div class="card-footer bg-light border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Menampilkan {{ $completedVideos->count() }} video
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection