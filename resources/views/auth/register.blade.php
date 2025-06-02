@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="login-full-bg">
    <div class="login-left-form">
        <div class="login-form-wrapper">
            <div class="text-center mb-4">
                <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 60px;">
                <h2 class="text-white mb-2">Create Account</h2>
                <p class="text-white small">Join our Research Academy</p>
            </div>

            <x-auth-session-status class="mb-3 alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div class="form-group mb-3">
                    <label for="full_name" class="form-label text-white small fw-semibold">Full Name</label>
                    <x-text-input id="full_name" type="text" name="full_name" :value="old('full_name')" class="form-control login-input" placeholder="Your name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('full_name')" class="mt-1 text-warning small" />
                </div>

                <!-- Username -->
                <div class="form-group mb-3">
                    <label for="username" class="form-label text-white small fw-semibold">Username</label>
                    <x-text-input id="username" type="text" name="username" :value="old('username')" class="form-control login-input" placeholder="Username" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-1 text-warning small" />
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label text-white small fw-semibold">Email</label>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" class="form-control login-input" placeholder="your@email.com" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-warning small" />
                </div>

                <!-- Passwords -->
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="password" class="form-label text-white small fw-semibold">Password</label>
                        <x-text-input id="password" type="password" name="password" class="form-control login-input" placeholder="••••••" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-warning small" />
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="password_confirmation" class="form-label text-white small fw-semibold">Confirm</label>
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" class="form-control login-input" placeholder="••••••" required autocomplete="new-password" />
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group mb-3">
                    <label for="role" class="form-label text-white small fw-semibold">Role</label>
                    <select id="role" name="role" class="form-select login-input" required>
                        <option value="">Select role</option>
                        <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                        <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1 text-warning small" />
                </div>

                <button type="submit" class="btn btn-teal w-100 mb-2">
                    Register
                </button>
            </form>

            <div class="text-center small text-white mt-3">
                <span>Already registered?</span>
                <a class="text-decoration-underline text-white fw-semibold" href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Global Reset */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Nunito', sans-serif;
    }

    /* Background dengan overlay gradasi hitam di atas foto background */
    .login-full-bg {
        background: linear-gradient(to right, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.5) 100%),
                    url('{{ asset('Backend/img/bg_LOG.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: flex-start; /* Form berada di sebelah kiri */
        padding-left: 50px;
        position: relative;
    }
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
    /* Styling untuk elemen select secara khusus */
    select.login-input {
        /* Meningkatkan opacity agar opsi terlihat jelas */
        background: rgba(255, 255, 255, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: #fff !important;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    select.login-input option {
        background: #000;
        color: #fff;
    }
    /* Styling Tombol */
    .btn-teal {
        background: #00b4d8;
        border: none;
        border-radius: 8px;
        padding: 10px 0;
        font-weight: 600;
        color: white;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn-teal:hover {
        background: #0096c7;
        transform: translateY(-2px);
    }
    /* Styling Alert */
    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
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
