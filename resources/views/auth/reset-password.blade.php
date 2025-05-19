@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-reset-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Reset Your Password</h1>
                                </div>
                                
                                <form method="POST" action="{{ route('password.store') }}" class="user">
                                    @csrf
                                    
                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    
                                    <div class="form-group">
                                        <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" 
                                            class="form-control form-control-user"
                                            placeholder="Email Address" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <x-text-input id="password" type="password" name="password" 
                                                class="form-control form-control-user"
                                                placeholder="Password" required autocomplete="new-password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="col-sm-6">
                                            <x-text-input id="password_confirmation" type="password" name="password_confirmation" 
                                                class="form-control form-control-user"
                                                placeholder="Repeat Password" required autocomplete="new-password" />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Reset Password') }}
                                    </button>
                                </form>
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
    .bg-reset-image {
        background: url("{{ asset('img/undraw_security_on_re_e491.svg') }}");
        background-position: center;
        background-size: cover;
    }
</style>
@endpush