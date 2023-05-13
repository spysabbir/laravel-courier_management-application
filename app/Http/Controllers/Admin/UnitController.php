<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $units = "";
            $query = Unit::select('units.*');

            if($request->status){
                $query->where('units.status', $request->status);
            }

            $units = $query->get();

            return DataTables::of($units)
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
        return view('admin.unit.index');
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
            Unit::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);
        }
    }

    public function edit(string $id)
    {
        $unit = Unit::where('id', $id)->first();
        return response()->json($unit);
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
            $unit = Unit::findOrFail($id);
            $unit->update($request->all()+[
                'updated_by' => Auth::user()->id,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->updated_by = Auth::user()->id;
        $unit->deleted_by = Auth::user()->id;
        $unit->save();
        $unit->delete();
    }

    public function recycle(Request $request)
    {
        if($request->ajax()){
            $recycle_units = Unit::onlyTrashed();
            return DataTables::of($recycle_units)
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
        Unit::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        Unit::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        Unit::onlyTrashed()->where('id', $id)->forceDelete();
    }

    public function status($id)
    {
        $unit = Unit::findOrFail($id);
        if($unit->status == "Active"){
            $unit->status = "Inactive";
        }else{
            $unit->status = "Active";
        }
        $unit->updated_by = Auth::user()->id;
        $unit->save();
    }
}
