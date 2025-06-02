@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="login-full-bg">
    <div class="login-left-form">
        <div class="login-form-wrapper">
            <div class="text-center mb-4">
                <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 60px;">
                <h1 class="h4 text-white mb-1">Reset Password</h1>
                <p class="text-white small mb-3">Enter your email to receive reset link</p>
            </div>

            <x-auth-session-status class="mb-3 alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="email" class="form-label text-white small">Email Address</label>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" 
                        class="form-control login-input"
                        placeholder="your@email.com"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-warning small" />
                </div>

                <button type="submit" class="btn btn-login w-100 mb-3">
                    {{ __('Send Reset Link') }}
                </button>
            </form>

            <div class="text-center small text-white">
                <a class="text-decoration-none text-white fw-semibold" href="{{ route('login') }}">
                    Back to Login
                </a>
                <span class="mx-2">|</span>
                <a class="text-decoration-none text-white fw-semibold" href="{{ route('register') }}">
                    Create Account
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Global Reset & Font */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Nunito', sans-serif;
    }
    /* Background full-screen dengan overlay gradasi hitam di atas gambar */
    .login-full-bg {
        background: linear-gradient(to right, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.5) 100%),
                    url('{{ asset('Backend/img/bg_LOG.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding-left: 50px;
    }
    /* Container form agar tampil di sebelah kiri */
    .login-left-form {
        width: 100%;
        max-width: 420px;
        padding: 40px;
    }
    .login-form-wrapper {
        width: 100%;
    }
    /* Styling Input */
    .login-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        color: white;
        transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .login-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    .login-input:focus {
        border-color: #00c3ff;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 8px rgba(0, 195, 255, 0.6);
        color: white;
    }
    /* Styling Tombol */
    .btn-login {
        background: #00b4d8;
        border: none;
        border-radius: 8px;
        padding: 10px 0;
        font-weight: 600;
        color: white;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-login:hover {
        background: #0096c7;
        transform: translateY(-2px);
    }
    /* Responsif */
    @media (max-width: 768px) {
        .login-full-bg {
            justify-content: center;
            padding-left: 0;
        }
        .login-left-form {
            max-width: 90%;
            padding: 30px;
        }
    }
</style>
@endpush
