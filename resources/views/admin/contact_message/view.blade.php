
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>{{ $contact_message->name }}</th>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{ $contact_message->phone_number }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $contact_message->email }}</td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>{{ $contact_message->subject }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <th><span class="badge bg-success">{{ $contact_message->created_at->format('d-M,Y h:m:s A') }}</span></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Message</td>
            <td>{{ $contact_message->message }}</td>
        </tr>
    </tbody>
</table>
