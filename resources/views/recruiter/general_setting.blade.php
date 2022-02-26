@extends('layouts.recruiter.app_recruiter')

@section('recruiter.settings', 'menu-is-opening menu-open')
@section('recruiter.general_setting', 'active')

@section('content')
<div class="jobs_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('web.general_settings')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('recruiter_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.general_settings')</li>
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
                        @if ($m = Session::get('success'))
                            <div class="alert alert-success">
                                <p> {{ $m }} </p>
                            </div>
                        @endif
                        <div class="card">
                            <form action="{{ route('recruiter.setting_store') }}" method="post">
                                @csrf
                                <div class="card-header">
                                    <h5>General Settings</h5>
                                </div>
                                <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-md-4 col-form-label">Coose Your Language</label>
                                    <div class="col-md-8">
                                    <select name="site_lang_id" class="form-control" id="">
                                        <option value="">Select One</option>
                                        @foreach ($languages as $lang)
                                        <option value="{{ $lang->id }}" {{ $global->lang_id == $lang->id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-md-4 col-form-label">Coose Your Timezone</label>
                                    <div class="col-md-8">
                                    <select name="time_zone_id" class="form-control" id="">
                                        <option value="">Select One</option>
                                        @foreach ($zones as $item)
                                        <option value="{{ $item->zone_id }}" {{ $global->zone_id == $item->zone_id ? 'selected' : '' }}>{{ $item->zone_name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-md-4 col-form-label"></label>
                                    <div class="col-md-8">

                                        <button type="submit" class="btn btn-info mr-2">Save</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                                </div>
                            </form>
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
