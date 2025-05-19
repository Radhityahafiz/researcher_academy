@extends('layouts.app')

@section('title', 'Quiz Result: ' . $attempt->quiz->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Quiz Result: {{ $attempt->quiz->title }}</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-{{ $attempt->passed() ? 'success' : 'danger' }}">
                        <h4 class="alert-heading">
                            {{ $attempt->passed() ? 'Congratulations!' : 'Try Again!' }}
                        </h4>
                        <p>
                            Your score: <strong>{{ $attempt->score }}%</strong> 
                            (Passing score: {{ $attempt->quiz->passing_score }}%)
                        </p>
                        <p>Completed at: {{ $attempt->completed_at ? $attempt->completed_at->format('d M Y, H:i') : 'Not completed' }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Questions and Answers</h5>
                        @foreach($attempt->quiz->questions as $question)
                            @php
                                $answer = $attempt->answers->where('question_id', $question->id)->first();
                                $isCorrect = $answer ? $answer->is_correct : false;
                                $correctOption = $question->options->where('is_correct', true)->first();
                            @endphp
                            
                            <div class="card mb-3 border-{{ $isCorrect ? 'success' : 'danger' }}">
                                <div class="card-header bg-{{ $isCorrect ? 'success' : 'danger' }} text-white">
                                    <h5>{{ $loop->iteration }}. {{ $question->question_text }}</h5>
                                    <span class="badge bg-light text-dark">{{ $question->points }} point(s)</span>
                                </div>
                                <div class="card-body">
                                    <p><strong>Your Answer:</strong> 
                                        <span class="{{ $isCorrect ? 'text-success' : 'text-danger' }}">
                                            {{ $answer && $answer->option ? $answer->option->option_text : 'No answer' }}
                                            @if($isCorrect)
                                                <i class="fas fa-check"></i>
                                            @else
                                                <i class="fas fa-times"></i>
                                            @endif
                                        </span>
                                    </p>
                                    
                                    @if(!$isCorrect && $correctOption)
                                        <p><strong>Correct Answer:</strong> 
                                            <span class="text-success">
                                                {{ $correctOption->option_text }}
                                                <i class="fas fa-check"></i>
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Back to Quizzes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection