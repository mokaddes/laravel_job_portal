@extends('layouts.recruiter.app_recruiter')

@section('recruiter.profile', 'active')

@section('content')

@push('header_script')
    <style>
        input[type="file"] {height: 45px;}
        .form-control.is-invalid, .was-validated .form-control:invalid{border: 1px solid #dc3545 !important;}
    </style>
@endpush

<div class="companies_add_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('web.profile')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('recruiter_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.profile') Edit</li>
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
                        <div class="card">
                            <div class="card-header">
                                <h5>Edit Profile</h5>
                            </div>
                            <div class="card-body">
                                @if ($m = Session::get('success'))
                                    <div class="alert alert-success">
                                         {{ $m }}
                                    </div>
                                @endif
                                <form action="{{ route('recruiter.profile.update', $recruiter->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                            <div class="form-group">
                                                <label>@lang('web.recruiters') @lang('web.name')</label>
                                                <input type="text" name="name" value="{{ $recruiter->name }}" class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.email')</label>
                                                <input type="email" name="email" value="{{ $recruiter->email }}" class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.password')</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-success">@lang('web.submit')</button>
                                            </div>

                                </form>
                            </div>
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
