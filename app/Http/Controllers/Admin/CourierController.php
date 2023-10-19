<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourierDetails;
use App\Models\CourierSummary;
use App\Models\DefaultSetting;

class CourierController extends Controller
{
    public function courierDetailsView($id)
    {
        $courier_summary = CourierSummary::where('id', $id)->first();
        $courier_details =  CourierDetails::where('courier_summary_id', $id)->get();
        return view('admin.courier.view', compact('courier_summary', 'courier_details'));
    }

    public function courierInvoice($id)
    {
        $default_setting = DefaultSetting::first();
        $courier_summary = CourierSummary::where('id', $id)->first();
        $courier_details = CourierDetails::where('courier_summary_id', $id)->get();
        return view('admin.courier.invoice', compact('courier_summary', 'courier_details', 'default_setting'));
    }
}
