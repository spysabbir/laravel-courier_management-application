<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CourierSummaryExport;
use App\Exports\IncomeSummaryExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CourierSummary;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function reportCourier(Request $request)
    {
        if($request->ajax()){
            $courier_summaries = "";
            $query = CourierSummary::select('courier_summaries.*');

            if($request->sender_branch_id){
                $query->where('courier_summaries.sender_branch_id', $request->sender_branch_id);
            }

            if($request->receiver_branch_id){
                $query->where('courier_summaries.receiver_branch_id', $request->receiver_branch_id);
            }

            if($request->courier_status){
                $query->where('courier_summaries.courier_status', $request->courier_status);
            }

            if($request->payment_status){
                $query->where('courier_summaries.payment_status', $request->payment_status);
            }

            if($request->created_at_start){
                $query->whereDate('courier_summaries.created_at', '>=', $request->created_at_start);
            }

            if($request->created_at_end){
                $query->whereDate('courier_summaries.created_at', '<=', $request->created_at_end);
            }

            $courier_summaries = $query->get();

            return DataTables::of($courier_summaries)
            ->addIndexColumn()
            ->editColumn('sender_branch_name', function($row){
                return'
                <span class="badge bg-dark">'.Branch::find($row->sender_branch_id)->branch_name.'</span>
                ';
            })
            ->editColumn('receiver_branch_name', function($row){
                return'
                <span class="badge bg-dark">'.Branch::find($row->receiver_branch_id)->branch_name.'</span>
                ';
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['sender_branch_name', 'receiver_branch_name', 'action'])
            ->make(true);
        }

        $branches = Branch::all();

        return view('admin.report.courier', compact('branches'));
    }

    public function reportCourierPrint(Request $request)
    {
        if($request->ajax()) {
            $courier_summaries = "";
            $query = CourierSummary::select('courier_summaries.*');

            if($request->sender_branch_id){
                $query->where('courier_summaries.sender_branch_id', $request->sender_branch_id);
                $sender_branch_name = $request->sender_branch_id;
            }else{
                $sender_branch_name = "All";
            }

            if($request->receiver_branch_id){
                $query->where('courier_summaries.receiver_branch_id', $request->receiver_branch_id);
                $receiver_branch_name = $request->receiver_branch_id;
            }else{
                $receiver_branch_name = "All";
            }

            if($request->courier_status){
                $query->where('courier_summaries.courier_status', $request->courier_status);
                $courier_status = $request->courier_status;
            }else{
                $courier_status = "All";
            }

            if($request->payment_status){
                $query->where('courier_summaries.payment_status', $request->payment_status);
                $payment_status = $request->payment_status;
            }else{
                $payment_status = "All";
            }

            if($request->created_at_start){
                $query->whereDate('courier_summaries.created_at', '>=', $request->created_at_start);
                $created_at_start = $request->created_at_start;
            }else{
                $created_at_start = "All";
            }

            if($request->created_at_end){
                $query->whereDate('courier_summaries.created_at', '<=', $request->created_at_end);
                $created_at_end = $request->created_at_end;
            }else{
                $created_at_end = "All";
            }

            $courier_summaries = $query->get();
        }

        return view('admin.report.courier_print', compact('courier_summaries', 'sender_branch_name', 'receiver_branch_name', 'courier_status', 'payment_status', 'created_at_start', 'created_at_end'));
    }

    public function reportCourierExport(Request $request)
    {
        $courier_summaries = "";
        $query = CourierSummary::select('courier_summaries.*');

        if($request->sender_branch_id){
            $query->where('courier_summaries.sender_branch_id', $request->sender_branch_id);
        }

        if($request->receiver_branch_id){
            $query->where('courier_summaries.receiver_branch_id', $request->receiver_branch_id);
        }

        if($request->courier_status){
            $query->where('courier_summaries.courier_status', $request->courier_status);
        }

        if($request->payment_status){
            $query->where('courier_summaries.payment_status', $request->payment_status);
        }

        if($request->created_at_start){
            $query->whereDate('courier_summaries.created_at', '>=', $request->created_at_start);
        }

        if($request->created_at_end){
            $query->whereDate('courier_summaries.created_at', '<=', $request->created_at_end);
        }

        $courier_summaries = $query->get();

        return Excel::download(new CourierSummaryExport($courier_summaries), 'courier_summaries.xlsx');
    }

    public function reportIncome(Request $request)
    {
        if($request->ajax()){
            $income_summaries = "";
            $query = CourierSummary::where('payment_status', 'Paid');

            if($request->branch_id){
                $query->where('courier_summaries.payment_type', "Sender Payment")
                        ->where('courier_summaries.sender_branch_id', $request->branch_id)
                        ->orWhere('courier_summaries.payment_type', "Receiver Payment")
                        ->where('courier_summaries.receiver_branch_id', $request->branch_id);
            };

            if($request->created_at_start){
                $query->whereDate('courier_summaries.created_at', '>=', $request->created_at_start);
            }

            if($request->created_at_end){
                $query->whereDate('courier_summaries.created_at', '<=', $request->created_at_end);
            }

            $income_summaries = $query->select('courier_summaries.*')->get();

            return DataTables::of($income_summaries)
            ->addIndexColumn()
            ->editColumn('branch_name', function($row){
                if($row->payment_type == "Sender Payment"){
                    return'
                    <span class="badge bg-dark">'.Branch::find($row->sender_branch_id)->branch_name.'</span>
                    ';
                }else{
                    return'
                    <span class="badge bg-dark">'.Branch::find($row->receiver_branch_id)->branch_name.'</span>
                    ';
                }
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['branch_name', 'action'])
            ->make(true);
        }

        $branches = Branch::whereStatus('Active')->get();

        return view('admin.report.income', compact('branches'));
    }

    public function reportIncomePrint(Request $request)
    {
        if ($request->ajax()) {
            $income_summaries = "";
            $query = CourierSummary::where('payment_status', 'Paid');

            if($request->branch_id){
                $query->where('courier_summaries.payment_type', "Sender Payment")
                        ->where('courier_summaries.sender_branch_id', $request->branch_id)
                        ->orWhere('courier_summaries.payment_type', "Receiver Payment")
                        ->where('courier_summaries.receiver_branch_id', $request->branch_id);
            };

            if($request->created_at_start){
                $query->whereDate('courier_summaries.created_at', '>=', $request->created_at_start);
                $created_at_start = $request->created_at_start;
            }else{
                $created_at_start = 'All';
            }

            if($request->created_at_end){
                $query->whereDate('courier_summaries.created_at', '<=', $request->created_at_end);
                $created_at_end = $request->created_at_end;
            }else{
                $created_at_end = 'All';
            }

            $income_summaries = $query->select('courier_summaries.*')->get();
        }
        return view('admin.report.income_print', compact('income_summaries', 'created_at_start', 'created_at_end'));
    }

    public function reportIncomeExport(Request $request)
    {
        $income_summaries = "";
        $query = CourierSummary::where('payment_status', 'Paid');

        if($request->branch_id){
            $query->where('courier_summaries.payment_type', "Sender Payment")
                    ->where('courier_summaries.sender_branch_id', $request->branch_id)
                    ->orWhere('courier_summaries.payment_type', "Receiver Payment")
                    ->where('courier_summaries.receiver_branch_id', $request->branch_id);
        };
        
        if($request->created_at_start){
            $query->whereDate('courier_summaries.created_at', '>=', $request->created_at_start);
        }

        if($request->created_at_end){
            $query->whereDate('courier_summaries.created_at', '<=', $request->created_at_end);
        }

        $income_summaries = $query->select('courier_summaries.*')->get();

        return Excel::download(new IncomeSummaryExport($income_summaries), 'income_summaries.xlsx');
    }
}
