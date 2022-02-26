<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cc', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('config:clear');
    \Artisan::call('config:cache');
    return 'DONE';
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('details/{slug?}', [App\Http\Controllers\HomeController::class, 'details'])->name('details');
Route::post('apply', [App\Http\Controllers\HomeController::class, 'apply'])->name('apply');
Route::get('jobboard', [App\Http\Controllers\HomeController::class, 'jobboard'])->name('jobboard');
Route::get('changelang/{lang}', [App\Http\Controllers\LangController::class, 'changelang'])->name('changelang');



Route::get('admin', [App\Http\Controllers\DashboardAdminController::class, 'index'])->name('admin_dashboard');
Route::get('admin/talent_pool', [App\Http\Controllers\DashboardAdminController::class, 'talent_pool'])->name('admin.talent_pool');
Route::get('admin/applications', [App\Http\Controllers\DashboardAdminController::class, 'applications'])->name('admin.applications');
Route::get('admin/jobs', [App\Http\Controllers\DashboardAdminController::class, 'jobs'])->name('admin.jobs');
Route::get('admin/job_categories', [App\Http\Controllers\DashboardAdminController::class, 'job_categories'])->name('admin.job_categories');

// Route::get('admin/orders', [App\Http\Controllers\DashboardAdminController::class, 'orders'])->name('admin.orders');


Route::get('admin/organization_overview', [App\Http\Controllers\DashboardAdminController::class, 'organization_overview'])->name('admin.organization_overview')->middleware('auth');
Route::get('admin/organization_profile', [App\Http\Controllers\DashboardAdminController::class, 'organization_profile'])->name('admin.organizations_profile');
Route::get('admin/organization_add', [App\Http\Controllers\DashboardAdminController::class, 'organization_add'])->name('admin.organization_add');
Route::get('admin/organization_edit/{organization}', [App\Http\Controllers\DashboardAdminController::class, 'organization_edit'])->name('admin.organization.edit');
Route::post('admin/organization/store', [App\Http\Controllers\DashboardAdminController::class, 'organizationStore'])->name('admin.organization.store')->middleware('auth');
Route::post('admin/organization/update/{organization}', [App\Http\Controllers\DashboardAdminController::class, 'organizationUpdate'])->name('admin.organization.update')->middleware('auth');
Route::get('admin/organization/delete/{organization}', [App\Http\Controllers\DashboardAdminController::class, 'organizationDelete'])->name('admin.organization.delete')->middleware('auth');

Route::get('admin/resume', [App\Http\Controllers\DashboardAdminController::class, 'resume'])->name('admin.resume');
Route::post('admin/resume', [App\Http\Controllers\DashboardAdminController::class, 'resumeStore'])->name('admin.resume.store');
Route::get('admin/edu_hist/{id}', [App\Http\Controllers\DashboardAdminController::class, 'edu_hist_delete'])->name('admin.edu_hist.delete');
Route::get('admin/emp_hist/{id}', [App\Http\Controllers\DashboardAdminController::class, 'emp_hist_delete'])->name('admin.emp_hist.delete');
Route::get('admin/add_lang/{id}', [App\Http\Controllers\DashboardAdminController::class, 'add_lang_delete'])->name('admin.add_lang.delete');
Route::get('admin/ideas', [App\Http\Controllers\DashboardAdminController::class, 'ideas'])->name('admin.ideas');
Route::get('admin/jobboard', [App\Http\Controllers\DashboardAdminController::class, 'jobboard'])->name('admin.jobboard');
Route::get('admin/general-settings', [App\Http\Controllers\Admin\GeneralSettingController::class, 'index'])->name('admin.general_settings');
Route::post('admin/general-settings/store', [App\Http\Controllers\Admin\GeneralSettingController::class, 'store'])->name('general-settings.store');
Route::get('admin/email_templates', [App\Http\Controllers\Admin\GeneralSettingController::class, 'emailTemplates'])->name('admin.email_templates')->middleware('auth');
Route::post('admin/email_templates/store', [App\Http\Controllers\Admin\GeneralSettingController::class, 'emailTemplatesStore'])->name('admin.email_templates.store')->middleware('auth');
Route::post('admin/email_templates/edit/{id}', [App\Http\Controllers\Admin\GeneralSettingController::class, 'emailTemplatesEdit'])->name('admin.email_templates.edit')->middleware('auth');
Route::post('admin/customize/form', [App\Http\Controllers\Admin\GeneralSettingController::class, 'customizeForm'])->name('admin.customize.form')->middleware('auth');
Route::post('admin/customize/form/eidt/{id}', [App\Http\Controllers\Admin\GeneralSettingController::class, 'customizeFormEdit'])->name('admin.customize.form.edit')->middleware('auth');


Route::resource('professions', App\Http\Controllers\ProfessionController::class);
Route::get('profession/delete/{profession}', [App\Http\Controllers\ProfessionController::class, 'destroy'])->name('profession.delete');
Route::resource('industry', App\Http\Controllers\IndustryController::class);
Route::get('industry/delete/{industry}', [App\Http\Controllers\IndustryController::class, 'destroy'])->name('industry.delete');
Route::resource('jobcategories', App\Http\Controllers\JobCategoryController::class);
Route::get('jobcategory/delete/{id}', [App\Http\Controllers\JobCategoryController::class, 'destroy'])->name('jobcategories.delete');
Route::get('inactive/jobcategories/{id}', [App\Http\Controllers\JobCategoryController::class, 'inactive'])->name('jobcategories.inactive');
Route::get('active/jobcategories/{id}', [App\Http\Controllers\JobCategoryController::class, 'active'])->name('jobcategories.active');
Route::resource('adminjobs', App\Http\Controllers\AdminJobController::class);
Route::get('inactive/adminjob/{id}', [App\Http\Controllers\AdminJobController::class, 'inactive'])->name('adminjobs.inactive');
Route::get('active/adminjob/{id}', [App\Http\Controllers\AdminJobController::class, 'active'])->name('adminjobs.active');
Route::resource('orders', App\Http\Controllers\AdminOrderController::class);
Route::get('admin/orders/delete/{order}', [App\Http\Controllers\AdminOrderController::class, 'destroy'])->name('admin.orders.delete');

Route::get('admin/profile', [App\Http\Controllers\DashboardAdminController::class, 'adminProfile'])->name('admin.profile');
Route::post('admin/profile/{id}', [App\Http\Controllers\DashboardAdminController::class, 'adminUpdate'])->name('admin.profile.update');

Route::get('admin/users', [App\Http\Controllers\DashboardAdminController::class, 'users'])->name('admin.users');
Route::get('admin/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('admin/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('admin/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::post('admin/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
Route::get('admin/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');



Route::get('applicant', [App\Http\Controllers\DashboardApplicantController::class, 'index'])->name('applicant_dashboard');
Route::get('applicant/talent_pool', [App\Http\Controllers\DashboardApplicantController::class, 'talent_pool'])->name('applicant.talent_pool');
Route::get('applicant/applications', [App\Http\Controllers\DashboardApplicantController::class, 'applications'])->name('applicant.applications');
Route::get('applicant/resume', [App\Http\Controllers\DashboardApplicantResumeController::class, 'resume'])->name('applicant.resume');
Route::get('applicant/ideas', [App\Http\Controllers\DashboardApplicantController::class, 'ideas'])->name('applicant.ideas');
Route::post('applicant/idea_store', [App\Http\Controllers\DashboardApplicantController::class, 'idea_store'])->name('applicant.idea_store');
Route::post('applicant/order_store', [App\Http\Controllers\DashboardApplicantController::class, 'order_store'])->name('applicant.order_store');
Route::post('applicant/email_templates/store',[App\Http\Controllers\DashboardApplicantController::class,'emailTemplatesStore'])->name('applicant.email_templates.store')->middleware('auth');
Route::post('applicant/email_templates/edit/{id}',[App\Http\Controllers\DashboardApplicantController::class,'emailTemplatesEdit'])->name('applicant.email_templates.edit')->middleware('auth');
Route::post('applicant/customize/form',[App\Http\Controllers\DashboardApplicantController::class,'customizeForm'])->name('applicant.customize.form')->middleware('auth');
Route::post('applicant/customize/form/eidt/{id}',[App\Http\Controllers\DashboardApplicantController::class,'customizeFormEdit'])->name('applicant.customize.form.edit')->middleware('auth');

Route::post('applicant/resume', [App\Http\Controllers\DashboardApplicantResumeController::class, 'resumeStore'])->name('applicant.resume.store');
Route::get('applicant/edu_hist/{id}', [App\Http\Controllers\DashboardApplicantResumeController::class, 'edu_hist_delete'])->name('applicant.edu_hist.delete');
Route::get('applicant/emp_hist/{id}', [App\Http\Controllers\DashboardApplicantResumeController::class, 'emp_hist_delete'])->name('applicant.emp_hist.delete');
Route::get('applicant/add_lang/{id}', [App\Http\Controllers\DashboardApplicantResumeController::class, 'add_lang_delete'])->name('applicant.add_lang.delete');

Route::get('applicant/profile', [App\Http\Controllers\DashboardApplicantProfileController::class, 'applicantProfile'])->name('applicant.profile');
Route::post('applicant/profile', [App\Http\Controllers\DashboardApplicantProfileController::class, 'socail_add'])->name('applicant.socail_add');

Route::post('applicant/profile/{id}', [App\Http\Controllers\DashboardApplicantProfileController::class, 'applicantProfileUpdate'])->name('applicant.profile_update');
Route::get('applicant/jobboard', [App\Http\Controllers\DashboardApplicantController::class, 'jobboard'])->name('applicant.jobboard');
Route::post('applicant/jobboard/subscribe', [App\Http\Controllers\DashboardApplicantController::class, 'subscribe'])->name('applicant.jobboard.subscribe');




Route::get('recruiter', [App\Http\Controllers\DashboardRecruiterController::class, 'index'])->name('recruiter_dashboard');
Route::get('recruiter/talent_pool', [App\Http\Controllers\DashboardRecruiterController::class, 'talent_pool'])->name('recruiter.talent_pool');
Route::get('recruiter/applications', [App\Http\Controllers\DashboardRecruiterController::class, 'applications'])->name('recruiter.applications');

Route::get('not_view/application/{id}', [App\Http\Controllers\DashboardRecruiterController::class, 'not_view'])->name('applications.not_view');
Route::get('view/application/{id}', [App\Http\Controllers\DashboardRecruiterController::class, 'view'])->name('applications.view');


Route::get('recruiter/jobs', [App\Http\Controllers\JobsController::class, 'index'])->name('recruiter.jobs');
Route::get('recruiter/jobs_create', [App\Http\Controllers\JobsController::class, 'jobsCreate'])->name('recruiter.jobs_create');
Route::post('recruiter/jobs_store', [App\Http\Controllers\JobsController::class, 'jobsStore'])->name('recruiter.jobs_store');
Route::get('recruiter/jobs_edit/{id}', [App\Http\Controllers\JobsController::class, 'jobsEdit'])->name('recruiter.jobs_edit');
Route::post('recruiter/jobs_update/{id}', [App\Http\Controllers\JobsController::class, 'jobsUpdate'])->name('recruiter.jobs_update');
Route::post('recruiter/jobs_create_invoice', [App\Http\Controllers\JobsController::class, 'jobsStoreInvoice'])->name('recruiter.jobs_store.invoice');
Route::get('recruiter/organization_overview', [App\Http\Controllers\DashboardRecruiterController::class, 'organization_overview'])->name('recruiter.organization_overview')->middleware('auth');
Route::get('recruiter/organization_profile', [App\Http\Controllers\DashboardRecruiterController::class, 'organization_profile'])->name('recruiter.organization_profile');
Route::get('recruiter/organization_add', [App\Http\Controllers\DashboardRecruiterController::class, 'organization_add'])->name('recruiter.organization_add');
Route::get('recruiter/organization_edit/{organization}', [App\Http\Controllers\DashboardRecruiterController::class, 'organization_edit'])->name('recruiter.organization.edit');
Route::post('recruiter/organization/store', [App\Http\Controllers\DashboardRecruiterController::class, 'organizationStore'])->name('recruiter.organization.store')->middleware('auth');
Route::post('recruiter/organization/update/{organization}', [App\Http\Controllers\DashboardRecruiterController::class, 'organizationUpdate'])->name('recruiter.organization.update')->middleware('auth');
Route::get('recruiter/organization/delete/{organization}', [App\Http\Controllers\DashboardRecruiterController::class, 'organizationDelete'])->name('recruiter.organization.delete')->middleware('auth');

Route::get('recruiter/ideas', [App\Http\Controllers\DashboardRecruiterController::class, 'ideas'])->name('recruiter.ideas');

Route::get('recruiter/email_templates', [App\Http\Controllers\DashboardRecruiterController::class, 'email_templates'])->name('recruiter.email_templates');
Route::post('recuiter/email_templates/store',[App\Http\Controllers\DashboardRecruiterController::class,'emailTemplatesStore'])->name('recruiter.email_templates.store')->middleware('auth');
Route::post('recuiter/email_templates/edit/{id}',[App\Http\Controllers\DashboardRecruiterController::class,'emailTemplatesEdit'])->name('recruiter.email_templates.edit')->middleware('auth');
Route::post('recuiter/customize/form',[App\Http\Controllers\DashboardRecruiterController::class,'customizeForm'])->name('recruiter.customize.form')->middleware('auth');
Route::post('recuiter/customize/form/eidt/{id}',[App\Http\Controllers\DashboardRecruiterController::class,'customizeFormEdit'])->name('recruiter.customize.form.edit')->middleware('auth');


Route::get('recruiter/settings', [App\Http\Controllers\DashboardRecruiterController::class, 'general_setting'])->name('recruiter.general_setting');
Route::post('recruiter/settings/store', [App\Http\Controllers\DashboardRecruiterController::class, 'setting_store'])->name('recruiter.setting_store');

Route::get('recruiter/orders', [App\Http\Controllers\DashboardRecruiterController::class, 'orders'])->name('recruiter.orders');
Route::post('recuriter/orders/store', [App\Http\Controllers\DashboardRecruiterController::class, 'orderstore'])->name('recruiter.oder.store');
Route::get('recuriter/orders/view', [App\Http\Controllers\DashboardRecruiterController::class, 'order_view'])->name('recruiter.oder.view');
Route::get('recuriter/orders/edit/{order}', [App\Http\Controllers\DashboardRecruiterController::class, 'orders_edit'])->name('recruiter.order.edit');
Route::post('recuriter/orders/update/{order}', [App\Http\Controllers\DashboardRecruiterController::class, 'orderUpdate'])->name('recruiter.oder.update');
Route::get('recuriter/orders/delete/{order}', [App\Http\Controllers\DashboardRecruiterController::class, 'orderDelete'])->name('recruiter.order.delete');

Route::get('recruiter/profile', [App\Http\Controllers\DashboardRecruiterController::class, 'RecruiterProfile'])->name('recruiter.profile');
Route::post('recruiter/profile/{id}', [App\Http\Controllers\DashboardRecruiterController::class, 'RecruiterUpdate'])->name('recruiter.profile.update');

Route::get('inactive/job/{id}', [App\Http\Controllers\JobsController::class, 'inactive'])->name('jobs.inactive');
Route::get('active/job/{id}', [App\Http\Controllers\JobsController::class, 'active'])->name('jobs.active');
