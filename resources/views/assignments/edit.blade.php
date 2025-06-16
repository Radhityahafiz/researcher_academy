@extends('layouts.app')

@section('title', 'Edit Penugasan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Penugasan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('assignments.update', $assignment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $assignment->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Judul Penugasan</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $assignment->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ $assignment->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>File/Link Saat Ini</label>
                            @if($assignment->file_path)
                                <div class="mb-2">
                                    <a href="{{ $assignment->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> {{ basename($assignment->file_path) }}
                                    </a>
                                    <input type="hidden" id="remove_file" name="remove_file" value="0">
                                </div>
                            @elseif($assignment->external_link)
                                <div class="mb-2">
                                    <a href="{{ $assignment->external_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt"></i> {{ $assignment->external_link }}
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('remove_link').value = '1'">
                                        <i class="fas fa-trash"></i> Hapus Link
                                    </button>
                                    <input type="hidden" id="remove_link" name="remove_link" value="0">
                                </div>
                            @else
                                <p class="text-muted">Tidak ada file/link</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Upload File Baru PDF, DOC, DOCX (Maks 2 MB) atau Tautan</label>
                            <div class="form-group">
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>
                            <small class="form-text text-muted">Atau</small>
                            <input type="url" class="form-control mt-2" name="external_link" placeholder="Masukkan tautan tugas">
                        </div>

                        <div class="form-group">
                            <label for="due_date">Batas Waktu</label>
                            <input type="datetime-local" class="form-control" id="due_date" name="due_date" 
                                   value="{{ $assignment->due_date->format('Y-m-d\TH:i') }}" min="{{ now()->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="max_score">Nilai Maksimal</label>
                            <input type="number" class="form-control" id="max_score" name="max_score" 
                                   value="{{ $assignment->max_score }}" min="1" max="1000" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection