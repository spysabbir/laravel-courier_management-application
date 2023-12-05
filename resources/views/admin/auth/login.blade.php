@extends('admin.layouts.auth_master')

@section('title', 'Login')

@section('content')
<div class="col-lg-7">
    <div class="card-body mt-3 p-4 p-sm-5">
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
                    <label for="email" class="form-label">Email</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                        <input type="email" name="email" class="form-control radius-30 ps-5" id="email" placeholder="Enter Email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                        <input type="password" name="password" class="form-control radius-30 ps-5" id="password" placeholder="Enter Password">
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
        <div class="demo mt-2">
            <h5 class="text-center">Demo User Details</h5>
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>superadmin@email.com</td>
                            <td>12345678</td>
                            <td>Super Admin</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="copyUserDetails('superadmin@email.com', '12345678')">Copy</button>
                            </td>
                        </tr>
                        <tr>
                            <td>admin@email.com</td>
                            <td>12345678</td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="copyUserDetails('admin@email.com', '12345678')">Copy</button>
                            </td>
                        </tr>
                        <tr>
                            <td>manager1@email.com</td>
                            <td>12345678</td>
                            <td>Manager</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="copyUserDetails('manager1@email.com', '12345678')">Copy</button>
                            </td>
                        </tr>
                        <tr>
                            <td>manager2@email.com</td>
                            <td>12345678</td>
                            <td>Manager</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="copyUserDetails('manager2@email.com', '12345678')">Copy</button>
                            </td>
                        </tr>
                        <tr>
                            <td>staff1@email.com</td>
                            <td>12345678</td>
                            <td>Staff</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="copyUserDetails('staff1@email.com', '12345678')">Copy</button>
                            </td>
                        </tr>
                        <tr>
                            <td>staff2@email.com</td>
                            <td>12345678</td>
                            <td>Staff</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="copyUserDetails('staff2@email.com', '12345678')">Copy</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function copyUserDetails(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
@endsection
