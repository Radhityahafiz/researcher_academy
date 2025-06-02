@extends('layouts.app')

@section('title', 'Quizzes')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <h2>Quizzes</h2>
        </div>
        @if(auth()->user()->isMentor())
            <div class="col-md-6 text-end">
                <a href="{{ route('quizzes.create') }}" class="btn btn-teal">
                    <i class="fas fa-plus"></i> Create Quiz
                </a>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Passing Score</th>
                            <th>Created By</th>
                            <th>Questions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quizzes as $quiz)
                            <tr>
                                <td>{{ $quiz->title }}</td>
                                <td>{{ $quiz->category->name ?? 'Uncategorized' }}</td>
                                <td>{{ $quiz->passing_score }}%</td>
                                <td>{{ $quiz->creator->full_name }}</td>
                                <td>{{ $quiz->questions()->count() }}</td>
                                <td>
                                    <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if(auth()->user()->isMentor())
                                        <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        @if(!$quiz->attempts()->where('user_id', auth()->id())->exists())
                                            <a href="{{ route('quizzes.start', $quiz) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-play"></i> Start Quiz
                                            </a>
                                        @else
                                            <span class="badge bg-secondary">Completed</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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