@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="login-full-bg">
    <div class="login-left-form">
        <div class="login-form-wrapper">
            <div class="text-center mb-4">
                <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="Logo" style="width: 60px;">
                <h2 class="text-white mb-4">Acessar sua conta</h2>
            </div>

            @if (session('status'))
                <div class="alert alert-success mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-3 position-relative">
                    <label for="email" class="form-label text-white small">E-mail</label>
                    <x-text-input id="email" type="email" name="email" :value="old('email')"
                        class="form-control login-input" placeholder="email@domain.com" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-warning small" />
                </div>

                <div class="form-group mb-3 position-relative">
                    <label for="password" class="form-label text-white small">Senha</label>
                    <x-text-input id="password" type="password" name="password"
                        class="form-control login-input" placeholder="********" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-warning small" />
                </div>

                <div class="mb-3 text-end">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-light text-decoration-none">Esqueceu sua senha?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login w-100 mb-3">Entrar</button>

                <div class="text-center small text-white">
                    Novo usuário? <a href="{{ route('register') }}" class="text-white text-decoration-underline">Crie uma conta grátis</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Reset dasar & font */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Nunito', sans-serif;
    }

    /* Background penuh dengan gradasi dari kiri ke kanan di atas foto background */
    .login-full-bg {
        background: linear-gradient(to right, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 100%), url("{{ asset('Backend/img/bg_LOG.jpg') }}") no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: flex-start; /* Form berada di sebelah kiri */
        padding-left: 50px;
        position: relative;
    }

    /* Container form tanpa box background */
    .login-left-form {
        width: 100%;
        max-width: 420px;
        padding: 40px;
    }

    .login-form-wrapper {
        width: 100%;
    }

    /* Styling input modern */
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

    /* Tombol login dengan efek hover dan transisi */
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

    /* Alert sukses dengan desain lembut */
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
