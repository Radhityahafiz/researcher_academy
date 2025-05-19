@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf
                                    
                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                            class="form-control form-control-user"
                                            placeholder="Enter Email Address..." required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                    
                                    <!-- Password -->
                                    <div class="form-group">
                                        <x-text-input id="password" type="password" name="password" 
                                            class="form-control form-control-user"
                                            placeholder="Password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                    </div>
                                    
                                    <!-- Remember Me -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input id="remember_me" type="checkbox" class="custom-control-input" name="remember">
                                            <label class="custom-control-label" for="remember_me">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-teal btn-user btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </form>
                                
                                <hr>
                                
                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    </div>
                                @endif
                                
                                @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-login-image {
        background: url("{{ asset('Backend/img/undraw_education_f8ru.svg') }}");
        background-position: center;
        background-size: cover;
    }

    .btn-teal {
        background: linear-gradient(to right, #2980b9, #1abc9c);
        color: white;
        border: none;
    }

    .btn-teal:hover {
        background: linear-gradient(to right, #1abc9c, #2980b9);
        color: white;
    }
</style>
@endpush