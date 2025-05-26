@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4 p-sm-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 80px;">
                        <h2 class="h4 mt-3 mb-0 font-weight-bold">Welcome to Research Academy</h2>
                    </div>
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-3" :status="session('status')" />
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label small font-weight-bold">Email Address</label>
                            <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                class="form-control"
                                placeholder="Enter your email address" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label small font-weight-bold">Password</label>
                            <x-text-input id="password" type="password" name="password" 
                                class="form-control"
                                placeholder="Enter your password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small" />
                        </div>
                        
                        
                        
                        <button type="submit" class="btn btn-teal w-100 py-2 font-weight-bold">
                            {{ __('Login') }}
                        </button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="text-center small">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none text-teal" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                        @endif
                        
                        @if (Route::has('register'))
                            <div class="mt-2">
                                <span class="text-muted">Don't have an account?</span>
                                <a class="text-decoration-none text-teal font-weight-bold ml-1" href="{{ route('register') }}">Create one!</a>
                            </div>
                        @endif
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
        padding-top: 80px;
    }
    
    .btn-teal {
        background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%);
        color: white;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-teal:hover {
        background: linear-gradient(135deg, #16a085 0%, #2980b9 100%);
        color: white;
    }
    
    .text-teal {
        color: #1abc9c;
    }
    
    .card {
        border: none;
    }
    
    .form-control {
        border-radius: 6px;
        padding: 0.5rem 1rem;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
        border-color: #1abc9c;
    }
    
    .form-check-input:checked {
        background-color: #1abc9c;
        border-color: #1abc9c;
    }
    
    hr {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
</style>
@endpush