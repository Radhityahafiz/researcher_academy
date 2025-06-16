@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg border-0" style="border-radius: 15px; backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.85);">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 80px; height: auto;">
                        <h2 class="h4 mt-3 mb-0 font-weight-bold text-primary">Selamat Datang di Research Academy</h2>
                    </div>
                    
                    @if(session('status'))
                        <div class="alert alert-info mb-3 text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                            <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                class="form-control rounded-pill"
                                placeholder="Masukkan alamat email" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small text-center" />
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold text-secondary">Kata Sandi</label>
                            <x-text-input id="password" type="password" name="password" 
                                class="form-control rounded-pill"
                                placeholder="Masukkan kata sandi" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small text-center" />
                        </div>
                        
                        <div class="mb-3 form-check d-flex justify-content-between align-items-center">
                            <div>
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label small text-secondary">Ingat Saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none text-primary small" href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill">
                           Masuk
                        </button>
                    </form>
                    
                    @if (Route::has('register'))
                    <div class="text-center small mt-4">
                        <span class="text-secondary">Belum punya akun?</span>
                        <a class="text-decoration-none text-primary fw-bold ms-1" href="{{ route('register') }}">Daftar</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection