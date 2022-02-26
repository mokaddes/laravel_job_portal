@extends('layouts.admin.app_admin')
@section('admin.resume', 'active')

@push('header_script')
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
    input[type="file"] {height: 45px;}
    .input-group-text{cursor: pointer;}
    .remove-field {margin: 0 auto;}
    </style>

@endpush

@php

$em_type =  \DB::table('employment_type')->get();

@endphp

@section('content')
<div class="resume_page">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Resume</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.resume')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                         <form action="{{ route('admin.resume.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="part" value="basic" />
                            <div class="card">
                                <div class="card-header">
                                    <h5>Basic Data</h5>
                                </div>
                                <div class="px-2 pt-2">
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>First name</label>
                                        @if($data)
                                            <input type="text" name="first_name" class="form-control" value="{{$data->first_name}}">
                                            @else
                                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                            @endif

                                        @error('first_name')
                                         <div class="text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        @if($data)
                                            <input type="text" name="last_name" class="form-control" value="{{$data->last_name}}">
                                        @else
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"  class="form-control">
                                        @endif
                                        @error('last_name')
                                         <div class="text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        @if($data)
                                            <input type="text" name="email" class="form-control" value="{{$data->email}}">
                                        @else
                                            <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                        @endif
                                        @error('email')
                                         <div class="text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">CV</label>
                                        <div class="input-group">
                                                <input type="file" name="cv" class="form-control">
                                        </div>
                                        @error('cv')
                                          <div class="text text-danger">{{$message}}</div>
                                        @enderror
                                        <div >
                                            @if($data->cv ?? '')
                                            <a class="link" href="{{ asset($data->cv) }}" title="click here show for old cv"  target="_blank" >show old cv</a>
                                            @endif
                                        </div>
                                    </div>
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                                </div>
                            </div>
                         </form>
                            @if(isset($employ_history) && count($employ_history) > 0 )
                            @foreach($employ_history as $k => $emp_hist)
                            <div class="card customer_records">
                                <form action="{{ route('admin.resume.store') }}" method="post" >
                                    @csrf
                                    <input type="hidden" name="part" value="em_hist" />
                                    <input type="hidden" value="{{ $emp_hist->id }}" name="employ_history_id" />
                                    <div class="card-header">
                                        <h5>Employment history ({{ $k+1 }})</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Beginning:</label>
                                            <div class="input-group date" id="reservationdate{{ $k+1 }}" data-target-input="nearest">

                                                <input type="text" name="em_hist_beginning_at" class="form-control datetimepicker-input" data-target="#reservationdate{{ $k+1 }}" data-toggle="datetimepicker" value="{{ date('m/d/Y', strtotime($emp_hist->start_date)) }}" readonly>

                                                <div class="input-group-append" data-target="#reservationdate{{ $k+1 }}" autocomplete="off" value="">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            @error('em_hist_beginning_at')
                                              <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            @if ($emp_hist->til_today == 1)
                                                <div class="form-group form-check">
                                                    <input type="checkbox" {{ $emp_hist->til_today == 1 ? 'checked' : ''  }}  class="form-check-input" id="til-today2" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2" name="em_hist_til_today">
                                                    <label class="form-check-label" for="til-today2">till  today</label>
                                                </div>
                                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                    <label>End:</label>
                                                    <div class="input-group date" id="reservationdate3{{$k+1}}" data-target-input="nearest">
                                                        <input type="text" name="em_hist_end_at" class="form-control datetimepicker-input" data-target="#reservationdate3{{$k+1}}" autocomplete="off" data-toggle="datetimepicker" value="{{ $emp_hist->end_date }}">
                                                        <div class="input-group-append" data-target="#reservationdate3{{$k+1}}" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-group form-check">
                                                    <input type="checkbox"  class="form-check-input"  name="em_hist_til_today">
                                                    <label class="form-check-label" for="">till  today</label>
                                                </div>
                                                <div class="" id="">
                                                    <label>End:</label>
                                                    <div class="input-group date" id="reservationdate3{{$k+1}}" data-target-input="nearest">
                                                        <input type="text" name="em_hist_end_at" class="form-control datetimepicker-input" data-target="#reservationdate3{{$k+1}}" autocomplete="off" data-toggle="datetimepicker" value="{{ $emp_hist->end_date }}">
                                                        <div class="input-group-append" data-target="#reservationdate3{{$k+1}}" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>company name</label>
                                            <input type="text" name="em_hist_company_name" class="form-control" value="{{ $emp_hist->company_name}}">
                                            @error('em_hist_company_name')
                                            <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="from-group">
                                            <label>description</label>
                                            <textarea name="em_hist_description" class="form-control" cols="30" rows="3">{{ $emp_hist->description }}</textarea>
                                            @error('em_hist_description')
                                            <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="{{ route('admin.emp_hist.delete', $emp_hist->id) }}" class="btn btn-danger pull-right" style="float: right">Delete</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                            @else

                            <div class="card customer_records">
                                <form action="{{ route('admin.resume.store') }}" method="post" >
                                    @csrf
                                    <input type="hidden" name="part" value="em_hist" />
                                    <div class="card-header">
                                        <h5>Employment history</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Beginning:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">

                                                <input type="text" name="em_hist_beginning_at" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" value="{{ old('em_hist_beginning_at') }}" readonly>
                                                <div class="input-group-append" data-target="#reservationdate" autocomplete="off" value="">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            @error('em_hist_beginning_at')
                                              <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                             <div class="form-group form-check">

                                                  <input type="checkbox" checked class="form-check-input" id="til-today2" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2" name="em_hist_til_today">

                                                  <label class="form-check-label" for="til-today2">til today</label>
                                              </div>
                                              <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                    <label>End:</label>
                                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                        <input type="text" name="em_hist_end_at" class="form-control datetimepicker-input" data-target="#reservationdate2" autocomplete="off" data-toggle="datetimepicker" value="{{ old('em_hist_end_at') }}">
                                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>

                                              </div>
                                        </div>
                                        <div class="form-group">
                                            <label>company name</label>
                                            <input type="text" name="em_hist_company_name" class="form-control" value="{{ old('em_hist_company_name') }}">
                                            @error('em_hist_company_name')
                                            <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="from-group">
                                            <label>description</label>

                                            <textarea name="em_hist_description" class="form-control" cols="30" rows="3">{{ old('em_hist_description') }}</textarea>

                                            @error('em_hist_description')
                                            <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @endif

                            <div class="customer_records_dynamic"></div>
                            <div class="form-group">
                                <button  class="btn btn-success addfield"><i class="fa fa-plus"></i> add Employment history</button>
                            </div>

                            <div class="card">
                                <form action="{{ route('admin.resume.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="part" value="em_desired" />

                                    <div class="card-header">
                                        <h5>Desired Employment</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group" data-select2-id="5">
                                            <label>Desired type of employment</label>
                                            <select name="desired_employment_type" class="form-control"  data-placeholder="Select Desired type of employment"  required>
                                                @if ($data)
                                                    @foreach($em_type as $row)
                                                        <option value="{{ $row->name }}" {{ $data->desired_employment_type == $row->name ? 'selected' : '' }}>{{ $row->name }}</option>
                                                    @endforeach

                                                @else
                                                    @foreach($em_type as $row)
                                                        <option value="{{ $row->name }}">{{ $row->name }}</>
                                                    @endforeach
                                                @endif


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Desired position</label>
                                            @if ($data)
                                                <input type="text" name="desired_position" class="form-control" value="{{$data->desired_position}}">
                                            @else
                                                <input type="text" name="desired_position" class="form-control" value="{{ old('desired_position') }}">
                                            @endif

                                            @error('desired_position')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Preferred Job Location</label>
                                            @if ($data)
                                                <input type="text" name="job_location" class="form-control" value="{{$data->preferred_job_location}}">
                                            @else
                                                <input type="text" name="job_location" class="form-control" value="{{ old('job_location') }}">
                                            @endif
                                            @error('job_location')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Traveling</label>
                                            <select class="form-control" name="traveling">
                                                @if ($data)
                                                <option value="{{$data->traveling}}">{{$data->traveling}}</option>
                                                @else
                                                <option style="display:none;" value="">Select Traveling</option>
                                                @endif
                                                <option value="yes">Yes</option>
                                                <option value="conditional">Conditional</option>
                                                <option value="no">No</option>
                                            </select>
                                            @error('traveling')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>salary expectations</label>
                                            @if ($data)
                                            <input type="number" name="salary" class="form-control" value="{{$data->salary_expectations}}">
                                            @else
                                            <input type="number" name="salary" class="form-control" value="{{ old('salary') }}">
                                            @endif
                                            @error('salary')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @if(isset($education_history) && count($education_history) > 0 )
                            @foreach($education_history as $k => $edu_hist)
                            <div class="card education_records">
                                <form action="{{ route('admin.resume.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="part" value="edu_hist" />
                                    <input type="hidden" name="education_history_id" value=" {{ $edu_hist->id }} " />
                                    <div class="card-header">
                                        <h5>Education history  ({{ $k+1 }}, {{$edu_hist->edu_level}})</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Level of education</label>
                                            <div class="input-group "  >
                                                <input type="text" name="edu_level" class="form-control" value="{{ $edu_hist->edu_level }}" >
                                            </div>
                                            @error('edu_level')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Exam/Degree Title</label>
                                            <div class="input-group "  >
                                                <input type="text" name="exam_title" class="form-control" value="{{  $edu_hist->exam_title }}" >
                                            </div>
                                            @error('exam_title')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group" data-select2-id="53">
                                            <label>Country</label>
                                            <select name="country" class="form-control select2 select2-hidden-accessible" data-placeholder="Select a Country" data-value="" style="width: 100%;" data-select2-id="country" tabindex="-1" aria-hidden="true" required>
                                                <option value="{{  $edu_hist->country }}">{{  $edu_hist->country }}</option>
                                                 {{
                                                    $country =  DB::table('country')->get();
                                                 }}
                                                 @foreach($country as $row)
                                                   <option value="{{ $row->country_name }}">{{ $row->country_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <div class="input-group "  >
                                                <input type="text" name="city" class="form-control" value="{{  $edu_hist->city }}" >
                                            </div>
                                            @error('city')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Institute Name</label>
                                            <div class="input-group "  >
                                                <input type="text" name="institution_name" class="form-control" value="{{  $edu_hist->institution_name }}" >
                                            </div>
                                            @error('institution_name')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Result</label>
                                            <div class="input-group "  >
                                                <input type="text" name="result" class="form-control" value="{{  $edu_hist->result }}" >
                                            </div>
                                            @error('result')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Year of Passing</label>
                                            <div class="input-group "  >
                                                <input type="number" name="passing_year" class="form-control" value="{{  $edu_hist->passing_year  }}" >
                                            </div>
                                            @error('passing_year')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <div class="input-group "  >
                                                <input type="number" name="duration" class="form-control" value="{{  $edu_hist->duration  }}" >
                                            </div>
                                            @error('duration')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Achievement</label>
                                            <div class="input-group "  >
                                                <input type="text" name="achievement" class="form-control" value="{{  $edu_hist->achievement }}" >
                                            </div>
                                            @error('achievement')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary pull-left">Save</button>
                                            <a href="{{ route('admin.edu_hist.delete', $edu_hist->id) }}" class="btn btn-danger pull-right" style="float: right">Delete</a>
                                        </div>
                                    </div>
                              </form>
                            </div>
                            @endforeach
                            @else
                            <div class="card education_records">
                                <form action="{{ route('admin.resume.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="part" value="edu_hist" />
                                    <div class="card-header">
                                        <h5>Education history</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Level of education</label>
                                            <div class="input-group "  >
                                                <input type="text" name="edu_level" class="form-control" value="{{ old('edu_level') }}" >
                                            </div>
                                            @error('edu_level')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Exam/Degree Title</label>
                                            <div class="input-group "  >
                                                <input type="text" name="exam_title" class="form-control" value="{{ old('exam_title') }}" >
                                            </div>
                                            @error('exam_title')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group" data-select2-id="53">
                                            <label>Country</label>
                                            <select name="country" class="select2 select2-hidden-accessible" data-placeholder="Select a Country" data-value="" style="width: 100%;" data-select2-id="country" tabindex="-1" aria-hidden="true" required>
                                                <option value=""></option>
                                                 {{
                                                    $country =  DB::table('country')->get();
                                                 }}
                                                 @foreach($country as $row)
                                                   <option value="{{ $row->country_name }}">{{ $row->country_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <div class="input-group "  >
                                                <input type="text" name="city" class="form-control" value="{{ old('city') }}" >
                                            </div>
                                            @error('city')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Institute Name</label>
                                            <div class="input-group "  >
                                                <input type="text" name="institution_name" class="form-control" value="{{ old('institution_name') }}" >
                                            </div>
                                            @error('institution_name')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Result</label>
                                            <div class="input-group "  >
                                                <input type="text" name="result" class="form-control" value="{{ old('result') }}" >
                                            </div>
                                            @error('result')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Year of Passing</label>
                                            <div class="input-group "  >
                                                <input type="number" name="passing_year" class="form-control" value="{{ old('passing_year') }}" >
                                            </div>
                                            @error('passing_year')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <div class="input-group "  >
                                                <input type="number" name="duration" class="form-control" value="{{ old('duration') }}" >
                                            </div>
                                            @error('duration')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Achievement</label>
                                            <div class="input-group "  >
                                                <input type="text" name="achievement" class="form-control" value="{{ old('achievement') }}" >
                                            </div>
                                            @error('achievement')
                                                <div class="text text-danger">{{  'The field is required' }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                              </form>
                            </div>
                            @endif
                            <div class="education_records_dynamic"></div>
                            <div class="form-group">
                                <button  class="btn btn-success addfieldedu"><i class="fa fa-plus"></i> add more Education history</button>
                            </div>
                            <div class="card">
                                <form action="{{ route('admin.resume.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="part" value="native_lang" />

                                <div class="card-header">
                                    <h5>Native language</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group" data-select2-id="55">
                                        <label>Language</label>
                                        <select name="language" class="form-control "  data-placeholder="Select Language" data-value="" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                            <option style="display:none;" value="" >select a language</option>
                                            @foreach($language as $row)
                                            <option value="{{ $row->id }}" @if($data) {{ $data->native_language==$row->id ? 'selected' : '' }} @endif>{{ $row->name }}</option>
                                           @endforeach
                                       </select>
                                       @error('language')
                                            <div class="text text-danger">{{  'The field is required' }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            @if(isset($additional_lang) && count($additional_lang) > 0 )
                            @foreach($additional_lang as $k => $add_lang)
                            <div class="card add_lang">
                                <div class="card-header">
                                    <h5>Additional Language Skills ({{$k+1}})</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.resume.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="add_lang_id" value=" {{ $add_lang->id }} " />
                                        <div class="form-group" ata-select2-id="56">
                                            <label>Language</label>
                                            <select name="language" class="form-control" data-placeholder="Select Language" style="width: 100%;" >
                                                @foreach($language as $row)
                                                    <option value="{{ $row->id }} "  {{ $add_lang->language == $row->id ? 'selected': '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @foreach ($formdatas as $k => $formdata )
                                        <div class="form-group">
                                            <label>{{$formdata->name}}</label>
                                            <select name="{{$formdata->form_name}}" class="form-control">
                                                {{-- {{ $filed_name =  $formdata->name}} --}}
                                                <option style="display:none;" value="" >select an option</option>
                                                {{$child=DB::table('d_form_values')->where('f_form_no',$formdata->id)->get();}}

                                                @foreach($child as $item)
                                                    <option value="{{ $item->id }}" {{ ( $add_lang->understand == $item->id) ? 'selected': '' }} {{ ( $add_lang->to_speak == $item->id) ? 'selected': '' }} {{ ( $add_lang->participate_in_conversations == $item->id) ? 'selected': '' }} {{ ( $add_lang->to_read == $item->id) ? 'selected': '' }} {{ ( $add_lang->to_write == $item->id) ? 'selected': '' }} {{ ( $add_lang->to_listen == $item->id) ? 'selected': '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endforeach
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="{{ route('admin.add_lang.delete', $add_lang->id) }}" class="btn btn-danger pull-right" style="float: right">Delete</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="card add_lang">
                                <div class="card-header">
                                    <h5>Additional Language Skills</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.resume.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" ata-select2-id="56">
                                            <label>Language</label>
                                            <select name="language" class="form-control" data-placeholder="Select Language" style="width: 100%;" >
                                                <option style="display:none;" value="" >select a language</option>
                                                @foreach($language as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @foreach ($formdatas as $formdata )
                                        <div class="form-group">
                                            <label>{{$formdata->name}}</label>
                                            <select name="{{$formdata->form_name}}" class="form-control">
                                                <option style="display:none;" value="" >select an option</option>
                                                {{$child=DB::table('d_form_values')->where('f_form_no',$formdata->id)->get();}}
                                                @foreach($child as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endforeach
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                            <div class="add_lang_dynamic"></div>
                            <div class="form-group">
                                <button  class="btn btn-success addfieldlang"><i class="fa fa-plus"></i> add more Language Skills</button>
                            </div>
                            <div class="card">
                                <form action="{{ route('admin.resume.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="part" value="investments" />
                                <div class="card-header">
                                    <h5>Investments</h5>
                                </div>
                                <div class="card-body">
                                    <input type="file" name="investment" class="form-control">
                                    @error('investment')
                                          <div class="text text-danger">{{$message}}</div>
                                    @enderror
                                    <div >

                                        @if($data->investments ?? '')
                                        <a target="_blank" class="link" href="{{ asset($data->investments) }}" title="click here show for old investments">show old investments</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save </button>
                                </div>
                                </form>
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

 @push('footer_script')

 <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $(function () {
          $('.select2').select2()
          $('.select3').select2()
          $('.select4').select2()
          $('.select5').select2()
    });
    $(function() {
        //Date picker
        $('#reservationdate1').datetimepicker({
            format: 'L'
        });

        $('#reservationdate2').datetimepicker({
            format: 'L'
        });
         $('#reservationdate3').datetimepicker({
            format: 'L'
        });
        $('#reservationdate4').datetimepicker({
            format: 'L'
        });

        $('#reservationdate5').datetimepicker({
            format: 'L'
        });


        $('#reservationdate6').datetimepicker({
            format: 'L'
        });


        $('#reservationdate7').datetimepicker({
            format: 'L'
        });


        $('#reservationdate8').datetimepicker({
            format: 'L'
        });

        $('#reservationdate9').datetimepicker({
            format: 'L'
        });

        // end date
        $('#reservationdate31').datetimepicker({
            format: 'L'
        });

        $('#reservationdate32').datetimepicker({
            format: 'L'
        });
         $('#reservationdate33').datetimepicker({
            format: 'L'
        });
        $('#reservationdate34').datetimepicker({
            format: 'L'
        });

        $('#reservationdate35').datetimepicker({
            format: 'L'
        });


        $('#reservationdate36').datetimepicker({
            format: 'L'
        });


        $('#reservationdate37').datetimepicker({
            format: 'L'
        });


        $('#reservationdate38').datetimepicker({
            format: 'L'
        });

        $('#reservationdate39').datetimepicker({
            format: 'L'
        });


    })

    var i = 0;
    var j = 0;
    // Add Employment History
    $(document).on('click', '.addfield', function(e) {
        i++;
        j++;
        var reservationdate     = 'reservationdate_'+i;
        var reservationdate2    = 'reservationdate2_'+j;
        let html = '';
            html += '<div class="card customer_records"><form action="{{ route('admin.resume.store') }}" method="post" >@csrf<input type="hidden" name="part" value="em_hist" /><div class="card-header"><h5>Employment history</h5></div><div class="card-body">';

            html += '<div class="form-group"><label>Beginning:</label><div class="input-group date" id="'+reservationdate+'" data-target-input="nearest"><input type="text" name="em_hist_beginning_at" class="form-control datetimepicker-input" data-target="#'+reservationdate+'" data-toggle="datetimepicker" value="" readonly required><div class="input-group-append" data-target="#'+reservationdate+'" autocomplete="off" value=""><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div>';

            html += '<div class="form-group"><div class="form-group form-check"><input type="checkbox" checked class="form-check-input" id="til-today2" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2" name="em_hist_til_today"><label class="form-check-label" for="til-today2">til today</label></div><div class="collapse multi-collapse" id="multiCollapseExample2"><label>End:</label><div class="input-group date" id="'+reservationdate2+'" data-target-input="nearest"><input type="text" name="em_hist_end_at" class="form-control datetimepicker-input" data-target="#'+reservationdate2+'" autocomplete="off" data-toggle="datetimepicker" value=""><div class="input-group-append" data-target="#'+reservationdate2+'" data-toggle="datetimepicker"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div></div>';

            html += '<div class="form-group"><label>company name</label><input type="text" name="em_hist_company_name" class="form-control" value="" required ></div>';

            html += '<div class="from-group"><label>description</label><textarea name="em_hist_description" class="form-control" cols="30" rows="3" required>{{ old('em_hist_description') }}</textarea></div>';

            html += '<div class="form-group mt-3"><button type="submit" class="btn btn-primary">Save</button></div>';


        html += '</div></form></div>';

          $(html).appendTo('.customer_records_dynamic');
          $('.customer_records_dynamic .customer_records').addClass('single remove');
          $('.single .addfield').remove();
          $('.single').append('<a href="#" class="remove-field btn btn-primary float-right mr-3 mb-3">Remove</a>');
          $('.customer_records_dynamic > .single').attr("class", "remove mb-3 card");

          // $('.customer_records_dynamic input').each(function() {
          //   var count = 0;
          //   var fieldname = $(this).attr("name");
          //   $(this).attr('name', fieldname + count );
          //   count++;
          // });

        $('#'+reservationdate).datetimepicker({
                format: 'L'
        });

        $('#'+reservationdate2).datetimepicker({
                format: 'L'
        });

        });

        $(document).on('click', '.remove-field', function(e) {
              $(this).parent('.remove').remove();
              e.preventDefault();
        });

</script>

<script>
    var i = 0;
    var j = 0;
    $(document).on('click', '.addfieldedu', function(e) {
        i++;
        j++;
        var reservationdate     = 'reservationdate_'+i;
        var reservationdate2    = 'reservationdate2_'+j;
        let html = '';
            html += '<div class="card education_records">';
            html += '<form action="{{ route('admin.resume.store') }}" method="post">@csrf<input type="hidden" name="part" value="edu_hist" />';
            html += '<div class="card-header"><h5>Education history</h5></div><div class="card-body"><div class="form-group"><label>Level of education</label><div class="input-group " ><input type="text" name="edu_level" class="form-control" value="{{ old('edu_level') }}" ></div></div>';
            html += '<div class="form-group"><label>Exam/Degree Title</label><div class="input-group "  ><input type="text" name="exam_title" class="form-control" value="{{ old('exam_title') }}" >';
            html += '</div></div><div class="form-group" data-select2-id="53"><label>Country</label><select name="country" class="select2 form-control" data-placeholder="Select a Country" data-value="" style="width: 100%;" data-select2-id="country" tabindex="-1" aria-hidden="true">';
            html += '<option value="">Select One</option>+{{$country =  DB::table('country')->get();}}"@foreach($country as $row)<option value="{{ $row->country_name }}">{{ $row->country_name }}</option>@endforeach</select></div>';
            html += '<div class="form-group"><label>City</label><div class="input-group " ><input type="text" name="city" class="form-control" value="{{ old('city') }}" >';
            html += '</div></div><div class="form-group"><label>Institute Name</label><div class="input-group"><input type="text" name="institution_name" class="form-control" value="{{ old('institution_name') }}" >';
            html += '</div></div><div class="form-group"><label>Result</label><div class="input-group"><input type="text" name="result" class="form-control" value="{{ old('result') }}" >';
            html += '</div></div><div class="form-group"><label>Year of Passing</label><div class="input-group"><input type="number" name="passing_year" class="form-control" value="{{ old('passing_year') }}" >';
            html += '</div></div><div class="form-group"><label>Duration</label><div class="input-group"><input type="number" name="duration" class="form-control" value="{{ old('duration') }}" >';
            html += '</div></div><div class="form-group"><label>Achievement</label><div class="input-group"><input type="text" name="achievement" class="form-control" value="{{ old('achievement') }}" >';
            html += '</div></div><div class="form-group mt-3"><button type="submit" class="btn btn-primary">Save</button></div></div></form></div>';

          $(html).appendTo('.education_records_dynamic');
          $('.education_records_dynamic .education_records').addClass('single remove');
          $('.single .addfieldedu').remove();
          $('.single').append('<a href="#" class="remove-field btn btn-primary float-right mr-3 mb-3">Remove</a>');
          $('.education_records_dynamic > .single').attr("class", "remove mb-3 card");

        });

        $(document).on('click', '.remove-field', function(e) {
              $(this).parent('.remove').remove();
              e.preventDefault();
        });
</script>
<script>
    var i = 0;
    var j = 0;
    $(document).on('click', '.addfieldlang', function(e) {
        let html = '';
            html += '<div class="card add_lang"><div class="card-header"><h5>Additional Language Skills</h5></div><div class="card-body"><form action="{{ route('admin.resume.store') }}" method="post" enctype="multipart/form-data">@csrf<div class="form-group" ata-select2-id="56">';
            html += '<label>Language</label><select name="language" class="form-control" data-placeholder="Select Language" style="width: 100%;" ><option style="display:none;" value="" >select a language</option>@foreach($language as $row)<option value="{{ $row->id }}">{{ $row->name }}</option>@endforeach</select></div>@foreach ($formdatas as $formdata )<div class="form-group">';
            html += '<label>{{$formdata->name}}</label><select name="{{$formdata->form_name}}" class="form-control"><option style="display:none;" value="" >select an option</option>{{$child=DB::table('d_form_values')->where('f_form_no',$formdata->id)->get();}}@foreach($child as $item)<option value="{{ $item->id }}">{{ $item->name }}</option>@endforeach</select></div>@endforeach';
            html += '<div class="form-group mt-3"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div>';

          $(html).appendTo('.add_lang_dynamic');
          $('.add_lang_dynamic .add_lang').addClass('single remove');
          $('.single .addfieldlang').remove();
          $('.single').append('<a href="#" class="remove-field btn btn-primary float-right mr-3 mb-3">Remove</a>');
          $('.add_lang_dynamic > .single').attr("class", "remove mb-3 card");

        });

        $(document).on('click', '.remove-field', function(e) {
              $(this).parent('.remove').remove();
              e.preventDefault();
        });
</script>

@endpush

