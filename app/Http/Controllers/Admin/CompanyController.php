<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $companies = "";
            $query = Company::select('companies.*');

            if($request->status){
                $query->where('companies.status', $request->status);
            }

            $companies = $query->get();

            return DataTables::of($companies)
            ->addIndexColumn()
            ->editColumn('company_photo', function($row){
                return'
                <div class="product-box">
                    <img src="'.asset('uploads/company_photo').'/'.$row->company_photo.'" alt="">
                </div>
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
                    <button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteBtn"><i class="bi bi-trash-fill"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['company_photo', 'status', 'action'])
            ->make(true);
        }
        return view('admin.company.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_owner' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_phone_number' => 'required|min:11|max:14',
            'company_address' => 'required',
            'company_url' => 'required',
            'company_photo' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            if($request->hasFile('company_photo')){
                $company_photo_name =  Str::slug($request->company_name).".". $request->file('company_photo')->getClientOriginalExtension();
                $upload_link = base_path("public/uploads/company_photo/").$company_photo_name;
                Image::make($request->file('company_photo'))->resize(239, 110)->save($upload_link);
            }else{
                $company_photo_name = 'default_company_photo.jpg';
            }

            Company::insert([
                'company_name' => $request->company_name,
                'company_owner' => $request->company_owner,
                'company_email' => $request->company_email,
                'company_phone_number' => $request->company_phone_number,
                'company_address' => $request->company_address,
                'company_url' => $request->company_url,
                'company_photo' => $company_photo_name,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 200,
                'message'=> "Company store successfully."
            ]);
        };
    }

    public function edit(string $id)
    {
        $company = Company::where('id', $id)->first();
        return response()->json($company);
    }

    public function update(Request $request, string $id)
    {
        $company = Company::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_owner' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_phone_number' => 'required|min:11|max:14',
            'company_address' => 'required',
            'company_url' => 'required',
            'company_photo' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $company->update([
                'company_name' => $request->company_name,
                'company_owner' => $request->company_owner,
                'company_email' => $request->company_email,
                'company_phone_number' => $request->company_phone_number,
                'company_address' => $request->company_address,
                'company_url' => $request->company_url,
                'updated_by' => Auth::user()->id,
            ]);

            if($request->hasFile('company_photo')){
                if($company->company_photo != 'default_company_photo.jpg'){
                    unlink(base_path("public/uploads/company_photo/").$company->company_photo);
                }
                $company_photo_name =  Str::slug($request->company_name).".". $request->file('company_photo')->getClientOriginalExtension();
                $upload_link = base_path("public/uploads/company_photo/").$company_photo_name;
                Image::make($request->file('company_photo'))->resize(239, 110)->save($upload_link);
                $company->update([
                    'company_photo' => $company_photo_name,
                    'updated_by' => Auth::user()->id
                ]);
            }

            return response()->json([
                'status' => 200,
                'message'=> "Company update successfully."
            ]);
        }
    }

    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->updated_by = Auth::user()->id;
        $company->deleted_by = Auth::user()->id;
        $company->save();
        $company->delete();
    }

    public function recycle(Request $request)
    {
        if($request->ajax()){
            $recycle_companies = Company::onlyTrashed();
            return DataTables::of($recycle_companies)
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
        Company::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        Company::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        $company = Company::onlyTrashed()->where('id', $id)->first();
        if($company->company_photo != 'default_company_photo.jpg'){
            unlink(base_path("public/uploads/company_photo/").$company->company_photo);
        }
        $company->forceDelete();
    }

    public function status($id)
    {
        $company = Company::findOrFail($id);
        if($company->status == "Active"){
            $company->status = "Inactive";
        }else{
            $company->status = "Active";
        }
        $company->updated_by = Auth::user()->id;
        $company->save();
    }
}
