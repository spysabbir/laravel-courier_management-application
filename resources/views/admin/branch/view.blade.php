<h3 class="text-center bg-info">{{ $branch->branch_name }}</h3>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($branch_members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ ($member->phone_number ? $member->phone_number : "N/A") }}</td>
            <td><span class="badge bg-{{ ($member->role == "Manager") ? "success" : "primary" }}">{{ $member->role }}</span></td>
        </tr>
        @empty
        <tr>
            <td>
                Member Not Found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
