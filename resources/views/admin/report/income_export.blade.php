<table>
    <thead>
    <tr>
        <th>Sl No</th>
        <th>Tracking Id</th>
        <th>Sender Branch</th>
        <th>Receiver Branch</th>
        <th>Grand Total</th>
        <th>Payment Status</th>
        <th>Courier Status</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach($income_summaries as $summary)
        <tr>
            <td>{{ $loop->index+1}}</td>
            <td>{{ $summary->tracking_id }}</td>
            <td>{{ $summary->relationtosenderbranch->branch_name }}</td>
            <td>{{ $summary->relationtoreceiverbranch->branch_name }}</td>
            <td>{{ $summary->grand_total }}</td>
            <td>{{ $summary->payment_status }}</td>
            <td>{{ $summary->courier_status }}</td>
            <td>{{ $summary->created_at }}</td>
        </tr>
        @php
            $total += $summary->grand_total;
        @endphp
        @endforeach
        <tr>
            <td class="text-center" colspan="4">Total</td>
            <td>{{ $total }}</td>
        </tr>
    </tbody>
</table>
