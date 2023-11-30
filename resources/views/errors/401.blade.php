@extends('errors::layout')

@section('title', __('Unauthorized'))

@section('content')
<div class="container mt-5">
    <div class="card py-5">
    <div class="row g-0">
        <div class="col col-xl-5">
        <div class="card-body p-4">
            <h1 class="display-1"><span class="text-danger">4</span><span class="text-primary">0</span><span class="text-success">1</span></h1>
            <h2 class="font-weight-bold display-4">Unauthorized</h2>
            <p>You have reached the edge of the universe.
            <br>The page you requested could not be found.
            <br>Dont'worry and return to the previous page.</p>
            <div class="mt-5">
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg px-md-5 radius-30">Go Back</a>
            </div>
        </div>
        </div>
        <div class="col-xl-7">
        <img src="{{ asset('admin') }}/images/error/404-error.png" class="img-fluid" alt="">
        </div>
    </div>
    <!--end row-->
    </div>
</div>
@endsection
