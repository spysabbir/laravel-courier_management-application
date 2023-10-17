@extends('admin.layouts.admin_master')

@section('title', 'Send Courier')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Details</h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST" id="sendCourierForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Sender information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>Sender Type</label>
                                        <select name="sender_type" class="form-select" id="sender_type">
                                            <option value="">Select Type</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Company">Company</option>
                                        </select>
                                        <span class="text-danger error-text sender_type_error"></span>
                                    </div>
                                    <div class="mb-3" id="company_name">
                                        <label>Company Name</label>
                                        <select class="form-select" id="selectCompany">
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Sender Name</label>
                                        <input type="text" class="form-control" name="sender_name" id="sender_name" placeholder="Sender name">
                                        <span class="text-danger error-text sender_name_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Sender Email</label>
                                        <input type="text" class="form-control" name="sender_email" id="sender_email" placeholder="Sender email">
                                    </div>
                                    <div class="mb-3">
                                        <label>Sender Phone Number</label>
                                        <input type="text" class="form-control" name="sender_phone_number" id="sender_phone_number" placeholder="Sender phone number">
                                        <span class="text-danger error-text sender_phone_number_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Sender Address</label>
                                        <textarea class="form-control" name="sender_address" id="sender_address" placeholder="Sender address"></textarea>
                                        <span class="text-danger error-text sender_address_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Receiver information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>Receiver Branch Name</label>
                                        <select name="receiver_branch_id" class="form-select">
                                            <option value="">Select Branch</option>
                                            @foreach ($branches->where('id', '!=' ,Auth::user()->branch_id) as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text receiver_branch_id_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Receiver Name</label>
                                        <input type="text" class="form-control" name="receiver_name" placeholder="Receiver name">
                                        <span class="text-danger error-text receiver_name_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Receiver Email</label>
                                        <input type="text" class="form-control" name="receiver_email" placeholder="Receiver email">
                                    </div>
                                    <div class="mb-3">
                                        <label>Receiver Phone Number</label>
                                        <input type="text" class="form-control" name="receiver_phone_number" placeholder="Receiver phone number">
                                        <span class="text-danger error-text receiver_phone_number_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Receiver Address</label>
                                        <textarea class="form-control" name="receiver_address" placeholder="Receiver address"></textarea>
                                        <span class="text-danger error-text receiver_address_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Item Details</h4>
                                </div>
                                <div class="card-body" id="item_list">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label>Item Description</label>
                                            <textarea class="form-control" rows="1" name="inputs[0][item_description]" placeholder="Item description"></textarea>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                    <label>Unit Name</label>
                                                    <select name="inputs[0][unit_id]" class="form-select select_unit_id" >
                                                        <option value="">Select Unit</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-6 col-12 mb-3">
                                                    <label>Cost</label>
                                                    <input type="number" class="form-control get_cost_rate" name="inputs[0][cost_rate]" placeholder="Cost" readonly>
                                                </div>
                                                <div class="col-lg-2 col-md-6 col-12 mb-3">
                                                    <label>Quantity</label>
                                                    <input type="number" class="form-control get_item_quantity" name="inputs[0][item_quantity]" placeholder="Quantity">
                                                </div>
                                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                                    <label>Total Cost</label>
                                                    <input type="number" class="form-control total_cost_rate" name="inputs[0][total_cost_rate]" placeholder="Total cost" readonly>
                                                </div>
                                                <div class="col-lg-1 col-md-6 col-12 mb-3">
                                                    <label>Action</label>
                                                    <button type="button" class="btn btn-primary add_item_btn"><i class="bi bi-plus-square-dotted"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger" id="validation-errors"></span>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label>Special Comment</label>
                                            <textarea name="special_comment" rows="1" class="form-control" placeholder="Special comment"></textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Grand Total</label>
                                            <input type="number" name="grand_total" class="form-control" id="get_grand_total"  placeholder="Grand total" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Payment Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-3 mb-3">
                                            <label>Payment Type</label>
                                            <select name="payment_type" class="form-select" id="select_payment_type">
                                                <option value="">Select Type</option>
                                                <option value="Sender Payment">Sender Payment</option>
                                                <option value="Receiver Payment">Receiver Payment</option>
                                            </select>
                                            <span class="text-danger error-text payment_type_error"></span>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label>Payment Amount</label>
                                            <input type="number" class="form-control" name="payment_amount" id="get_payment_amount" placeholder="Payment amount" readonly>
                                            <span class="text-danger error-text payment_amount_error"></span>
                                        </div>
                                        <div class="col-lg-2 mb-3">
                                            <button type="submit" class="btn btn-success mt-4 px-5"><i class="bi bi-cursor-fill"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

        $('#company_name').hide();
        // Show Company Name
        $(document).on('change', '#sender_type', function() {
            $('#sender_name').val('');
            $('#sender_email').val('');
            $('#sender_phone_number').val('');
            $('#sender_address').val('');
            var sender_type = $(this).val();
            if (sender_type == 'Company') {
                $('#company_name').show();
                $('#sender_name').attr('readonly', true);
                $('#sender_email').attr('readonly', true);
                $('#sender_phone_number').attr('readonly', true);
                $('#sender_address').attr('readonly', true);
            } else {
                $('#company_name').hide();
                $('#sender_name').removeAttr('readonly');
                $('#sender_email').removeAttr('readonly');
                $('#sender_phone_number').removeAttr('readonly');
                $('#sender_address').removeAttr('readonly');
            }
        });

        // Get Sender Info
        $(document).on('change', '#selectCompany', function() {
            var company_id = $(this).val();
            $.ajax({
                url: "{{ route('get.sender.info') }}",
                type: "POST",
                data: {company_id:company_id},
                success: function (response) {
                    $('#sender_name').val(response.company_name);
                    $('#sender_email').val(response.company_email);
                    $('#sender_phone_number').val(response.company_phone_number);
                    $('#sender_address').val(response.company_address);
                },
            });
        });

        // Add Item
        var counter = 0;
        $('.add_item_btn').click(function() {
            ++counter;
            $('#item_list').append(`
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <textarea class="form-control" rows="1" name="inputs[`+ counter +`][item_description]" placeholder="Item description"></textarea>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <select name="inputs[`+ counter +`][unit_id]" class="form-select select_unit_id" id="select_unit_id">
                                    <option value="">Select Unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 mb-3">
                                <input type="number" class="form-control get_cost_rate" name="inputs[`+ counter +`][cost_rate]" placeholder="Cost" readonly>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 mb-3">
                                <input type="number" class="form-control get_item_quantity" name="inputs[`+ counter +`][item_quantity]" placeholder="Quantity">
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 mb-3">
                                <input type="number" class="form-control total_cost_rate" name="inputs[`+ counter +`][total_cost_rate]" placeholder="Total cost" readonly>
                            </div>
                            <div class="col-lg-1 col-md-6 col-12 mb-3">
                                <button type="button" class="btn btn-danger remove_item_btn"><i class="bi bi-x-octagon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });

        // Remove Item
        $(document).on('click', '.remove_item_btn', function() {
            $(this).parent().parent().parent().parent().remove();

            var cost_rate = $(this).closest(".row").find(".get_cost_rate").val();
            var item_quantity = $(this).closest(".row").find(".get_item_quantity").val();
            var total_cost = cost_rate * item_quantity;
            $(this).closest(".row").find(".total_cost_rate").val(total_cost);

            // Calculate the grand total
            var grand_total = 0;
            $(".total_cost_rate").each(function () {
                grand_total += parseFloat($(this).val()) || 0;
            });
            $("#get_grand_total").val(grand_total);

            $('#select_payment_type').val("");
            $('#get_payment_amount').val("");

        });

        // Get Cost
        $('body').on('change', '.select_unit_id', function() {
            var unit_id = $(this).val();
            var $this = $(this);
            $.ajax({
                url: "{{ route('get.cost.rate') }}",
                type: 'POST',
                data: {unit_id: unit_id},
                success: function(response) {
                    $this.closest('.row').find('.get_cost_rate').val(response.cost_rate);
                    $this.closest('.row').find('.get_item_quantity').val("");
                    $this.closest('.row').find('.total_cost_rate').val(0);
                }
            });
        });

        // Calculate the grand total when the item quantity or cost rate is changed
        $(document).on("change", ".get_item_quantity, .get_cost_rate", function () {
            var cost_rate = $(this).closest(".row").find(".get_cost_rate").val();
            var item_quantity = $(this).closest(".row").find(".get_item_quantity").val();
            var total_cost = cost_rate * item_quantity;
            $(this).closest(".row").find(".total_cost_rate").val(total_cost);

            // Calculate the grand total
            var grand_total = 0;
            $(".total_cost_rate").each(function () {
                grand_total += parseFloat($(this).val()) || 0;
            });
            $("#get_grand_total").val(grand_total);

            $('#select_payment_type').val("");
            $('#get_payment_amount').val("");
        });

        // Get Payment Amount
        $(document).on('change', '#select_payment_type', function (e) {
            e.preventDefault();
            $('#get_payment_amount').val("");
            var payment_amount = $('#get_grand_total').val();
            if ($('#select_payment_type').val() == "Sender Payment") {
                $('#get_payment_amount').val(payment_amount);
            }
            if ($('#select_payment_type').val() == "Receiver Payment") {
                $('#get_payment_amount').val(0);
            }
        });

        // Send Courier
        $('#sendCourierForm').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('send.courier.post') }}",
                type: "POST",
                data: $(this).serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                    $('#validation-errors').empty();
                },
                success: function (response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        if (response.status == 401) {
                            toastr.error('Inputs field Error!');
                            $.each(response.errors, function(field, messages) {
                                const errorList = $('<ul>');
                                $.each(messages, function(index, message) {
                                    errorList.append($('<li>').text(message));
                                });
                                $('#validation-errors').append(errorList);
                            });
                        } else {
                            $('#sendCourierForm')[0].reset();
                            toastr.success('Send courier successfully.');

                            var id = response.courier_summary_id;
                            var url = "{{ route('courier.invoice', ':id') }}";
                            url = url.replace(':id', id);
                            window.location.href = url;
                        }
                    }
                },
            });
        });
    })
</script>
@endsection
