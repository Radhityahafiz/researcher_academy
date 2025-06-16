@extends('layouts.guest')

@section('title', 'Lupa Kata Sandi')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg border-0" style="border-radius: 15px; backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.85);">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 70px; height: auto;">
                        <h2 class="h4 mt-3 mb-1 font-weight-bold text-primary">Atur Ulang Kata Sandi</h2>
                        <p class="small text-secondary">Masukkan email Anda untuk menerima tautan reset</p>
                    </div>
                    
                    <x-auth-session-status class="mb-3 alert alert-info text-center" :status="session('status')" />
                    
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                            <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                class="form-control rounded-pill"
                                placeholder="emailanda@gmail.com" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small text-center" />
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill mb-3">
                            Kirim Tautan Reset
                        </button>
                    </form>
                    
                    <div class="text-center small">
                        <a class="text-decoration-none text-primary fw-bold" href="{{ route('login') }}">
                            Kembali Masuk
                        </a>
                        <span class="mx-2 text-secondary">|</span>
                        <a class="text-decoration-none text-primary fw-bold" href="{{ route('register') }}">
                            Buat Akun
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection