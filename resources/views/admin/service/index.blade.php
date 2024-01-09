@extends('admin.layouts.admin_master')

@section('title', 'Service')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">List</h4>
                <div class="action-btn">
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
                                <form action="" method="POST" id="createForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Service Name</label>
                                            <input type="text" class="form-control" name="service_name" placeholder="Service Name">
                                            <span class="text-danger error-text service_name_error"></span>
                                        </div>
                                        <div class="mb-3">
                                            <label>Service Details</label>
                                            <textarea name="service_details" class="form-control" placeholder="Service Details"></textarea>
                                            <span class="text-danger error-text service_details_error"></span>
                                        </div>
                                        <div class="mb-3">
                                            <label>Service Photo</label>
                                            <input type="file" name="service_photo" class="form-control" id="image" accept=".jpeg, .jpg, .png">
                                            <img src="" width="100"  height="100" id="imagePreview" style="display:none;">
                                            <span class="text-danger error-text service_photo_error"></span>
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
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#recycleModal"><i class="bi bi-recycle"></i></button>
                    <!-- Modal -->
                    <div class="modal fade" id="recycleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Recycle</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped table-hover table-borderless table-primary align-middle" id="recycleDataTable" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Service Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="filter">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <select class="form-select filter_data" id="status">
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
                                <th>Service Name</th>
                                <th>Service Photo</th>
                                <th>Service Status</th>
                                <th>Action</th>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="#" method="POST" id="editForm" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <input type="hidden" id="service_id">
                                                <div class="mb-3">
                                                    <label>Service Name</label>
                                                    <input type="text" class="form-control" name="service_name" id="service_name">
                                                    <span class="text-danger error-text update_service_name_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Service Details</label>
                                                    <textarea name="service_details" class="form-control" id="service_details"></textarea>
                                                    <span class="text-danger error-text update_service_details_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Service Photo</label>
                                                    <input type="file" name="service_photo" class="form-control" id="updateImage" accept=".jpeg, .jpg, .png">
                                                    <img src="" width="100"  height="100" id="updateImagePreview">
                                                    <span class="text-danger error-text update_service_photo_error"></span>
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
                        </thead>
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
                url: "{{ route('service.index') }}",
                "data":function(e){
                    e.status = $('#status').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'service_name', name: 'service_name' },
                { data: 'service_photo', name: 'service_photo' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Filter Data
        $(document).on('change', '.filter_data', function(e){
            e.preventDefault();
            $('#allDataTable').DataTable().ajax.reload();
        })
        // Store Image Preview
        $('#image').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });
        // Store Data
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: "{{ route('service.store') }}",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    if(response.status == 400){
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $('#createForm')[0].reset();
                        $("#createModal").modal('hide');
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success(response.message);
                    }
                },
            });
        });
        // Edit Data
        $(document).on('click', '.editBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('service.edit', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#service_id').val(response.id);
                    $('#service_name').val(response.service_name);
                    $('#service_details').val(response.service_details);
                    $('#updateImagePreview').attr('src', "{{ asset('uploads/service_photo') }}"+"/"+ response.service_photo);
                },
            });
        });
        // Update Image Preview
        $('#updateImage').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#updateImagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });
        // Update Data
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            var id = $('#service_id').val();
            var url = "{{ route('service.update', ":id") }}";
            url = url.replace(':id', id)
            const formData = new FormData(this);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    if(response.status == 400){
                        $.each(response.error, function(prefix, val){
                            $('span.update_'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $('#allDataTable').DataTable().ajax.reload();
                        $("#editModal").modal('hide');
                        toastr.success(response.message);
                    }
                },
            });
        });
        // Delete Data
        $(document).on('click', '.deleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('service.destroy', ":id") }}";
            url = url.replace(':id', id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        success: function(response) {
                            $('#allDataTable').DataTable().ajax.reload();
                            toastr.warning('Service delete successfully.');
                            $('#recycleDataTable').DataTable().ajax.reload();
                        }
                    });
                }
            })
        })
        // Recycle Data
        $('#recycleDataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('service.recycle') }}",
            },
            columns: [
                { data: 'service_name', name: 'service_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Restore Data
        $(document).on('click', '.restoreBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('service.restore', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $("#recycleModal").modal('hide');
                    $('#allDataTable').DataTable().ajax.reload();
                    $('#recycleDataTable').DataTable().ajax.reload();
                    toastr.success('Service restore successfully.');
                },
            });
        });
        // Force Delete Data
        $(document).on('click', '.forceDeleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('service.force.delete', ":id") }}";
            url = url.replace(':id', id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            $("#recycleModal").modal('hide');
                            $('#recycleDataTable').DataTable().ajax.reload();
                            toastr.error('Service force delete successfully.');
                        }
                    });
                }
            })
        })
        // Status Change
        $(document).on('click', '.statusBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('service.status', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#allDataTable').DataTable().ajax.reload();
                    toastr.success('Service status change successfully.');
                },
            });
        });
    })
</script>
@endsection
