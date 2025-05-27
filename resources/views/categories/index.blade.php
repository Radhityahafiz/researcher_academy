@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <h2>Categories</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('categories.create') }}" class="btn btn-teal">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Materials</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    @if($category->thumbnail)
                                        <img src="{{ $category->thumbnail_url }}" alt="{{ $category->name }}" style="max-height: 50px;">
                                    @else
                                        <span class="text-muted">No thumbnail</span>
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->materials()->count() }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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