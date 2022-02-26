@extends('layouts.recruiter.app_recruiter')
@section('recruiter.dashboard','active')
@section('content')
<div class="dashboard_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('web.users')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.users')</li>
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
                <div class="card-right_banner text-center bg-light p-5 mb-3">
                    <h4>@lang('web.welcome')</h4>
                    <p>@lang('web.connect_applicants')</p>
                    <p>@lang('web.this_is_a_demo')</p>
                    <p>@lang('web.download_link')</a>
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>@lang('web.logged_in_recruiter')</h4>
                                </div>
                                <div class="card-body">
                                    <span>@lang('web.logout_from_panel')</span>

                                    <a class="btn btn-secondary mt-3" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('web.logout')
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mini_card mb-3">
                                        <div class="card-header">
                                            <h4>Integrate Jobs into your personal homepage</h4>
                                        </div>
                                        <div class="card-body">
                                            <span>You can add your active job openings into your personal homepage by using the</span>
                                            <a href="#">YawikWidget more information</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card mini_card">
                                        <div class="card-header">
                                            <h4>MyYAWIK as a job exchange</h4>
                                        </div>
                                        <div class="card-body">
                                            <span>Check out MyYAWIK how it works as a <a href="#">job</a> board . running. Here is an example of MyYAWIK running as  <a href="#">a job portal for gastronomy in Switzerland .</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="card application_form mb-3">
                            <div class="card-header">
                                <h4>Test application form</h4>
                            </div>
                            <div class="card-body">
                                <span>You can test an example application form here.</span>
                                <div class="mt-2">
                                    <div class="mb-3">
                                        <h3> <span class="text-danger">NEW</span> <a href="#">Unsolicited application</a></h3>
                                        <p>An application form as a standalone SPA. Customizable and ready to use in conjunction with MyYAWIK. Works in all modern browsers and on mobile devices.</p>
                                    </div>
                                    <div class="mb-3">
                                        <h3> <span class="text-danger">NEW</span> <a href="#">Application to job ad.</a></h3>
                                        <p>The application form references a specific job advertisement.</p>
                                    </div>
                                    <a href="#">application form</a>
                                    <p>The application is saved in the integrated applicant management system</p>
                                    <a href="#">application form</a>
                                    <p>The application will be sent by email.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
@endsection
