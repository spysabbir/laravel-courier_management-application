<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CourierSummaryExport implements FromCollection, WithHeadings, WithMapping
{
    protected $courier_summaries;

    public function __construct($courier_summaries)
    {
        $this->courier_summaries = $courier_summaries;
    }

    public function collection()
    {
        return collect($this->courier_summaries);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Tracking Id',
            'Sender Branch',
            'Receiver Branch',
            'Grand Total',
            'Payment Status',
            'Courier Status',
            'Date',
        ];
    }

    public function map($courier_summaries): array
    {
        return [
            $courier_summaries->id,
            $courier_summaries->tracking_id,
            $courier_summaries->relationtosenderbranch->branch_name,
            $courier_summaries->relationtoreceiverbranch->branch_name,
            $courier_summaries->grand_total,
            $courier_summaries->payment_status,
            $courier_summaries->courier_status,
            $courier_summaries->created_at,
        ];
    }
}
