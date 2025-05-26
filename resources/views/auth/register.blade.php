@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 60px;">
                        <h2 class="h5 mt-2 mb-0 font-weight-bold">Create Account</h2>
                        <p class="small text-muted mt-1">Join our Research Academy</p>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="row g-2">
                            <!-- Full Name -->
                            <div class="col-12 mb-2">
                                <label for="full_name" class="form-label small font-weight-bold">Full Name</label>
                                <x-text-input id="full_name" type="text" name="full_name" :value="old('full_name')" 
                                    class="form-control form-control-sm"
                                    placeholder="Your name" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('full_name')" class="mt-1 text-danger small" />
                            </div>
                            
                            <!-- Username -->
                            <div class="col-12 mb-2">
                                <label for="username" class="form-label small font-weight-bold">Username</label>
                                <x-text-input id="username" type="text" name="username" :value="old('username')" 
                                    class="form-control form-control-sm"
                                    placeholder="Username" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('username')" class="mt-1 text-danger small" />
                            </div>
                            
                            <!-- Email -->
                            <div class="col-12 mb-2">
                                <label for="email" class="form-label small font-weight-bold">Email</label>
                                <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                    class="form-control form-control-sm"
                                    placeholder="your@email.com" required autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                            </div>
                            
                            <!-- Password -->
                            <div class="col-md-6 mb-2">
                                <label for="password" class="form-label small font-weight-bold">Password</label>
                                <x-text-input id="password" type="password" name="password" 
                                    class="form-control form-control-sm"
                                    placeholder="••••••" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small" />
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-2">
                                <label for="password_confirmation" class="form-label small font-weight-bold">Confirm</label>
                                <x-text-input id="password_confirmation" type="password" name="password_confirmation" 
                                    class="form-control form-control-sm"
                                    placeholder="••••••" required autocomplete="new-password" />
                            </div>
                            
                            <!-- Role -->
                            <div class="col-12 mb-3">
                                <label for="role" class="form-label small font-weight-bold">Role</label>
                                <select id="role" name="role" class="form-select form-select-sm" required>
                                    <option value="">Select role</option>
                                    <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                                    <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-1 text-danger small" />
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-teal w-100 btn-sm py-2 mb-2">
                            {{ __('Register') }}
                        </button>
                    </form>
                    
                    <div class="text-center small mt-3">
                        <span class="text-muted">Already registered?</span>
                        <a class="text-decoration-none text-teal font-weight-bold ms-1" href="{{ route('login') }}">Sign in</a>
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
    
    .card {
        max-height: calc(100vh - 2rem);
        overflow-y: auto;
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
    
    .form-control-sm, .form-select-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
    }
    
    .text-teal {
        color: #1abc9c;
    }
</style>
@endpush