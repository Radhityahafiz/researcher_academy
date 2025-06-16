@extends('layouts.app')

@section('title', 'Detail Pengumpulan Tugas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Detail Pengumpulan Tugas: {{ $submission->assignment->title }}
                    </h6>
                    <span class="badge badge-{{ $submission->passed() ? 'success' : 'danger' }}">
                        {{ $submission->score ?? 'Belum dinilai' }}/{{ $submission->assignment->max_score }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informasi Peserta</h5>
                            <p>
                                <strong>Nama:</strong> {{ $submission->user->full_name }}<br>
                                <strong>Tanggal Kumpul:</strong> {{ \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y H:i') }}<br>
                                <strong>Status:</strong> 
                                <span class="badge badge-{{ $submission->passed() ? 'success' : ($submission->score !== null ? 'danger' : 'info') }}">
                                    {{ $submission->status }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Informasi Tugas</h5>
                            <p>
                                <strong>Kategori:</strong> {{ $submission->assignment->category->name }}<br>
                                <strong>Batas Waktu:</strong> {{ \Carbon\Carbon::parse($submission->assignment->due_date)->format('d M Y H:i') }}<br>
                                <strong>Nilai Maksimal:</strong> {{ $submission->assignment->max_score }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Isi Tugas</h5>
                        @if($submission->submission_text)
                            <div class="border p-3 rounded bg-light mb-3">
                                {!! $submission->submission_text !!}
                            </div>
                        @endif

                        @if($submission->file_path)
                            <a href="{{ $submission->file_url }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-download"></i> Unduh File Tugas
                            </a>
                        @elseif($submission->external_link)
                            <a href="{{ $submission->external_link }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Buka Link Tugas
                            </a>
                        @endif
                    </div>

                    <form action="{{ route('assignments.grade', $submission) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="score">Nilai (0-{{ $submission->assignment->max_score }})</label>
                            <input type="number" class="form-control" id="score" name="score" 
                                   min="0" max="{{ $submission->assignment->max_score }}" 
                                   value="{{ $submission->score ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Umpan Balik (Opsional)</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="5">{{ $submission->feedback ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                        <a href="{{ route('assignments.show', $submission->assignment) }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection