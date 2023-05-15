@extends('admin.layouts.auth_master')

@section('title', 'Login')

@section('content')
<div class="col-lg-6">
    <div class="card-body p-4 p-sm-5">
        <h5 class="card-title">Sign In</h5>
        <p class="card-text mb-5">See your growth and get consulting support!</p>
        @if (session('status'))
        <div class="alert alert-info">
            <strong>{{ session('status') }}</strong>
        </div>
        @endif
        <form class="form-body" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label for="inputEmailAddress" class="form-label">Email</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                        <input type="email" name="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Enter Email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="inputChoosePassword" class="form-label">Password</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                        <input type="password" name="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Enter Password">
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="remember" type="checkbox" id="remember_me">
                        <label class="form-check-label" for="remember_me">Remember Me</label>
                    </div>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('password.request') }}">Forgot Password ?</a>
                </div>
                <div class="col-12">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
