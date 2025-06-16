@extends('layouts.app')

@section('title', 'Buat Penugasan Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Buat Penugasan Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Judul Penugasan</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                           <div class="form-group">
                                <label for="file">Unggah File PDF, DOC, DOCX (Maks 2 MB) atau Tautan</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>
                            <small class="form-text text-muted">Atau</small>
                            <input type="url" class="form-control mt-2" name="external_link" placeholder="Masukkan tautan tugas" value="{{ old('external_link') }}">
                        </div>

                        <div class="form-group">
                            <label for="due_date">Batas Waktu</label>
                            <input type="datetime-local" class="form-control" id="due_date" name="due_date" 
                                   value="{{ old('due_date') }}" min="{{ now()->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="max_score">Nilai Maksimal</label>
                            <input type="number" class="form-control" id="max_score" name="max_score" 
                                   value="{{ old('max_score', 100) }}" min="1" max="1000" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection