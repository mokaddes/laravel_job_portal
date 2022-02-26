@extends('layouts.recruiter.app_recruiter')

@section('recruiter.organizations', 'active')
@section('recruiter.organization_add', 'active')

@section('content')
 @push('header_script')
    <style>
        input[type="file"] {height: 45px;}
        .form-control.is-invalid, .was-validated .form-control:invalid{
            border: 1px solid #dc3545 !important;
        }
    </style>
@endpush
<div class="companies_add_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('web.organization')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('recruiter_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item"><a href=" {{ route('recruiter.organization_overview') }} ">@lang('web.organization')</a></li>
                            <li class="breadcrumb-item active">@lang('web.organization') @lang('web.insert')</li>
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
                    <div class="col-8">
                        <form action="{{ route('recruiter.organization.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('web.organization') @lang('web.name')</label>
                                        <input type="text" name="org_name" value="{{ old('org_name') }}" class="form-control @error('org_name') is-invalid @enderror">
                                        @error('org_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.street')</label>
                                        <input type="text" name="street" value="{{ old('street') }}" class="form-control @error('street') is-invalid @enderror">
                                        @error('street')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.house_number')</label>
                                        <input type="text" name="house_number" value="{{ old('house_number') }}" class="form-control @error('house_number') is-invalid @enderror">
                                    @error('house_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.postal_code')</label>
                                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control @error('postal_code') is-invalid @enderror">
                                        @error('postal_code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.location')</label>
                                        <input type="text" name="location" value="{{ old('location') }}" class="form-control @error('location') is-invalid @enderror">
                                        @error('location')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.country')</label>
                                        <select name="country" class="select2 form-select form-control @error('country')is-invalid @enderror" aria-label="Default select example">
                                            <option value="" style="display:none;">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                            @endforeach
                                          </select>


                                        @error('country')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.contact_no')</label>
                                        <input type="number" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.fax')</label>
                                        <input type="number" name="fax" value="{{ old('fax') }}" class="form-control @error('fax') is-invalid @enderror">
                                        @error('fax')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.image')</label>
                                        <input type="file" name="image" class="form-control @error('image')is-invalid @enderror">
                                        @error('image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('web.description')</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="2">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5>@lang('web.org_setting') </h5>
                                    <div class="form-group">
                                        <label>@lang('web.ideas')</label>
                                        <select name="ideas" class="form-select form-control @error('ideas')is-invalid @enderror" aria-label="Default select example">
                                            <option value="" style="dispaly:none;">@lang('web.select') @lang('web.ideas')</option>
                                            <option value="1">@lang('web.active_profie')</option>
                                            <option value="2">@lang('web.active_profie_if')</option>
                                            <option value="3">@lang('web.deactive_profile')</option>
                                          </select>
                                          @error('ideas')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-success">@lang('web.submit')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
@endsection
