@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <!-- Session Status -->
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Profile Update Form -->
                    <div class="mb-5">
                        <h5 class="card-title mb-3">Informasi Profil</h5>
                        <p class="card-text text-muted mb-4">Perbarui informasi profil dan alamat email Anda.</p>
                        
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="row g-3 mb-4">
                                <!-- Username -->
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input id="username" name="username" type="text" 
                                           value="{{ old('username', $user->username) }}"
                                           class="form-control @error('username') is-invalid @enderror"
                                           required autofocus>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label">Nama Lengkap</label>
                                    <input id="full_name" name="full_name" type="text" 
                                           value="{{ old('full_name', $user->full_name) }}"
                                           class="form-control @error('full_name') is-invalid @enderror"
                                           required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" name="email" type="email" 
                                           value="{{ old('email', $user->email) }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-warning">
                                            Alamat email Anda belum terverifikasi.
                                            <button form="send-verification" class="btn btn-link p-0">
                                                Klik di sini untuk mengirim ulang email verifikasi.
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                        <p class="text-success">
                                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                                        </p>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Email Verification Form -->
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <!-- Password Update Section -->
                    <div class="mb-5">
                        <h5 class="card-title mb-3">Perbarui Password</h5>
                        <p class="card-text text-muted mb-4">
                            Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.
                        </p>

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="current_password" class="form-label">Password Saat Ini</label>
                                    <input id="current_password" name="current_password" type="password" 
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           autocomplete="current-password">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input id="password" name="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror"
                                           autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" 
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           autocomplete="new-password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Password
                                    </button>

                                    @if (session('status') === 'password-updated')
                                    <span class="text-success ms-3">Berhasil disimpan!</span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Account Deletion Section -->
                    <div class="border-start border-5 border-danger p-3 bg-light rounded">
                        <h5 class="card-title text-danger mb-3">Hapus Akun</h5>
                        <p class="card-text text-muted mb-4">
                            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
                        </p>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            Hapus Akun
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Apakah Anda yakin ingin menghapus akun Anda?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">
                    Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                </p>
                <form method="post" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                    @csrf
                    @method('delete')
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password Anda">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deleteAccountForm" class="btn btn-danger">Hapus Akun</button>
            </div>
        </div>
    </div>
</div>
@endsection