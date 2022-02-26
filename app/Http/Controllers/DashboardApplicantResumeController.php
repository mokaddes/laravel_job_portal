<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use Auth;
use App\Models\ApplicantProfile;
use App\Models\EmploymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class DashboardApplicantResumeController extends Controller
{


    public function __construct()
    {
       $this->middleware(['auth', 'applicant']);
    }


    public function resume()
    {
        $data = ApplicantProfile::where('user_id',Auth::user()->id)->first();
        $employ_history = EmploymentHistory::where('user_id',Auth::user()->id)->get();
        $education_history = DB::table('education_history')->where('user_id',Auth::user()->id)->get();
        $additional_lang = DB::table('employee_language_skills')->where('user_id',Auth::user()->id)->get();
        $language =  DB::table('language')->get();
        $formdatas =  DB::table('d_forms')->get();
        return view('applicant.resume',compact('data','employ_history', 'language', 'formdatas', 'education_history', 'additional_lang'));
    }


	public function resumeStore(Request $request)
	{
	    // dd($request->all());
        $check = ApplicantProfile::where('user_id',Auth::user()->id)->first();

		if($request->part == 'basic'){
            if(!$check){
                $request->validate([
                    'first_name' => 'required',
                    'last_name'  => 'required',
                    'email'      => ['required', 'string', 'email', 'max:255'],
                    'cv' 		 => 'required|mimes:pdf'
                ]);
            }


		 $data = array();
		 $data['first_name'] = $request->first_name;
		 $data['last_name']  = $request->last_name;
		 $data['email']  	 = $request->email;
		 $data['user_id']  	 = Auth::user()->id;
         if ($request->hasFile('cv')) {
            $request->validate([
                'cv' 		 => 'required|mimes:pdf'
            ]);
            $image = $request->file('cv');
            $name  = time() . '.' . $image->getClientOriginalExtension();
            $image->move('media/cv/', $name);
            $data['cv'] = 'media/cv/' . $name;

        }
            if($check){
                DB::table('resumes')->where('user_id', Auth::user()->id)->update($data);
                return redirect()->back()->with('success', 'Data Updated Successfully.');
            } else {
                DB::table('resumes')->insert($data);
                return redirect()->back()->with('success', 'Data Inserted Successfully.');
            }





		}

		if($request->part == 'em_hist'){
        	$request->validate([
			 	'em_hist_beginning_at' 		=> 'required',
			 	'em_hist_company_name'  	=> 'required',
			 	'em_hist_description'   	=> 'nullable',
		     ]);
            $data = array();
            $data['start_date']     = date('Y-m-d', strtotime($request->em_hist_beginning_at));
            if($request->em_hist_til_today){
                $data['end_date']  	= null;
                $data['til_today']  	= 1;
            }else{
                if($request->em_hist_end_at){
                    $data['end_date'] = $request->em_hist_end_at;
                    $data['til_today']  	= 0;
                }else{
                    $data['end_date'] = null;
                }
            }

            $data['company_name']   = $request->em_hist_company_name;
            $data['description']    = $request->em_hist_description;
            $data['created_at']     = Carbon::now();
            $data['created_by']     = auth()->user()->id;
            $data['user_id']        = auth()->user()->id;

             if($request->employ_history_id){
                 //update
                 DB::table('employment_history')->where('id', $request->employ_history_id)->update($data);
                 return redirect()->back()->with('success', 'Data Updated Successfully.');

             }else{
                 //insert
                DB::table('employment_history')->insert($data);
			    return redirect()->back()->with('success', 'Data Inserted Successfully.');
             }

		}

		if($request->part == 'em_desired'){
            if($check){
			   $request->validate([
				  'desired_employment_type'     => 'required',
				  'desired_position'            => 'required',
				  'job_location'                => 'required',
				  'traveling' 		            => 'required',
				  'salary' 		 	            => 'required'
			  ]);
            }

			 $data = array();
			 $data['desired_employment_type']   = $request->desired_employment_type;
			 $data['desired_position']  	 	= $request->desired_position;
			 $data['preferred_job_location']  	= $request->job_location;
			 $data['traveling']  	 			= $request->traveling;
			 $data['salary_expectations']  	 	= $request->salary;

            //  if ($request->desired_employment_type) {
            //     $desired_employment_type_arr       = $request->desired_employment_type;
            //     $data['desired_employment_type']   = implode(', ', $desired_employment_type_arr);
            //     } else {
            //         $data['desired_employment_type'] = null;
            //     }

             if($check){
                DB::table('resumes')->where('user_id', Auth::user()->id)->update($data);
                return redirect()->back()->with('success', 'Data Updated Successfully.');
             }
             else{
                $data['user_id']     = auth()->user()->id;
                DB::table('resumes')->insert($data);
                return redirect()->back()->with('success', 'Data Inserted Successfully.');
            }
		}
        if($request->part == 'native_lang'){
            $request->validate([
                'language'  => 'required',
            ]);
            $check->native_language=$request->language;
            $check->save();
            if($check->native_language!=Null){
                return redirect()->back()->with('success', 'Data updated Successfully.');
            }
            else{
                return redirect()->back()->with('success', 'Data Inserted Successfully.');
            }

        }
        if($request->part == 'investments'){
            $data=$request->validate([
                'investment' 		 => 'required|mimes:pdf'
            ]);
            if ($request->hasFile('investment')) {

                $file = $request->file('investment');
                $name  = time() . '.' . $file->getClientOriginalExtension();
                $file->move('media/investments/', $name);
                $check->investments= 'media/investments/' . $name;
                $check->save();
                return redirect()->back()->with('success', 'Data stored Successfully.');
            }
            else{
                return redirect()->back();
            }

        }



        if($request->part == 'edu_hist'){
        	// $request->validate([
			//  	'em_hist_beginning_at' 		=> 'required',
			//  	'em_hist_company_name'  	=> 'required',
			//  	'em_hist_description'   	=> 'required',
		    //  ]);
            $data = array();

            $data['edu_level']          = $request->edu_level;
            $data['exam_title']         = $request->exam_title;
            $data['result']             = $request->result;
            $data['passing_year']       = $request->passing_year;
            $data['duration']           = $request->duration;
            $data['achievement']        = $request->achievement;
            $data['institution_name']   = $request->institution_name;
            $data['country']            = $request->country;
            $data['city']               = $request->city;
            $data['created_at']         = Carbon::now();
            $data['created_by']         = auth()->user()->id;
            $data['user_id']            = auth()->user()->id;
// dd($data);
             if($request->education_history_id){
                 //update
                 DB::table('education_history')->where('id',  $request->education_history_id )->update($data);
                 return redirect()->back()->with('success', 'Data Updated Successfully.');

             }else{
                //  insert
                DB::table('education_history')->insert($data);
			    return redirect()->back()->with('success', 'Data Inserted Successfully.');
             }

		}

            $data = array();

            $data['language']          = $request->language;
            $data['understand']         = $request->	understand;
            $data['participate_in_conversations']             = $request->participate_in_conversations;
            $data['to_speak']       = $request->to_speak;
            $data['to_read']           = $request->to_read;
            $data['to_write']           = $request->to_write;
            $data['to_listen']        = $request->to_listen;
            $data['created_at']         = Carbon::now();
            $data['created_by']         = auth()->user()->id;
            $data['user_id']            = auth()->user()->id;

            if($request->add_lang_id){
                //update
                DB::table('employee_language_skills')->where('id',  $request->add_lang_id )->update($data);
                return redirect()->back()->with('success', 'Data Updated Successfully.');

            }else{
                //  insert
                DB::table('employee_language_skills')->insert($data);
                return redirect()->back()->with('success', 'Data Inserted Successfully.');
            }



	}

    public function edu_hist_delete($id)
    {
        DB::table('education_history')->where('id', $id)->delete();
                 return redirect()->back()->with('success', 'Data Deleted Successfully.');
    }

    public function emp_hist_delete($id)
    {
        DB::table('employment_history')->where('id', $id)->delete();
                 return redirect()->back()->with('success', 'Data Deleted Successfully.');
    }


    public function add_lang_delete($id)
    {
        DB::table('employee_language_skills')->where('id', $id)->delete();
                 return redirect()->back()->with('success', 'Data Deleted Successfully.');
    }


}
