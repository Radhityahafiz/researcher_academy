@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 60px;">
                        <h2 class="h5 mt-2 mb-1 font-weight-bold">Reset Password</h2>
                        <p class="small text-muted">Enter your email to receive reset link</p>
                    </div>
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-3 small" :status="session('status')" />
                    
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label small font-weight-bold">Email Address</label>
                            <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                class="form-control form-control-sm"
                                placeholder="your@email.com" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                        </div>
                        
                        <button type="submit" class="btn btn-teal w-100 btn-sm py-2 mb-3">
                            {{ __('Send Reset Link') }}
                        </button>
                    </form>
                    
                    <div class="text-center small">
                        <a class="text-decoration-none text-teal font-weight-bold" href="{{ route('login') }}">
                            Back to Login
                        </a>
                        <span class="mx-2 text-muted">|</span>
                        <a class="text-decoration-none text-teal font-weight-bold" href="{{ route('register') }}">
                            Create Account
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-teal {
        background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%);
        min-height: 100vh;
        padding: 1rem;
        display: flex;
        align-items: center;
    }
    
    .btn-teal {
        background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%);
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .btn-teal:hover {
        background: linear-gradient(135deg, #16a085 0%, #2980b9 100%);
    }
    
    .form-control-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
    }
    
    .text-teal {
        color: #1abc9c;
    }
</style>
@endpush