<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ env('APP_NAME') }}</h4>
        <p class="card-text">Sender Branch: {{ ($sender_branch_id) ? App\Models\Branch::find($sender_branch_id)->branch_name : "N/A" }}</p>
        <p class="card-text">Receiver Branch: {{ ($receiver_branch_id) ? App\Models\Branch::find($request->receiver_branch_id)->branch_name : "N/A" }}</p>
        <p class="card-text">Courier Status: {{ ($courier_status) ? $courier_status : "N/A" }}</p>
        <p class="card-text">Payment Status: {{ ($payment_status) ? $payment_status : "N/A" }}</p>
        <p class="card-text">Order Start Start: {{ ($created_at_start) ? $created_at_start : "N/A" }}</p>
        <p class="card-text">Order End Date: {{ ($created_at_end) ? $created_at_end : "N/A" }}</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Tracking Id</th>
                        <th>Sender Type</th>
                        <th>Sender Branch</th>
                        <th>Receiver Branch</th>
                        <th>Payment Status</th>
                        <th>Courier Status</th>
                        <th>Processing Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courier_summaries as $courier_summary)
                    <tr>
                        <td>{{ $courier_summary->index+1 }}</td>
                        <td>{{ $courier_summary->tracking_id }}</td>
                        <td>{{ $courier_summary->sender_type }}</td>
                        <td>{{ $courier_summary->sender_branch_id }}</td>
                        <td>{{ $courier_summary->receiver_branch_id }}</td>
                        <td>{{ $courier_summary->payment_status }}</td>
                        <td>{{ $courier_summary->courier_status }}</td>
                        <td>{{ $courier_summary->created_at->format('D d-M,Y h:m:s A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="50">Courier Not Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <p class="card-text">Report Print Date : {{ date('d M Y') }}</p>
    </div>
</div>
