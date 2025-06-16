@extends('layouts.participant')

@section('title', $assignment->title)

@section('content')
<a href="{{ route('participant.categories.show', $assignment->category) }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali
</a>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-tasks me-2 text-primary"></i> {{ $assignment->title }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-primary fw-bold mb-3">
                            <i class="fas fa-align-left me-2"></i> Deskripsi Tugas
                        </h5>
                        <div class="border p-3 rounded bg-light bg-opacity-10">
                            {!! $assignment->description !!}
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-primary fw-bold mb-3">
                            <i class="fas fa-info-circle me-2"></i> Detail Tugas
                        </h5>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 py-3">
                                <div>
                                    <i class="fas fa-folder me-2 text-muted"></i> Kategori
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    {{ $assignment->category->name }}
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 py-3">
                                <div>
                                    <i class="fas fa-calendar-alt me-2 text-muted"></i> Batas Waktu
                                </div>
                                <span class="badge bg-{{ $assignment->isPastDue() ? 'danger' : 'primary' }} bg-opacity-10 text-{{ $assignment->isPastDue() ? 'danger' : 'primary' }}">
                                    {{ $assignment->due_date->format('d M Y H:i') }}
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 py-3">
                                <div>
                                    <i class="fas fa-star me-2 text-muted"></i> Nilai Maksimal
                                </div>
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    {{ $assignment->max_score }} Poin
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($assignment->file_path)
                        <div class="mb-3">
                            <a href="{{ $assignment->file_url }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-download me-2"></i> Unduh File Tugas
                            </a>
                        </div>
                    @elseif($assignment->external_link)
                        <div class="mb-3">
                            <a href="{{ $assignment->external_link }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i> Buka Link Tugas
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-paper-plane me-2 text-primary"></i> Pengumpulan Tugas
                    </h5>
                </div>
                <div class="card-body">
                    @if($submission && $submission->submitted_at)
                        <div class="alert alert-success bg-opacity-10 border-0">
                            <i class="fas fa-check-circle me-2"></i> Anda sudah mengumpulkan tugas ini
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Detail Pengumpulan:</h6>
                            @if($submission->file_path)
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-file-alt fa-2x text-muted me-3"></i>
                                    <div>
                                        <p class="mb-0 fw-bold">File Tugas</p>
                                        <a href="{{ $submission->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            @elseif($submission->external_link)
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-link fa-2x text-muted me-3"></i>
                                    <div>
                                        <p class="mb-0 fw-bold">Link Tugas</p>
                                        <a href="{{ $submission->external_link }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-external-link-alt me-1"></i> Buka
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if($submission->submission_text)
                                <div class="border p-3 rounded bg-light bg-opacity-10 mb-3">
                                    <h6 class="fw-bold mb-2">Deskripsi:</h6>
                                    {!! $submission->submission_text !!}
                                </div>
                            @endif
                        </div>

                        @if($submission->score !== null)
                            <div class="alert alert-info bg-opacity-10 border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold">Nilai:</h6>
                                    <span class="badge bg-info bg-opacity-25 text-info fs-6">
                                        {{ $submission->score }}/{{ $assignment->max_score }}
                                    </span>
                                </div>
                                @if($submission->feedback)
                                    <hr>
                                    <p class="mb-0"><strong>Feedback:</strong> {{ $submission->feedback }}</p>
                                @endif
                            </div>
                        @else
                            <div class="alert alert-warning bg-opacity-10 border-0">
                                <i class="fas fa-clock me-2"></i> Tugas Anda belum dinilai
                            </div>
                        @endif
                    @else
                        @if($assignment->isPastDue())
                            <div class="alert alert-danger bg-opacity-10 border-0">
                                <i class="fas fa-exclamation-triangle me-2"></i> Batas waktu pengumpulan sudah lewat
                            </div>
                        @else
                            <form action="{{ route('participant.assignments.submit', $assignment) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="submission_text" class="form-label fw-bold">Deskripsi (Opsional)</label>
                                    <textarea class="form-control" id="submission_text" name="submission_text" rows="3">{{ old('submission_text') }}</textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">Upload File atau Link</label>
                                    <div class="file-upload-wrapper mb-2">
                                        <input type="file" class="form-control" id="file" name="file">
                                        <small class="text-muted">Format: PDF, DOC, DOCX (Maks: 2MB)</small>
                                    </div>
                                    <div class="text-center text-muted my-2">— atau —</div>
                                    <input type="url" class="form-control" name="external_link" placeholder="Masukkan link tugas" value="{{ old('external_link') }}">
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                    <i class="fas fa-paper-plane me-2"></i> Kumpulkan Tugas
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection