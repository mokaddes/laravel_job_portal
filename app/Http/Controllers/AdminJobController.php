<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmploymentType;
use App\Models\Industry;
use App\Models\JobPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\JobPostInvoiceAddress;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Profession;

class AdminJobController extends Controller
{

    public function __construct()
    {
       $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            return view('admin.jobs.index', compact('job'));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\JobPost $jobPost
     * @return \Illuminate\Http\Response
     */
    public function show(JobPost $jobPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\JobPost $jobPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->user_type == 1) {
            $data['title'] = 'Job create';
            $data['locations'] = Location::get();
            $data['professions'] = Profession::get();
            $data['industries'] = Industry::get();
            $data['employmentTypes'] = EmploymentType::get();
            $data['job'] = JobPost::query()->find($id);
            // dd($data['job']);
            $data['organizations'] = Organization::where('user_id',$data['job']->recru_id)->get();
            // dd($data['organizations']);
            $data['category'] = DB::table('job_category')->select('pk_no','name')->get();
            return view('admin.jobs.edit', compact('data'));
        } else {
            abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobPost $jobPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'is_popular' => ''
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

        }
        return redirect(route('adminjobs.edit', $job->id))->withSuccess('data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\JobPost $jobPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPost $jobPost)
    {
        //
    }

    public function jobsStoreInvoice(Request $request)
    {

        $data = $request->validate([
            'company' => 'required',
            'street' => 'required',
            'country' => 'required',
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


        DB::beginTransaction();
        try {
           JobPostInvoiceAddress::query()->create($data);
        } catch (\Exception $e) {
            DB::rollBack();

        }

        DB::commit();
    }

    // public function jobpreview($id)
    // {
    //     $jobs = JobPost::find($id);

    //     return view('recruiter.jobs_create', compact('jobs'));
    // }

    public function inactive($id)
    {
        JobPost::where('id', $id)->update(['status' => 2]);

        return redirect()->back()->with('success', 'Job Status Inactivated');
    }

    public function active($id)
    {
        JobPost::where('id', $id)->update(['status' => 1, 'publish_date' => date('Y-m-d')]);
        return redirect()->back()->with('success', 'Job Status Activated');
    }
}
