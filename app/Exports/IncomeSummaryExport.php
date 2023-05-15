<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IncomeSummaryExport implements FromView
{
    protected $income_summaries;

    public function __construct($income_summaries)
    {
        $this->income_summaries = $income_summaries;
    }

    public function view(): View
    {
        return view('admin.report.income_export', [
            'income_summaries' => $this->income_summaries
        ]);
    }
}
