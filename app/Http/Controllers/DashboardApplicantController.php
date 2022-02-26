<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Country;
use App\Models\CustomizeApplyForm;
use App\Models\JobPost;
use App\Models\JobPostInvoiceAddress;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Order;
use App\Models\Organization;
use App\Models\Setting;
use App\Models\UserMailNotification;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Industry;
use App\Models\JobCategory;
use App\Models\Subscriber;
use Illuminate\Pipeline\Pipeline;
use App\QueryFilters\CategoryFilter;
use App\QueryFilters\SearchFilter;
use App\QueryFilters\IndustryFilter;
use App\QueryFilters\LocationFilter;
use App\QueryFilters\OrganizationFilter;
use App\QueryFilters\TodayJobFilter;

class DashboardApplicantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(['auth', 'applicant']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        return view('applicant.index');
    }
    public function talent_pool()
    {
        return view('applicant.talent_pool');
    }
    public function applications()
    {
        $applications = Application::query()->where('applicant_id', Auth::user()->id)->get();

        $jobs = JobPost::query()->get();
        // dd($jobs);
        return view('applicant.applications', compact('applications', 'jobs'));
    }

    public function ideas()
    {
        $languages = Language::get();
        $zones = Zone::get();
        $setting = Setting::where('id', Auth::user()->id)->first();
        $usermail = UserMailNotification::where('user_id',auth()->user()->id)->first();
        $customizeForm =CustomizeApplyForm::where('user_id',auth()->user()->id)->first();
        $data['orders'] = Order::where('user_id',auth()->user()->id)->first();
        $data['organizations'] = Organization::all();
        $countries = Country::all();
        return view('applicant.ideas', compact('countries','languages','zones', 'setting', 'usermail', 'customizeForm', 'data'));
    }
    public function jobboard(Request $request)
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

        return view('applicant.jobboard', compact('data'));
    }
    public function subscribe(Request $request)
    {
        $check = DB::table('subscribers')->where('user_id', Auth::user()->id)->first();
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers',
            'search_key' => 'nullable',
            'location' => 'nullable',
            'perimeter' => 'nullable',
         ]);
        $data['user_id'] = Auth::user()->id;

        if($check){
            DB::table('subscribers')->where('user_id', Auth::user()->id)->update($data);
            return redirect()->back()->with('success', 'Data Updated Successfully.');
        } else {
            DB::table('subscribers')->insert($data);
            return redirect()->back()->with('success', 'Data Inserted Successfully.');
        }
    }

    public function idea_store(Request $request)
    {

        if ($request->part == 'setting')
        {
            $settings = Setting::firstOrCreate(['id'=> Auth::user()->id],[]);
            $settings->id = Auth::user()->id;
            if($request->has('site_lang_id') && !blank($request->site_lang_id)){
                $lang = Language::findOrFail($request->site_lang_id);
                $settings->site_lang = $lang->name;
                $settings->site_lang_id = $request->site_lang_id;
            }
            if($request->has('time_zone_id') && !blank($request->time_zone_id)){
                $zone = Zone::where('zone_id',$request->time_zone_id)->first();
                $settings->time_zone_id = $request->time_zone_id;
                $settings->time_zone = $zone->zone_name;

            }
            $settings->save();
            return redirect()->back()->with('success', 'Settings Inserted');
        }

        if ($request->part == 'orders') {
            $data = $request->validate([
                'company' => 'required',
                'street' => 'required',
                'house_no' => 'required',
                'postal_code' => 'required',
                'city' => 'required',
                'region' => 'required',
                'country' => 'required',
                'tax_id' => 'required',
                'salutation' => 'required',
                'contact_persion' => 'required',
                'email' => 'required|email',
            ]);

                $data['user_id'] = Auth::user()->id;
                // dd($data);

                if ($request->orders_id) {
                    // dd($request->jobid);
                    DB::table('orders')->where('user_id', Auth::user()->id)->update($data);
                    return redirect()->back()->withSuccess('data Updated successfully');
                } else {

                    DB::table('orders')->insert($data);
                    return redirect()->back()->withSuccess('data stored successfully');
                }
        }



    }

    public function emailTemplatesStore(Request $request)
    {
        $data = $request->validate([
            'mailtext' => 'nullable|string',
            'confirmation_mail_text' => 'nullable|string',
            'invitation_mail_text' => 'nullable|string',
            'accept_mail_text' => 'nullable|string',
            'rejection_mail_text' => 'nullable|string',
        ]);

        if($request->receive_mail_alert == "on"){
            $request->receive_mail_alert = 1;
        }else{
            $request->receive_mail_alert = 0;
        }
        if($request->confirm_application_immidiatly_after_submit == "on"){
            $request->confirm_application_immidiatly_after_submit = 1;
        }else{
            $request->confirm_application_immidiatly_after_submit = 0;
        }
        if($request->get_blind_carbon_copy_of_all_own_mail == "on"){
            $request->get_blind_carbon_copy_of_all_own_mail = 1;
        }else{
            $request->get_blind_carbon_copy_of_all_own_mail = 0;
        }
        $usermail = new UserMailNotification();
        $usermail->user_id = auth()->user()->id;
        $usermail->receive_mail_alert = $request->receive_mail_alert;
        $usermail->mailtext = $request->mailtext;
        $usermail->confirm_application_immidiatly_after_submit = $request->confirm_application_immidiatly_after_submit;
        $usermail->confirmation_mail_text = $request->confirmation_mail_text;
        $usermail->invitation_mail_text = $request->invitation_mail_text;
        $usermail->accept_mail_text = $request->accept_mail_text;
        $usermail->rejection_mail_text = $request->rejection_mail_text;
        $usermail->get_blind_carbon_copy_of_all_own_mail = $request->get_blind_carbon_copy_of_all_own_mail;
        $usermail->save();

        return back()->with('success','Email template submit success');
    }



    public function customizeForm(Request $request)
    {

        $customizeForm =new CustomizeApplyForm();
        if($request->is_active == "on"){
            $customizeForm->is_active = 1;
        }
        else {
            $customizeForm->is_active = 0;
        }
        if($request->facts == "on"){
            $customizeForm->facts = 1;
        }
        else {
            $customizeForm->facts = 0;
        }
        if($request->willingness_to_travel == "on"){
            $customizeForm->willingness_to_travel = 1;
        }
        else {
            $customizeForm->willingness_to_travel = 0;
        }
        if($request->earlies_startin_date == "on"){
            $customizeForm->earlies_startin_date = 1;
        }
        else {
            $customizeForm->earlies_startin_date = 0;
        }
        if($request->Expected_salary == "on"){
            $customizeForm->Expected_salary = 1;
        }
        else {
            $customizeForm->Expected_salary = 0;
        }
        if($request->driving_license == "on"){
            $customizeForm->driving_license = 1;
        }
        else {
            $customizeForm->driving_license = 0;
        }
        if($request->is_active_social_profiles == "on"){
            $customizeForm->is_active_social_profiles = 1;
        }
        else {
            $customizeForm->is_active_social_profiles = 0;
        }
        if($request->facebook == "on"){
            $customizeForm->facebook = 1;
        }
        else {
            $customizeForm->facebook = 0;
        }
        if($request->xing == "on"){
            $customizeForm->xing = 1;
        }
        else {
            $customizeForm->xing = 0;
        }
        if($request->linkedIn == "on"){
            $customizeForm->linkedIn = 1;
        }
        else {
            $customizeForm->linkedIn = 0;
        }
        $customizeForm->user_id = auth()->user()->id;
        $customizeForm->save();
        return back()->with('success','Customize form submited success');

    }

    public function emailTemplatesEdit(Request $request,$id)
    {
        $usermail = UserMailNotification::findOrfail($id);
        $data = $request->validate([
            'mailtext' => 'nullable|string',
            'confirmation_mail_text' => 'nullable|string',
            'invitation_mail_text' => 'nullable|string',
            'accept_mail_text' => 'nullable|string',
            'rejection_mail_text' => 'nullable|string',
        ]);

        if($request->receive_mail_alert == "on"){
            $request->receive_mail_alert = 1;
        }else{
            $request->receive_mail_alert = 0;
        }
        if($request->confirm_application_immidiatly_after_submit == "on"){
            $request->confirm_application_immidiatly_after_submit = 1;
        }else{
            $request->confirm_application_immidiatly_after_submit = 0;
        }
        if($request->get_blind_carbon_copy_of_all_own_mail == "on"){
            $request->get_blind_carbon_copy_of_all_own_mail = 1;
        }else{
            $request->get_blind_carbon_copy_of_all_own_mail = 0;
        }
        $usermail->user_id = auth()->user()->id;
        $usermail->receive_mail_alert = $request->receive_mail_alert;
        $usermail->mailtext = $request->mailtext;
        $usermail->confirm_application_immidiatly_after_submit = $request->confirm_application_immidiatly_after_submit;
        $usermail->confirmation_mail_text = $request->confirmation_mail_text;
        $usermail->invitation_mail_text = $request->invitation_mail_text;
        $usermail->accept_mail_text = $request->accept_mail_text;
        $usermail->rejection_mail_text = $request->rejection_mail_text;
        $usermail->get_blind_carbon_copy_of_all_own_mail = $request->get_blind_carbon_copy_of_all_own_mail;
        $usermail->save();

        return back()->with('success','Email template submit success');
    }


    public function customizeFormEdit(Request $request,$id)
    {
        $customizeForm = CustomizeApplyForm::findOrFail($id);
        if($request->is_active == "on"){
            $customizeForm->is_active = 1;
        }
        else {
            $customizeForm->is_active = 0;
        }
        if($request->facts == "on"){
            $customizeForm->facts = 1;
        }
        else {
            $customizeForm->facts = 0;
        }
        if($request->willingness_to_travel == "on"){
            $customizeForm->willingness_to_travel = 1;
        }
        else {
            $customizeForm->willingness_to_travel = 0;
        }
        if($request->earlies_startin_date == "on"){
            $customizeForm->earlies_startin_date = 1;
        }
        else {
            $customizeForm->earlies_startin_date = 0;
        }
        if($request->Expected_salary == "on"){
            $customizeForm->Expected_salary = 1;
        }
        else {
            $customizeForm->Expected_salary = 0;
        }
        if($request->driving_license == "on"){
            $customizeForm->driving_license = 1;
        }
        else {
            $customizeForm->driving_license = 0;
        }
        if($request->is_active_social_profiles == "on"){
            $customizeForm->is_active_social_profiles = 1;
        }
        else {
            $customizeForm->is_active_social_profiles = 0;
        }
        if($request->facebook == "on"){
            $customizeForm->facebook = 1;
        }
        else {
            $customizeForm->facebook = 0;
        }
        if($request->xing == "on"){
            $customizeForm->xing = 1;
        }
        else {
            $customizeForm->xing = 0;
        }
        if($request->linkedIn == "on"){
            $customizeForm->linkedIn = 1;
        }
        else {
            $customizeForm->linkedIn = 0;
        }
        $customizeForm->user_id = auth()->user()->id;
        $customizeForm->save();
        return back()->with('success','Customize form submited success');
    }




}
