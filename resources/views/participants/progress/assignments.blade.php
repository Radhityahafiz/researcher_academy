@extends('layouts.participant')

@section('title', 'Tugas Diselesaikan')

@section('content')
<a href="{{ route('welcome') }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali</a>

<div class="completed-assignments-container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <h3 class="fw-bold mb-0"><i class="fas fa-tasks me-2"></i> Tugas Diselesaikan</h3>
                                <p class="mb-0 mt-1">Daftar tugas yang telah Anda kerjakan</p>
                            </div>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill">
                                {{ $submissions->count() }} Tugas
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        @if($submissions->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($submissions as $submission)
                            <div class="list-group-item border-0 p-3 p-md-4 {{ $loop->last ? '' : 'border-bottom' }} animate__animated animate__fadeIn">
                                <div class="d-flex flex-column flex-md-row align-items-start">
                                    <div class="assignment-icon mb-3 mb-md-0 me-md-3">
                                        <div class="icon-wrapper 
                                            {{ $submission->passed() ? 'bg-success' : ($submission->score !== null ? 'bg-danger' : 'bg-secondary') }} 
                                            bg-opacity-10 p-2 p-md-3 rounded-circle">
                                            <i class="fas 
                                                {{ $submission->passed() ? 'fa-check-circle text-success' : 
                                                   ($submission->score !== null ? 'fa-times-circle text-danger' : 'fa-clock text-secondary') }} 
                                                fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 me-md-3">
                                        <h5 class="fw-bold mb-2">{{ $submission->assignment->title }}</h5>
                                        <div class="assignment-meta d-flex flex-wrap gap-2 mb-3">
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                <i class="fas fa-folder-open me-1"></i> 
                                                {{ $submission->assignment->category->name ?? 'Tanpa Kategori' }}
                                            </span>
                                            <span class="badge 
                                                {{ $submission->passed() ? 'bg-success' : 
                                                   ($submission->score !== null ? 'bg-danger' : 'bg-secondary') }} 
                                                bg-opacity-10 
                                                {{ $submission->passed() ? 'text-success' : 
                                                   ($submission->score !== null ? 'text-danger' : 'text-secondary') }}">
                                                <i class="fas 
                                                    {{ $submission->passed() ? 'fa-check' : 
                                                       ($submission->score !== null ? 'fa-times' : 'fa-clock') }} 
                                                    me-1"></i>
                                                {{ $submission->status }}
                                            </span>
                                            @if($submission->score !== null)
                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                <i class="fas fa-star me-1"></i> 
                                                Nilai: {{ $submission->score }}/{{ $submission->assignment->max_score }}
                                            </span>
                                            @endif
                                        </div>
                                        <p class="text-muted mb-0">
                                            <strong>Tanggal Pengumpulan:</strong> 
                                            {{ $submission->submitted_at->format('d M Y H:i') }}
                                        </p>
                                        @if($submission->feedback)
                                        <div class="feedback mt-2 p-2 bg-light rounded">
                                            <strong>Feedback Mentor:</strong>
                                            <p class="mb-0">{{ $submission->feedback }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="mt-3 mt-md-0 ms-md-3">
                                        <a href="{{ route('participant.assignments.show', $submission->assignment) }}" class="btn btn-outline-primary px-3">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="empty-state text-center py-5">
                            <div class="empty-state-icon mb-4">
                                <i class="fas fa-tasks fa-4x text-muted opacity-25"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Belum ada tugas yang dikumpulkan</h4>
                            <p class="text-muted mb-4">Kerjakan tugas sekarang untuk melihat progres belajar Anda</p>
                            <a href="{{ route('participant.assignments.index') }}" class="btn btn-primary px-4">
                                <i class="fas fa-tasks me-2"></i> Lihat Tugas
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    @if($submissions->count() > 0)
                    <div class="card-footer bg-light border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Menampilkan {{ $submissions->count() }} tugas
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection