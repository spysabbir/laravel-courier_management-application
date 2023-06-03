<div class="card">
    <div class="card-header">
        <h4 class="text-center">{{ env('APP_NAME') }}</h4>
        <h4 class="text-center">Courier Summary Report</h4>
        <div class="my-3 d-flex justify-content-between">
            <span class="card-text">Sender Branch: {{ $sender_branch_name }}</span>
            <span class="card-text">Receiver Branch: {{ $receiver_branch_name }}</span>
            <span class="card-text">Courier Status: {{ $courier_status }}</span>
            <span class="card-text">Payment Status: {{ $payment_status }}</span>
            <span class="card-text">Order Start Start: {{ $created_at_start }}</span>
            <span class="card-text">Order End Date: {{ $created_at_end }}</span>
        </div>
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
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $courier_summary->tracking_id }}</td>
                        <td>{{ $courier_summary->sender_type }}</td>
                        <td>{{ $courier_summary->relationtosenderbranch->branch_name }}</td>
                        <td>{{ $courier_summary->relationtoreceiverbranch->branch_name }}</td>
                        <td>{{ $courier_summary->payment_status }}</td>
                        <td>{{ $courier_summary->courier_status }}</td>
                        <td>{{ $courier_summary->created_at->format('d-M,Y h:m A') }}</td>
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
        <p class="card-text">Report Print Date : {{ date('d,M-Y') }}</p>
    </div>
</div>
