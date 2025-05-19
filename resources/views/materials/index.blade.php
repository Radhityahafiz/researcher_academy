@extends('layouts.app')

@section('title', 'Materials')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <h2>Materials</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('materials.create') }}" class="btn btn-teal">
                <i class="fas fa-plus"></i> Add Material
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{ $material->title }}</td>
                                <td>{{ $material->category->name }}</td>
                                <td>{{ ucfirst($material->content_type) }}</td>
                                <td>{{ $material->creator->full_name }}</td>
                                <td>
                                    <a href="{{ route('materials.show', $material) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('materials.edit', $material) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('materials.destroy', $material) }}" method="POST" class="d-inline">
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