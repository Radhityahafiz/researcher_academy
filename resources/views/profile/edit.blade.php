@extends('layouts.profile')

@section('title', 'Edit Profile')
@section('header', 'Edit Profile')

@section('content')
<!-- Session Status -->
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Validation Errors -->
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul class="mb-0">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Profile Update Form -->
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Profile Information</h5>
    <p class="card-text">Update your account's profile information and email address.</p>
    
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('patch')

      <div class="row g-3 mb-4">
        <!-- Username -->
        <div class="col-md-6">
          <label for="username" class="form-label">Username</label>
          <input id="username" name="username" type="text" 
                 value="{{ old('username', $user->username) }}"
                 class="form-control"
                 required autofocus>
        </div>

        <!-- Full Name -->
        <div class="col-md-6">
          <label for="full_name" class="form-label">Full Name</label>
          <input id="full_name" name="full_name" type="text" 
                 value="{{ old('full_name', $user->full_name) }}"
                 class="form-control"
                 required>
        </div>

        <!-- Email -->
        <div class="col-12">
          <label for="email" class="form-label">Email</label>
          <input id="email" name="email" type="email" 
                 value="{{ old('email', $user->email) }}"
                 class="form-control"
                 required>

          @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
          <div class="mt-2">
            <p class="text-warning">
              Your email address is unverified.
              <button form="send-verification" class="btn btn-link p-0">
                Click here to re-send the verification email.
              </button>
            </p>

            @if (session('status') === 'verification-link-sent')
            <p class="text-success">
              A new verification link has been sent to your email address.
            </p>
            @endif
          </div>
          @endif
        </div>

        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">
            Save Changes
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

<!-- Password Update Section -->
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Update Password</h5>
    <p class="card-text">
      Ensure your account is using a long, random password to stay secure.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="mt-3">
      @csrf
      @method('put')

      <div class="row g-3">
        <div class="col-12">
          <label for="current_password" class="form-label">Current Password</label>
          <input id="current_password" name="current_password" type="password" 
                 class="form-control"
                 autocomplete="current-password">
        </div>

        <div class="col-md-6">
          <label for="password" class="form-label">New Password</label>
          <input id="password" name="password" type="password" 
                 class="form-control"
                 autocomplete="new-password">
        </div>

        <div class="col-md-6">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input id="password_confirmation" name="password_confirmation" type="password" 
                 class="form-control"
                 autocomplete="new-password">
        </div>

        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">
            Save Password
          </button>

          @if (session('status') === 'password-updated')
          <span class="text-success ms-3">Saved successfully!</span>
          @endif
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Account Deletion Section -->
<div class="card border-danger">
  <div class="card-body">
    <h5 class="card-title text-danger">Delete Account</h5>
    <p class="card-text">
      Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
    </p>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
      Delete Account
    </button>
  </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAccountModalLabel">Are you sure you want to delete your account?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
        </p>
        <form method="post" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
          @csrf
          @method('delete')
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" 
                   class="form-control"
                   placeholder="Enter your password">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="deleteAccountForm" class="btn btn-danger">Delete Account</button>
      </div>
    </div>
  </div>
</div>
@endsection