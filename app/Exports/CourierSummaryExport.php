<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CourierSummaryExport implements FromView
{
    protected $courier_summaries;

    public function __construct($courier_summaries)
    {
        $this->courier_summaries = $courier_summaries;
    }

    public function view(): View
    {
        return view('admin.report.courier_export', [
            'courier_summaries' => $this->courier_summaries
        ]);
    }
}
