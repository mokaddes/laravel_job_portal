@extends('layouts.recruiter.app_recruiter')
@section('recruiter.jobs', 'active')
@section('recruiter.jobs_create', 'active')

@push('header_script')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('richtexteditor/rte_theme_default.css')}}" />
    <link href="{{asset('summernote/summernote-bs4.css')}}" rel="stylesheet">
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">

@endpush

@php

$countries = \DB::table('country')->get();

@endphp

@section('content')
    <div class="jobs_page">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Create a job <small>(draft)</small></h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('recruiter_dashboard') }}">@lang('web.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('recruiter.jobs') }}">@lang('web.jobs')</a></li>
                                <li class="breadcrumb-item active">@lang('web.create')</li>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                               href="#custom-tabs-four-home" role="tab"
                                               aria-controls="custom-tabs-four-home" aria-selected="true">Basic Data</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                               href="#custom-tabs-four-profile" role="tab"
                                               aria-controls="custom-tabs-four-profile" aria-selected="false">Create job
                                                opening</a>
                                        </li> --}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                               href="#custom-tabs-four-messages" role="tab"
                                               aria-controls="custom-tabs-four-messages" aria-selected="false">Invoice
                                                Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                               href="#custom-tabs-four-settings" role="tab"
                                               aria-controls="custom-tabs-four-settings"
                                               aria-selected="false">Preview</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-four-home"
                                             role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Title and job location</h5>
                                                        </div>
                                                        <div class="px-2 pt-2">
                                                            @if(session()->has('success'))
                                                                <div class="alert alert-success">
                                                                    {{ session()->get('success') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('recruiter.jobs_store') }}{{ isset($data['job']->id) ? '?jobid=' . $data['job']->id : '' }}" id="form1" method="post">

                                                                <div class="form-group">
                                                                    <label>Job title</label>
                                                                    <input type="text" name="title"
                                                                           value="{{ $data['job']->title ?? '' }}"
                                                                           data-validation-required-message="Title is required"
                                                                           class="form-control required">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Location</label>
                                                                    <select name="location" class="form-control @error('location') is-invalid @enderror" data-validation-required-message="Location is required"  required>
                                                                        <option value="">Select Location</option>
                                                                        @if(isset($data['locations']) && count($data['locations']) > 0 )
                                                                        @foreach($data['locations'] as $location)
                                                                            <option value="{{ $location->url_slug }}" @if (isset($data['job']->id))
                                                                                {{ ($data['job']->location == $location->url_slug) ? 'selected': '' }}
                                                                            @endif >{{ $location->name }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('location')
                                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Vacancy</label>
                                                                    <input type="number" name="vacancy"
                                                                           value="{{ $data['job']->vacancy ?? '' }}"
                                                                           class="form-control @error('vacancy') is-invalid @enderror" data-validation-required-message="Vacancy is required" required>
                                                                           @error('vacancy')
                                                                               <span class="invalid-feedback"> {{ $message }} </span>
                                                                           @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Educational Qulaifications</label>
                                                                    <input type="text" name="qualification"
                                                                           value="{{ $data['job']->qualification ?? '' }}"
                                                                           data-validation-required-message="Qualification is required"
                                                                           class="form-control" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Experience requirement (Year)</label>
                                                                    <input type="number" name="experience_requirement"
                                                                           value="{{ $data['job']->experience_requirement ?? 0 }}"
                                                                           data-validation-required-message="Experience requirement is required"
                                                                           class="form-control"  >
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Job category</label>
                                                                    <select class="form-control  @error('job_category_id') is-invalid @enderror" name="job_category_id" data-validation-required-message="job category is required">
                                                                        <option value="">Select job category</option>
                                                                        @if(isset($data['category']) && count($data['category']) > 0 )
                                                                        @foreach($data['category'] as $k => $cat)
                                                                            <option value="{{ $cat->pk_no }}"  @if (isset($data['job']->id))
                                                                                {{ ($data['job']->job_category_id == $cat->pk_no) ? 'selected': '' }}
                                                                            @endif >{{ $cat->name }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('job_category_id')
                                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Publish Date</label>
                                                                    <input type="date" id="datepicker-131" name="publish_date"
                                                                        value="{{ $data['job']->publish_date ?? '' }}"
                                                                        data-validation-required-message="Publish Date is required"
                                                                        class="form-control"  placeholder="MM/DD/YYYY">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Job Deadline</label>
                                                                    <input type="date" id="datepicker-141" name="deadline"
                                                                        value="{{ $data['job']->deadline ?? '' }}"
                                                                        class="form-control @error('deadline') is-invalid @enderror"  placeholder="MM/DD/YYYY">
                                                                        @error('deadline')
                                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                </div>



                                                                <div class="mt-2 float-right">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Company Name</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('recruiter.jobs_store') }}{{ isset($data['job']->id) ? '?jobid=' . $data['job']->id : '' }}" id="form2" method="post">
                                                                <div class="form-group">
                                                                    <label>Company Name</label>
                                                                    <select class="form-select form-control  @error('company') is-invalid @enderror" name="company"
                                                                            aria-label="Default select example" >
                                                                            <option value="">Select Company</option>
                                                                            @foreach ($data['organizations'] as $org)
                                                                            <option value="{{ $org->org_name }}" @if (isset($data['job']->id))
                                                                                {{ ($data['job']->company == $org->org_name) ? 'selected': '' }}
                                                                            @endif >{{ $org->org_name }}</option>
                                                                            @endforeach
                                                                    </select>
                                                                    @error('company')
                                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">

                                                                    <div class="form-group">
                                                                        <label>Manager Name</label>
                                                                        <input type="text" name="managers"
                                                                               value="{{ $data['job']->managers ?? '' }}"
                                                                               data-validation-required-message="Managers is required"
                                                                               class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2 float-right">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Salary</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('recruiter.jobs_store') }}{{ isset($data['job']->id) ? '?jobid=' . $data['job']->id : '' }}" id="form3" method="post">
                                                                <div class="form-group">
                                                                    <label>Salary</label>
                                                                    <input type="number" name="salary" value="{{ $data['job']->salary ?? '' }}" class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Currency</label>
                                                                    <select class="form-select form-control"
                                                                            name="currency"
                                                                            aria-label="Default select example" required>
                                                                        <option value="USD" @if(isset($data['job']->id)) {{ $data['job']->currency == 'USD' ? 'selected' : '' }} @endif >USD</option>
                                                                        <option value="CAD" @if(isset($data['job']->id)) {{ $data['job']->currency == 'CAD' ? 'selected' : '' }} @endif >CAD</option>
                                                                        <option value="EUR" @if(isset($data['job']->id)) {{ $data['job']->currency == 'ERU' ? 'selected' : '' }} @endif >EUR</option>
                                                                        <option value="AED" @if(isset($data['job']->id)) {{ $data['job']->currency == 'AED' ? 'selected' : '' }} @endif >AED</option>
                                                                        <option value="AFN" @if(isset($data['job']->id)) {{ $data['job']->currency == 'AFN' ? 'selected' : '' }} @endif >AFN</option>
                                                                        <option value="ALL" @if(isset($data['job']->id)) {{ $data['job']->currency == 'ALL' ? 'selected' : '' }} @endif >ALL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Time interval unit</label>
                                                                    <select class="form-select form-control" name="time_interval_unit" aria-label="Default select example"required>
                                                                        <option value="Hour"    @if(isset($data['job']->id)) {{ $data['job']->time_interval_unit == 'Hour'  ? 'selected' : '' }} @endif>Hour</option>
                                                                        <option value="Day"     @if(isset($data['job']->id)) {{ $data['job']->time_interval_unit == 'Day'   ? 'selected' : '' }} @endif>Day</option>
                                                                        <option value="Week"    @if(isset($data['job']->id)) {{ $data['job']->time_interval_unit == 'Week'  ? 'selected' : '' }} @endif>Week</option>
                                                                        <option value="Month"   @if(isset($data['job']->id)) {{ $data['job']->time_interval_unit == 'Month' ? 'selected' : '' }} @endif>Month</option>
                                                                        <option value="Year"    @if(isset($data['job']->id)) {{ $data['job']->time_interval_unit == 'Year'  ? 'selected' : '' }} @endif>Year</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-2 float-right">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Classifications</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('recruiter.jobs_store') }}{{ isset($data['job']->id) ? '?jobid=' . $data['job']->id : '' }}" id="form4" method="post">
                                                                <div class="form-group">
                                                                    <label>Profession</label>
                                                                    <select
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        style="width: 100%;" name="profession" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                                                        <option data-select2-id="3">
                                                                            Select Profession
                                                                        </option>
                                                                    @foreach ($data['professions'] as $profession)
                                                                           <option value="{{ $profession->name }}"
                                                                                @if (isset($data['job']->id)){{
                                                                                    ($data['job']->profession == $profession->name) ? 'selected': '' }}
                                                                                @endif>
                                                                                {{ $profession->name }}
                                                                            </option>
                                                                       @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Industries</label>
                                                                    <select   class="form-control select2 select2-hidden-accessible"
                                                                        style="width: 100%;" name="industries" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                                                        @foreach ($data['industries'] as $industry)
                                                                            <option value="{{ $industry->name }}"
                                                                                @if (isset($data['job']->id)){{
                                                                                    ($data['job']->industries == $industry->name) ? 'selected': '' }}
                                                                                @endif >
                                                                                {{ $industry->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group" data-select2-id="53">
                                                                    <label>Employment Types</label>
                                                                    <select name="employment_type" class="select2 select2-hidden-accessible"
                                                                         style="width: 100%;"
                                                                            data-select2-id="3" tabindex="-1"
                                                                            aria-hidden="true" required>
                                                                        @foreach($data['employmentTypes'] as $type)
                                                                            <option value="{{ $type->name }}"
                                                                                @if (isset($data['job']->id))
                                                                                {{ ($data['job']->employment_type == $type->name) ? 'selected': '' }}
                                                                                @endif>
                                                                                {{ $type->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-2 float-right">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Multiposting</h5>
                                                        </div>
                                                        <div class="card-body active_label">
                                                            <div class="mb-2">
                                                                <h5>General</h5>
                                                            </div>
                                                            <form action="{{ route('recruiter.jobs_store') }}{{ isset($data['job']->id) ? '?jobid=' . $data['job']->id : '' }}" id="form5" method="POST">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-md-4 mb-2">
                                                                        <div class="btn-group btn-group-toggle"
                                                                             data-toggle="buttons">
                                                                            <label class="btn btn-secondary"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Publish the job for 30 days on myyawik.com">
                                                                                <input type="checkbox" name="yawik" @if(isset($data['job']->id)) {{ $data['job']->yawik == 1 ? 'checked' : '' }} @endif id="" autocomplete="off"> Yawik
                                                                            </label>
                                                                            <span class="input-group-text"
                                                                                  data-toggle="modal"
                                                                                  data-target="#modal-default">?</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-4 mb-2">
                                                                        <div class="btn-group btn-group-toggle"
                                                                             data-toggle="buttons">
                                                                            <label class="btn btn-secondary"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Publish the job for 30 days on myyawik.com">
                                                                                <input type="checkbox" name="jobsintown" @if(isset($data['job']->id)) {{ $data['job']->jobsintown == 1 ? 'checked' : '' }} @endif id=""
                                                                                       autocomplete="off">jobsintown
                                                                            </label>
                                                                            <span class="input-group-text"
                                                                                  data-toggle="modal"
                                                                                  data-target="#modal-default">?</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-4 mb-2">
                                                                        <div class="btn-group btn-group-toggle"
                                                                             data-toggle="buttons">
                                                                            <label class="btn btn-secondary"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Publish the job for 30 days on myyawik.com">
                                                                                <input type="checkbox" name="fazjob_net" @if(isset($data['job']->id)) {{ $data['job']->fazjob_net == 1 ? 'checked' : '' }} @endif id=""
                                                                                       autocomplete="off">FAZjob.NET
                                                                            </label>
                                                                            <span class="input-group-text"
                                                                                  data-toggle="modal"
                                                                                  data-target="#modal-default">?</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-4">
                                                                        <div class="btn-group btn-group-toggle"
                                                                             data-toggle="buttons">
                                                                            <label class="btn btn-secondary"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Publish the job for 30 days on myyawik.com">
                                                                                <input type="checkbox" name="your_homepage" @if(isset($data['job']->id)) {{ $data['job']->your_homepage == 1 ? 'checked' : '' }} @endif id=""
                                                                                       autocomplete="off">Your Homepage
                                                                            </label>
                                                                            <span class="input-group-text"
                                                                                  data-toggle="modal"
                                                                                  data-target="#modal-default">?</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2 float-right">
                                                                    <button type="submit" name="multiposting" class="btn btn-success">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Job Context</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('recruiter.jobs_store') }}{{ isset($data['job']->id) ? '?jobid=' . $data['job']->id : '' }}" method="POST" id="form6">
                                                                @csrf
                                                                <textarea id="summernote1" name="context" class="form-control overflow-hidden" style="width: 100%; overflow-x:auto" >{{ $data['job']->context ?? '' }}</textarea>
                                                                <div class="mt-2 float-right">
                                                                    <button type="submit" class="btn btn-success">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Job Responsibilities</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('recruiter.jobs_store') }}{{ isset($data['job']->id) ? '?jobid=' . $data['job']->id : '' }}" method="POST" id="form7">
                                                                @csrf
                                                                <textarea id="summernote2" name="responsibilities" class="form-control" required>{{ $data['job']->responsibilities ?? '' }}</textarea>
                                                                <div class="mt-2 float-right">
                                                                    <button type="submit" class="btn btn-success">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                             aria-labelledby="custom-tabs-four-profile-tab">
                                        </div> --}}
                                        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                             aria-labelledby="custom-tabs-four-messages-tab">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Invoice Address</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('recruiter.jobs_store.invoice') }}" id="form7" method="post">
                                                                @csrf
                                                                <input type="hidden" name="jobid" value="{{ $data['job']->id ?? ''}}" />
                                                                <input type="hidden" name="invoice_id" value="{{ $data['invoice']->id ?? ''}}" />

                                                                <div class="form-group">
                                                                    <label>@lang('web.company')</label>
                                                                    <select class="form-control" name="company">
                                                                        <option value="">@lang('web.select') @lang('web.company')</option>
                                                                        @foreach ($data['organizations'] as $company)
                                                                            <option value=" {{ $company->org_name }}" @if(isset($data['invoice']) && $data['invoice']->company ) {{ $data['invoice']->company == $company->org_name ? 'selected' : ''  }}  @endif>{{ $company->org_name }}</option>
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
                                                                    <input type="text" name="street" class="form-control" value="{{ $data['invoice']->street ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>@lang('web.house_number')</label>
                                                                    <input type="text" name="house_number" class="form-control" value="{{$data['invoice']->house_number ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>@lang('web.postal_code')</label>
                                                                    <input type="number" name="postalcode" class="form-control" value="{{ $data['invoice']->postalcode ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>@lang('web.city')</label>
                                                                    <input type="text" name="city" class="form-control" value="{{ $data['invoice']->city ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>@lang('web.region')</label>
                                                                    <input type="text" name="region" class="form-control" value="{{ $data['invoice']->region ?? '' }}">
                                                                <div class="form-group">
                                                                    <label>@lang('web.country')</label>
                                                                    <select class="form-control" name="country">
                                                                        <option value="">@lang('web.select') @lang('web.country')</option>
                                                                        @foreach ($countries as $country)
                                                                            <option value=" {{ $country->country_name }}" @if(isset($data['invoice']) && $data['invoice']->country ) {{ $data['invoice']->country == $country->country_name ? 'selected' : ''  }}  @endif >{{ $country->country_name }}</option>
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
                                                                    <input type="text" name="tax_id" class="form-control" value="{{ $data['invoice']->tax_id ?? '' }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>@lang('web.salutation')</label>
                                                                    <select class="form-control" name="salutation">
                                                                        <option value="Mister" @if(isset($data['invoice'])) {{ $data['invoice']->salutation == 'Mister' ? 'selected' : '' }}  @endif>Mister</option>
                                                                        <option value="Mrs" @if(isset($data['invoice'])) {{ $data['invoice']->salutation == 'Mrs' ? 'selected' : '' }} @endif >Mrs</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>@lang('web.contact_no')</label>
                                                                    <input type="number" name="contact_person" class="form-control" value="{{$data['invoice']->contact_person ?? ''}}">
                                                                    @if ($errors->has('contact_person'))
                                                                        <p class="alert alert-danger p-1">
                                                                            {{ $errors->first('contact_person') }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>EmailAddress</label>
                                                                    <input type="email" name="email" class="form-control" value="{{$data['invoice']->email ?? '' }}">
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
                                        </div>

                                        <div class="tab-pane" id="custom-tabs-four-settings"
                                             role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                             <div class="row d-flex justify-content-center">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Job Preview </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            @if(!empty($data['job']))
                                                            <div class="header" style="color: green">
                                                                <h5>{{ $data['job']->title ?? '' }}
                                                                <div class="float-right">
                                                                    <button class="btn btn-info">
                                                                        {{ $data['job']->company ?? '' }}
                                                                    </button>
                                                                </div>
                                                                </h5>
                                                            </div>

                                                            <div class="form-group">
                                                                <strong>Job Location:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->location}}</p>
                                                            </div>


                                                            @if ($data['job']->vacancy ?? '' )
                                                            <div class="form-group">
                                                                <strong>Vacency:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->vacancy}}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->qualification ?? '' )
                                                            <div class="form-group">
                                                                <strong>Educational Qualification:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->qualification}}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->experience_requirement ?? '')
                                                            <div class="form-group">
                                                                <strong>Experience Requirements:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->experience_requirement }} Years</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->job_category_id ?? '')
                                                            <div class="form-group">
                                                                <strong>Job Category:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">
                                                                @foreach ($data['category'] as $item)
                                                                    @if ($data['job']->job_category_id == $item->pk_no)
                                                                    {{$item->name}}
                                                                    @endif
                                                                @endforeach
                                                                </p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->publish_date ?? '' )
                                                            <div class="form-group">
                                                                <strong>Pubish Date:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ date('d F Y', strtotime($data['job']->publish_date));}}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->deadline ?? '' )
                                                            <div class="form-group">
                                                                <strong>Job Deadline:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ date('d F Y', strtotime($data['job']->deadline));}}</p>
                                                            </div>
                                                            @endif

                                                            @if ($data['job']->context ?? '' )
                                                            <div class="form-group">
                                                                <strong>Job Context:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{!! $data['job']->context !!}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->responsibilities ?? '' )
                                                            <div class="form-group">
                                                                <strong>Job Responsibilities:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{!! $data['job']->responsibilities !!}</p>
                                                            </div>
                                                            @endif

                                                            @if ($data['job']->salary ?? 0 && $data['job']->currency ?? '' && $data['job']->time_interval_unit ?? '')
                                                            <div class="form-group">
                                                                <strong>Salary:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->salary}} {{$data['job']->currency}}/{{$data['job']->time_interval_unit}}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->company ?? '' )
                                                            <div class="form-group">
                                                                <strong>Company Name:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->company}}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->managers ?? '' )
                                                            <div class="form-group">
                                                                <strong>Manager Name:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->managers}}</p>
                                                            </div>
                                                            @endif

                                                            @if ($data['job']->profession ?? '' )
                                                            <div class="form-group">
                                                                <strong>Profession:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->profession }}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->industries ?? '' )
                                                            <div class="form-group">
                                                                <strong>Industries:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->industries }}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->employment_type ?? '' )
                                                            <div class="form-group">
                                                                <strong>Employment Types:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->employment_type }}</p>
                                                            </div>
                                                            @endif

                                                            @if ($data['job']->id ?? '')
                                                            @if ($data['job']->status == 1)
                                                            <a class="btn btn-primary" href="{{ route('jobs.inactive', $data['job']->id) }}">Inactive</i></a>
                                                        @else
                                                            <a class="btn btn-warning" href="{{ route('jobs.active', $data['job']->id) }}">Active</i></a>
                                                        @endif
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Publish on YAWIK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-2">
                            <div class="modal_content">
                                <h4>über YAWIK</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur sunt ipsa nulla
                                    impedit laudantium, assumenda aliquam laboriosam sequi vero dicta eius ipsam
                                    dolorum, unde saepe numquam voluptatibus quibusdam, porro aut.</p>
                                <h5>Schaltungsdauer: 30 Tage, Einzelpreis: <span class="badge badge-info">€499.00</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal_bx">
                                <img class="img-fluid" src="{{ asset('assets/dist/img/photo2.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('footer_script')

    <script src="{{ asset('assets/plugins/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );

        let jobId = null;
        $(document).ready(function () {

            let form1 = $('#form1');
            let form2 = $('#form2');
            let form3 = $('#form3');
            let form4 = $('#form4');
            let form5 = $('#form5');
            let form6 = $('#form6');
            let form7 = $('#form7');


        });

        $(function () {
            $('.select2').select2()
        })


        $(function () {
            //$('[data-toggle="tooltip"]').tooltip()
        })

    </script>
    <script type="text/javascript" src="{{asset('richtexteditor/rte.js')}}"></script>
    <script type="text/javascript" src="{{asset('richtexteditor/plugins/all_plugins.js')}}"></script>
    <script>
        var editor1 = new RichTextEditor("#div_editor1");
        //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
    </script>
    <script>
        var editor2 = new RichTextEditor("#div_editor2");
        //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
    </script>
    <script src="{{asset('medium-editor/medium-editor.js')}}"></script>
    <script src="{{asset('summernote/summernote-bs4.min.js')}}"></script>
    <script>
      $(function(){
        'use strict';
        // Inline editor
        // var editor = new MediumEditor('.editable');
        // Summernote editor
        $('#summernote1').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>
    <script>
        $(function(){
          'use strict';
          // Inline editor
          // var editor = new MediumEditor('.editable');
          // Summernote editor
          $('#summernote2').summernote({
            height: 150,
            tooltip: false
          })
        });
      </script>

{{-- <script src = "https://code.jquery.com/jquery-1.10.2.js"></script> --}}
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!-- Javascript -->
<script>
   $(function() {
      $( "#datepicker-13" ).datepicker();
   });
   $(function() {
      $( "#datepicker-14" ).datepicker();
   });
</script>
@endpush
