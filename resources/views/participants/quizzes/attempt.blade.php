@extends('layouts.participant')

@section('title', 'Quiz: ' . $quiz->title)

@section('content')
<div class="container-fluid quiz-attempt-container">
    <!-- Quiz Header -->
    <div class="quiz-attempt-header">
        <div class="quiz-progress">
            <div class="progress-bar-container">
                <div class="progress-bar" style="width: {{ ($currentQuestion / $totalQuestions) * 100 }}%"></div>
            </div>
            <div class="progress-text">
                Pertanyaan {{ $currentQuestion }} dari {{ $totalQuestions }}
            </div>
        </div>
        <div class="quiz-info">
            <h2>{{ $quiz->title }}</h2>
            <div class="quiz-meta">
                <span><i class="fas fa-bullseye"></i> Nilai Kelulusan: {{ $quiz->passing_score }}%</span>
                <span><i class="fas fa-stopwatch"></i> Tidak ada batas waktu</span>
            </div>
        </div>
    </div>

    <!-- Question Form -->
    <form id="quizForm">
        @csrf
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <input type="hidden" name="current_question" value="{{ $currentQuestion }}">
        
        <div class="question-card">
            <div class="question-header">
                <div class="question-number">Pertanyaan {{ $currentQuestion }}</div>
                <div class="question-points">{{ $question->points }} poin</div>
            </div>
            
            <div class="question-text">
                {{ $question->question_text }}
            </div>
            
            <div class="options-container">
                @foreach($question->options as $index => $option)
<div class="option-item">
    <input type="radio" name="answers[{{ $question->id }}]" 
           id="option_{{ $option->id }}" 
           value="{{ $option->id }}" 
           class="option-input"
           @if(isset($savedAnswers[$question->id]) && $savedAnswers[$question->id] == $option->id) checked @endif>
    <label for="option_{{ $option->id }}" class="option-label">
        <span class="option-letter">{{ chr(65 + $index) }}</span>
        <span class="option-text">{{ $option->option_text }}</span>
    </label>
</div>
@endforeach
            </div>
        </div>
        
        <div class="navigation-buttons">
            @if($currentQuestion > 1)
                <a href="{{ route('participant.quizzes.start', ['quiz' => $quiz, 'question' => $currentQuestion - 1]) }}" 
                   class="btn btn-prev">
                    <i class="fas fa-arrow-left"></i> Sebelumnya
                </a>
            @else
                <div></div>
            @endif
            
            @if($currentQuestion < $totalQuestions)
                <button type="button" onclick="validateAndContinue()" class="btn btn-next">
                    Selanjutnya <i class="fas fa-arrow-right"></i>
                </button>
            @else
                <button type="button" onclick="submitQuiz()" class="btn btn-submit">
                    Submit Quiz <i class="fas fa-paper-plane"></i>
                </button>
            @endif
        </div>
    </form>
</div>

<style>
    .quiz-attempt-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .quiz-attempt-header {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .quiz-progress {
        margin-bottom: 1.5rem;
    }

    .progress-bar-container {
        height: 8px;
        background: #edf2f7;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #4fd1c5, #38b2ac);
        transition: width 0.3s ease;
    }

    .progress-text {
        text-align: right;
        font-size: 0.9rem;
        color: #718096;
        margin-top: 0.5rem;
    }

    .quiz-info h2 {
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .quiz-meta {
        display: flex;
        gap: 1rem;
        color: #718096;
        font-size: 0.9rem;
    }

    .question-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .question-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #edf2f7;
    }

    .question-number {
        font-weight: 600;
        color: #2d3748;
    }

    .question-points {
        background: #ebf8ff;
        color: #3182ce;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .question-text {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #4a5568;
        margin-bottom: 2rem;
    }

    .options-container {
        display: grid;
        gap: 1rem;
    }

    .option-item {
        position: relative;
    }

    .option-input {
        position: absolute;
        opacity: 0;
    }

    .option-label {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        background: #f7fafc;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
    }

    .option-input:checked + .option-label {
        background: #ebf8ff;
        border-color: #90cdf4;
        box-shadow: 0 0 0 2px #ebf8ff;
    }

    .option-input:focus + .option-label {
        box-shadow: 0 0 0 2px #90cdf4;
    }

    .option-letter {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        background: #e2e8f0;
        color: #4a5568;
        border-radius: 50%;
        margin-right: 1rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .option-input:checked + .option-label .option-letter {
        background: #4299e1;
        color: white;
    }

    .option-text {
        flex: 1;
    }

    .navigation-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }

    .btn-prev, .btn-next, .btn-submit {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-prev {
        background: #edf2f7;
        color: #4a5568;
    }

    .btn-prev:hover {
        background: #e2e8f0;
    }

    .btn-next {
        background: #4299e1;
        color: white;
    }

    .btn-next:hover {
        background: #3182ce;
    }

    .btn-submit {
        background: #38a169;
        color: white;
    }

    .btn-submit:hover {
        background: #2f855a;
    }
</style>

<script>
    function validateAndContinue() {
    const selectedOption = document.querySelector('input[name="answers[{{ $question->id }}]"]:checked');
    if (!selectedOption) {
        alert('Silakan pilih jawaban sebelum melanjutkan.');
        return false;
    }
    
    const formData = new FormData();
    formData.append('answers[{{ $question->id }}]', selectedOption.value);
    formData.append('_token', '{{ csrf_token() }}');
    
    // Simpan semua jawaban yang sudah dipilih sebelumnya
    @foreach($savedAnswers as $qId => $answer)
        @if($qId != $question->id)
            formData.append('answers[{{ $qId }}]', '{{ $answer }}');
        @endif
    @endforeach

    fetch('{{ route("participant.quizzes.save-progress", $quiz) }}', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = "{{ route('participant.quizzes.start', ['quiz' => $quiz, 'question' => $currentQuestion + 1]) }}";
        }
    });
}

function submitQuiz() {
    const selectedOption = document.querySelector('input[name="answers[{{ $question->id }}]"]:checked');
    if (!selectedOption) {
        alert('Silakan pilih jawaban sebelum submit.');
        return false;
    }
    
    // Submit form secara manual dengan semua jawaban
    const form = document.createElement('form');
    form.action = "{{ route('participant.quizzes.submit', $quiz) }}";
    form.method = "POST";
    
    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);
    
    // Tambahkan jawaban saat ini
    const currentAnswer = document.createElement('input');
    currentAnswer.type = 'hidden';
    currentAnswer.name = 'answers[{{ $question->id }}]';
    currentAnswer.value = selectedOption.value;
    form.appendChild(currentAnswer);
    
    // Tambahkan jawaban yang sudah disimpan sebelumnya
    @foreach($savedAnswers as $qId => $answer)
        @if($qId != $question->id)
            const answer{{ $qId }} = document.createElement('input');
            answer{{ $qId }}.type = 'hidden';
            answer{{ $qId }}.name = 'answers[{{ $qId }}]';
            answer{{ $qId }}.value = '{{ $answer }}';
            form.appendChild(answer{{ $qId }});
        @endif
    @endforeach
    
    document.body.appendChild(form);
    form.submit();
    }
</script>
@endsection