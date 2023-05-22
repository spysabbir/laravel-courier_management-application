<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\PrivacyPolicy;
use App\Models\TermsOfService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function aboutUsPage(){
        $aboutUs = AboutUs::first();
        return view('admin.page.about_us', compact('aboutUs'));
    }

    public function aboutUsPageUpdate(Request $request, $id){
        $request->validate([
            'about_photo' => 'nullable|image|mimes:png,jpg,jpeg',
            '*' => 'required',
        ]);
        $aboutUs = AboutUs::where('id', $id)->first();
        AboutUs::where('id', $id)->update([
            'headline' => $request->headline,
            'description' => $request->description,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        // About Photo Upload
        if($request->hasFile('about_photo')){
            if($aboutUs->about_photo != 'default_about_photo.png'){
                unlink(base_path("public/uploads/default_photo/").$aboutUs->about_photo);
            }
            $about_photo_name = "About-Photo".".". $request->file('about_photo')->getClientOriginalExtension();
            $upload_link = base_path("public/uploads/default_photo/").$about_photo_name;
            Image::make($request->file('about_photo'))->resize(636, 635)->save($upload_link);
            $aboutUs->update([
                'about_photo' => $about_photo_name
            ]);
        }

        $notification = array(
            'message' => 'About us page updated successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function privacyPolicyPage(){
        $privacyPolicy = PrivacyPolicy::first();
        return view('admin.page.privacy_policy', compact('privacyPolicy'));
    }

    public function privacyPolicyPageUpdate(Request $request, $id){
        $request->validate([
            '*' => 'required',
        ]);
        PrivacyPolicy::where('id', $id)->update([
            'headline' => $request->headline,
            'description' => $request->description,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Privacy policy page updated successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function termsOfServicePage(){
        $termsOfService = TermsOfService::first();
        return view('admin.page.terms_of_service', compact('termsOfService'));
    }

    public function termsOfServicePageUpdate(Request $request, $id){
        $request->validate([
            '*' => 'required',
        ]);
        TermsOfService::where('id', $id)->update([
            'headline' => $request->headline,
            'description' => $request->description,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Terms of service page updated successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
}
