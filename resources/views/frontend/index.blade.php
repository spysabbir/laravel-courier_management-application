@extends('frontend.layouts.frontend_master')

@section('title', 'Home')

@section('content')
<!-- ========================= hero-section start ========================= -->
<section id="home" class="hero-section">
    <div class="hero-shape">
        <img src="{{ asset('frontend') }}/img/hero/hero-shape.svg" alt="" class="shape">
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="wow fadeInUp" data-wow-delay=".2s">On-time Delivery<span> and Customer Satisfaction.</span> </h1>
                    <p class="wow fadeInUp" data-wow-delay=".4s">It is an efficient and user-friendly courier management company. The company work to handle deliveries, track shipments and provide customer service.</p>
                    <a href="{{ route('check.status') }}" rel="nofollow" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".6s">Check Status</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                    <img src="{{ asset('frontend') }}/img/hero/hero-img.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= hero-section end ========================= -->

<!-- ========================= service-section start ========================= -->
<section id="services" class="service-section pt-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center mb-70">
                    <span class="wow fadeInUp" data-wow-delay=".2s">Delivery Services</span>
                    <h1 class="wow fadeInUp" data-wow-delay=".4s">All Essentials You Need</h1>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($services->take(6) as $service)
            <div class="col-lg-4 col-md-6">
                <div class="single-service wow fadeInUp" data-wow-delay=".2s">
                    <div class="icon">
                        <img src="{{ asset('uploads/service_photo') }}/{{ $service->service_photo }}" alt="">
                    </div>
                    <div class="content">
                        <h3>{{ $service->service_name }}</h3>
                        <p>{{ $service->service_details }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-warning" role="alert">
                <strong>Data Not Found!</strong>
            </div>
            @endforelse
        </div>
    </div>
</section>
<!-- ========================= service-section end ========================= -->

<!-- ========================= about-section start ========================= -->
<section id="about" class="about-section pt-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-img wow fadeInUp" data-wow-delay=".5s">
                    <img src="{{ asset('uploads/default_photo') }}/{{ $aboutUs->about_photo }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title">
                        <span class="wow fadeInUp" data-wow-delay=".2s">About Us</span>
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">{{ $aboutUs->headline }}</h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{!! $aboutUs->description !!}</p>
                    </div>
                    <div class="counter-up wow fadeInUp" data-wow-delay=".8s">
                        <div class="single-counter">
                            <h3 id="secondo1" class="countup" cup-end="{{ $companies }}" cup-append="+">{{ $companies }}</h3>
                            <h5>Partner Company</h5>
                        </div>
                        <div class="single-counter position-relative">
                            <h3 id="secondo2" class="countup" cup-end="{{ $branches }}" cup-append="+">{{ $branches }}</h3>
                            <h5>Branch</h5>
                        </div>
                        <div class="single-counter">
                            <h3 id="secondo3" class="countup" cup-end="{{ $happy_customars }}" cup-append="+">{{ $happy_customars }}</h3>
                            <h5>Customer Satisfaction</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= about-section end ========================= -->

<!-- ========================= delivery-section start ========================= -->
<section id="how" class="delivery-section pt-150">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="delivery-content">
                    <div class="section-title">
                        <span class="wow fadeInUp" data-wow-delay=".2s">Fast Delivery</span>
                        <h1 class="mb-35 wow fadeInUp" data-wow-delay=".4s">Order Now, Recieve Within 3-7 days</h1>
                        <p class="mb-35 wow fadeInUp" data-wow-delay=".6s">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore hdht dolore magna aliquyam erat, sed diam voluptua.</p>
                        <a href="{{ route('check.status') }}" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".8s">Check Status</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 order-first order-lg-last">
                <div class="delivery-img wow fadeInUp" data-wow-delay=".5s">
                    <img src="{{ asset('frontend') }}/img/delivery/delivery-img.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= delivery-section end ========================= -->

<!-- ========================= about-section start ========================= -->
<section id="received" class="about-section received-section pt-150">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img received-img wow fadeInUp" data-wow-delay=".5s">
                    <img src="{{ asset('frontend') }}/img/received/received-img.png" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content received-content">
                    <div class="section-title">
                        <span class="wow fadeInUp" data-wow-delay=".2s">Contactless Delivery</span>
                        <h1 class="mb-25 wow fadeInUp" data-wow-delay=".4s">On-time Delivery to Your Doorstep</h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= about-section end ========================= -->

<!-- ========================= testimonial-section start ========================= -->
<section id="testimonial" class="testimonial-section img-bg pt-150 pb-40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title mb-60 text-center">
                    <span class="wow fadeInUp" data-wow-delay=".2s">Testimonials</span>
                    <h1 class="wow fadeInUp" data-wow-delay=".4s">What Our Users Says</h1>
                </div>
            </div>
        </div>
        <div class="row testimonial-wrapper">
            @forelse ($testimonials->take(6) as $testimonial)
            <div class="col-lg-4 col-md-6 mt-30">
                <div class="single-testimonial wow fadeInUp" data-wow-delay=".2s">
                    <div class="content">
                        <p>{{ $testimonial->testimonial_content }}</p>
                    </div>
                    <div class="info">
                        <div class="image">
                            <img src="{{ asset('frontend') }}/img/testimonial/testimonial.jpg" alt="">
                        </div>
                        <div class="text">
                            <h5>{{ $testimonial->testimonial_author_name }}</h5>
                            <p>{{ $testimonial->testimonial_author_title }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-warning" role="alert">
                <strong>Data Not Found!</strong>
            </div>
            @endforelse
        </div>
    </div>
</section>
<!-- ========================= testimonial-section end ========================= -->
@endsection
