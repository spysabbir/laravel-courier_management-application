<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\ContactMessage;
use App\Models\CourierSummary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function dashboard()
    {
        $branches = Branch::count();
        $companies = Company::count();
        $all_admin = User::where('role','Admin')->count();
        $all_manager = User::where('role','Manager')->count();
        $all_staff = User::where('role','Staff')->count();
        $all_courier = CourierSummary::count();
        $all_message = ContactMessage::count();
        return view('admin.dashboard', compact('branches', 'companies', 'all_admin', 'all_manager', 'all_staff', 'all_courier', 'all_message'));
    }

    public function allManager(Request $request)
    {
        if($request->ajax()){
            $all_manager = "";
            $query = User::where('role', 'Manager')->leftJoin('branches', 'users.branch_id', 'branches.id');

            if($request->status){
                $query->where('users.status', $request->status);
            }

            $all_manager = $query->select('users.*', 'branches.branch_name')->get();

            return DataTables::of($all_manager)
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
        return view('admin.manager.index', compact('branchs'));
    }

    public function managerRegister(Request $request)
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
            User::create($request->except(['password', 'password_confirmation'])+[
                'role' => 'Manager',
                'password' => Hash::make($request->password),
            ]);
        }
    }

    public function managerEdit(string $id)
    {
        $manager = User::where('id', $id)->first();
        return response()->json($manager);
    }

    public function managerUpdate(Request $request, string $id)
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
            $manager = User::findOrFail($id);
            $manager->update($request->all());
        }
    }

    public function managerStatus($id)
    {
        $user = User::findOrFail($id);
        if($user->status == "Active"){
            $user->status = "Inactive";
        }else{
            $user->status = "Active";
        }
        $user->save();
    }

    public function managerView($id)
    {
        $manager = User::where('id', $id)->first();
        return view('admin.manager.view', compact('manager'));
    }
}
