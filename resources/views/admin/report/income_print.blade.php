<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ env('APP_NAME') }}</h4>
        {{-- <p class="card-text">Branch Name: {{ ($branch_id) ? App\Models\Branch::find($branch_id)->branch_name : "N/A" }}</p> --}}
        <p class="card-text">Order Start Start: {{ ($created_at_start) ? $created_at_start : "N/A" }}</p>
        <p class="card-text">Order End Date: {{ ($created_at_end) ? $created_at_end : "N/A" }}</p>
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
                    @forelse ($income_summaries as $income_summary)
                    <tr>
                        <td>{{ $income_summary->index+1 }}</td>
                        <td>
                            @if ($income_summary->payment_type == "Sender Payment")
                            <span class="badge bg-dark">{{ App\Models\Branch::find($income_summary->sender_branch_id)->branch_name }}</span>
                            @else
                            <span class="badge bg-dark">{{ App\Models\Branch::find($income_summary->receiver_branch_id)->branch_name }}</span>
                            @endif
                        </td>
                        <td>{{ $income_summary->payment_type }}</td>
                        <td>{{ $income_summary->payment_amount }}</td>
                        <td>{{ $income_summary->courier_status }}</td>
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
