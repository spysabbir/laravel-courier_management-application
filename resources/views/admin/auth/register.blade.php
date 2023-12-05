@extends('admin.layouts.auth_master')

@section('title', 'Register')

@section('content')
<div class="col-lg-7">
    <div class="card-body p-4 p-sm-5">
        <h5 class="card-title">Sign Up</h5>
        <p class="card-text mb-5">See your growth and get consulting support!</p>
        <form class="form-body" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12 ">
                    <label for="inputName" class="form-label">Name</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                        <input type="text" name="name" class="form-control radius-30 ps-5" id="inputName" placeholder="Enter Name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
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
                <div class="col-12">
                    <label for="inputChooseConfirmPassword" class="form-label">Confirm Password</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                        <input type="password" name="password_confirmation" class="form-control radius-30 ps-5" id="inputChooseConfirmPassword" placeholder="Enter Confirm Password">
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary radius-30">Sign Up</button>
                </div>
                </div>
                <div class="col-12">
                <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                </div>
            </div>
        </form>
   </div>
</div>
@endsection
