
<h5 class="text-center"><strong>Tracking Id: </strong>{{ $courier_summary->tracking_id }}</h5>
<h5 class="text-center"><strong>Courier Status: </strong>{{ $courier_summary->courier_status }}</h5>

<h5 class="text-center bg-success mt-3">Courier Details</h5>
<table class="table">
    <tr>
        <th>Item</th>
        <th>Sender Info</th>
        <th>Receiver Info</th>
    </tr>
    <tbody>
        <tr>
            <td>Branch Name</td>
            <td>{{ App\Models\Branch::find($courier_summary->sender_branch_id)->branch_name }}</td>
            <td>{{ App\Models\Branch::find($courier_summary->receiver_branch_id)->branch_name }}</td>
        </tr>
        <tr>
            <td>Sender Agent</td>
            <td>{{ App\Models\User::find($courier_summary->sender_agent_id)->name }}</td>
            <td>{{ ($courier_summary->delivery_agent_id) ?  App\Models\User::find($courier_summary->delivery_agent_id)->name : "N/A" }}</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>{{ $courier_summary->created_at->format('D d-M,Y h:m:s A') }}</td>
            <td>{{ ($courier_summary->delivery_agent_id) ?  $courier_summary->updated_at->format('D d-M,Y h:m:s A') : "N/A" }}</td>
        </tr>
    </tbody>
</table>

<h5 class="text-center bg-info">Customer Details</h5>
<table class="table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Sender Info</th>
            <th>Receiver Info</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $courier_summary->sender_name }}</td>
            <td>{{ $courier_summary->receiver_name }}</td>
        </tr>
        <tr>
            <td>Phone Email</td>
            <td>{{ ($courier_summary->sender_email) ? $courier_summary->sender_email : "N/A" }}</td>
            <td>{{ ($courier_summary->receiver_email) ? $courier_summary->receiver_email : "N/A" }}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{ $courier_summary->sender_phone_number }}</td>
            <td>{{ $courier_summary->receiver_phone_number }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $courier_summary->sender_address }}</td>
            <td>{{ $courier_summary->receiver_address}}</td>
        </tr>
        <tr>
            <td>Special Comment</td>
            <td colspan="50">{{ $courier_summary->special_comment}}</td>
        </tr>
    </tbody>
</table>

<h5 class="text-center bg-info">Payment Details</h5>
<table class="table">
    <tbody>
        <tr>
            <td>Grand Total</td>
            <td>{{ $courier_summary->grand_total }}</td>
        </tr>
        <tr>
            <td>Payment Type</td>
            <td>{{ $courier_summary->payment_type }}</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td>{{ $courier_summary->payment_status}}</td>
        </tr>
        <tr>
            <td>Payment Amount</td>
            <td>{{ $courier_summary->payment_amount}}</td>
        </tr>
    </tbody>
</table>

<h5 class="text-center bg-info">Item Details</h5>
<table class="table">
    <thead>
        <tr>
            <th>Description</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Total Cost</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courier_details as $item)
        <tr>
            <td>{{ $item->item_description }}</td>
            <td>{{ $item->unit_id }}</td>
            <td>{{ $item->item_quantity }}</td>
            <td>{{ $item->cost_rate }}</td>
            <td>{{ $item->total_cost_rate }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
