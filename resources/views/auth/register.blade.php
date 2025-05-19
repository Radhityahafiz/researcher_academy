@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                
                                <form method="POST" action="{{ route('register') }}" class="user">
                                    @csrf
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <x-text-input id="full_name" type="text" name="full_name" :value="old('full_name')" 
                                                class="form-control form-control-user"
                                                placeholder="Full Name" required autofocus autocomplete="name" />
                                            <x-input-error :messages="$errors->get('full_name')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <x-text-input id="username" type="text" name="username" :value="old('username')" 
                                            class="form-control form-control-user"
                                            placeholder="Username" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('username')" class="mt-2 text-danger" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <x-text-input id="email" type="email" name="email" :value="old('email')" 
                                            class="form-control form-control-user"
                                            placeholder="Email Address" required autocomplete="email" />
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
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <select id="role" name="role" class="form-control form-control-user" required>
                                            <option value="">Select Role</option>
                                            <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                                            <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2 text-danger" />
                                    </div>
                                    
                                    <button type="submit" class="btn btn-teal btn-user btn-block">
                                        {{ __('Register Account') }}
                                    </button>
                                </form>
                                
                                <hr>
                                
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
    .bg-register-image {
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