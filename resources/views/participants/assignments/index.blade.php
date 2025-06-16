@extends('layouts.participant')

@section('title', 'Daftar Tugas')

@section('content')
<a href="{{ route('welcome') }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali
</a>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-tasks me-2 text-primary"></i> Daftar Tugas
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($assignments->count() > 0)
                        <div class="row g-4">
                            @foreach($assignments as $assignment)
                                @php
                                    $submission = $assignment->submissions->first();
                                @endphp
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 animate__animated animate__fadeIn">
                                    <div class="card assignment-card h-100">
                                        <div class="card-body">
                                            <div class="assignment-icon mb-3 text-center">
                                                <i class="fas fa-tasks fa-3x text-primary opacity-75"></i>
                                            </div>
                                            <h5 class="card-title fw-bold">{{ Str::limit($assignment->title, 50) }}</h5>
                                            <p class="card-text text-muted">{{ Str::limit($assignment->description, 100) }}</p>
                                            
                                            <div class="assignment-meta mb-3">
                                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                                    <i class="fas fa-clock me-1"></i> {{ $assignment->due_date->format('d M Y') }}
                                                </span>
                                                <span class="badge bg-info bg-opacity-10 text-info">
                                                    <i class="fas fa-star me-1"></i> {{ $assignment->max_score }} Poin
                                                </span>
                                            </div>
                                            
                                            <div class="mt-auto pt-3">
                                                @if($submission)
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="badge bg-{{ $submission->passed() ? 'success' : ($submission->score !== null ? 'danger' : 'info') }} bg-opacity-10 text-{{ $submission->passed() ? 'success' : ($submission->score !== null ? 'danger' : 'info') }}">
                                                            <i class="fas fa-{{ $submission->passed() ? 'trophy' : ($submission->score !== null ? 'times' : 'check') }} me-1"></i> 
                                                            @if($submission->score !== null)
                                                                {{ $submission->score }}%
                                                            @else
                                                                Terkumpul
                                                            @endif
                                                        </span>
                                                        <a href="{{ route('participant.assignments.show', $assignment) }}" class="btn btn-outline-primary btn-sm">
                                                            Lihat
                                                        </a>
                                                    </div>
                                                @else
                                                    <a href="{{ route('participant.assignments.show', $assignment) }}" class="btn btn-primary w-100">
                                                        <i class="fas fa-eye me-2"></i> Lihat Tugas
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            {{ $assignments->links() }}
                        </div>
                    @else
                        <div class="empty-state text-center py-5">
                            <div class="empty-state-icon mb-4">
                                <i class="fas fa-tasks fa-4x text-muted opacity-25"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Belum ada tugas tersedia</h4>
                            <p class="text-muted mb-4">Tugas akan muncul di sini ketika tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection