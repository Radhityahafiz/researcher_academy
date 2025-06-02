@extends('layouts.participant')

@section('title', 'Progres Belajar')

@section('content')
<div class="progress-container">
    <div class="container">
        <div class="progress-header text-center mb-5">
            <h1 class="fw-bold mb-3">Progres Belajar Anda</h1>
            <p class="lead text-muted">Pantau perkembangan dan pencapaian pembelajaran Anda</p>
        </div>

        @auth
        <div class="row g-4 justify-content-center">
            <!-- Progress Card 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="progress-card card border-0 shadow-sm h-100 animate__animated animate__fadeInUp">
                    <div class="card-body p-4 text-center">
                        <div class="progress-circle mx-auto mb-4" data-value="{{ $materialProgress }}">
                            <span class="progress-value">{{ $materialProgress }}%</span>
                        </div>
                        <h4 class="fw-bold mb-3">Materi Diselesaikan</h4>
                        <p class="text-muted mb-4">Anda telah menyelesaikan {{ $completedMaterials }} dari {{ $totalMaterials }} materi</p>
                        <a href="{{ route('progress.materials') }}" class="btn btn-primary px-4">
                            <i class="fas fa-book-open me-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <!-- Progress Card 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="progress-card card border-0 shadow-sm h-100 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card-body p-4 text-center">
                        <div class="progress-circle mx-auto mb-4" data-value="{{ $videoProgress }}">
                            <span class="progress-value">{{ $videoProgress }}%</span>
                        </div>
                        <h4 class="fw-bold mb-3">Video Ditonton</h4>
                        <p class="text-muted mb-4">Anda telah menonton {{ $completedVideos }} dari {{ $totalVideos }} video</p>
                        <a href="{{ route('progress.videos') }}" class="btn btn-primary px-4">
                            <i class="fas fa-video me-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <!-- Progress Card 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="progress-card card border-0 shadow-sm h-100 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card-body p-4 text-center">
                        <div class="progress-circle mx-auto mb-4" data-value="{{ $quizProgress }}">
                            <span class="progress-value">{{ $quizProgress }}%</span>
                        </div>
                        <h4 class="fw-bold mb-3">Kuis Diselesaikan</h4>
                        <p class="text-muted mb-4">Anda telah menyelesaikan {{ $completedQuizzes }} dari {{ $totalQuizzes }} kuis</p>
                        <a href="{{ route('progress.quizzes') }}" class="btn btn-primary px-4">
                            <i class="fas fa-tasks me-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Summary -->
        <div class="progress-summary mt-5 animate__animated animate__fadeIn">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4"><i class="fas fa-chart-line me-2"></i> Ringkasan Progres</h4>
                    <div class="row">
                        <div class="col-md-4 border-end">
                            <div class="text-center py-2">
                                <h2 class="fw-bold text-primary">{{ $materialProgress }}%</h2>
                                <p class="text-muted mb-0">Rata-rata Materi</p>
                            </div>
                        </div>
                        <div class="col-md-4 border-end">
                            <div class="text-center py-2">
                                <h2 class="fw-bold text-primary">{{ $videoProgress }}%</h2>
                                <p class="text-muted mb-0">Rata-rata Video</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center py-2">
                                <h2 class="fw-bold text-primary">{{ $quizProgress }}%</h2>
                                <p class="text-muted mb-0">Rata-rata Kuis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="empty-state text-center py-5 animate__animated animate__fadeIn">
            <div class="empty-state-icon mb-4">
                <i class="fas fa-user-lock fa-4x text-muted"></i>
            </div>
            <h4 class="fw-bold mb-3">Silakan masuk untuk melihat progres belajar Anda</h4>
            <p class="text-muted mb-4">Masuk untuk melanjutkan pembelajaran dan memantau perkembangan Anda</p>
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk Sekarang
            </a>
        </div>
        @endauth
    </div>
</div>

<style>
    .progress-container {
        padding: 3rem 0;
        background-color: white;
        border-radius: 16px;
        margin: 2rem auto;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .progress-header h1 {
        color: var(--primary-color);
        font-size: 2.5rem;
    }
    
    .progress-card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(67, 97, 238, 0.1);
    }
    
    .progress-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(67, 97, 238, 0.15) !important;
    }
    
    .progress-circle {
        width: 140px;
        height: 140px;
        position: relative;
        border-radius: 50%;
        background: #f5f7fa;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
    }
    
    .progress-circle::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(var(--primary-color) calc(var(--progress) * 1%), #f5f7fa 0);
        transition: background 1s ease;
    }
    
    .progress-value {
        position: relative;
        font-size: 2rem;
        font-weight: bold;
        color: var(--primary-color);
    }
    
    .progress-summary {
        background-color: rgba(67, 97, 238, 0.03);
        border-radius: 12px;
        padding: 1px;
    }
    
    .empty-state {
        max-width: 500px;
        margin: 0 auto;
        padding: 2rem;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .empty-state-icon {
        opacity: 0.6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.progress-circle').forEach(circle => {
            const progress = circle.getAttribute('data-value');
            circle.style.setProperty('--progress', progress);
        });
    });
</script>
@endsection