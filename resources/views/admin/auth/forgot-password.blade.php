@extends('admin.layouts.auth_master')

@section('title', 'Forgot Password')

@section('content')
<div class="col-lg-7">
    <div class="card-body p-4 p-sm-5">
        <h5 class="card-title">Forgot Password?</h5>
        <p class="card-text mb-5">Enter your registered email ID to reset the password</p>
        <!-- Session Status -->
        @if (session('status'))
        <div class="alert alert-info">
            <strong>{{ session('status') }}</strong>
        </div>
        @endif
        <form class="form-body" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg radius-30" id="inputEmailAddress" placeholder="Email Address" value="{{ old('email') }}">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-lg btn-primary radius-30">Send</button>
                        <a href="{{ route('login') }}" class="btn btn-lg btn-light radius-30">Back to Login</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
