@extends('admin.layouts.admin_master')

@section('title', 'Report Income')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Report Income</h4>
            </div>
            <div class="card-body">
                <div class="filter">
                    <form action="{{ route('report.income.export') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label>Branch</label>
                                <select class="form-control filter_data" id="branch_id" name="branch_id">
                                    <option value="">-- Branch --</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Start Date</label>
                                <input type="date" id="created_at_start" name="created_at_start" class="form-control filter_data">
                            </div>
                            <div class="col-lg-3">
                                <label>End Date</label>
                                <input type="date" id="created_at_end" name="created_at_end" class="form-control filter_data">
                            </div>
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-info btn-sm mt-4" id="print">Print</button>
                                <button type="submit" class="btn btn-success btn-sm mt-4">Export</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-primary" id="all_income_data">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Branch Name</th>
                                <th>Payment Type</th>
                                <th>Payment Amount</th>
                                <th>Courier Status</th>
                            </tr>
                        </thead>
                        <tbody>

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
        $('#all_income_data').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('report.income') }}",
                "data":function(e){
                    e.branch_id = $('#branch_id').val();
                    e.created_at_start = $('#created_at_start').val();
                    e.created_at_end = $('#created_at_end').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'branch_name', name: 'branch_name' },
                { data: 'payment_type', name: 'payment_type' },
                { data: 'payment_amount', name: 'payment_amount' },
                { data: 'courier_status', name: 'courier_status' },
            ]
        });
        // Filter Data
        $(document).on('change', '.filter_data', function(e){
            e.preventDefault();
            $('#all_income_data').DataTable().ajax.reload();
        })
        // Print
        $('#print').on('click', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('report.income.print') }}",
                method: 'GET',
                data: {
                    branch_id : $('#branch_id').val(),
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
