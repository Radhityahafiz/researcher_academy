@extends('layouts.app')

@section('title', 'Daftar Penugasan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penugasan</h6>
                    <a href="{{ route('assignments.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Penugasan
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Batas Waktu</th>
                                    <th>Jumlah Pengumpulan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $assignment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $assignment->title }}</td>
                                    <td>{{ $assignment->category->name }}</td>
                                    <td class="{{ $assignment->isPastDue() ? 'text-danger' : '' }}">
                                        {{ $assignment->due_date->format('d M Y H:i') }}
                                    </td>
                                    <td>{{ $assignment->submissions->count() }}</td>
                                    <td>
                                        <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus penugasan ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $assignments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection