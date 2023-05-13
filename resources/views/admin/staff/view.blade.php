<table class="table">
    <thead>
        <tr>
            <th>Profile Photo</th>
            <th><img src="{{ asset('uploads/profile_photo') }}/{{ $staff->profile_photo }}" class="rounded-circle shadow" width="120" height="120" alt="Profile Photo"></th>
        </tr>
        <tr>
            <th>Name</th>
            <th>{{ $staff->name }}</th>
        </tr>
        <tr>
            <th>Created At</th>
            <th><span class="badge bg-success">{{ $staff->created_at->format('D d-M,Y h:m:s A') }}</span></th>
        </tr>
        <tr>
            <th>Last Active</th>
            <th><span class="badge bg-info">{{ date('D d-M,Y h:m:s A', strtotime($staff->last_active)) }}</span></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Email</td>
            <td>{{ $staff->email }}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{ $staff->phone_number }}</td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>{{ $staff->gender }}</td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td>{{ $staff->date_of_birth }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $staff->address }}</td>
        </tr>
        <tr>
            <td>Branch Name</td>
            <td>{{ $staff->relationtobranch->branch_name }}</td>
        </tr>
    </tbody>
</table>
