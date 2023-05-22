@extends('frontend.layouts.frontend_master')

@section('title', 'Privacy Policy')

@section('content')
<!-- ========================= privacy-policy-section start ========================= -->
<section class="about-section pt-150 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content received-content">
                    <div class="section-title">
                        <span class="wow fadeInUp" data-wow-delay=".2s">Privacy Policy - {{ env('APP_NAME') }}</span>
                        <h1 class="mb-25 wow fadeInUp" data-wow-delay=".4s">{{ $privacyPolicy->headline }}</h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{!! $privacyPolicy->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= privacy-policy-section end ========================= -->
@endsection
