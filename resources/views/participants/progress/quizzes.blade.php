@extends('layouts.participant')

@section('title', 'Kuis Diselesaikan')

@section('content')
<div class="completed-quizzes-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-bold mb-0"><i class="fas fa-tasks me-2"></i> Kuis Diselesaikan</h3>
                                <p class="mb-0 mt-1">Daftar kuis yang telah Anda kerjakan</p>
                            </div>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill">
                                {{ $quizAttempts->count() }} Kuis
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        @if($quizAttempts->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($quizAttempts as $attempt)
                            <div class="list-group-item border-0 p-4 {{ $loop->last ? '' : 'border-bottom' }} animate__animated animate__fadeIn">
                                <div class="d-flex align-items-start">
                                    <div class="quiz-icon me-3">
                                        <div class="icon-wrapper bg-success bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-check-circle text-success fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold mb-2">{{ $attempt->quiz->title }}</h5>
                                        <div class="quiz-meta d-flex flex-wrap gap-2 mb-3">
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                <i class="fas fa-question-circle me-1"></i> 
                                                {{ $attempt->quiz->questions_count }} Soal
                                            </span>
                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                <i class="fas fa-bullseye me-1"></i> 
                                                Kelulusan: {{ $attempt->quiz->passing_score }}%
                                            </span>
                                            <span class="badge {{ $attempt->passed() ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $attempt->passed() ? 'text-success' : 'text-danger' }}">
                                                <i class="fas fa-{{ $attempt->passed() ? 'trophy' : 'redo' }} me-1"></i> 
                                                {{ $attempt->score }}% ({{ $attempt->passed() ? 'Lulus' : 'Tidak Lulus' }})
                                            </span>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                <i class="far fa-clock me-1"></i> 
                                                {{ $attempt->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <a href="{{ route('participant.quizzes.result', $attempt) }}" class="btn btn-success px-3">
                                            <i class="fas fa-chart-bar me-1"></i> Hasil
                                        </a>
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
                            <h4 class="fw-bold mb-3">Belum ada kuis yang diselesaikan</h4>
                            <p class="text-muted mb-4">Mulai kerjakan kuis sekarang untuk melihat hasil dan progres belajar Anda</p>
                            <a href="{{ route('welcome') }}" class="btn btn-primary px-4">
                                <i class="fas fa-tasks me-2"></i> Jelajahi Kuis
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    @if($quizAttempts->count() > 0)
                    <div class="card-footer bg-light border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Menampilkan {{ $quizAttempts->count() }} kuis
                            </div>
                            <a href="{{ route('welcome') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .completed-quizzes-container {
        padding: 3rem 0;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 12px 12px 0 0 !important;
    }
    
    .quiz-icon .icon-wrapper {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .quiz-meta .badge {
        font-weight: 400;
        padding: 0.35rem 0.75rem;
    }
    
    .empty-state {
        padding: 3rem 1rem;
    }
    
    .empty-state-icon i {
        opacity: 0.3;
    }
</style>
@endsection