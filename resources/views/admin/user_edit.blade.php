@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('admin.users', 'active')

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
                        <h1 class="m-0">@lang('web.users')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item"><a href=" {{ route('admin.users') }} ">@lang('web.users')</a></li>
                            <li class="breadcrumb-item active">@lang('web.users') @lang('web.edit') </li>
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
                                <h5>@lang('web.users') @lang('web.edit')</h5>
                            </div>
                            <div class="card-body">
                                @if ($m = Session::get('success'))
                                    <div class="alert alert-success">
                                        <span> {{ $m }} </span>
                                    </div>
                                @endif
                                <form action=" {{ route('admin.user.update', $user->id) }} " method="post" enctype="multipart/form-data">
                                    @csrf
                                            <div class="form-group">
                                                <label>@lang('web.users') @lang('web.name')</label>
                                                <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.email')</label>
                                                <input type="email" name="email" value="{{ $user->email }}"  class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('web.role')</label>
                                                <select name="user_type" id="" class="form-control @error('user_type') is-invalid @enderror">
                                                    <option value="2" {{ $user->user_type == 2 ? 'selected': '' }}>Applicant</option>
                                                    <option value="3" {{ $user->user_type == 3 ? 'selected': '' }}>Recruiter</option>
                                                    <option value="1" {{ $user->user_type == 1 ? 'selected': '' }}>Admin</option>
                                                </select>
                                            @error('user_type')
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
