@extends('admin.layouts.admin_master')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-0">My Account</h5>
                <hr>
                <div class="card shadow-none border">
                    <div class="card-header">
                        <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="profilePhoto">Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo" id="profilePhoto">
                                @error('profile_photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Enter your phone number." value="{{ old('phone_number', $user->phone_number) }}">
                                @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="Male" @selected(old('gender', $user->gender) == "Male")>Male</option>
                                    <option value="Female" @selected(old('gender', $user->gender) == "Female")>Female</option>
                                </select>
                                @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                @error('date_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address"  class="form-control" placeholder="Enter your address.">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow-none border">
                    <div class="card-header">
                        <h6 class="mb-0">Update Password</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            <!-- Current Password -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter your current password.">
                                @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                             <!-- New Password -->
                             <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your new password.">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Enter your confirm password.">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body">
                <div class="profile-avatar text-center">
                    <img src="{{ asset('uploads/profile_photo') }}/{{ $user->profile_photo }}" class="rounded-circle shadow" width="120" height="120" alt="Profile Photo" id="profilePhotoPreview">
                </div>
                <div class="text-center mt-4">
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="mb-0 text-secondary">{{ $user->role }}</p>
                    <p class="mb-0 text-secondary">{{ ($user->branch_id) ? $user->relationtobranch->branch_name : "" }}</p>
                    <hr>
                    <h4 class="mb-1"></h4>
                    <p class="mb-0 text-secondary">Last Active: {{ date('d-M,Y h:m:s A', strtotime($user->last_active)) }}</p>
                    <p class="mb-0 text-secondary">Join: {{ $user->created_at->format('D d-M,Y h:m:s A') }}</p>
                </div>
                <hr>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                    Phone Number
                    <span class="badge bg-primary rounded-pill">{{ $user->phone_number }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                    Gender
                    <span class="badge bg-primary rounded-pill">{{ $user->gender }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                    Date of Birth
                    <span class="badge bg-primary rounded-pill">{{ $user->date_of_birth }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                    Address
                    <span class="badge bg-primary rounded-pill">{{ $user->address }}</span>
                </li>
            </ul>
        </div>
    </div>
</div><!--end row-->
@endsection

@section('script')
<script>
    $(document).ready(function(){
        // Profile Photo Preview
        $('#profilePhoto').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profilePhotoPreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    })
</script>
@endsection
