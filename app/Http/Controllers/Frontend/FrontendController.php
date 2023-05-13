<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ContactMessage;
use App\Models\DefaultSetting;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'Active')->get();
        $testimonials = Testimonial::where('status', 'Active')->get();
        return view('frontend.index', compact('services', 'testimonials'));
    }

    public function allBranch()
    {
        $branches = Branch::where('status', 'Active')->get();
        return view('frontend.all_branch', compact('branches'));
    }

    public function contactUs()
    {
        $default_setting = DefaultSetting::first();
        return view('frontend.contact_us', compact('default_setting'));
    }

    public function contactMessageSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|min:11|max:14',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            ContactMessage::create($request->all());
        }
    }
}
