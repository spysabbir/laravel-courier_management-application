<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ManagerController extends Controller
{
    public function allStaff(Request $request)
    {
        if($request->ajax()){
            $all_staff = "";
            if (Auth::user()->role == 'Manager') {
                $query = User::where('role', 'Staff')->where('branch_id', Auth::user()->branch_id)->leftJoin('branches', 'users.branch_id', 'branches.id');
            } else {
                $query = User::where('role', 'Staff')->leftJoin('branches', 'users.branch_id', 'branches.id');
            }

            if($request->status){
                $query->where('users.status', $request->status);
            }

            $all_staff = $query->select('users.*', 'branches.branch_name')->get();

            return DataTables::of($all_staff)
            ->addIndexColumn()
            ->editColumn('branch_name', function($row){
                return'
                <span class="badge bg-dark">'.$row->branch_name.'</span>
                ';
            })
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
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['branch_name', 'status', 'action'])
            ->make(true);
        }
        $branchs = Branch::where('status', 'Active')->get();
        return view('admin.staff.index', compact('branchs'));
    }

    public function staffRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*' => 'required',
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            User::create($request->except(['password', 'password_confirmation'])+[
                'branch_id' => Auth::user()->branch_id,
                'role' => 'Staff',
                'password' => Hash::make($request->password),
            ]);
        }
    }

    public function staffEdit(string $id)
    {
        $staff = User::where('id', $id)->first();
        return response()->json($staff);
    }

    public function staffUpdate(Request $request, string $id)
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
            $staff = User::findOrFail($id);
            $staff->update($request->all());
        }
    }

    public function staffStatus($id)
    {
        $user = User::findOrFail($id);
        if($user->status == "Active"){
            $user->status = "Inactive";
        }else{
            $user->status = "Active";
        }
        $user->save();
    }

    public function staffView($id)
    {
        $staff = User::where('id', $id)->first();
        return view('admin.staff.view', compact('staff'));
    }
}
