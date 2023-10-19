<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CourierSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DeliveryCourierController extends Controller
{
    // Staff Method
    public function deliveryCourier(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::leftJoin('branches', 'courier_summaries.sender_branch_id', 'branches.id')
                    ->where('receiver_branch_id', Auth::user()->branch_id)
                    ->where('courier_status', 'Shipped');

            if($request->courier_status){
                $query->where('courier_summaries.courier_status', $request->courier_status);
            }

            $courier_summaries = $query->select('courier_summaries.*', 'branches.branch_name')->get();

            return DataTables::of($courier_summaries)
            ->addIndexColumn()
            ->editColumn('payment_status', function($row){
                if($row->payment_status == 'Unpaid'){
                    $payment_status = '
                    <span class="badge bg-danger">'.$row->payment_status.'</span>
                    ';
                }else{
                    $payment_status = '
                    <span class="badge bg-success">'.$row->payment_status.'</span>
                    ';
                };
                return $payment_status;
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#editModal">Delivery</button>
                ';
                return $btn;
            })
            ->rawColumns(['payment_status', 'action'])
            ->make(true);
        }
        return view('admin.delivery_courier.create');
    }

    public function editDeliveryCourierStatus($id)
    {
        $send_courier_summary = CourierSummary::where('id', $id)->first();
        return response()->json($send_courier_summary);
    }

    public function resendOtp($id)
    {
        $send_courier_summary = CourierSummary::findOrFail($id);
        $otp = random_int(1000, 9999).$id;

        $send_courier_summary->update([
            'otp' => $otp
        ]);

        // Send SMS
        $url = "https://bulksmsbd.net/api/smsapi";
        $api_key = env('SMS_API_KEY');
        $senderid = env('SMS_SENDER_ID');
        $number = "$send_courier_summary->receiver_phone_number";
        $message = "Hello $send_courier_summary->receiver_name, your otp is $otp.";
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

    public function updateDeliveryCourierStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            '*' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $exists = CourierSummary::where('id', $id)->where('otp', $request->otp)->exists();
            if (!$exists) {
                return response()->json([
                    'status' => 401,
                    'message'=> 'Otp Not Valid!'
                ]);
            } else {
                $send_courier_summary = CourierSummary::findOrFail($id);
                $send_courier_summary->update($request->all()+[
                    'payment_status' => "Paid",
                    'courier_status' => "Delivered",
                    'payment_amount' => $send_courier_summary->grand_total,
                    'delivery_agent_id' => Auth::user()->id,
                ]);
            }
        }
    }

    public function deliveryCourierList(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::leftJoin('branches', 'courier_summaries.sender_branch_id', 'branches.id')
                    ->where('delivery_agent_id', Auth::user()->id);

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
                    <a href="'.route('courier.invoice', $row->id).'" class="btn btn-info btn-sm"><i class="bi bi-download"></i></a>
                ';
                return $btn;
            })
            ->rawColumns(['courier_status', 'action'])
            ->make(true);
        }
        return view('admin.delivery_courier.index');
    }

    // Manager Method
    public function processingCourierList(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::leftJoin('branches', 'courier_summaries.receiver_branch_id', 'branches.id')
                    ->where('receiver_branch_id', Auth::user()->branch_id)
                    ->whereIn('courier_status', ['On the way', 'Shipped']);

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
                if($row->courier_status == 'On the way'){
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
                <a href="'.route('courier.invoice', $row->id).'" class="btn btn-info btn-sm"><i class="bi bi-download"></i></a>
                ';
                return $btn;
            })
            ->rawColumns(['checkbox', 'courier_status', 'action'])
            ->make(true);
        }
        return view('admin.delivery_courier.processing_list');
    }

    public function deliveredCourierList(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::leftJoin('branches', 'courier_summaries.receiver_branch_id', 'branches.id')
                    ->where('receiver_branch_id', Auth::user()->branch_id)
                    ->where('courier_status', 'Delivered');

            if($request->courier_status){
                $query->where('courier_summaries.courier_status', $request->courier_status);
            }

            $courier_summaries = $query->select('courier_summaries.*', 'branches.branch_name')->get();

            return DataTables::of($courier_summaries)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '
                <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                <a href="'.route('courier.invoice', $row->id).'" class="btn btn-info btn-sm"><i class="bi bi-download"></i></a>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.delivery_courier.delivered_list');
    }

    public function changeShippedCourierStatus(Request $request)
    {
        if ($request->all_selected_id) {
            $all_selected_id = explode( ',', $request->all_selected_id );
            foreach($all_selected_id as $selected_id){
                $courier_summary = CourierSummary::where('id', $selected_id)->first();
                $branch = Branch::find($courier_summary->receiver_branch_id);
                $otp = random_int(1000, 9999).$selected_id;
                $courier_summary->update([
                    'courier_status' => "Shipped",
                    'otp' => $otp,
                ]);
                // Send SMS
                $url = "https://bulksmsbd.net/api/smsapi";
                $api_key = env('SMS_API_KEY');
                $senderid = env('SMS_SENDER_ID');
                $number = "$courier_summary->receiver_phone_number";
                $message = "Hello $courier_summary->receiver_name, your courier is received in $branch->branch_name. Your tracking id is $courier_summary->tracking_id and courier delivery otp number is $otp . Please save this message and collect your courier.";
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
        }else{
            return response()->json([
                'status' => 400,
            ]);
        }
    }
}
