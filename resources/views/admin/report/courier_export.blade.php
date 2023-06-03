<table>
    <thead>
    <tr>
        <th>Sl No</th>
        <th>Tracking Id</th>
        <th>Sender Branch</th>
        <th>Receiver Branch</th>
        <th>Payment Status</th>
        <th>Courier Status</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
        @foreach($courier_summaries as $summary)
        <tr>
            <td>{{ $loop->index+1}}</td>
            <td>{{ $summary->tracking_id }}</td>
            <td>{{ $summary->relationtosenderbranch->branch_name }}</td>
            <td>{{ $summary->relationtoreceiverbranch->branch_name }}</td>
            <td>{{ $summary->payment_status }}</td>
            <td>{{ $summary->courier_status }}</td>
            <td>{{ $summary->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
