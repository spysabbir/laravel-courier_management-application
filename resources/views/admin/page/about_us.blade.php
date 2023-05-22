@extends('admin.layouts.admin_master')

@section('title', 'About Us Page')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">About Us Page</h4>
                <p class="card-text">Body</p>
            </div>
            <div class="card-body">
                <form action="{{route('about.us.page.update', $aboutUs->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label>About Photo</label>
                            <input type="file" class="form-control" name="about_photo" id="aboutPhoto">
                            <img src="{{ asset('uploads/default_photo') }}/{{ $aboutUs->about_photo }}" width="100"  height="100" id="aboutPhotoPreview">
                            @error('about_photo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label>Headline</label>
                            <input type="text" class="form-control" name="headline" value="{{old('headline', $aboutUs->headline)}}">
                            @error('headline')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{old('description', $aboutUs->description)}}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-info" type="submit">Update About Us Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        // Logo Image Preview
        $('#aboutPhoto').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#aboutPhotoPreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    })
</script>
@endsection
