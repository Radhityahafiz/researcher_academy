@extends('layouts.participant')

@section('title', 'Edit Profil')
@section('header', 'Edit Profil')

@section('content')
<a href="{{ route('welcome') }}" class="btn btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i> Kembali</a>

<div class="profile-edit-container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Session Status -->
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Profile Information Card -->
                <div class="card mb-4">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <h3 class="fw-bold mb-0"><i class="fas fa-user-edit me-2"></i> Informasi Profil</h3>
                                <p class="mb-0 mt-1">Perbarui informasi profil akun Anda</p>
                            </div>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill">
                                <i class="fas fa-user me-1"></i> {{ $user->username }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('participant.profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="row g-3">
                                <!-- Username -->
                                <div class="col-md-6">
                                    <label for="username" class="form-label fw-bold">Username</label>
                                    <input id="username" name="username" type="text" 
                                           value="{{ old('username', $user->username) }}"
                                           class="form-control"
                                           required autofocus>
                                </div>

                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label fw-bold">Nama Lengkap</label>
                                    <input id="full_name" name="full_name" type="text" 
                                           value="{{ old('full_name', $user->full_name) }}"
                                           class="form-control"
                                           required>
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input id="email" name="email" type="email" 
                                           value="{{ old('email', $user->email) }}"
                                           class="form-control"
                                           required>

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-warning">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Alamat email Anda belum terverifikasi.
                                            <button form="send-verification" class="btn btn-link p-0 text-warning">
                                                Klik di sini untuk mengirim ulang email verifikasi.
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                        <p class="text-success">
                                            <i class="fas fa-check-circle me-1"></i> Tautan verifikasi baru telah dikirim ke alamat email Anda.
                                        </p>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Email Verification Form -->
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <!-- Password Update Card -->
                <div class="card mb-4">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h3 class="fw-bold mb-0"><i class="fas fa-lock me-2"></i> Perbarui Kata Sandi</h3>
                        <p class="mb-0 mt-1">Pastikan akun Anda menggunakan password yang aman</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="current_password" class="form-label fw-bold">Kata Sandi Saat Ini</label>
                                    <input id="current_password" name="current_password" type="password" 
                                           class="form-control"
                                           autocomplete="current-password">
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-bold">Kata Sandi Baru</label>
                                    <input id="password" name="password" type="password" 
                                           class="form-control"
                                           autocomplete="new-password">
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Kata Sandi</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" 
                                           class="form-control"
                                           autocomplete="new-password">
                                </div>

                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-1"></i> Simpan Kata Sandi
                                    </button>

                                    @if (session('status') === 'password-updated')
                                    <span class="text-success ms-3">
                                        <i class="fas fa-check-circle me-1"></i> Berhasil disimpan!
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Account Deletion Card -->
                <div class="card border-danger">
                    <div class="card-header bg-gradient-danger text-white py-3">
                        <h3 class="fw-bold mb-0"><i class="fas fa-exclamation-triangle me-2"></i> Hapus Akun</h3>
                        <p class="mb-0 mt-1">Aksi permanen yang tidak dapat dibatalkan</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="alert alert-danger mb-4">
                            <i class="fas fa-info-circle me-2"></i> Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data yang ingin Anda simpan.
                        </div>

                        <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="fas fa-trash-alt me-1"></i> Hapus Akun
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
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Penghapusan Akun
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-info-circle me-2"></i> Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.
                </div>
                <p class="mb-4">
                    Masukkan password Anda untuk mengonfirmasi penghapusan akun permanen.
                </p>
                <form method="post" action="{{ route('participant.profile.destroy') }}" id="deleteAccountForm">
                    @csrf
                    @method('delete')
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" name="password" id="password" 
                               class="form-control"
                               placeholder="Masukkan password Anda">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="submit" form="deleteAccountForm" class="btn btn-danger px-4">
                    <i class="fas fa-trash-alt me-1"></i> Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>
@endsection