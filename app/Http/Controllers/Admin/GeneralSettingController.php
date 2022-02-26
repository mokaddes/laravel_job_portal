<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomizeApplyForm;
use App\Models\Language;
use App\Models\Setting;
use App\Models\UserMailNotification;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralSettingController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $languages = Language::get();
        $zones = Zone::get();
        $setting = Setting::where('id', Auth::user()->id)->first();
        return view('admin.general_setting',compact('languages','zones', 'setting'));
    }

    public function store(Request $request)
    {


        $setting = Setting::firstOrCreate(['id'=> Auth::user()->id],[]);

        $setting->id = Auth::user()->id;
        $setting->site_name = $request->site_name;
        $setting->app_mode = $request->app_mode;
        // $setting['site_lang_id'] = $request->site_lang_id;
        // $setting['time_zone_id'] = $request->time_zone_id;
        if($request->has('site_lang_id') && !blank($request->site_lang_id)){
            $lang = Language::findOrFail($request->site_lang_id);
            $setting->site_lang = $lang->name;
            $setting->site_lang_id = $request->site_lang_id;
        }
        if($request->has('time_zone_id') && !blank($request->time_zone_id)){
            $zone = Zone::where('zone_id',$request->time_zone_id)->first();
            $setting->time_zone_id = $request->time_zone_id;
            $setting->time_zone = $zone->zone_name;

        }

        if($request->has('site_logo')) {
            $file = $request->file('site_logo');
            $name_gen = time().".".$file->getClientOriginalExtension();
            $file->move('asset/images/setting',$name_gen);
            $setting->site_logo = 'asset/images/setting/' . $name_gen;
        }

        $setting->save();

        return back()->with('success','General setting updated');

    }


    public function emailTemplates()
    {
        $usermail = UserMailNotification::where('user_id',auth()->user()->id)->first();
        $customizeForm =CustomizeApplyForm::where('user_id',auth()->user()->id)->first();
        return view('admin.email_template',compact('usermail','customizeForm'));
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
}
