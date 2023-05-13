<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cost;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CostController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $costs = "";
            $query = Cost::leftJoin('units', 'costs.unit_id', 'units.id');

            if($request->status){
                $query->where('costs.status', $request->status);
            }

            $costs = $query->select('costs.*', 'units.unit_name')->get();

            return DataTables::of($costs)
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if($row->status == 'Active'){
                    $status = '
                    <span class="badge bg-success">'.$row->status.'</span>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-warning btn-sm statusBtn"><i class="bi bi-hand-thumbs-down-fill"></i></button>
                    ';
                }else{
                    $status = '
                    <span class="badge bg-warning">'.$row->status.'</span>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm statusBtn"><i class="bi bi-hand-thumbs-up-fill"></i></button>
                    ';
                };
                return $status;
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-warning btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-fill"></i></button>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteBtn"><i class="bi bi-trash-fill"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
        }

        $units = Unit::where('status', 'Active')->get();
        return view('admin.cost.index', compact('units'));
    }

    public function store(Request $request)
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
            Cost::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);
        }
    }

    public function edit(string $id)
    {
        $cost = Cost::where('id', $id)->first();
        return response()->json($cost);
    }

    public function update(Request $request, string $id)
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
            $cost = Cost::findOrFail($id);
            $cost->update($request->all()+[
                'updated_by' => Auth::user()->id,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $cost = Cost::findOrFail($id);
        $cost->updated_by = Auth::user()->id;
        $cost->deleted_by = Auth::user()->id;
        $cost->save();
        $cost->delete();
    }

    public function recycle(Request $request)
    {
        if($request->ajax()){
            $recycle_costs = Cost::onlyTrashed()->leftJoin('units', 'costs.unit_id', 'units.id')->select('costs.*', 'units.unit_name')->get();
            return DataTables::of($recycle_costs)
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm restoreBtn"><i class="bi bi-arrow-clockwise"></i></button>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-sm forceDeleteBtn"><i class="bi bi-trash"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function restore($id)
    {
        Cost::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        Cost::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        Cost::onlyTrashed()->where('id', $id)->forceDelete();
    }

    public function status($id)
    {
        $cost = Cost::findOrFail($id);
        if($cost->status == "Active"){
            $cost->status = "Inactive";
        }else{
            $cost->status = "Active";
        }
        $cost->updated_by = Auth::user()->id;
        $cost->save();
    }
}
