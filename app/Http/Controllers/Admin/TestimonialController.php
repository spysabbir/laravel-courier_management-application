<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $testimonials = "";
            $query = Testimonial::select('testimonials.*');

            if($request->status){
                $query->where('testimonials.status', $request->status);
            }

            $testimonials = $query->get();

            return DataTables::of($testimonials)
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
        return view('admin.testimonial.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'testimonial_author_name' => 'required|max:255',
            'testimonial_author_title' => 'required|max:255',
            'testimonial_content' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            Testimonial::create($request->all()+[
                'created_by' => Auth::user()->id,
            ]);
        }
    }

    public function edit(string $id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        return response()->json($testimonial);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'testimonial_author_name' => 'required|max:255',
            'testimonial_author_title' => 'required|max:255',
            'testimonial_content' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->update($request->all()+[
                'updated_by' => Auth::user()->id,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->updated_by = Auth::user()->id;
        $testimonial->deleted_by = Auth::user()->id;
        $testimonial->save();
        $testimonial->delete();
    }

    public function recycle(Request $request)
    {
        if($request->ajax()){
            $recycle_testimonials = Testimonial::onlyTrashed();
            return DataTables::of($recycle_testimonials)
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
        Testimonial::onlyTrashed()->where('id', $id)->update([
            'deleted_by' => NULL
        ]);
        Testimonial::onlyTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        Testimonial::onlyTrashed()->where('id', $id)->forceDelete();
    }

    public function status($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if($testimonial->status == "Active"){
            $testimonial->status = "Inactive";
        }else{
            $testimonial->status = "Active";
        }
        $testimonial->updated_by = Auth::user()->id;
        $testimonial->save();
    }
}
