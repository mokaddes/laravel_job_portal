<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantProfile;
use App\Models\SocailProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class DashboardApplicantProfileController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth', 'applicant']);
    }

    public function applicantProfile()
    {
        $profile = ApplicantProfile::where('user_id', Auth::user()->id)->first();
        return view('applicant.profile', compact('profile'));
    }

    public function applicantProfileUpdate(Request $request, $id)
    {
         $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'username'  => 'required',
            'email'     => 'required'
         ]);

         $data = ApplicantProfile::find($id);
         $data->first_name   = $request->first_name;
         $data->last_name    = $request->last_name;
         $data->username    = $request->username;
         $data->email       = $request->email;
         if ($request->hasFile('image')) {
            // delete old image
            $destination = public_path($data->image);
            if (file_exists($destination)) {
                File::delete($destination);
            }
            // add new image
            $image = $request->file('image');
            $name  = time() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images/profile/', $name);
            $data->image = 'assets/images/profile/' . $name;
         }

         $data->update();
         return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function socail_add(Request $request)
    {
        $check = SocailProfile::where('user_id',Auth::user()->id)->first();

        $request->validate([
            'facebook' => 'nullable',
            'twitter'  => 'nullable',
            'linkedin'  => 'nullable',
         ]);

        if ($request->part == 'facebook') {

            $data = array();
            $data['facebook'] = $request->facebook;
            $data['user_id']  	 = Auth::user()->id;

            if($check){
                DB::table('socail_profiles')->where('user_id', Auth::user()->id)->update($data);
                return redirect()->back()->with('success', 'Data Updated Successfully.');
            } else {
                DB::table('socail_profiles')->insert($data);
                return redirect()->back()->with('success', 'Data Inserted Successfully.');
            }

            return redirect()->back()->with('success', 'Socail Link Inserted');
        }


        if ($request->part == 'twitter') {

            $data = array();
            $data['twitter'] = $request->twitter;
            $data['user_id']  	 = Auth::user()->id;

            if($check){
                DB::table('socail_profiles')->where('user_id', Auth::user()->id)->update($data);
                return redirect()->back()->with('success', 'Data Updated Successfully.');
            } else {
                DB::table('socail_profiles')->insert($data);
                return redirect()->back()->with('success', 'Data Inserted Successfully.');
            }

            return redirect()->back()->with('success', 'Socail Link Inserted');
        }

        if ($request->part == 'linkedin') {

            $data = array();
            $data['linkedin'] = $request->linkedin;
            $data['user_id']  	 = Auth::user()->id;

            if($check){
                DB::table('socail_profiles')->where('user_id', Auth::user()->id)->update($data);
                return redirect()->back()->with('success', 'Data Updated Successfully.');
            } else {
                DB::table('socail_profiles')->insert($data);
                return redirect()->back()->with('success', 'Data Inserted Successfully.');
            }

            return redirect()->back()->with('success', 'Socail Link Inserted');
        }
    }


}
