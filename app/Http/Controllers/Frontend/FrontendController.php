<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Branch;
use App\Models\Company;
use App\Models\ContactMessage;
use App\Models\CourierSummary;
use App\Models\DefaultSetting;
use App\Models\PrivacyPolicy;
use App\Models\Service;
use App\Models\TermsOfService;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'Active')->get();
        $testimonials = Testimonial::where('status', 'Active')->get();
        $aboutUs = AboutUs::first();
        $companies = Company::count();
        $branches = Branch::count();
        $happy_customars = CourierSummary::count();
        return view('frontend.index', compact('services', 'testimonials', 'aboutUs', 'companies', 'branches', 'happy_customars'));
    }

    public function allBranch()
    {
        $branches = Branch::where('status', 'Active')->get();
        return view('frontend.all_branch', compact('branches'));
    }

    public function allService()
    {
        $services = Service::where('status', 'Active')->get();
        return view('frontend.all_service', compact('services'));
    }

    public function aboutUs()
    {
        $aboutUs = AboutUs::first();
        return view('frontend.about_us', compact('aboutUs'));
    }

    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('frontend.privacy_policy', compact('privacyPolicy'));
    }

    public function termsOfService()
    {
        $termsOfService = TermsOfService::first();
        return view('frontend.terms_of_service', compact('termsOfService'));
    }

    public function checkStatus()
    {
        return view('frontend.check_status');
    }

    public function checkStatusResult(Request $request)
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
            $courierSummary = CourierSummary::where('tracking_id', $request->tracking_id)->first();
            $sender_branch = $courierSummary->relationtosenderbranch->branch_name;
            $receiver_branch = $courierSummary->relationtoreceiverbranch->branch_name;
            $payment_status = $courierSummary->payment_status;
            $courier_status = $courierSummary->courier_status;
            return response()->json([
                'status' => 200,
                'sender_branch'=> $sender_branch,
                'receiver_branch'=> $receiver_branch,
                'payment_status'=> $payment_status,
                'courier_status'=> $courier_status,
            ]);
        }
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
