@extends('layouts.participant')

@section('title', 'Daftar Quiz')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="quiz-header mb-5">
        <h1 class="display-4 text-white font-weight-bold">Quiz Tersedia</h1>
        <p class="lead text-white">Uji pengetahuan Anda dengan quiz berikut</p>
    </div>

    <!-- Quiz Cards Grid -->
    <div class="row quiz-grid">
        @foreach($quizzes as $quiz)
        @php
            $attempt = $quiz->attempts()->where('user_id', auth()->id())->first();
            $progress = $attempt ? ($attempt->score / 100) * 360 : 0;
        @endphp
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="quiz-card card h-100 shadow-lg">
                <div class="card-header position-relative">
                    <div class="progress-circle" data-percent="{{ $attempt ? $attempt->score : 0 }}">
                        <svg class="progress-circle-svg">
                            <circle class="progress-circle-bg" cx="50%" cy="50%" r="45%"></circle>
                            <circle class="progress-circle-fill" cx="50%" cy="50%" r="45%" 
                                    style="stroke-dashoffset: calc(283 - (283 * {{ $attempt ? $attempt->score : 0 }}) / 100)"></circle>
                        </svg>
                        <div class="progress-circle-text">
                            @if($attempt)
                                {{ $attempt->score }}%
                            @else
                                <i class="fas fa-lock-open"></i>
                            @endif
                        </div>
                    </div>
                    <h3 class="quiz-title">{{ $quiz->title }}</h3>
                </div>
                <div class="card-body">
                    <div class="quiz-meta">
                        <span><i class="fas fa-question-circle"></i> {{ $quiz->questions()->count() }} Pertanyaan</span>
                        <span><i class="fas fa-bullseye"></i> Lulus: {{ $quiz->passing_score }}%</span>
                    </div>
                    <p class="quiz-description">{{ Str::limit($quiz->description ?? 'Tidak ada deskripsi', 120) }}</p>
                </div>
                <div class="card-footer bg-transparent">
                    @if($attempt)
                        <div class="quiz-result {{ $attempt->passed() ? 'passed' : 'failed' }}">
                            <span>
                                <i class="fas fa-{{ $attempt->passed() ? 'check-circle' : 'times-circle' }}"></i>
                                {{ $attempt->passed() ? 'Selesai' : 'Dicoba' }}
                            </span>
                            <a href="{{ route('participant.quizzes.result', $attempt) }}" class="btn btn-detail">
                                Lihat Hasil <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('participant.quizzes.start', $quiz) }}" class="btn btn-start-quiz">
                            Mulai Quiz <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .quiz-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    .quiz-header::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        transform: rotate(30deg);
    }

    .quiz-card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .quiz-card .card-header {
        background: white;
        padding: 1.5rem;
        text-align: center;
        border-bottom: none;
        position: relative;
    }

    .quiz-title {
        font-weight: 700;
        color: #2d3748;
        margin-top: 1rem;
    }

    .progress-circle {
        width: 100px;
        height: 100px;
        margin: 0 auto;
        position: relative;
    }

    .progress-circle-svg {
        width: 100%;
        height: 100%;
    }

    .progress-circle-bg {
        fill: none;
        stroke: #edf2f7;
        stroke-width: 8;
    }

    .progress-circle-fill {
        fill: none;
        stroke: #4fd1c5;
        stroke-width: 8;
        stroke-linecap: round;
        transition: stroke-dashoffset 1s ease;
    }

    .progress-circle-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.25rem;
        font-weight: bold;
        color: #4fd1c5;
    }

    .quiz-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: #718096;
        font-size: 0.9rem;
    }

    .quiz-description {
        color: #4a5568;
        line-height: 1.6;
    }

    .btn-start-quiz {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-start-quiz:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .quiz-result {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .quiz-result.passed {
        color: #38a169;
    }

    .quiz-result.failed {
        color: #e53e3e;
    }

    .btn-detail {
        background: #edf2f7;
        color: #4a5568;
        border: none;
        padding: 0.25rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        background: #e2e8f0;
    }
</style>
@endsection