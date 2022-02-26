<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Location;
use App\Models\Industry;
use App\Models\JobCategory;
use Illuminate\Pipeline\Pipeline;
use App\QueryFilters\CategoryFilter;
use App\QueryFilters\SearchFilter;
use App\QueryFilters\IndustryFilter;
use App\QueryFilters\LocationFilter;
use App\QueryFilters\OrganizationFilter;
use App\QueryFilters\TodayJobFilter;
use App\Models\ApplicantProfile;
use App\Models\EmploymentHistory;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(['auth', 'admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(Request $request)
    {
        $user_type = $request->query->get('type') ?? 1;
        $data['users'] = User::query()
            ->where('user_type', '=', $user_type)
            ->get();

        return view('admin.index', compact('data'));
    }
    public function talent_pool()
    {
        return view('admin.talent_pool');
    }

    public function applications()
    {
        $applications = Application::query()->get();
        $resume = DB::table('resumes')->get();
        $jobs = JobPost::query()->get();
        $users = DB::table('users')->get();
        if (request('title') && request('search')== '' && request('status') == '') {
            $applications =  Application::query()
            ->where('job_title', 'like', '%' . request('title') . '%')->get();
        }
        if (request('status') && request('title')== '' && request('search') == '') {
            $applications =  Application::query()
            ->where('status', '=',  request('status'))->get();
        }
        if (request('search') && request('title')== '' && request('status') == '') {
            $applications =  Application::query()
            ->where('job_title', 'like', '%' . request('search') . '%')
            ->orWhere('applicant_name', 'like', '%' . request('search') . '%')
            ->orWhere('company_name', 'like', '%' . request('search') . '%')->get();
        }

        return view('admin.applications', compact('applications', 'resume', 'jobs', 'users'));
    }
    public function jobs()
    {
        if (Auth::user()->user_type == 1) {
            $job = JobPost::latest();

            if (request('job_search')) {

                $job = $job->Where('title', 'like', '%' . request('job_search') . '%')
                    ->orWhere('location', 'like', '%' . request('job_search') . '%')
                    ->orWhere('managers', 'like', '%' . request('job_search') . '%')
                    ->orWhere('company', 'like', '%' . request('job_search') . '%')
                    ->orWhere('salary', 'like', '%' . request('job_search') . '%')
                    ->orWhere('currency', 'like', '%' . request('job_search') . '%')
                    ->orWhere('profession', 'like', '%' . request('job_search') . '%')
                    ->orWhere('context', 'like', '%' . request('job_search') . '%')
                    ->orWhere('responsibilities', 'like', '%' . request('job_search') . '%');
            }

            if (request('status') == 'draft') {
                $job = $job->where('status', 0);
            }
            if (request('status') == 'all') {
                $job = $job->whereIn('status', [1, 2, 3]);
            }
            if (request('status') == 'active') {
                $job = $job->where('status', 1);
            }
            if (request('status') == 'inactive') {
                $job = $job->latest()
                    ->whereIn('status', [2, 3]);
            }
            $job = $job->get();
            return view('admin.jobs', compact('job'));
        } else {
            abort('404');
        }
    }
    public function job_categories()
    {
        return view('admin.job_categories');
    }
    public function users(Request $request)
    {
        $user_type = $request->query->get('type') ?? 1;
        $data['users'] = User::query()
            ->where('user_type', '=', $user_type)
            ->get();

        return view('admin.users', compact('data'));
    }
    public function orders()
    {
        return view('admin.orders');
    }


    public function organizations_profile()
    {
        return view('admin.organizations_profile');
    }

    public function resume()
    {
        $data = ApplicantProfile::where('user_id',Auth::user()->id)->first();
        $employ_history = EmploymentHistory::where('user_id',Auth::user()->id)->get();
        $education_history = DB::table('education_history')->where('user_id',Auth::user()->id)->get();
        $additional_lang = DB::table('employee_language_skills')->where('user_id',Auth::user()->id)->get();
        $language =  DB::table('language')->get();
        $formdatas =  DB::table('d_forms')->get();
        return view('admin.resume',compact('data','employ_history', 'language', 'formdatas', 'education_history', 'additional_lang'));

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
    public function ideas()
    {
        return view('admin.ideas');
    }
    public function jobboard()
    {
        $today = date('Y-m-d');
        $data['jobs'] = app(Pipeline::class)
            ->send(
                JobPost::query()
                    ->select('job_post.*')
                    ->where('status', '=', 1)
                    ->where('deadline', '>=', $today)
                    ->whereNull('deleted_at')
                    ->groupBy('job_post.id')
            )
            ->through([
                CategoryFilter::class,
                IndustryFilter::class,
                LocationFilter::class,
                OrganizationFilter::class,
                TodayJobFilter::class,
            ])
            ->thenReturn();



        $data['jobs'] = $data['jobs']->paginate(15);
//        ddd($data);

        if (request('search')) {
            $data['jobs'] = JobPost::query()
                ->where('status', '=', 1)
                ->where('deadline', '>=', $today)
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('company', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%')
                ->orWhere('context', 'like', '%' . request('search') . '%')
                ->get();
            // dd($data);
        }
        if (request('search') && request('location')== '' && request('length') == '') {
            $data['jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->where('deadline', '>=', $today)
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('company', 'like', '%' . request('search') . '%')
            ->orWhere('location', 'like', '%' . request('search') . '%')
            ->orWhere('context', 'like', '%' . request('search') . '%')
            ->get();
        }

        $data['categories'] = JobCategory::query()
            ->where('is_active', '=', 1)
            ->where('is_delete', '=', 0)
            ->get();
        $data['locations'] = Location::query()->get();
        $data['industries'] = Industry::query()->pluck('name', 'id');
        $data['subscriber'] = DB::table('subscribers')->where('user_id', Auth::user()->id)->first();

        return view('admin.jobboard', compact('data'));
    }

    public function organization_overview()
    {
        $organizations = Organization::all();
        return view('admin.organization_overview',compact('organizations'));
    }

    public function organization_add()
    {
        $countries = Country::get();
        return view('admin.organization_add',compact('countries'));
    }

    public function organizationStore(Request $request)
    {
        $data = $request->validate([
            'org_name' => 'required|string',
            'street' => 'required|string',
            'house_number' => 'required|string',
            'postal_code' => 'required|string',
            'location' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|numeric|min:8',
            'fax' => 'required|numeric|string',
            'image' => 'nullable',
            'description' => 'required|string',
            'ideas' => 'required',
        ]);

        if($request->has('image')) {
            $file = $request->file('image');
            $name_gen = time().".".$file->getClientOriginalExtension();
            $file->move('asset/images/organization',$name_gen);
            $data['image'] = 'asset/images/organization/'.$name_gen;
        }
        $data['user_id'] = auth()->user()->id;

        Organization::create($data);
        return redirect()->route('admin.organization_overview')->with('success','Organization added success');

    }
    public function organization_edit(Organization $organization)
    {
        $countries = Country::get();
        return view('admin.organization_edit',compact('countries', 'organization'));
    }

    public function organizationUpdate(Request $request, Organization $organization)
    {
        $request->validate([
            'org_name' => 'required|string',
            'street' => 'required|string',
            'house_number' => 'required|string',
            'postal_code' => 'required|string',
            'location' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|numeric|min:8',
            'fax' => 'required|numeric|string',
            'image' => 'nullable',
            'description' => 'required|string',
            'ideas' => 'required',
        ]);
        $organization->org_name = $request->org_name;
        $organization->street = $request->street;
        $organization->house_number = $request->house_number;
        $organization->postal_code = $request->postal_code;
        $organization->location = $request->location;
        $organization->country = $request->country;
        $organization->phone = $request->phone;
        $organization->fax = $request->fax;
        $organization->description = $request->description;
        $organization->ideas = $request->ideas;
        $organization->user_id = auth()->user()->id;

        if($request->has('image')) {
            $file = $request->file('image');
            $name_gen = time().".".$file->getClientOriginalExtension();
            $file->move('asset/images/organization',$name_gen);
            $organization->image = 'asset/images/organization/'.$name_gen;
        }

        $organization->update();

        return redirect()->route('admin.organization_overview')->with('success','Organization Update success');

    }

    public function organizationDelete(Organization $organization)
    {
        $organization->delete();

        return redirect()->route('admin.organization_overview')->with('success','Organization delete success');
    }

    public function adminProfile()
    {
        $admin = User::where('id', Auth::user()->id)->first();
        return view('admin.profile', compact('admin'));

    }
    public function adminUpdate(Request $request, $id)
    {


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->update();
        return redirect()->back()->with('success', 'Profile Updated');
    }




}
