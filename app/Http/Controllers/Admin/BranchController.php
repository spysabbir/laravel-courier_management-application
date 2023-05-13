<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $branches = "";
            $query = Branch::select('branches.*');

            if($request->status){
                $query->where('branches.status', $request->status);
            }

            $branches = $query->get();

            return DataTables::of($branches)
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
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-warning btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-fill"></i></button>
                    <button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteBtn"><i class="bi bi-trash-fill"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
        }
        return view('admin.branch.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_name' => 'required|max:255',
            'branch_email' => 'required|email|max:255',
            'branch_phone_number' => 'required|min:11|max:14',
            'branch_address' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Branch::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);
        }
    }

    public function show($id)
    {
        $branch = Branch::where('id', $id)->first();
        $branch_members = User::where('branch_id', $branch->id)->get();
        return view('admin.branch.view', compact('branch', 'branch_members'));
    }

    public function edit(string $id)
    {
        $branch = Branch::where('id', $id)->first();
        return response()->json($branch);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'branch_name' => 'required|max:255',
            'branch_email' => 'required|email|max:255',
            'branch_phone_number' => 'required|min:11|max:14',
            'branch_address' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $branch = Branch::findOrFail($id);
            $branch->update($request->all()+[
                'updated_by' => Auth::user()->id,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->updated_by = Auth::user()->id;
        $branch->deleted_by = Auth::user()->id;
        $branch->save();
        $branch->delete();
    }

    public function recycle(Request $request)
    {
        if($request->ajax()){
            $recycle_branches = Branch::onlyTrashed();
            return DataTables::of($recycle_branches)
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
        Branch::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        Branch::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        Branch::onlyTrashed()->where('id', $id)->forceDelete();
    }

    public function status($id)
    {
        $branch = Branch::findOrFail($id);
        if($branch->status == "Active"){
            $branch->status = "Inactive";
        }else{
            $branch->status = "Active";
        }
        $branch->updated_by = Auth::user()->id;
        $branch->save();
    }
}
