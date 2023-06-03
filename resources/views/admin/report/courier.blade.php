@extends('admin.layouts.admin_master')

@section('title', 'Report Courier')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Report Courier</h4>
            </div>
            <div class="card-body">
                <div class="filter">
                    <form action="{{ route('report.courier.export') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <select class="form-control filter_data" id="sender_branch_id" name="sender_branch_id">
                                    <option value="">-- Sender Branch --</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control filter_data" id="receiver_branch_id" name="receiver_branch_id">
                                    <option value="">-- Receiver Branch --</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control filter_data" id="courier_status" name="courier_status">
                                    <option value="">-- Courier Status --</option>
                                    <option value="Processing">Processing</option>
                                    <option value="On the way">On the way</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control filter_data" id="payment_status" name="payment_status">
                                    <option value="">-- Payment Status --</option>
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="Paid">Paid</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Start Date</label>
                                <input type="date" id="created_at_start" class="form-control filter_data" name="created_at_start">
                            </div>
                            <div class="col-lg-3">
                                <label>End Date</label>
                                <input type="date" id="created_at_end" class="form-control filter_data" name="created_at_end">
                            </div>
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-info btn-sm mt-4" id="print">Print</button>
                                <button type="submit" class="btn btn-success btn-sm mt-4">Export</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-primary" id="all_courier_data">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Tracking Id</th>
                                <th>Sender Type</th>
                                <th>Sender Branch Name</th>
                                <th>Receiver Branch Name</th>
                                <th>Payment Status</th>
                                <th>Courier Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Modal -->
                            <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">View</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="modalBody">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
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
        $('#all_courier_data').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('report.courier') }}",
                "data":function(e){
                    e.sender_branch_id = $('#sender_branch_id').val();
                    e.receiver_branch_id = $('#receiver_branch_id').val();
                    e.courier_status = $('#courier_status').val();
                    e.payment_status = $('#payment_status').val();
                    e.created_at_start = $('#created_at_start').val();
                    e.created_at_end = $('#created_at_end').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'tracking_id', name: 'tracking_id' },
                { data: 'sender_type', name: 'sender_type' },
                { data: 'sender_branch_name', name: 'sender_branch_name' },
                { data: 'receiver_branch_name', name: 'receiver_branch_name' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'courier_status', name: 'courier_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Filter Data
        $(document).on('change', '.filter_data', function(e){
            e.preventDefault();
            $('#all_courier_data').DataTable().ajax.reload();
        })
        // View Data
        $(document).on('click', '.viewBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('courier.details.view', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#modalBody').html(response);
                },
            });
        });
        // Print
        $('#print').on('click', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('report.courier.print') }}",
                method: 'GET',
                data: {
                    sender_branch_id : $('#sender_branch_id').val(),
                    receiver_branch_id : $('#receiver_branch_id').val(),
                    courier_status : $('#courier_status').val(),
                    payment_status : $('#payment_status').val(),
                    created_at_start : $('#created_at_start').val(),
                    created_at_end : $('#created_at_end').val(),
                    },
                success: function(data) {
                    $(data).printThis({
                        debug: false,
                        importCSS: true,
                        importStyle: true,
                        removeInline: false,
                        printDelay: 500,
                        header: null,
                        footer: null,
                    })
                }
            });
        })
    })
</script>
@endsection
