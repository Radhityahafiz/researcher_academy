@extends('layouts.participant')

@section('title', 'Hasil Quiz: ' . $attempt->quiz->title)

@section('content')
<div class="container-fluid quiz-result-container">
    <!-- Result Header -->
    <div class="result-header">
        <div class="result-badge {{ $attempt->passed() ? 'passed' : 'failed' }}">
            <div class="badge-icon">
                <i class="fas fa-{{ $attempt->passed() ? 'trophy' : 'redo' }}"></i>
            </div>
            <div class="badge-text">
                <h3>{{ $attempt->passed() ? 'Selamat!' : 'Tetap Semangat!' }}</h3>
                <p>Anda {{ $attempt->passed() ? 'lulus' : 'tidak lulus' }} quiz ini</p>
            </div>
        </div>
        
        <div class="result-score">
            <div class="score-circle">
                <svg class="progress-ring" width="160" height="160">
                    <circle class="progress-ring-circle" stroke-width="12" fill="transparent" r="68" cx="80" cy="80"/>
                    <circle class="progress-ring-circle-fill" stroke-width="12" fill="transparent" r="68" cx="80" cy="80"
                            stroke-dasharray="427.256" stroke-dashoffset="{{ 427.256 * (1 - $attempt->score/100) }}"/>
                </svg>
                <div class="score-text">
                    <span>{{ $attempt->score }}</span>%
                </div>
            </div>
            <div class="score-meta">
                <p>Nilai Kelulusan: {{ $attempt->quiz->passing_score }}%</p>
                <div class="score-stats">
                    <div class="stat-item correct">
                        <span>{{ $attempt->answers->where('is_correct', true)->count() }}</span>
                        <small>Benar</small>
                    </div>
                    <div class="stat-item incorrect">
                        <span>{{ $attempt->answers->where('is_correct', false)->count() }}</span>
                        <small>Salah</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Question Review -->
    <div class="question-review">
        <h3 class="review-title">Review Pertanyaan</h3>
        
        @foreach($attempt->quiz->questions as $question)
        @php
            $answer = $attempt->answers->where('question_id', $question->id)->first();
            $isCorrect = $answer ? $answer->is_correct : false;
            $correctOption = $question->options->where('is_correct', true)->first();
        @endphp
        <div class="review-item {{ $isCorrect ? 'correct' : 'incorrect' }}">
            <div class="review-question">
                <div class="question-number">#{{ $loop->iteration }}</div>
                <div class="question-text">{{ $question->question_text }}</div>
                <div class="question-status">
                    <span class="status-badge {{ $isCorrect ? 'correct' : 'incorrect' }}">
                        {{ $isCorrect ? 'Benar' : 'Salah' }}
                    </span>
                    <span class="points-badge">{{ $question->points }} poin</span>
                </div>
            </div>
            
            <div class="review-answer">
                <div class="your-answer">
                    <h5>Jawaban Anda:</h5>
                    <div class="answer-content">
                        {{ $answer && $answer->option ? $answer->option->option_text : 'Tidak menjawab' }}
                    </div>
                </div>
                
                @if(!$isCorrect)
                <div class="correct-answer">
                    <h5>Jawaban Benar:</h5>
                    <div class="answer-content">
                        {{ $correctOption->option_text }}
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Completion Actions -->
    <div class="completion-actions">
        <a href="{{ url('/') }}" class="btn btn-back">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>
        <a href="{{ route('participant.quizzes.index') }}" class="btn btn-primary">
            <i class="fas fa-list"></i> Lihat Quiz Lain
        </a>
    </div>
</div>

<style>
    .quiz-result-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .result-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .result-badge {
        display: inline-flex;
        align-items: center;
        padding: 1rem 2rem;
        border-radius: 50px;
        margin-bottom: 2rem;
    }

    .result-badge.passed {
        background: linear-gradient(135deg, rgba(72, 187, 120, 0.1) 0%, rgba(56, 161, 105, 0.1) 100%);
        color: #38a169;
    }

    .result-badge.failed {
        background: linear-gradient(135deg, rgba(245, 101, 101, 0.1) 0%, rgba(229, 62, 62, 0.1) 100%);
        color: #e53e3e;
    }

    .badge-icon {
        font-size: 2rem;
        margin-right: 1rem;
    }

    .badge-text h3 {
        margin: 0;
        font-weight: 700;
    }

    .badge-text p {
        margin: 0;
        opacity: 0.8;
    }

    .result-score {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 3rem;
        margin-top: 2rem;
    }

    .score-circle {
        position: relative;
        width: 160px;
        height: 160px;
    }

    .progress-ring-circle {
        stroke: #edf2f7;
    }

    .progress-ring-circle-fill {
        stroke: #4fd1c5;
        transition: stroke-dashoffset 1s ease;
    }

    .score-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
    }

    .score-text span {
        font-size: 3rem;
    }

    .score-meta p {
        color: #718096;
        margin-bottom: 1.5rem;
    }

    .score-stats {
        display: flex;
        gap: 1.5rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-item span {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .stat-item small {
        font-size: 0.8rem;
        color: #718096;
    }

    .stat-item.correct span {
        color: #38a169;
    }

    .stat-item.incorrect span {
        color: #e53e3e;
    }

    .question-review {
        margin-top: 3rem;
    }

    .review-title {
        color: #2d3748;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #edf2f7;
    }

    .review-item {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-left: 4px solid;
    }

    .review-item.correct {
        border-left-color: #38a169;
    }

    .review-item.incorrect {
        border-left-color: #e53e3e;
    }

    .review-question {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #edf2f7;
    }

    .question-number {
        background: #edf2f7;
        color: #4a5568;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-right: 1rem;
    }

    .question-text {
        flex: 1;
        min-width: 60%;
        font-weight: 500;
    }

    .question-status {
        display: flex;
        gap: 0.5rem;
        margin-left: auto;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-badge.correct {
        background: rgba(72, 187, 120, 0.1);
        color: #38a169;
    }

    .status-badge.incorrect {
        background: rgba(245, 101, 101, 0.1);
        color: #e53e3e;
    }

    .points-badge {
        background: rgba(66, 153, 225, 0.1);
        color: #4299e1;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .review-answer {
        padding: 0 1rem;
    }

    .your-answer, .correct-answer {
        margin-bottom: 1rem;
    }

    .your-answer h5, .correct-answer h5 {
        font-size: 0.9rem;
        color: #718096;
        margin-bottom: 0.5rem;
    }

    .answer-content {
        background: #f7fafc;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border-left: 3px solid;
    }

    .review-item.correct .answer-content {
        border-left-color: #38a169;
    }

    .review-item.incorrect .answer-content {
        border-left-color: #e53e3e;
    }

    .correct-answer .answer-content {
        border-left-color: #4299e1;
    }

    .completion-actions {
        text-align: center;
        margin-top: 3rem;
    }

    .btn-back {
        background: #edf2f7;
        color: #4a5568;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #e2e8f0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate the progress ring
        const circle = document.querySelector('.progress-ring-circle-fill');
        const radius = circle.r.baseVal.value;
        const circumference = 2 * Math.PI * radius;
        
        // Set initial state
        circle.style.strokeDasharray = circumference;
        circle.style.strokeDashoffset = circumference;
        
        // Animate to actual score
        const offset = circumference - ({{ $attempt->score }}/100) * circumference;
        circle.style.strokeDashoffset = offset;
    });
</script>
@endsection