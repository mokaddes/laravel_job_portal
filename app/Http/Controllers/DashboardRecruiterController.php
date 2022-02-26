<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Country;
use App\Models\Language;
use App\Models\Organization;
use App\Models\Zone;
use App\Models\JobPost;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserMailNotification;
use App\Models\CustomizeApplyForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardRecruiterController extends Controller
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
        return view('recruiter.index');
    }

    public function talent_pool()
    {
        return view('recruiter.talent_pool');
    }
    public function applications()
    {
        $applications = Application::query()->where('recruiter_id', Auth::user()->id)->get();
        $resume = DB::table('resumes')->get();
        $jobs = JobPost::query()->get();
        if (request('title') && request('search')== '' && request('status') == '') {
            $applications =  Application::query()
            ->where('recruiter_id', Auth::user()->id)
            ->where('job_title', 'like', '%' . request('title') . '%')->get();
        }
        if (request('status') && request('title')== '' && request('search') == '') {
            $applications =  Application::query()
            ->where('recruiter_id', Auth::user()->id)
            ->where('status', '=',  request('status'))->get();
        }
        if (request('search') && request('title')== '' && request('status') == '') {
            $applications =  Application::query()
            ->where('recruiter_id', Auth::user()->id)
            ->where('job_title', 'like', '%' . request('search') . '%')
            ->orWhere('applicant_name', 'like', '%' . request('search') . '%')
            ->orWhere('company_name', 'like', '%' . request('search') . '%')->get();
        }

        return view('recruiter.applications', compact('applications', 'resume', 'jobs'));
    }
    public function not_view($id)
    {
        Application::where('id', $id)->update(['status' => 1]);

        return redirect()->back()->with('success', 'Mark as Not Viewed');
    }

    public function view($id)
    {
        Application::where('id', $id)->update(['status' => 2]);

        return redirect()->back()->with('success', 'Mark as viewed');
    }

    public function organization_overview()
    {
        $organizations = Organization::where('user_id',auth()->user()->id)->latest()->paginate(8);
        return view('recruiter.organization_overview',compact('organizations'));
    }
    public function organization_profile()
    {
        return view('recruiter.organization_profile');
    }
    public function organization_add()
    {
        $countries = Country::get();
        return view('recruiter.organization_add',compact('countries'));
    }
    public function organization_edit(Organization $organization)
    {
        $countries = Country::get();
        return view('recruiter.organization_edit',compact('countries', 'organization'));
    }
    public function ideas()
    {
        return view('recruiter.ideas');
    }
    public function jobs()
    {
        //
    }
     public function email_templates()
    {
        $usermail = UserMailNotification::where('user_id',auth()->user()->id)->first();
        $customizeForm =CustomizeApplyForm::where('user_id',auth()->user()->id)->first();
        return view('recruiter.email_template', compact('usermail', 'customizeForm'));
    }
     public function general_setting()
    {
        $languages = Language::get();
        $zones = Zone::get();
        $setting = Setting::where('id', Auth::user()->id)->first();
        return view('recruiter.general_setting',compact('languages','zones', 'setting'));
    }
     public function orders()
    {
        $industry = DB::table('organization')->get();
        $countries = DB::table('country')->get();
        return view('recruiter.orders', compact('industry', 'countries'));
    }

    public function orders_edit(Order $order)
    {
        $industry = DB::table('organization')->get();
        $countries = DB::table('country')->get();
        return view('recruiter.ordersedit', compact('industry', 'countries', 'order'));
    }

    public function orderstore(Request $request)
    {

        $valid = $request->validate([
            'email'             => 'required',
            'contact_persion'   => 'required',
            'country'           => 'required',
            'company'           => 'required',
        ]);
        $order = new Order();
        $order->company = $request->company;
        $order->country = $request->country;
        $order->street = $request->street;
        $order->house_no = $request->house_no;
        $order->postal_code = $request->postal_code;
        $order->city = $request->city;
        $order->region = $request->region;
        $order->tax_id = $request->tax_id;
        $order->salutation = $request->salutation;
        $order->contact_persion = $request->contact_persion;
        $order->email = $request->email;
        $order->user_id = Auth::user()->id;
        $order->save();
        return redirect()->route('recruiter.oder.view')->with('success', 'Order Inserted');


    }

    public function orderUpdate(Request $request, Order $order)
    {

        $valid = $request->validate([
            'email'             => 'required',
            'contact_persion'   => 'required',
            'country'           => 'required',
            'company'           => 'required',
        ]);
        $order->company = $request->company;
        $order->country = $request->country;
        $order->street = $request->street;
        $order->house_no = $request->house_no;
        $order->postal_code = $request->postal_code;
        $order->city = $request->city;
        $order->region = $request->region;
        $order->tax_id = $request->tax_id;
        $order->salutation = $request->salutation;
        $order->contact_persion = $request->contact_persion;
        $order->email = $request->email;
        $order->user_id = Auth::user()->id;
        $order->update();
        return redirect()->route('recruiter.oder.view')->with('success', 'Order Update');


    }

    public function orderDelete(Order $order)
    {
        $order->delete();
        return redirect()->route('recruiter.oder.view')->with('success', 'Order Delete');

    }

    public function order_view()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();

        return view('recruiter.order_view', compact('orders'));
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
        return redirect()->route('recruiter.organization_overview')->with('success','Organization added success');

    }

    public function organizationUpdate(Request $request, Organization $organization)
    {
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

        return redirect()->route('recruiter.organization_overview')->with('success','Organization Update success');

    }

    public function organizationDelete(Organization $organization)
    {
        $organization->delete();

        return redirect()->route('recruiter.organization_overview')->with('success','Organization delete success');
    }


    public function setting_store(Request $request)
    {

            $setting = Setting::firstOrCreate(['id'=>1],[]);
        if($request->has('site_lang_id') && !blank($request->site_lang_id)){
            $lang = Language::findOrFail($request->site_lang_id);
            $setting->site_lang = $lang->name;
            $setting->site_lang_id = $request->site_lang_id;
            $setting->save();
        }
        if($request->has('time_zone_id') && !blank($request->time_zone_id)){
            $zone = Zone::where('zone_id',$request->time_zone_id)->first();
            $setting->time_zone_id = $request->time_zone_id;
            $setting->time_zone = $zone->zone_name;
            $setting->save();
        }


        return redirect()->back()->with('success', 'Settings Saved');

    }

    public function emailTemplatesStore(Request $request)
    {
        $data = $request->validate([
            'mailtext' => 'nullable|string',
            'confirmation_mail_text' => 'nullable|string',
            'invitation_mail_text' => 'nullable|string',
            'accept_mail_text' => 'nullable|string',
            'rejection_mail_text' => 'required|string',
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
            'rejection_mail_text' => 'required|string',
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


    public function RecruiterProfile()
    {
        $recruiter = User::where('id', Auth::user()->id)->first();
        return view('recruiter.profile', compact('recruiter'));

    }
    public function RecruiterUpdate(Request $request, $id)
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
