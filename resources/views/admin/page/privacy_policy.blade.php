@extends('admin.layouts.admin_master')

@section('title', 'Privacy Policy Page')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Privacy Policy Page</h4>
                <p class="card-text">Body</p>
            </div>
            <div class="card-body">
                <form action="{{route('privacy.policy.page.update', $privacyPolicy->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label>Headline</label>
                            <input type="text" class="form-control" name="headline" value="{{old('headline', $privacyPolicy->headline)}}">
                            @error('headline')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{old('description', $privacyPolicy->description)}}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-info" type="submit">Update Privacy Policy Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
