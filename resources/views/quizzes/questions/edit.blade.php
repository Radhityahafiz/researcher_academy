@extends('layouts.app')

@section('title', 'Edit Question: ' . $question->question_text)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('quizzes.show', $quiz) }}">{{ $quiz->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Question</li>
                </ol>
            </nav>
            
            <h2>Edit Question</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('quizzes.questions.update', [$quiz, $question]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="question_text" class="form-label">Question Text</label>
                            <textarea class="form-control @error('question_text') is-invalid @enderror" id="question_text" name="question_text" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                            @error('question_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="question_type" class="form-label">Question Type</label>
                            <select class="form-control @error('question_type') is-invalid @enderror" id="question_type" name="question_type_display" readonly>
                                <option value="multiple_choice" {{ $question->question_type == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                                <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}>True/False</option>
                            </select>
                            <input type="hidden" name="question_type" value="{{ $question->question_type }}">
                            @error('question_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Question type cannot be changed after creation.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="points" class="form-label">Points</label>
                            <input type="number" class="form-control @error('points') is-invalid @enderror" id="points" name="points" value="{{ old('points', $question->points) }}" min="1" required>
                            @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="options-container">
                            <h5>Options</h5>
                            @foreach($question->options as $index => $option)
                                <div class="mb-3">
                                    <div class="input-group mb-2">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correct_option" value="{{ $index }}" {{ $option->is_correct ? 'checked' : '' }} required>
                                        </div>
                                        <input type="text" class="form-control" name="options[{{ $index }}][text]" value="{{ $option->option_text }}" {{ $question->question_type == 'true_false' ? 'readonly' : '' }} required>
                                        <input type="hidden" name="options[{{ $index }}][id]" value="{{ $option->id }}">
                                        @if($question->question_type == 'multiple_choice' && $index >= 2)
                                            <button type="button" class="btn btn-outline-danger remove-option">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($question->question_type == 'multiple_choice')
                            <div class="mb-3">
                                <button type="button" id="add-option" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus"></i> Add Option
                                </button>
                            </div>
                        @endif
                        
                        <button type="submit" class="btn btn-primary">Update Question</button>
                        <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if($question->question_type == 'multiple_choice')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const optionsContainer = document.getElementById('options-container');
        const addOptionBtn = document.getElementById('add-option');
        let optionCount = {{ $question->options->count() }};
        
        addOptionBtn.addEventListener('click', function() {
            const newOption = document.createElement('div');
            newOption.className = 'mb-3';
            newOption.innerHTML = `
                <div class="input-group mb-2">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" name="correct_option" value="${optionCount}">
                    </div>
                    <input type="text" class="form-control" name="options[${optionCount}][text]" placeholder="Option text" required>
                    <button type="button" class="btn btn-outline-danger remove-option">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            optionsContainer.appendChild(newOption);
            optionCount++;
            
            // Add event listener to remove button
            newOption.querySelector('.remove-option').addEventListener('click', function() {
                optionsContainer.removeChild(newOption);
            });
        });
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-option').forEach(button => {
            button.addEventListener('click', function() {
                optionsContainer.removeChild(button.closest('.mb-3'));
            });
        });
    });
</script>
@endif
@endsection