@extends('layouts.participant')

@section('title', $quiz->title)

@section('content')
<div class="container-fluid">
    <!-- Quiz Header -->
    <div class="quiz-header mb-5">
        <div class="quiz-header-content">
            <h1 class="display-4 text-white font-weight-bold">{{ $quiz->title }}</h1>
            <p class="lead text-white">Uji pengetahuan dan kemampuan Anda</p>
        </div>
    </div>

    <!-- Quiz Details Card -->
    <div class="card quiz-details-card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="quiz-description-title">Deskripsi Quiz</h3>
                    <p class="quiz-description-text">
                        {{ $quiz->description ?? 'Tidak ada deskripsi untuk quiz ini.' }}
                    </p>
                    
                    <div class="quiz-stats">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h5>Pertanyaan</h5>
                                <p>{{ $quiz->questions()->count() }}</p>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div class="stat-content">
                                <h5>Nilai Kelulusan</h5>
                                <p>{{ $quiz->passing_score }}%</p>
                            </div>
                        </div>
                        
                        @if($attempt)
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-content">
                                <h5>Nilai Anda</h5>
                                <p class="{{ $attempt->passed() ? 'text-success' : 'text-danger' }}">
                                    {{ $attempt->score }}% 
                                    <small>({{ $attempt->passed() ? 'Lulus' : 'Tidak Lulus' }})</small>
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="quiz-actions">
                        @if(!$attempt)
                            <a href="{{ route('participant.quizzes.start', $quiz) }}" 
                               class="btn btn-start-quiz">
                                <i class="fas fa-play"></i> Mulai Quiz
                            </a>
                        @else
                            <div class="attempt-result">
                                <div class="result-badge {{ $attempt->passed() ? 'passed' : 'failed' }}">
                                    <i class="fas fa-{{ $attempt->passed() ? 'check-circle' : 'times-circle' }}"></i>
                                    {{ $attempt->passed() ? 'Selesai' : 'Dicoba' }}
                                </div>
                                <a href="{{ route('participant.quizzes.result', $attempt) }}" 
                                   class="btn btn-view-result">
                                    <i class="fas fa-chart-bar"></i> Lihat Hasil
                                </a>
                            </div>
                        @endif
                        
                        <a href="{{ route('participant.quizzes.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .quiz-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .quiz-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 70% 30%, rgba(255,255,255,0.1) 0%, transparent 70%);
    }
    
    .quiz-header-content {
        position: relative;
        z-index: 1;
    }
    
    .quiz-details-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .quiz-description-title {
        color: #2d3748;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #edf2f7;
    }
    
    .quiz-description-text {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 2rem;
    }
    
    .quiz-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        background: #f7fafc;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        background: #ebf8ff;
        color: #4299e1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-right: 1rem;
    }
    
    .stat-content h5 {
        color: #718096;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .stat-content p {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 0;
        font-size: 1.1rem;
    }
    
    .quiz-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        height: 100%;
    }
    
    .btn-start-quiz {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .btn-start-quiz:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .attempt-result {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .result-badge {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
    }
    
    .result-badge.passed {
        background: rgba(72, 187, 120, 0.1);
        color: #38a169;
    }
    
    .result-badge.failed {
        background: rgba(245, 101, 101, 0.1);
        color: #e53e3e;
    }
    
    .btn-view-result {
        background: #4299e1;
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .btn-view-result:hover {
        background: #3182ce;
        transform: translateY(-2px);
    }
    
    .btn-back {
        background: #edf2f7;
        color: #4a5568;
        border: none;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
        margin-top: auto;
    }
    
    .btn-back:hover {
        background: #e2e8f0;
    }
</style>
@endsection