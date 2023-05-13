<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $contact_messages = "";
            $query = ContactMessage::select('contact_messages.*');

            if($request->status){
                $query->where('contact_messages.status', $request->status);
            }

            $contact_messages = $query->get();

            return DataTables::of($contact_messages)
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if($row->status == 'Read'){
                    $status = '
                    <span class="badge bg-success">'.$row->status.'</span>
                    ';
                }else{
                    $status = '
                    <span class="badge bg-warning">'.$row->status.'</span>
                    ';
                };
                return $status;
            })
            ->editColumn('created_at', function($row){
                return '
                    <span class="badge bg-info">'.$row->created_at->format('d-M,Y').'</span>
                ';
            })
            ->addColumn('action', function ($row) {
                $btn = '
                    <button type="button" data-id="'.$row->id.'" class="btn btn-success btn-sm viewBtn" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="bi bi-eye"></i></button>
                ';
                return $btn;
            })
            ->rawColumns(['status', 'created_at', 'action'])
            ->make(true);
        }
        return view('admin.contact_message.index');
    }

    public function view($id)
    {
        $contact_message = ContactMessage::where('id', $id)->first();
        $contact_message->update([
            'status' => "Read"
        ]);
        return view('admin.contact_message.view', compact('contact_message'));
    }
}
