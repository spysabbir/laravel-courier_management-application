@extends('frontend.layouts.frontend_master')

@section('title', 'Check Status')

@section('content')
<!-- ========================= check-status-section start ========================= -->
<section class="about-section pt-150 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card wow fadeInUp mt-5"  data-wow-delay=".6s">
                    <div class="card-header">
                        <div class="section-title">
                            <span class="wow fadeInUp" data-wow-delay=".2s">Status Result</span>
                        </div>
                    </div>
                    <div class="card-body wow fadeInUp" data-wow-delay=".2s" id="courier_details">
                        <span>Input your tracking id and check.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card wow fadeInUp mt-5"  data-wow-delay=".6s">
                    <div class="card-header">
                        <div class="section-title">
                            <span class="wow fadeInUp" data-wow-delay=".2s">Check Status</span>
                        </div>
                    </div>
                    <div class="card-body wow fadeInUp" data-wow-delay=".2s">
                        <form id="checkForm">
                            @csrf
                            <div class="mb-2">
                                <input type="text" class="form-control" name="tracking_id" placeholder="Enter your tracking id">
                                <span class="text-danger error-text tracking_id_error"></span>
                            </div>
                            <button type="submit" class="main-btn btn-hover wow fadeInUp" data-wow-delay=".6s">Check</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= check-status-section end ========================= -->
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
        $('#checkForm').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('check.status.result') }}",
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
                        var courier_details = `
                            <p>Sender Branch: <strong>${response.sender_branch}</strong></p>
                            <p>Receiver Branch: <strong>${response.receiver_branch}</strong></p>
                            <p>Payment Status: <strong>${response.payment_status}</strong></p>
                            <p>Courier Status: <strong>${response.courier_status}</strong></p>
                        `;
                        $('#courier_details').html(courier_details);
                    }
                },
            });
        });
    })
</script>
@endsection
