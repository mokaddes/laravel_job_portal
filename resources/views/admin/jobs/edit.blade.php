@extends('layouts.admin.app_admin')
@section('admin.jobs', 'active')

@push('header_script')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link href="{{asset('summernote/summernote-bs4.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="jobs_page">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit a job @if($data['job']->status == 0) <small>(draft)</small> @endif</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit a job</li>
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form1" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label>Job title</label>
                                                                    <input type="text" name="title"
                                                                           value="{{ $data['job']->title ?? '' }}"
                                                                           data-validation-required-message="Location is required"
                                                                           class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Location</label>
                                                                    <input class="form-control" name="location" data-validation-required-message="Location is required"
                                                                    required value="{{ $data['job']->location  }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Vacancy</label>
                                                                    <input type="number" name="vacancy"
                                                                           value="{{ $data['job']->vacancy ?? '' }}"
                                                                           data-validation-required-message="Vacancy is required"
                                                                           class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Experience requirement (Year)</label>
                                                                    <input type="number" name="experience_requirement"
                                                                           value="{{ $data['job']->experience_requirement ?? 0 }}"
                                                                           data-validation-required-message="Experience requirement is required"
                                                                           class="form-control" required >
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Job category</label>
                                                                    <select class="form-control" name="job_category_id" data-validation-required-message="job category is required">
                                                                        <option value="">Select job category</option>
                                                                        @if(isset($data['category']) && count($data['category']) > 0 )
                                                                        @foreach($data['category'] as $k => $cat)
                                                                            <option value="{{ $cat->pk_no }}" {{ $data['job']->job_category_id == $cat->pk_no ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <div class="mt-2 float-right">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Update
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form2" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label>Company Name</label>
                                                                    <select class="form-select form-control" name="company"
                                                                            aria-label="Default select example" required>
                                                                            @foreach ($data['organizations'] as $org)
                                                                            <option value="{{ $org->org_name }}" @if($data['job']->company  ==$org->org_name ) selected @endif>{{ $org->org_name }}</option>
                                                                            @endforeach

                                                                    </select>
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
                                                                    <button type="submit" class="btn btn-success">Update
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form3" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label>Salary</label>
                                                                    <input type="number" name="salary" value="{{ $data['job']->salary ?? '' }}" class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Currency</label>
                                                                    <select class="form-select form-control"
                                                                            name="currency"
                                                                            aria-label="Default select example" required>
                                                                        <option @if($data['job']->currency=="USD")selected @endif>USD</option>
                                                                        <option @if($data['job']->currency=="CAD")selected @endif>CAD</option>
                                                                        <option @if($data['job']->currency=="EUR")selected @endif>EUR</option>
                                                                        <option @if($data['job']->currency=="AED")selected @endif>AED</option>
                                                                        <option @if($data['job']->currency=="AFN")selected @endif>AFN</option>
                                                                        <option @if($data['job']->currency=="ALL")selected @endif>ALL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Time interval unit</label>
                                                                    <select class="form-select form-control" name="time_interval_unit" aria-label="Default select example"required>
                                                                        <option @if($data['job']->time_interval_unit=="Hour")selected @endif>Hour</option>
                                                                        <option @if($data['job']->time_interval_unit=="Day")selected @endif>Day</option>
                                                                        <option @if($data['job']->time_interval_unit=="Week")selected @endif>Week</option>
                                                                        <option @if($data['job']->time_interval_unit=="Month")selected @endif>Month</option>
                                                                        <option @if($data['job']->time_interval_unit=="Year")selected @endif>Year</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-2 float-right">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Update
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form4" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label>Profession</label>
                                                                    <select
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        style="width: 100%;" name="profession" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                                                        <option selected="selected" data-select2-id="3">
                                                                            Profession
                                                                        </option>
                                                                    @foreach ($data['professions'] as $profession)
                                                                           <option value="{{ $profession->name }}">
                                                                                {{ $profession->name }}
                                                                            </option>
                                                                       @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Industries{{$data['job']->industries}}</label>
                                                                    <select   class="form-control select2 select2-hidden-accessible"
                                                                        style="width: 100%;" name="industries" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                                                        @foreach ($data['industries'] as $industry)
                                                                            <option value="{{ $industry->name }}" @if($data['job']->industries==$industry->name) selected @endif>{{ $industry->name }}</option>
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
                                                                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-2 float-right">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Update
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form5" method="post">
                                                                @csrf
                                                                @method('PUT')
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
                                                                    <button type="submit" name="multiposting" class="btn btn-success">Update
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form6" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                @csrf
                                                                <textarea name="context" class="form-control summernote" cols="30" rows="2" required>{{ $data['job']->context ?? '' }}</textarea>
                                                                <div class="mt-2 float-right">
                                                                    <button type="submit" class="btn btn-success">Update
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form7" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                @csrf
                                                                <textarea name="responsibilities" class="form-control summernote" cols="30" rows="2" required>{{ $data['job']->responsibilities ?? '' }}</textarea>
                                                                <div class="mt-2 float-right">
                                                                    <button type="submit" class="btn btn-success">Update
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Is Popular Job?</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                @csrf
                                                                <label for="is_popular">
                                                                    <input type="radio" name="is_popular" {{ $data['job']->is_popular ? 'checked' : '' }} value="1" id="is_popular">
                                                                    <span>Yes</span>
                                                                </label>
                                                                <label for="is_popular_no">
                                                                    <input type="radio" name="is_popular" {{ $data['job']->is_popular ? '' : 'checked' }} value="0" id="is_popular_no">
                                                                    <span>No</span>
                                                                </label>

                                                                <div class="mt-2 float-right">
                                                                    <button type="submit" class="btn btn-success">Update
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
                                                            <form action="{{ route('adminjobs.update',$data['job']->id) }}" id="form7" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Company</label>
                                                                    <input type="text" name="company" value="{{ old('company') }}" class="form-control @error('company') is-invalid @enderror" required>
                                                                    @error('company')
                                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Street</label>
                                                                    <input type="text" name="street" value="{{ old('street') }}" class="form-control @error('street') is-invalid @enderror" required>
                                                                    @error('street')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>House number</label>
                                                                    <input type="text" name="house_number" value="{{ old('house_number') }}" class="form-control @error('house_number') is-invalid @enderror" required>
                                                                    @error('house_number')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Postal code</label>
                                                                    <input type="text" name="postalcode" value="{{ old('postalcode') }}" class="form-control @error('postalcode') is-invalid @enderror" required>
                                                                    @error('postalcode')
                                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" required>
                                                                    @error('city')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Region</label>
                                                                    <input type="text" name="region" value="{{ old('region') }}" class="form-control @error('region') is-invalid @enderror" required>
                                                                    @error('region')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <input type="text" name="country" value="{{ old('country') }}" class="form-control @error('country') is-invalid @enderror" required>
                                                                    @error('country')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Value added tax ID</label>
                                                                    <input type="number" name="tax_id" value="{{ old('tax_id') }}" class="form-control @error('tax_id') is-invalid @enderror" required>
                                                                    @error('tax_id')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Salutation</label>
                                                                    <select class="form-select form-control @error('salutation') is-invalid @enderror"
                                                                            name="salutation"
                                                                            aria-label="Default select example" required>
                                                                        <option value="" style="display:none;">Select Salutation</option>
                                                                        <option value="mr.">Mr.</option>
                                                                        <option value="mrs.">Mrs.</option>
                                                                    </select>
                                                                    @error('salutation')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Contact Person</label>
                                                                    <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-control @error('contact_person') is-invalid @enderror" required>
                                                                    @error('contact_person')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Email Address</label>
                                                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                                                                    @error('email')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                </div>
                                                                <div class="mt-3">
                                                                    <button type="submit" class="btn btn-success">Update
                                                                    </button>
                                                                </div>
                                                            </form>
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
                                                            <h5>Job Preview</h5>
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
                                                            @if ($data['job']->location ?? '')
                                                            <div class="form-group">
                                                                <strong>Job Location:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->location}}</p>
                                                            </div>
                                                            @elseif ($data['job']->location == Location )
                                                            <div class="form-group">
                                                                <strong>Job Location:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">Anywhare of Country</p>
                                                            </div>
                                                            @endif

                                                            @if ($data['job']->vacancy ?? '' )
                                                            <div class="form-group">
                                                                <strong>Vacency:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->vacancy}}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->experience_requirement ?? '')
                                                            <div class="form-group">
                                                                <strong>Experience Requirements:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->experience_requirement }} Years</p>
                                                            </div>
                                                            @endif

                                                            @if ($data['job']->context ?? '' )
                                                            <div class="form-group">
                                                                <strong>Job Context:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->context}}</p>
                                                            </div>
                                                            @endif
                                                            @if ($data['job']->responsibilities ?? '' )
                                                            <div class="form-group">
                                                                <strong>Job Responsibilities:</strong>
                                                                <p class="text-justify" style="margin-left: 50px">{{ $data['job']->responsibilities }}</p>
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
                                                                    <a class="btn btn-primary" href="{{ route('adminjobs.inactive', $data['job']->id) }}">Inactive</i></a>
                                                                @else
                                                                    <a class="btn btn-warning" href="{{ route('adminjobs.active', $data['job']->id) }}">Active</i></a>
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

    <script src="{{asset('summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 150,
                tooltip: false
            });
        });
    </script>

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

            {{--form1.submit(function (e) {--}}
            {{--    e.preventDefault();--}}
            {{--    $.ajax({--}}
            {{--        url: '{{ route('recruiter.jobs_store') }}' + (jobId ? '?jobid=' + jobId : ''),--}}
            {{--        type: 'POST',--}}
            {{--        data: {--}}
            {{--            _token: '{{ csrf_token() }}',--}}
            {{--            form: 1,--}}
            {{--            title: $('input[name=title]').val(),--}}
            {{--            location: $('input[name=location]').val(),--}}
            {{--        },--}}
            {{--        success: function (res) {--}}
            {{--            console.log(res);--}}
            {{--        },--}}
            {{--        error: function (err) {--}}
            {{--            console.log(err);--}}
            {{--        }--}}
            {{--    });--}}
            // });
        });

        $(function () {
            $('.select2').select2()
        })


        $(function () {
            //$('[data-toggle="tooltip"]').tooltip()
        });


    </script>
@endpush
