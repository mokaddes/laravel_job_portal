@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('admin.email_templates', 'active')
@section('content')
<div class="jobs_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">E-Mail Notifications</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">E-Mail Notifications</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>Email notifications</h5>
                            </div>
                            <form action="{{ !blank($usermail) ? route('admin.email_templates.edit',$usermail->id) : route('admin.email_templates.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @if ($m = Session::get('success'))
                                        <div class="alert alert-success">
                                            <span> {{ $m }} </span>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Receive E-Mail alert</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" @if(!blank($usermail)){{ $usermail->receive_mail_alert == 1 ? 'checked' : '' }} @endif name="receive_mail_alert"  id="email">
                                            <label class="form-check-label" for="email">if checked, you'll be informed by mail about new applications.</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mailtext</label>
                                        <textarea name="mailtext" class="form-control" cols="30" rows="3">{{ old('mailtext',$usermail->mailtext ?? '') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>confirm application immidiatly after submit</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" @if(!blank($usermail)) {{ $usermail->confirm_application_immidiatly_after_submit == 1 ? 'checked' : '' }} @endif name="confirm_application_immidiatly_after_submit"  id="confirmation">
                                            <label class="form-check-label" for="confirmation">if checked, an application is immediatly confirmed. If unchecked confirmation is the duty of the recruiter.</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirmation mail text</label>
                                        <textarea name="confirmation_mail_text" class="form-control" cols="30" rows="3">{{ old('confirmation_mail_text',$usermail->confirmation_mail_text ?? '') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Invitation mail text</label>
                                        <textarea name="invitation_mail_text" class="form-control" cols="30" rows="3">{{ old('invitation_mail_text',$usermail->invitation_mail_text ?? '') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Accept mail text</label>
                                        <textarea name="accept_mail_text" class="form-control" cols="30" rows="3">{{ old('accept_mail_text',$usermail->accept_mail_text ?? '') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Rejection mail text</label>
                                        <textarea name="rejection_mail_text" class="form-control @error('rejection_mail_text') is-invalid @enderror" cols="30" rows="3">{{ old('rejection_mail_text',$usermail->rejection_mail_text ?? '') }}</textarea>
                                        @error('rejection_mail_text')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>get blind carbon copy of all own mails</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" @if(!blank($usermail)) {{ $usermail->get_blind_carbon_copy_of_all_own_mail == 1 ? 'checked' : '' }} @endif  name="get_blind_carbon_copy_of_all_own_mail" id="email-ads">
                                            <label class="form-check-label" for="email-ads">if checked, you'll get a copy of all mails you send.</label>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-danger">Save on computer</button>
                                    </div>
                                </div>
                            </form>
                            @if(blank($customizeForm))
                            <form action="{{ route('admin.customize.form') }}" method="POST" >
                                @csrf
                                <div class="card-footer">
                                    <div class="text-center mb-3">
                                        <h4>Customize application form</h4>
                                    </div>
                                     <div class="form-group form-check">
                                          <input type="checkbox" class="form-check-input" name="is_active" id="exampleCheck1" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                         <label class="form-check-label" for="exampleCheck1"><strong>Activate</strong>  Enables the form element customization.</label>
                                      </div>
                                    <div class="collapse" id="collapseExample">
                                       <div class="card card-body">
                                            <div class="row">
                                                <div class="col-sm-6 mb-4">
                                                    <div class="facts-item">
                                                     <div class="form-group form-check">
                                                         <input type="checkbox" id="facts" name="facts" class="form-check-input" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                                         <label class="form-check-label" for="facts">Facts</label>
                                                     </div>
                                                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                               <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        Ask the applicant about the willingness to travel
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="willingness_to_travel" type="checkbox"  id="travel">
                                                                        <label class="form-check-label" for="travel">Willingness to travel</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        sk the applicant about the earliest starting date.
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="earlies_startin_date" type="checkbox"  id="eariest">
                                                                        <label class="form-check-label" for="eariest">Earliest starting date</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        Ask users about their expected salary.
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="Expected_salary" type="checkbox"  id="salary">
                                                                        <label class="form-check-label" for="salary">Expected salary</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        Ask the applicant, if he has a driving license.
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="driving_license" type="checkbox"  id="driving">
                                                                        <label class="form-check-label" for="driving">driving licence</label>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="social-item">
                                                        <div class="form-group form-check">
                                                         <input type="checkbox" id="profile" name="is_active_social_profiles" class="form-check-input" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                                                         <label class="form-check-label" for="profile">Social Profiles</label>
                                                        </div>
                                                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                            <div class="form-group">
                                                                <div class="alert alert-primary" role="alert">
                                                                    Allow users to attach their Facebook profile.
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="facebook" type="checkbox"  id="fb">
                                                                    <label class="form-check-label" for="fb">Facebook</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="alert alert-primary" role="alert">
                                                                    Allow users to attach their Xing profile.
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="xing" type="checkbox"  id="xing">
                                                                    <label class="form-check-label" for="xing">Xing</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="alert alert-primary" role="alert">
                                                                    Allow users to attach their LinkedIn profile.
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="linkedIn" type="checkbox"  id="lin">
                                                                    <label class="form-check-label" for="lin">LinkedIn</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-danger">Save on computer</button>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="{{ route('admin.customize.form.edit',$customizeForm->id) }}" method="POST" >
                                @csrf
                                <div class="card-footer">
                                    <div class="text-center mb-3">
                                        <h4>Customize application form</h4>
                                    </div>
                                     <div class="form-group form-check">
                                          <input type="checkbox" class="form-check-input" name="is_active" @if(!blank($customizeForm)) {{ $customizeForm->is_active == 1 ? 'checked' : ''  }} @endif  id="exampleCheck1" aria-controls="collapseExample">
                                         <label class="form-check-label" for="exampleCheck1"><strong>Activate</strong>  Enables the form element customization.</label>
                                      </div>
                                    <div id="collapseExample">
                                       <div class="card card-body">
                                            <div class="row">
                                                <div class="col-sm-6 mb-4">
                                                    <div class="facts-item">
                                                     <div class="form-group form-check">
                                                         <input type="checkbox" id="facts" name="facts" @if(!blank($customizeForm)) {{ $customizeForm->facts == 1 ? 'checked' : ''  }} @endif class="form-check-input"  href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                                         <label class="form-check-label" for="facts">Facts</label>
                                                     </div>
                                                        <div class="multi-collapse" id="multiCollapseExample1">
                                                               <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        Ask the applicant about the willingness to travel
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="willingness_to_travel" @if(!blank($customizeForm)) {{ $customizeForm->willingness_to_travel == 1 ? 'checked' : ''  }} @endif type="checkbox"  id="travel">
                                                                        <label class="form-check-label" for="travel">Willingness to travel</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        sk the applicant about the earliest starting date.
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="earlies_startin_date" @if(!blank($customizeForm)) {{ $customizeForm->earlies_startin_date == 1 ? 'checked' : ''  }} @endif type="checkbox"  id="eariest">
                                                                        <label class="form-check-label" for="eariest">Earliest starting date</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        Ask users about their expected salary.
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="Expected_salary" @if(!blank($customizeForm)) {{ $customizeForm->Expected_salary == 1 ? 'checked' : ''  }} @endif type="checkbox"  id="salary">
                                                                        <label class="form-check-label" for="salary">Expected salary</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        Ask the applicant, if he has a driving license.
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="driving_license"  type="checkbox" @if(!blank($customizeForm)) {{ $customizeForm->driving_license == 1 ? 'checked' : ''  }} @endif  id="driving">
                                                                        <label class="form-check-label" for="driving">driving licence</label>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="social-item">
                                                        <div class="form-group form-check">
                                                         <input type="checkbox" id="profile" name="is_active_social_profiles" @if(!blank($customizeForm)) {{ $customizeForm->is_active_social_profiles == 1 ? 'checked' : ''  }} @endif class="form-check-input"  data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                                                         <label class="form-check-label" for="profile">Social Profiles</label>
                                                        </div>
                                                        <div class=" multi-collapse" id="multiCollapseExample2">
                                                            <div class="form-group">
                                                                <div class="alert alert-primary" role="alert">
                                                                    Allow users to attach their Facebook profile.
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="facebook"  @if(!blank($customizeForm)) {{ $customizeForm->facebook == 1 ? 'checked' : ''  }} @endif type="checkbox"  id="fb">
                                                                    <label class="form-check-label" for="fb">Facebook</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="alert alert-primary" role="alert">
                                                                    Allow users to attach their Xing profile.
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="xing" @if(!blank($customizeForm)) {{ $customizeForm->xing == 1 ? 'checked' : ''  }} @endif type="checkbox"  id="xing">
                                                                    <label class="form-check-label" for="xing">Xing</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="alert alert-primary" role="alert">
                                                                    Allow users to attach their LinkedIn profile.
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="linkedIn" @if(!blank($customizeForm)) {{ $customizeForm->linkedIn == 1 ? 'checked' : ''  }} @endif type="checkbox"  id="lin">
                                                                    <label class="form-check-label" for="lin">LinkedIn</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-danger">Save on computer</button>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
@endsection
