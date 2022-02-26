@extends('layouts.applicant.app_applicant')
@section('applicant.ideas', 'active')
@section('content')
<div class="ideas_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">ideas</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('applicant_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.ideas')</li>
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
                            @if ($message = Session::get('success'))
                                <div class="card">
                                    <div class="card-body">
                                        <div class="alert alert-success">
                                            <p> {{ $message }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('web.general_settings')</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <form action="{{ route('applicant.idea_store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="part" value="setting">
                                        <div class="form-group">
                                            <label>@lang('web.language')</label>
                                            <select name="site_lang_id" class=" form-control select2" style="width: 100%;">
                                                <option value="">@lang('web.select')</option>
                                                @foreach ($languages as $lang)
                                                <option value="{{ $lang->id }}"  @if (isset($setting)){{ $setting->site_lang_id == $lang->id ? 'selected' : '' }}@endif>{{ $lang->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('web.time_zone')</label>
                                            <select name="time_zone_id" class="form-control select3">
                                                <option value="">@lang('web.select')</option>
                                                @foreach ($zones as $item)
                                                <option value="{{ $item->zone_id }}" @if (isset($setting)){{ $setting->time_zone_id == $item->zone_id ? 'selected' : '' }}@endif>{{ $item->zone_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-success">@lang('web.submit')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Email Notifications</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <form action="{{ !blank($usermail) ? route('applicant.email_templates.edit',$usermail->id) : route('applicant.email_templates.store') }}" method="post">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>@lang('web.recive_alert')</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" @if(!blank($usermail)){{ $usermail->receive_mail_alert == 1 ? 'checked' : '' }} @endif name="receive_mail_alert"  id="email">
                                                    <label class="form-check-label" for="email">@lang('web.recive_checked')</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.mail_text')</label>
                                                <textarea name="mailtext" class="form-control" cols="30" rows="3">{{ old('mailtext',$usermail->mailtext ?? '') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.confirm_alert')>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" @if(!blank($usermail)) {{ $usermail->confirm_application_immidiatly_after_submit == 1 ? 'checked' : '' }} @endif name="confirm_application_immidiatly_after_submit"  id="confirmation">
                                                    <label class="form-check-label" for="confirmation">@lang('web.confirm_checked')</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.confirmation') @lang('web.mail_text')</label>
                                                <textarea name="confirmation_mail_text" class="form-control" cols="30" rows="3">{{ old('confirmation_mail_text',$usermail->confirmation_mail_text ?? '') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.invitation') @lang('web.mail_text')</label>
                                                <textarea name="invitation_mail_text" class="form-control" cols="30" rows="3">{{ old('invitation_mail_text',$usermail->invitation_mail_text ?? '') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.accept') @lang('web.mail_text')</label>
                                                <textarea name="accept_mail_text" class="form-control" cols="30" rows="3">{{ old('accept_mail_text',$usermail->accept_mail_text ?? '') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.rejection') @lang('web.mail_text')</label>
                                                <textarea name="rejection_mail_text" class="form-control @error('rejection_mail_text') is-invalid @enderror" cols="30" rows="3">{{ old('rejection_mail_text',$usermail->rejection_mail_text ?? '') }}</textarea>
                                                @error('rejection_mail_text')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.get_blind')</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" @if(!blank($usermail)) {{ $usermail->get_blind_carbon_copy_of_all_own_mail == 1 ? 'checked' : '' }} @endif  name="get_blind_carbon_copy_of_all_own_mail" id="email-ads">
                                                    <label class="form-check-label" for="email-ads">@lang('web.check_blind')</label>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-danger">@lang('web.submit')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    @if(blank($customizeForm))
                                        <form action="{{ route('applicant.customize.form') }}" method="POST" >
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
                                        <form action="{{ route('applicant.customize.form.edit',$customizeForm->id) }}" method="POST" >
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
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">orders
                                        <br/><span>bill address</span></h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block">
                                    <form action="{{ route('applicant.idea_store') }}" id="form7" method="post">
                                        @csrf
                                        <input type="hidden" name="part" value="orders" />
                                        <input type="hidden" name="orders_id" value="{{ $data['orders']->id ?? ''}}" />

                                        <div class="form-group">
                                            <label>@lang('web.company')</label>
                                            <select class="form-control" name="company">
                                                <option value="">@lang('web.select') @lang('web.company')</option>
                                                @foreach ($data['organizations'] as $company)
                                                    <option value=" {{ $company->org_name }}" @if(isset($data['orders']) && $data['orders']->company ) {{ $data['orders']->company == $company->org_name ? 'selected' : ''  }}  @endif>{{ $company->org_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('company'))
                                                <p class="alert alert-danger p-1">
                                                    {{ $errors->first('company') }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('web.street')</label>
                                            <input type="text" name="street" class="form-control" value="{{ $data['orders']->street ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('web.house_number')</label>
                                            <input type="text" name="house_no" class="form-control" value="{{$data['orders']->house_no ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('web.postal_code')</label>
                                            <input type="number" name="postal_code" class="form-control" value="{{ $data['orders']->postal_code ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('web.city')</label>
                                            <input type="text" name="city" class="form-control" value="{{ $data['orders']->city ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('web.region')</label>
                                            <input type="text" name="region" class="form-control" value="{{ $data['orders']->region ?? '' }}">
                                        <div class="form-group">
                                            <label>@lang('web.country')</label>
                                            <select class="form-control" name="country">
                                                <option value="">@lang('web.select') @lang('web.country')</option>
                                                @foreach ($countries as $country)
                                                    <option value=" {{ $country->country_name }}" @if(isset($data['orders']) && $data['orders']->country ) {{ $data['orders']->country == $country->country_name ? 'selected' : ''  }}  @endif >{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country'))
                                                <p class="alert alert-danger p-1">
                                                    {{ $errors->first('country') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('web.tax_id')</label>
                                            <input type="text" name="tax_id" class="form-control" value="{{ $data['orders']->tax_id ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('web.salutation')</label>
                                            <select class="form-control" name="salutation">
                                                <option value="Mister" @if(isset($data['orders'])) {{ $data['orders']->salutation == 'Mister' ? 'selected' : '' }}  @endif>Mister</option>
                                                <option value="Mrs" @if(isset($data['orders'])) {{ $data['orders']->salutation == 'Mrs' ? 'selected' : '' }} @endif >Mrs</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('web.contact_no')</label>
                                            <input type="number" name="contact_persion" class="form-control" value="{{$data['orders']->contact_persion ?? ''}}">
                                            @if ($errors->has('contact_person'))
                                                <p class="alert alert-danger p-1">
                                                    {{ $errors->first('contact_person') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>EmailAddress</label>
                                            <input type="email" name="email" class="form-control" value="{{$data['orders']->email ?? '' }}">
                                            @if ($errors->has('email'))
                                                <p class="alert alert-danger p-1">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-success">@lang('web.submit')</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@endsection
