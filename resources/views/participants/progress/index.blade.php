@extends('layouts.participant')

@section('title', 'Progres Belajar')

@section('content')
<div class="progress-container py-4">
    <div class="container">
        <div class="progress-header text-center mb-5">
            <h1 class="fw-bold mb-3">Progres Belajar Anda</h1>
            <p class="lead text-muted">Pantau perkembangan dan pencapaian pembelajaran Anda</p>
        </div>

        @auth
        <div class="row g-4 justify-content-center">
            <!-- Progress Card 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="progress-card card h-100 animate__animated animate__fadeInUp">
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
                <div class="progress-card card h-100 animate__animated animate__fadeInUp animate__delay-1s">
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
                <div class="progress-card card h-100 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card-body p-4 text-center">
                        <div class="progress-circle mx-auto mb-4" data-value="{{ $assignmentProgress }}">
                            <span class="progress-value">{{ $assignmentProgress }}%</span>
                        </div>
                        <h4 class="fw-bold mb-3">Tugas Dikerjakan</h4>
                        <p class="text-muted mb-4">Anda telah mengerjakan {{ $completedAssignments }} dari {{ $totalAssignments }} tugas</p>
                        <a href="{{ route('progress.assignments') }}" class="btn btn-primary px-4">
                            <i class="fas fa-tasks me-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Summary -->
        <div class="progress-summary mt-5 animate__animated animate__fadeIn">
            <div class="card">
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
                                <h2 class="fw-bold text-primary">{{ $assignmentProgress }}%</h2>
                                <p class="text-muted mb-0">Rata-rata Tugas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="empty-state text-center py-5">
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
@endsection