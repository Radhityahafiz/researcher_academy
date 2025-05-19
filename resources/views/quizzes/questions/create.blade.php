@extends('layouts.app')

@section('title', 'Add Question to: ' . $quiz->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('quizzes.show', $quiz) }}">{{ $quiz->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Question</li>
                </ol>
            </nav>
            
            <h2>Add Question to: {{ $quiz->title }}</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('quizzes.questions.store', $quiz) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="question_text" class="form-label">Question Text</label>
                            <textarea class="form-control @error('question_text') is-invalid @enderror" id="question_text" name="question_text" rows="3" required>{{ old('question_text') }}</textarea>
                            @error('question_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="question_type" class="form-label">Question Type</label>
                            <select class="form-control @error('question_type') is-invalid @enderror" id="question_type" name="question_type" required>
                                <option value="">Select Question Type</option>
                                <option value="multiple_choice" {{ old('question_type') == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                                <option value="true_false" {{ old('question_type') == 'true_false' ? 'selected' : '' }}>True/False</option>
                            </select>
                            @error('question_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="points" class="form-label">Points</label>
                            <input type="number" class="form-control @error('points') is-invalid @enderror" id="points" name="points" value="{{ old('points', 1) }}" min="1" required>
                            @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="options-container">
                            <h5>Options</h5>
                            <div class="mb-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="correct_option" value="0" required>
                                    </div>
                                    <input type="text" class="form-control" name="options[0][text]" placeholder="Option text" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="correct_option" value="1">
                                    </div>
                                    <input type="text" class="form-control" name="options[1][text]" placeholder="Option text" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <button type="button" id="add-option" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-plus"></i> Add Option
                            </button>
                        </div>
                        
                        <button type="submit" class="btn btn-teal">Add Question</button>
                        <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questionType = document.getElementById('question_type');
        const optionsContainer = document.getElementById('options-container');
        const addOptionBtn = document.getElementById('add-option');
        let optionCount = 2;
        
        questionType.addEventListener('change', function() {
            if (this.value === 'true_false') {
                optionsContainer.innerHTML = `
                    <h5>Options</h5>
                    <div class="mb-3">
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="correct_option" value="0" required checked>
                            </div>
                            <input type="text" class="form-control" name="options[0][text]" value="True" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="correct_option" value="1">
                            </div>
                            <input type="text" class="form-control" name="options[1][text]" value="False" readonly>
                        </div>
                    </div>
                `;
            } else if (this.value === 'multiple_choice') {
                optionsContainer.innerHTML = `
                    <h5>Options</h5>
                    <div class="mb-3">
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="correct_option" value="0" required>
                            </div>
                            <input type="text" class="form-control" name="options[0][text]" placeholder="Option text" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="correct_option" value="1">
                            </div>
                            <input type="text" class="form-control" name="options[1][text]" placeholder="Option text" required>
                        </div>
                    </div>
                `;
                optionCount = 2;
                addOptionBtn.style.display = 'block';
            }
        });
        
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
    });
</script>

<style>
    .btn-teal {
        background: linear-gradient(to right, #2980b9, #1abc9c);
        color: white;
        border: none;
    }

    .btn-teal:hover {
        background: linear-gradient(to right, #1abc9c, #2980b9);
        color: white;
    }
</style>
@endsection