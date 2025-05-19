@extends('layouts.app')

@section('title', $quiz->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('quizzes.index') }}">Quizzes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $quiz->title }}</li>
                </ol>
            </nav>
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $quiz->title }}</h4>
                        <div>
                            @if(auth()->user()->isMentor())
                                <a href="{{ route('quizzes.questions.create', $quiz) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Add Question
                                </a>
                                <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @elseif(!$quiz->attempts()->where('user_id', auth()->id())->exists())
                                <a href="{{ route('quizzes.start', $quiz) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-play"></i> Start Quiz
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Details</h5>
                        <ul class="list-unstyled">
                            <li><strong>Description:</strong> {{ $quiz->description ?? 'No description provided.' }}</li>
                            <li><strong>Passing Score:</strong> {{ $quiz->passing_score }}%</li>
                            <li><strong>Created By:</strong> {{ $quiz->creator->full_name }}</li>
                            <li><strong>Created At:</strong> {{ $quiz->created_at->format('d M Y, H:i') }}</li>
                            <li><strong>Questions:</strong> {{ $quiz->questions()->count() }}</li>
                        </ul>
                    </div>
                    
                    @if(auth()->user()->isMentor() || $quiz->attempts()->where('user_id', auth()->id())->exists())
                        <div class="mb-4">
                            <h5>Questions</h5>
                            @if($quiz->questions->isEmpty())
                                <div class="alert alert-info">No questions added yet.</div>
                            @else
                                <div class="list-group">
                                    @foreach($quiz->questions as $question)
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>{{ $loop->iteration }}. {{ $question->question_text }}</strong>
                                                    <div class="mt-2">
                                                        <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $question->question_type)) }}</span>
                                                        <span class="badge bg-info">{{ $question->points }} point(s)</span>
                                                    </div>
                                                    
                                                    @if($question->options->isNotEmpty())
                                                        <ul class="mt-2">
                                                            @foreach($question->options as $option)
                                                                <li class="{{ $option->is_correct ? 'text-success fw-bold' : '' }}">
                                                                    {{ $option->option_text }}
                                                                    @if($option->is_correct)
                                                                        <i class="fas fa-check"></i>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                                
                                                @if(auth()->user()->isMentor())
                                                    <div>
                                                        <a href="{{ route('quizzes.questions.edit', [$quiz, $question]) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('quizzes.questions.destroy', [$quiz, $question]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    @if(auth()->user()->isMentor())
                        <div class="mb-4">
                            <h5>Attempts</h5>
                            @if($quiz->attempts->isEmpty())
                                <div class="alert alert-info">No attempts yet.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Score</th>
                                                <th>Status</th>
                                                <th>Completed At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($quiz->attempts as $attempt)
                                                <tr>
                                                    <td>{{ $attempt->user->full_name }}</td>
                                                    <td>{{ $attempt->score }}%</td>
                                                    <td>
                                                        @if($attempt->score >= $quiz->passing_score)
                                                            <span class="badge bg-success">Passed</span>
                                                        @else
                                                            <span class="badge bg-danger">Failed</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $attempt->completed_at->format('d M Y, H:i') }}</td>
                                                    <td>
                                                        <a href="{{ route('quizzes.result', $attempt) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection