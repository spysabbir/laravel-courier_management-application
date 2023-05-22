@extends('frontend.layouts.frontend_master')

@section('title', 'Terms Of Service')

@section('content')
<!-- ========================= terms-of-service-section start ========================= -->
<section class="about-section pt-150 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content received-content">
                    <div class="section-title">
                        <span class="wow fadeInUp" data-wow-delay=".2s">Terms Of Service {{ env('APP_NAME') }}</span>
                        <h1 class="mb-25 wow fadeInUp" data-wow-delay=".4s">{{ $termsOfService->headline }}</h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{!! $termsOfService->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= terms-of-service-section end ========================= -->
@endsection
