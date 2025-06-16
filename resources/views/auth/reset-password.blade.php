@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg border-0" style="border-radius: 15px; backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.85);">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('Backend/img/logo_HRP.png') }}" alt="HRP Logo" style="width: 80px; height: auto;">
                        <h2 class="h4 mt-3 mb-0 font-weight-bold text-primary">Atur Ulang Kata Sandi Anda</h2>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-info mb-3 text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" 
                                class="form-control rounded-pill"
                                placeholder="Enter your email address" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small text-center" />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold text-secondary">Kata Sandi Baru</label>
                            <x-text-input id="password" type="password" name="password" 
                                class="form-control rounded-pill"
                                placeholder="Enter your new password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small text-center" />
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label small fw-bold text-secondary">Konfirmasi Kata Sandi</label>
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation" 
                                class="form-control rounded-pill"
                                placeholder="Repeat your new password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger small text-center" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
