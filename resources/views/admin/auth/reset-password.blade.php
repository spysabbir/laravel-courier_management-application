@extends('admin.layouts.auth_master')

@section('title', 'Genrate New Password')

@section('content')
<div class="col-lg-7">
    <div class="card-body p-4 p-sm-5">
        <h5 class="card-title">Genrate New Password</h5>
        <p class="card-text mb-5">We received your reset password request. Please enter your new password!</p>
        <form class="form-body" method="POST" action="{{ route('password.store') }}">
            <div class="row g-3">

                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                <div class="col-12">
                    <label for="inputNewPassword" class="form-label">New Password</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                        <input type="email" name="password" class="form-control radius-30 ps-5" id="inputNewPassword" placeholder="Enter New Password">
                    </div>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                        <input type="password" name="password_confirmation" class="form-control radius-30 ps-5" id="inputConfirmPassword" placeholder="Confirm Password">
                    </div>
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-primary radius-30">Change Password</button>
                        <a href="{{ route('login') }}" class="btn btn-lg btn-light radius-30">Back to Login</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
