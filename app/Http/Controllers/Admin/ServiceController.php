<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $services = "";
            $query = Service::select('services.*');

            if($request->status){
                $query->where('services.status', $request->status);
            }

            $services = $query->get();

            return DataTables::of($services)
            ->addIndexColumn()
            ->editColumn('service_photo', function($row){
                return'
                <div class="product-box">
                    <img src="'.asset('uploads/service_photo').'/'.$row->service_photo.'" alt="">
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
            ->rawColumns(['service_photo', 'status', 'action'])
            ->make(true);
        }
        return view('admin.service.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'service_details' => 'required',
            'service_photo' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $service_photo_name =  Str::slug($request->service_name).".". $request->file('service_photo')->getClientOriginalExtension();
            $upload_link = base_path("public/uploads/service_photo/").$service_photo_name;
            Image::make($request->file('service_photo'))->resize(450, 200)->save($upload_link);

            Service::insert([
                'service_name' => $request->service_name,
                'service_details' => $request->service_details,
                'service_photo' => $service_photo_name,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 200,
                'message'=> "Service store successfully."
            ]);
        };
    }

    public function edit(string $id)
    {
        $service = Service::where('id', $id)->first();
        return response()->json($service);
    }

    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'service_details' => 'required',
            'service_photo' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $service->update([
                'service_name' => $request->service_name,
                'service_details' => $request->service_details,
                'updated_by' => Auth::user()->id,
            ]);

            if($request->hasFile('service_photo')){
                unlink(base_path("public/uploads/service_photo/").$service->service_photo);
                $service_photo_name =  Str::slug($request->service_name).".". $request->file('service_photo')->getClientOriginalExtension();
                $upload_link = base_path("public/uploads/service_photo/").$service_photo_name;
                Image::make($request->file('service_photo'))->resize(450, 200)->save($upload_link);
                $service->update([
                    'service_photo' => $service_photo_name,
                    'updated_by' => Auth::user()->id
                ]);
            }

            return response()->json([
                'status' => 200,
                'message'=> "Service update successfully."
            ]);
        }
    }

    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->updated_by = Auth::user()->id;
        $service->deleted_by = Auth::user()->id;
        $service->save();
        $service->delete();
    }

    public function recycle(Request $request)
    {
        if($request->ajax()){
            $recycle_services = Service::onlyTrashed();
            return DataTables::of($recycle_services)
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
        Service::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        Service::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        $service = Service::onlyTrashed()->where('id', $id)->first();
        unlink(base_path("public/uploads/service_photo/").$service->service_photo);
        $service->forceDelete();
    }

    public function status($id)
    {
        $service = Service::findOrFail($id);
        if($service->status == "Active"){
            $service->status = "Inactive";
        }else{
            $service->status = "Active";
        }
        $service->updated_by = Auth::user()->id;
        $service->save();
    }
}
