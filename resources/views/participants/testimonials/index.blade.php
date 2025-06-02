@extends('layouts.participant')

@section('title', 'Testimoni Peserta')

@section('content')
<div class="testimonials-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-bold mb-0"><i class="fas fa-comments me-2"></i> Testimoni Peserta</h3>
                                <p class="mb-0 mt-1">Bagikan pengalaman belajar Anda dengan peserta lain</p>
                            </div>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill">
                                {{ $testimonials->total() }} Testimoni
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('info'))
                            <div class="alert alert-info alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                                <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <a href="{{ route('testimonials.create') }}" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-plus me-2"></i>Tambah Testimoni
                            </a>
                        </div>

                        @if($testimonials->isEmpty())
                            <div class="empty-state text-center py-5">
                                <div class="empty-state-icon mb-4">
                                    <i class="fas fa-comment-slash fa-4x text-muted opacity-25"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Belum ada testimoni yang disetujui</h4>
                                <p class="text-muted mb-4">Jadilah yang pertama membagikan pengalaman belajar Anda</p>
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach($testimonials as $testimonial)
                                    <div class="col-md-6 animate__animated animate__fadeIn">
                                        <div class="card testimonial-card h-100 border-0 shadow-sm">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="avatar bg-primary text-white rounded-circle me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: bold;">
                                                        {{ substr($testimonial->user->full_name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-bold mb-0">{{ $testimonial->user->full_name }}</h5>
                                                        <div class="text-muted small">
                                                            {{ $testimonial->created_at->format('d M Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="rating mb-3">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                    @endfor
                                                </div>
                                                
                                                <p class="testimonial-content">{{ $testimonial->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $testimonials->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .testimonials-container {
        padding: 3rem 0;
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 12px 12px 0 0 !important;
    }
    
    .testimonial-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .rating {
        color: #ffc107;
        font-size: 1.1rem;
    }
    
    .testimonial-content {
        line-height: 1.6;
        color: #555;
    }
    
    .empty-state {
        padding: 3rem 1rem;
    }
    
    .empty-state-icon i {
        opacity: 0.3;
    }
    
    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .pagination .page-link {
        color: var(--primary-color);
    }
</style>
@endsection