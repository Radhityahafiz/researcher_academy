@extends('layouts.participant')

@section('title', 'Buat Testimoni')

@section('content')
<a href="{{ route('testimonials.index') }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali</a>

<div class="testimonial-create-container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h3 class="fw-bold mb-0"><i class="fas fa-edit me-2"></i> Buat Testimoni</h3>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('testimonials.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            
                            <div class="mb-4">
                                <label for="rating" class="form-label fw-bold">Rating</label>
                                <div class="rating-input">
                                    <input type="hidden" name="rating" id="rating-value" value="{{ old('rating', 0) }}" required>
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star fa-2x star" data-value="{{ $i }}" style="color: #ddd; cursor: pointer;"></i>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="content" class="form-label fw-bold">Testimoni Anda</label>
                                <textarea name="content" id="content" rows="6" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                                <div class="form-text">Bagikan pengalaman belajar Anda (minimal 20 karakter, maksimal 500 karakter)</div>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <a href="{{ route('testimonials.index') }}" class="btn btn-outline-secondary mb-3 mb-sm-0">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Testimoni
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection