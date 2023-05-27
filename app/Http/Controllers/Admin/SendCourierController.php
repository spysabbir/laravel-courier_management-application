<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Cost;
use App\Models\CourierDetails;
use App\Models\CourierSummary;
use App\Models\DefaultSetting;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SendCourierController extends Controller
{
    public function sendCourier()
    {
        $branches = Branch::where('status', 'Active')->get();
        $units = Unit::where('status', 'Active')->get();
        $companies = Company::where('status', 'Active')->get();
        return view('admin.send_courier.create', compact('branches', 'units', 'companies'));
    }

    public function getSenderInfo(Request $request)
    {
        $company = Company::where('id', $request->company_id)->first();
        return response()->json($company);
    }

    public function getCostRate(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $cost_rate = Cost::find($unit_id)->cost_rate;

        return response()->json(['cost_rate' => $cost_rate]);
    }

    public function sendCourierPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_type' => 'required',
            'sender_name' => 'required',
            'sender_phone_number' => 'required',
            'sender_address' => 'required',
            'receiver_branch_id' => 'required',
            'receiver_name' => 'required',
            'receiver_phone_number' => 'required',
            'receiver_address' => 'required',
            'payment_type' => 'required',
            'payment_amount' => 'required',
            'inputs.*.item_description' => 'required|max:255',
            'inputs.*.unit_id' => 'required|exists:units,id',
            'inputs.*.item_quantity' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{

            $tracking_id = date('dmy').random_int(100, 999);

            if ($request->payment_type == "Sender Payment") {
                $payment_status = "Paid";
            } else {
                $payment_status = "Unpaid";
            }

            $courier_summary_id = CourierSummary::insertGetId([
                'tracking_id' => $tracking_id,
                'sender_type' => $request->sender_type,
                'sender_branch_id' => Auth::user()->branch_id,
                'sender_name' => $request->sender_name,
                'sender_email' => $request->sender_email,
                'sender_phone_number' => $request->sender_phone_number,
                'sender_address' => $request->sender_address,
                'receiver_branch_id' => $request->receiver_branch_id,
                'receiver_name' => $request->receiver_name,
                'receiver_email' => $request->receiver_email,
                'receiver_phone_number' => $request->receiver_phone_number,
                'receiver_address' => $request->receiver_address,
                'special_comment' => $request->special_comment,
                'grand_total' => $request->grand_total,
                'payment_type' => $request->payment_type,
                'payment_status' => $payment_status,
                'payment_amount' => $request->payment_amount,
                'sender_agent_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            foreach($request->inputs as $value){
                CourierDetails::insert($value+[
                    'courier_summary_id' => $courier_summary_id,
                ]);
            }

            // Send SMS
            $url = "https://bulksmsbd.net/api/smsapi";
            $api_key = env('SMS_API_KEY');
            $senderid = env('SMS_SENDER_ID');
            $number = "$request->receiver_phone_number";
            $message = "Hello $request->sender_name, your courier is processing. Your tracking id is $tracking_id. Save this message if you want to know your status.";
            $data = [
                "api_key" => $api_key,
                "senderid" => $senderid,
                "number" => $number,
                "message" => $message
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            // return $response;
        }
    }

    public function sendCourierInvoice($id)
    {
        $default_setting = DefaultSetting::first();
        $courier_summary = CourierSummary::where('id', $id)->first();
        $courier_details = CourierDetails::where('courier_summary_id', $id)->get();
        return view('admin.send_courier.invoice', compact('courier_summary', 'courier_details', 'default_setting'));
    }

    public function sendCourierList(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::leftJoin('branches', 'courier_summaries.receiver_branch_id', 'branches.id')
                    ->where('sender_agent_id', Auth::user()->id);

            if($request->courier_status){
                $query->where('courier_summaries.courier_status', $request->courier_status);
            }

            $courier_summaries = $query->select('courier_summaries.*', 'branches.branch_name')->get();

            return DataTables::of($courier_summaries)
            ->addIndexColumn()
            ->editColumn('courier_status', function($row){
                if($row->courier_status == 'Processing'){
                    $courier_status = '
                    <span class="badge bg-warning">'.$row->courier_status.'</span>
                    ';
                }else{
                    $courier_status = '
                    <span class="badge bg-success">'.$row->courier_status.'</span>
                    ';
                };
                return $courier_status;
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['courier_status', 'action'])
            ->make(true);
        }
        return view('admin.send_courier.list');
    }

    public function processingCourierList(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::leftJoin('branches', 'courier_summaries.receiver_branch_id', 'branches.id')
                    ->where('sender_branch_id', Auth::user()->branch_id)
                    ->whereIn('courier_status', ['Processing', 'On the way']);

            if($request->courier_status){
                $query->where('courier_summaries.courier_status', $request->courier_status);
            }

            $courier_summaries = $query->select('courier_summaries.*', 'branches.branch_name')->get();

            return DataTables::of($courier_summaries)
            ->addIndexColumn()
            ->editColumn('checkbox', function($row){
                return'
                <input type="checkbox" class="courier_id" name="change_status[]" value="'.$row->id.'">
                ';
            })
            ->editColumn('courier_status', function($row){
                if($row->courier_status == 'Processing'){
                    $courier_status = '
                    <span class="badge bg-warning">'.$row->courier_status.'</span>
                    ';
                }else{
                    $courier_status = '
                    <span class="badge bg-success">'.$row->courier_status.'</span>
                    ';
                };
                return $courier_status;
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['checkbox', 'courier_status', 'action'])
            ->make(true);
        }
        return view('admin.send_courier.processing_list');
    }

    public function deliveredCourierList(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::leftJoin('branches', 'courier_summaries.receiver_branch_id', 'branches.id')
                    ->where('sender_branch_id', Auth::user()->branch_id)
                    ->where('courier_status', 'Delivered');

            if($request->courier_status){
                $query->where('courier_summaries.courier_status', $request->courier_status);
            }

            $courier_summaries = $query->select('courier_summaries.*', 'branches.branch_name')->get();

            return DataTables::of($courier_summaries)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '
                <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.send_courier.delivered_list');
    }

    public function courierDetailsView($id)
    {
        $courier_summary = CourierSummary::where('id', $id)->first();
        $courier_details =  CourierDetails::where('courier_summary_id', $id)->get();
        return view('admin.send_courier.view', compact('courier_summary', 'courier_details'));
    }

    public function changeOnTheWayCourierStatus(Request $request)
    {
        if ($request->all_selected_id) {
            $all_selected_id = explode( ',', $request->all_selected_id );
            CourierSummary::whereIn('id', $all_selected_id)->update(['courier_status' => "On the way"]);
        }else{
            return response()->json([
                'status' => 400,
            ]);
        }
    }
}
