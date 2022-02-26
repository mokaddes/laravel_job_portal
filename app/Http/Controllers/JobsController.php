<?php

namespace App\Http\Controllers;

use App\Models\EmploymentType;
use App\Models\Industry;
use App\Models\JobPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\JobPostInvoiceAddress;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Profession;

class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(['auth', 'recruiter']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {

        $job = JobPost::Where('recru_id', Auth::user()->id)->latest();

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
        return view('recruiter.jobs', compact('job'));
    }

    public function jobsCreate(Request $request)
    {
        if (Auth::user()->user_type == 3 || Auth::user()->user_type == 1) {
            $data['title'] = 'Job create';
            $data['locations'] = DB::table('locations')->get();
            $data['professions'] = Profession::get();
            $data['industries'] = Industry::get();


            $data['employmentTypes'] = EmploymentType::get();
            $data['organizations'] = Organization::where('user_id', auth()->user()->id)->get();
            $data['job'] = [];
            if ($request->query->has('jobid')) {
                $data['job'] = JobPost::query()->find($request->query->get('jobid'));
                if ($data['job']) {

                }
                $data['invoice'] = DB::table('job_post_invoice_address')->where('job_post_id', $data['job']->id)->first();

            }
            $data['category'] = DB::table('job_category')->select('pk_no', 'name')->get();

            return view('recruiter.jobs_create', compact('data'));
        } else {
            abort('404');
        }

    }

    public function jobsStore(Request $request)
    {

        $data = $request->validate([
            'title' => '',
            'location' => '',
            'company' => '',
            'managers' => '',
            'profession' => '',
            'industries' => '',
            'employment_type' => '',
            'salary' => '',
            'currency' => '',
            'time_interval_unit' => '',
            'context' => '',
            'responsibilities' => '',
            'job_category_id' => '',
            'publish_date'  => '',
            'deadline'  => '',
            'qualification' => '',
            'vacancy'   => '',

        ]);


        $data['recru_id'] = auth()->user()->id;

        if ($request->has('multiposting')) {
            if ($request->yawik == "on") {
                $data['yawik'] = 1;
            } else {
                $data['yawik'] = 0;
            }

            if ($request->jobsintown == "on") {
                $data['jobsintown'] = 1;
            } else {
                $data['jobsintown'] = 0;
            }
            if ($request->fazjob_net == "on") {
                $data['fazjob_net'] = 1;
            } else {
                $data['fazjob_net'] = 0;
            }
            if ($request->your_homepage == "on") {
                $data['your_homepage'] = 1;
            } else {
                $data['your_homepage'] = 0;
            }
        }

        if ($request->vacancy) {
            $data['vacancy'] = $request->vacancy;
        }
        if ($request->context) {
            $data['context'] = $request->context;
        }

        if ($request->experience_requirement) {
            $data['experience_requirement'] = $request->experience_requirement;
        }
        if ($request->context) {
            $data['context'] = $request->context;
        }
        if ($request->responsibilities) {
            $data['responsibilities'] = $request->responsibilities;
        }


        DB::beginTransaction();
        try {
            $job = JobPost::query();
            if ($request->query->get('jobid')) {
                $job = $job->find($request->query->get('jobid'));
                $job->update($data);
            } else {
                $job = $job->create($data);
            }

            $slug = Str::slug($job->title);
            $check = JobPost::query()
                ->where('id', '!=', $job->id)
                ->where('url_slug', '=', $slug)
                ->first('code');
            if ($check) {
                $slug .= '-' . $job->code;
            }

            $job->update([
                'url_slug' => Str::slug($job->getOriginal('title'))
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect(route('recruiter.jobs_create') . '?jobid=' . $job->id)->withSuccess('data stored successfully');
    }

    public function jobsEdit($id)
    {
        if (Auth::user()->user_type) {
            $data['title'] = 'Job create';
            $data['locations'] = Location::get();
            $data['professions'] = Profession::get();
            $data['industries'] = Industry::get();
            $data['employmentTypes'] = EmploymentType::get();

            $data['organizations'] = Organization::where('user_id', auth()->user()->id)->get();
            $data['job'] = JobPost::query()->find($id);
            $data['invoice'] = DB::table('job_post_invoice_address')->where('job_post_id', $data['job']->id)->first();
            $data['category'] = DB::table('job_category')->select('pk_no', 'name')->get();
            return view('recruiter.jobs_edit', compact('data'));
        } else {
            abort('404');
        }
    }

    public function jobsUpdate(Request $request, $id)
    {

        $data = $request->validate([
            'title' => '',
            'location' => '',
            'company' => '',
            'managers' => '',
            'profession' => '',
            'industries' => '',
            'employment_type' => '',
            'salary' => '',
            'currency' => '',
            'time_interval_unit' => '',
            'context' => '',
            'responsibilities' => '',
            'job_category_id' => '',
            'publish_date'  => '',
            'deadline'  => '',
            'qualification' => '',
        ]);


        $data['recru_id'] = auth()->user()->id;

        if ($request->has('multiposting')) {
            if ($request->yawik == "on") {
                $data['yawik'] = 1;
            } else {
                $data['yawik'] = 0;
            }

            if ($request->jobsintown == "on") {
                $data['jobsintown'] = 1;
            } else {
                $data['jobsintown'] = 0;
            }
            if ($request->fazjob_net == "on") {
                $data['fazjob_net'] = 1;
            } else {
                $data['fazjob_net'] = 0;
            }
            if ($request->your_homepage == "on") {
                $data['your_homepage'] = 1;
            } else {
                $data['your_homepage'] = 0;
            }
        }
        if ($request->location) {
            $data['location'] = $request->location;
        }

        if ($request->vacancy) {
            $data['vacancy'] = $request->vacancy;
        }
        if ($request->context) {
            $data['context'] = $request->context;
        }

        if ($request->experience_requirement) {
            $data['experience_requirement'] = $request->experience_requirement;
        }
        if ($request->context) {
            $data['context'] = $request->context;
        }
        if ($request->responsibilities) {
            $data['responsibilities'] = $request->responsibilities;
        }


        DB::beginTransaction();
        try {
            $job = JobPost::query();
            $job = $job->find($id);
            $job->update($data);
            $job->update([
                'url_slug' => Str::slug($job->getOriginal('title'))
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect(route('recruiter.jobs_edit', $job->id))->withSuccess('data updated successfully');
    }

    public function jobsStoreInvoice(Request $request)
    {


        $data = $request->validate([
            'company' => 'required',
            'street' => 'required',
            'house_number' => 'required',
            'postalcode' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => 'required',
            'tax_id' => 'required',
            'salutation' => 'required',
            'contact_person' => 'required',
            'email' => 'required|email',
        ]);

        $data['job_post_id'] = $request->jobid;
        // $jobPostInvoice = JobPostInvoiceAddress::query()->create($data);


            if ($request->invoice_id) {
                // dd($request->jobid);
                JobPostInvoiceAddress::where('job_post_id', $request->jobid)->update($data);
                return redirect()->back()->withSuccess('data Updated successfully');
            } else {

                JobPostInvoiceAddress::query()->create($data);
                return redirect()->back()->withSuccess('data stored successfully');
            }

    }

    public function jobpreview($id)
    {
        $jobs = JobPost::find($id);

        return view('recruiter.jobs_create', compact('jobs'));
    }

    public function inactive($id)
    {
        JobPost::where('id', $id)->update(['status' => 3]);

        return redirect()->back()->with('success', 'Job Status Inactivated');
    }

    public function active($id)
    {
        JobPost::where('id', $id)->update(['status' => 1]);

        return redirect()->back()->with('success', 'Job Status Activated');
    }



}
