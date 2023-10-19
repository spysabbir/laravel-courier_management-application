@extends('admin.layouts.admin_master')

@section('title', 'Delivery Courier List')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Details</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-primary" id="delivery_courier_data">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Tracking Id</th>
                                <th>Sender Type</th>
                                <th>Sender Name</th>
                                <th>Receiver Name</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delivery</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="deliveryForm">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="delivery_courier_id">
                                                <div class="row">
                                                    <div class="col-lg-4 mb-3">
                                                        <label>Payment Type</label>
                                                        <input type="text" class="form-control" id="payment_type" readonly>
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <label>Payment Amount</label>
                                                        <input type="number" class="form-control" id="payment_amount" readonly>
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <label>Payment Status</label>
                                                        <input type="text" class="form-control" id="payment_status" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 mb-3">
                                                        <label>Otp</label>
                                                        <input type="number" class="form-control" name="otp" placeholder="Enter Otp">
                                                        <span class="text-danger error-text update_otp_error"></span>
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <button type="button" class="btn btn-warning mt-4" id="resendOtpBtn">Resend Otp</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Delivery</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Read Data
        $('#delivery_courier_data').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('delivery.courier') }}",
                "data":function(e){
                    e.courier_status = $('#courier_status').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'tracking_id', name: 'tracking_id' },
                { data: 'sender_type', name: 'sender_type' },
                { data: 'sender_name', name: 'sender_name' },
                { data: 'receiver_name', name: 'receiver_name' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Filter Data
        $(document).on('change', '.filter_data', function(e){
            e.preventDefault();
            $('#delivery_courier_data').DataTable().ajax.reload();
        })
        //Edit
        $(document).on('click', '.editBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('edit.delivery.courier.status', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#delivery_courier_id').val(response.id);
                    $('#payment_type').val(response.payment_type);
                    $('#payment_amount').val(response.grand_total);
                    $('#payment_status').val(response.payment_status);
                    if(response.payment_status == 'Unpaid'){
                        $('#payment_status').addClass('bg-danger');
                    }
                },
            });
        });
        // Resend Otp
        $(document).on('click', '#resendOtpBtn', function () {
            var id = $('#delivery_courier_id').val();
            var url = "{{ route('resend.otp', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    toastr.success('Otp resend successfully.');
                },
            });
        });
        // Update
        $('#deliveryForm').submit(function (event) {
            event.preventDefault();
            var id = $('#delivery_courier_id').val();
            var url = "{{ route('update.delivery.courier.status', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "PUT",
                data: $(this).serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.update_'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        if (response.status == 401) {
                            toastr.error(response.message);
                        } else {
                            $("#editModal").modal('hide');
                            $('#delivery_courier_data').DataTable().ajax.reload();
                            toastr.success('Courier delivered successfully.');
                        }
                    }
                },
            });
        });
    })
</script>
@endsection
