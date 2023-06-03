<div class="card">
    <div class="card-header">
        <h4 class="text-center">{{ env('APP_NAME') }}</h4>
        <h4 class="text-center">Income Summary Report</h4>
        <div class="my-3 d-flex justify-content-between">
            {{-- <p class="card-text">Branch Name: {{ $branch_name }}</p> --}}
            <span class="card-text">Order Start Date: {{ $created_at_start }}</span>
            <span class="card-text">Order End Date: {{ $created_at_end }}</span>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Branch Name</th>
                        <th>Payment Type</th>
                        <th>Payment Amount</th>
                        <th>Courier Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @forelse ($income_summaries as $income_summary)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                            @if ($income_summary->payment_type == "Sender Payment")
                            <span>{{ App\Models\Branch::find($income_summary->sender_branch_id)->branch_name }}</span>
                            @else
                            <span>{{ App\Models\Branch::find($income_summary->receiver_branch_id)->branch_name }}</span>
                            @endif
                        </td>
                        <td>{{ $income_summary->payment_type }}</td>
                        <td>{{ $income_summary->payment_amount }}</td>
                        <td>{{ $income_summary->courier_status }}</td>
                    </tr>
                    @php
                        $total += $income_summary->payment_amount;
                    @endphp
                    @empty
                    <tr>
                        <td colspan="50">Courier Not Found</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <p class="card-text">Report Print Date : {{ date('d M Y') }}</p>
    </div>
</div>
