@extends('frontend.layouts.frontend_master')

@section('title', 'All Service')

@section('content')
<!-- ========================= service-section start ========================= -->
<section class="about-section pt-150 pb-5">
    <div class="container">
        <div class="row">
            @foreach ($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="single-service wow fadeInUp" data-wow-delay=".2s">
                    <div class="icon mt-3">
                        <img width="80" height="80" src="{{ asset('uploads/service_photo') }}/{{ $service->service_photo }}" alt="">
                    </div>
                    <div class="content mt-3">
                        <h3>{{ $service->service_name }}</h3>
                        <p>{{ $service->service_details }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ========================= service-section end ========================= -->
@endsection
