<?php

namespace App\Http\Controllers;

use App\Mail\ApplyConfirmMail;
use App\Models\Application;
use App\Models\Industry;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\Location;
use App\Models\Organization;
use App\QueryFilters\CategoryFilter;
use App\QueryFilters\SearchFilter;
use App\QueryFilters\IndustryFilter;
use App\QueryFilters\LocationFilter;
use App\QueryFilters\NextFourDayFilter;
use App\QueryFilters\NextThreeDayFilter;
use App\QueryFilters\NextTwoDayFilter;
use App\QueryFilters\OrganizationFilter;
use App\QueryFilters\TodayJobFilter;
use App\QueryFilters\TomorrowFilter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = date('Y-m-d');
        $newdate = Carbon::now()->subDays(10)->format('Y-m-d');
        $data['categories'] = JobCategory::query()
            ->where('is_active', '=', 1)
            ->where('is_delete', '=', 0)
            ->orderByDesc('is_top')
            ->get();

        $data['popular'] = JobCategory::query()
            ->select('job_category.*')
            ->where('job_category.is_active', '=', 1)
            ->where('job_category.is_delete', '=', 0)
            ->leftJoin('job_post', 'job_post.job_category_id', '=', 'job_category.pk_no')
            ->where('job_post.is_popular', '=', 1)
            ->groupBy('job_category.pk_no')
            ->get();

        $data['latest_jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->orderByDesc('id')
            ->take(9)
            ->get();
        $data['new_jobs'] = JobPost::query()
        ->where('status', '=', 1)
            ->whereBetween('publish_date', [$newdate, $today])
            ->where('deadline', '>=', $today)
        ->get();

        $data['locations'] = Location::query()->get();
        $data['organizations'] = Organization::query()->pluck('org_name', 'id');

        return view('welcome', compact('data'));
        // dd($newdate);
    }

    public function jobboard()
    {
        return view('jobboard');
    }

    public function details($slug = '')
    {
        $data['job'] = JobPost::query()
            ->where('url_slug', '=', $slug)
            ->firstOrFail();
        $data['job']->update(['view_count' => $data['job']->getOriginal('view_count') + 1]);
        return view('details', compact('data'));
    }

    public function apply(Request $request)
    {
        $resume = DB::table('resumes')->where('user_id', Auth::user()->id)->first();

        if ($request->job_id) {
            $job = JobPost::query()->where('id', $request->job_id)->first();
            $data['job_id']             = $request->job_id;
            $data['recruiter_id']       = $job->recru_id;
            $data['applicant_id']       = Auth::user()->id;
            $data['applicant_name']     = Auth::user()->name;
            $data['resume_id']          = $resume->id ?? '';
            $data['email']              = $resume->email ?? '';
            $data['job_title']          = $job->title;
            $data['company_name']       = $job->company;
            $data['apply_date']         = now();
            $data['status']             = 1;
            // dd($data);
            Application::create($data);

            $recruiter = DB::table('users')->where('id', $job->recru_id)->first();
            $mails = [
                'title' => 'Mail from Job Site',
                'job_title' => $job->title,
                'applicant' => Auth::user()->name,
                'email'     => $resume->email ?? '',
                'apply_date'=>now()
            ];
            $send_mail = Mail::to($recruiter->email)->send(new ApplyConfirmMail($mails));
            return redirect()->back()->with('success', 'Application Complete');
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function search(Request $request)
    {
        $today = date('Y-m-d');
        $tenday = Carbon::now()->subDays(10)->format('Y-m-d');
        $tomorrow = Carbon::now()->addDays(1)->format('Y-m-d');
        $next_two_day = Carbon::now()->addDays(2)->format('Y-m-d');
        $next_three_day = Carbon::now()->addDays(3)->format('Y-m-d');
        $next_four_day = Carbon::now()->addDays(4)->format('Y-m-d');
        $data['jobs'] = app(Pipeline::class)
            ->send(
                JobPost::query()
                    ->select('job_post.*')
                    ->where('status', '=', 1)
                    ->where('publish_date', '<=', $today)
                    ->where('deadline', '>=', $today)
                    ->whereNull('deleted_at')
                    ->groupBy('job_post.id')
            )
            ->through([
                CategoryFilter::class,
                SearchFilter::class,
                IndustryFilter::class,
                LocationFilter::class,
                OrganizationFilter::class,
                TodayJobFilter::class,
            ])
            ->thenReturn();



        $data['jobs'] = $data['jobs']->paginate(5);
//        ddd($data);

        if ($request->query('latest') == 'view_all') {
            $data['jobs'] = JobPost::query()
                ->where('status', '=', 1)
                ->where('publish_date', '<=', $today)
                ->where('deadline', '>=', $today)
                ->orderByDesc('id')
                ->paginate(5);
            // dd($data);
        }

        if ($request->query('new_jobs') == 'newjobs') {
            $data['jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->whereBetween('publish_date', [$tenday, $today])
            ->where('deadline', '>=', $today)
            ->paginate(5);
        }
        if ($request->query('deadline') == 'today') {
            $data['jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->where('publish_date', '<=', $today)
            ->where('deadline', '=', $today)
            ->paginate(5);
        }
        if ($request->query('deadline') == 'tomorrow') {
            $data['jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->where('publish_date', '<=', $today)
            ->whereBetween('deadline', [$today, $tomorrow])
            ->paginate(5);
        }
        if ($request->query('deadline') == 'next_two_day') {
            $data['jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->where('publish_date', '<=', $today)
            ->whereBetween('deadline', [$today, $next_two_day])
            ->paginate(5);
        }
        if ($request->query('deadline') == 'next_three_day') {
            $data['jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->where('publish_date', '<=', $today)
            ->whereBetween('deadline', [$today, $next_three_day])
            ->paginate(5);
        }
        if ($request->query('deadline') == 'next_four_day') {
            $data['jobs'] = JobPost::query()
            ->where('status', '=', 1)
            ->where('publish_date', '<=', $today)
            ->whereBetween('deadline', [$today, $next_four_day])
            ->paginate(5);
        }


        $data['categories'] = JobCategory::query()
            ->where('is_active', '=', 1)
            ->where('is_delete', '=', 0)
            ->get();
        $data['locations'] = Location::query()->get();
        $data['industries'] = Industry::query()->pluck('name', 'id');


        return view('search', compact('data'));
    }


}
