@extends('layouts.app')

@section('title', 'Detail Testimoni')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Testimoni</h6>
                    <a href="{{ route('testimonials.dashboard') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="avatar bg-primary text-white rounded-circle me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: bold;">
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
                                    
                                    <div class="testimonial-content mb-4">
                                        <p class="lead">{{ $testimonial->content }}</p>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge 
                                            {{ $testimonial->status == 'approved' ? 'badge-success' : 
                                               ($testimonial->status == 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                            {{ $testimonial->status }}
                                        </span>
                                        
                                        <div class="d-flex">
                                            @if($testimonial->status != 'approved')
                                                <a href="{{ route('testimonials.approve', $testimonial) }}" class="btn btn-sm btn-success me-2" title="Setujui">
                                                    <i class="fas fa-check me-1"></i> Setujui
                                                </a>
                                            @endif
                                            
                                            @if($testimonial->status != 'rejected')
                                                <a href="{{ route('testimonials.reject', $testimonial) }}" class="btn btn-sm btn-danger me-2" title="Tolak">
                                                    <i class="fas fa-times me-1"></i> Tolak
                                                </a>
                                            @endif
                                            
                                            <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection