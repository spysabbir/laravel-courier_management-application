@extends('admin.layouts.admin_master')

@section('title', 'All Manager')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">List</h4>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bi bi-plus-circle"></i></button>
                <!-- Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="createForm" >
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                        <span class="text-danger error-text password_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                        <span class="text-danger error-text password_confirmation_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Branch Name</label>
                                        <select name="branch_id" class="form-select">
                                            <option value="">Select Branch</option>
                                            @foreach ($branchs as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text branch_id_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Phone number">
                                        <span class="text-danger error-text phone_number_error"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" placeholder="Address"></textarea>
                                        <span class="text-danger error-text address_error"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Store</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="filter">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <select class="form-control filter_data" id="status">
                                <option value="">-- Select Status --</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless table-primary align-middle" id="allDataTable">
                        <thead class="table-light">
                            <tr>
                                <th>Sl No</th>
                                <th>Manager Name</th>
                                <th>Manager Email</th>
                                <th>Manager Phone Number</th>
                                <th>Branch Name</th>
                                <th>Manager Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="editForm">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" id="manager_id">
                                            <div class="mb-3">
                                                <label>Branch Name</label>
                                                <select name="branch_id" class="form-select" id="branch_id">
                                                    <option value="">Select Branch</option>
                                                    @foreach ($branchs as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error-text update_branch_id_error"></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- View Modal -->
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
        $('#allDataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('all.manager') }}",
                "data":function(e){
                    e.status = $('#status').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'branch_name', name: 'branch_name' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Filter Data
        $(document).on('change', '.filter_data', function(e){
            e.preventDefault();
            $('#allDataTable').DataTable().ajax.reload();
        })
        // Register Data
        $('#createForm').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('manager.register') }}",
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
                        $('#createForm')[0].reset();
                        $("#createModal").modal('hide');
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('Manager register successfully.');
                    }
                },
            });
        });
        // Edit Data
        $(document).on('click', '.editBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('manager.edit', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#manager_id').val(response.id);
                    $('#branch_id').val(response.branch_id);
                },
            });
        });
        // Update Data
        $('#editForm').submit(function (event) {
            event.preventDefault();
            var id = $('#manager_id').val();
            var url = "{{ route('manager.update', ":id") }}";
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
                        $("#editModal").modal('hide');
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('Manager update successfully.');
                    }
                },
            });
        });
        // Change Status Data
        $(document).on('click', '.statusBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('manager.status', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#allDataTable').DataTable().ajax.reload();
                    toastr.success('Manager status change successfully.');
                },
            });
        });
        // View Data
        $(document).on('click', '.viewBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('manager.view', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#modalBody').html(response);
                },
            });
        });
    })
</script>
@endsection
