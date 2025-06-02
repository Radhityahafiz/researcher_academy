@extends('layouts.participant')

@section('title', 'Buat Testimoni')

@section('content')
<div class="testimonial-create-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h3 class="fw-bold mb-0"><i class="fas fa-edit me-2"></i> Buat Testimoni</h3>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('testimonials.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            
                            <div class="mb-4">
                                <label for="rating" class="form-label fw-bold">Rating</label>
                                <div class="rating-input">
                                    <input type="hidden" name="rating" id="rating-value" value="{{ old('rating') }}" required>
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star fa-2x star @if(old('rating') && $i <= old('rating')) active @endif" data-value="{{ $i }}"></i>
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
                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('testimonials.index') }}" class="btn btn-outline-secondary">
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

<style>
    .testimonial-create-container {
        padding: 3rem 0;
    }
    
    .rating-input .stars {
        display: flex;
        gap: 10px;
    }
    
    .rating-input .star {
        color: #ddd;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .rating-input .star:hover,
    .rating-input .star.active {
        color: #ffc107;
        transform: scale(1.1);
    }
    
    .rating-input .star:hover ~ .star,
    .rating-input .star.active ~ .star {
        color: #ddd;
    }
    
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Star rating interaction
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('rating-value');
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingValue.value = value;
                
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });
        
        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
@endsection