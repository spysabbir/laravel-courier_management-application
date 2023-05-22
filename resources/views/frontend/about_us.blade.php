@extends('frontend.layouts.frontend_master')

@section('title', 'About Us')

@section('content')
<!-- ========================= about-us-section start ========================= -->
<section class="about-section pt-150 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-img received-img wow fadeInUp" data-wow-delay=".5s">
                    <img src="{{ asset('uploads/default_photo') }}/{{ $aboutUs->about_photo }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content received-content">
                    <div class="section-title">
                        <span class="wow fadeInUp" data-wow-delay=".2s">About {{ env('APP_NAME') }}</span>
                        <h1 class="mb-25 wow fadeInUp" data-wow-delay=".4s">{{ $aboutUs->headline }}</h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{!! $aboutUs->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= about-us-section end ========================= -->
@endsection
