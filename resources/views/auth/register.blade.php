@extends('layouts.guest')

@section('title', 'Daftar')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg border-0" style="border-radius: 15px; backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.85);">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 70px; height: auto;">
                        <h2 class="h4 mt-3 mb-1 font-weight-bold text-primary">Buat Akun</h2>
                        <p class="small text-secondary mt-1">Bergabunglah dengan Research Academy</p>
                    </div>
                    
                    <x-auth-session-status class="mb-3 alert alert-info text-center" :status="session('status')" />
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="full_name" class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                            <x-text-input id="full_name" type="text" name="full_name" :value="old('full_name')" 
                                class="form-control rounded-pill"
                                placeholder="Nama anda" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-1 text-danger small text-center" />
                        </div>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label small fw-bold text-secondary">Username</label>
                            <x-text-input id="username" type="text" name="username" :value="old('username')" 
                                class="form-control rounded-pill"
                                placeholder="Username" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')" class="mt-1 text-danger small text-center" />
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                            <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                class="form-control rounded-pill"
                                placeholder="contoh@gmail.com" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small text-center" />
                        </div>
                        
                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label small fw-bold text-secondary">Kata Sandi</label>
                                <x-text-input id="password" type="password" name="password" 
                                    class="form-control rounded-pill"
                                    placeholder="••••••" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small text-center" />
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label small fw-bold text-secondary">Konfirmasi Kata Sandi</label>
                                <x-text-input id="password_confirmation" type="password" name="password_confirmation" 
                                    class="form-control rounded-pill"
                                    placeholder="••••••" required autocomplete="new-password" />
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill">
                            Daftar
                        </button>
                    </form>
                    
                    <div class="text-center small mt-4">
                        <span class="text-secondary">Sudah punya akun?</span>
                        <a class="text-decoration-none text-primary fw-bold ms-1" href="{{ route('login') }}">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection