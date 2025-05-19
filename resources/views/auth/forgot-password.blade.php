@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                </div>
                                
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                
                                <form method="POST" action="{{ route('password.email') }}" class="user">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                            class="form-control form-control-user"
                                            placeholder="Enter Email Address..." required autofocus />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                    
                                    <button type="submit" class="btn btn-teal btn-user btn-block">
                                        {{ __('Email Password Reset Link') }}
                                    </button>
                                </form>
                                
                                <hr>
                                
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
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

@push('styles')
<style>
    .bg-password-image {
        background: url("{{ asset('img/undraw_forgot_password_re_hxwm.svg') }}");
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