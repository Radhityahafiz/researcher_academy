@extends('layouts.app')

@section('title', 'Take Quiz: ' . $quiz->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ $quiz->title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('quizzes.submit', $quiz) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <p>{{ $quiz->description }}</p>
                            <p><strong>Passing Score:</strong> {{ $quiz->passing_score }}%</p>
                        </div>
                        
                        @foreach($quiz->questions as $question)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>{{ $loop->iteration }}. {{ $question->question_text }}</h5>
                                    <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $question->question_type)) }}</span>
                                    <span class="badge bg-info">{{ $question->points }} point(s)</span>
                                </div>
                                <div class="card-body">
                                    @if($question->question_type === 'true_false')
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="option_true_{{ $question->id }}" value="{{ $question->options->where('option_text', 'True')->first()->id }}" required>
                                            <label class="form-check-label" for="option_true_{{ $question->id }}">True</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="option_false_{{ $question->id }}" value="{{ $question->options->where('option_text', 'False')->first()->id }}">
                                            <label class="form-check-label" for="option_false_{{ $question->id }}">False</label>
                                        </div>
                                    @else
                                        @foreach($question->options as $option)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="option_{{ $option->id }}" value="{{ $option->id }}" required>
                                                <label class="form-check-label" for="option_{{ $option->id }}">{{ $option->option_text }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Quiz</button>
                            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection