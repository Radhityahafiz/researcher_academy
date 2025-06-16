@extends('layouts.participant')

@section('title', 'Materi Diselesaikan')

@section('content')
<a href="{{ route('welcome') }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali</a>
    
<div class="completed-materials-container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <h3 class="fw-bold mb-0"><i class="fas fa-book-open me-2"></i> Materi Diselesaikan</h3>
                                <p class="mb-0 mt-1">Daftar materi yang telah Anda selesaikan</p>
                            </div>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill">
                                {{ $completedMaterials->count() }} Materi
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        @if($completedMaterials->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($completedMaterials as $material)
                            <div class="list-group-item border-0 p-3 p-md-4 {{ $loop->last ? '' : 'border-bottom' }} animate__animated animate__fadeIn">
                                <div class="d-flex flex-column flex-md-row align-items-start">
                                    <div class="material-icon mb-3 mb-md-0 me-md-3">
                                        <div class="icon-wrapper bg-success bg-opacity-10 p-2 p-md-3 rounded-circle">
                                            <i class="fas fa-check-circle text-success fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 me-md-3">
                                        <h5 class="fw-bold mb-2">{{ $material->title }}</h5>
                                        <div class="material-meta d-flex flex-wrap gap-2 mb-3">
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                <i class="fas fa-folder-open me-1"></i> 
                                                {{ $material->category->name ?? 'Tanpa Kategori' }}
                                            </span>
                                            @if($material->pivot->completed_at)
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                <i class="far fa-clock me-1"></i>
                                                Selesai: {{ $material->pivot->completed_at->format('d M Y') }}
                                            </span>
                                            @endif
                                        </div>
                                        <p class="text-muted mb-0">{{ Str::limit($material->description, 150) }}</p>
                                    </div>
                                    <div class="mt-3 mt-md-0 ms-md-3">
                                        <a href="{{ route('participant.materials.show', $material) }}" class="btn btn-outline-primary px-3">
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
                                <i class="fas fa-book fa-4x text-muted opacity-25"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Belum ada materi yang diselesaikan</h4>
                            <p class="text-muted mb-4">Mulai pelajari materi sekarang untuk melihat progres belajar Anda</p>
                            <a href="{{ route('welcome') }}" class="btn btn-primary px-4">
                                <i class="fas fa-book-reader me-2"></i> Jelajahi Materi
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    @if($completedMaterials->count() > 0)
                    <div class="card-footer bg-light border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Menampilkan {{ $completedMaterials->count() }} materi
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