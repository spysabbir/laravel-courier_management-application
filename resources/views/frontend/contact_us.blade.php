@extends('frontend.layouts.frontend_master')

@section('title', 'Contact Us')

@section('content')
<!-- ========================= contact-section start ========================= -->
<section class="about-section pt-150 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title">
                        <span class="wow fadeInUp" data-wow-delay=".2s">Contact Details</span>
                    </div>
                    <div class="counter-up wow fadeInUp" data-wow-delay=".8s">
                        <div class="single-counter">
                            <h3>Phone: </h3>
                            <h5>{{ $default_setting->support_phone }}</h5>
                        </div>
                        <div class="single-counter">
                            <h3>Email: </h3>
                            <h5>{{ $default_setting->support_email }}</h5>
                        </div>
                        <div class="single-counter">
                            <h3>Address: </h3>
                            <h5>{{ $default_setting->address }}</h5>
                        </div>
                    </div>
                    <div class="counter-up wow fadeInUp mt-3" data-wow-delay=".8s">
                        {!! $default_setting->google_map_link !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card wow fadeInUp mt-5"  data-wow-delay=".6s">
                    <div class="card-header">
                        <div class="section-title">
                            <span class="wow fadeInUp" data-wow-delay=".2s">Contact Message</span>
                        </div>
                    </div>
                    <div class="card-body wow fadeInUp" data-wow-delay=".2s">
                        <form id="sendForm">
                            @csrf
                            <div class="mb-2">
                                <input type="text" class="form-control" name="name" placeholder="Enter your name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="email" placeholder="Enter your email">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="phone_number" placeholder="Enter your phone number">
                                <span class="text-danger error-text phone_number_error"></span>
                            </div>
                            <div class="mb-2">
                                <textarea class="form-control" name="subject" placeholder="Enter your subject"></textarea>
                                <span class="text-danger error-text subject_error"></span>
                            </div>
                            <div class="mb-2">
                                <textarea class="form-control" name="message" placeholder="Enter your message"></textarea>
                                <span class="text-danger error-text message_error"></span>
                            </div>
                            <button type="submit" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".6s">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= contact-section end ========================= -->
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Store Data
        $('#sendForm').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('contact.message.send') }}",
                type: "POST",
                data: $(this).serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $('#sendForm')[0].reset();
                        toastr.success('Contact message send successfully.');
                    }
                },
            });
        });
    })
</script>
@endsection
