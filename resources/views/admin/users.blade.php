@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('admin.users', 'active')
@section('content')
<div class="users_page">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.users', ['type' => 1]) }}" class="btn btn-{{ (!request()->query('type') || request()->query('type') == 1) ? '' : 'outline-' }}secondary">@lang('web.admins')</a>
                                <a href="{{ route('admin.users', ['type' => 2]) }}" class="btn btn-{{ (request()->query('type') == 2 ? '' : 'outline-') }}secondary">@lang('web.applicants')</a>
                                <a href="{{ route('admin.users', ['type' => 3]) }}" class="btn btn-{{ request()->query('type') == 3 ? '' : 'outline-' }}secondary">@lang('web.recruiters')</a>
                                <a href="{{ route('user.create') }}" class="btn btn-primary" style="float: right">Add User</a>
                            </div>
                            <div class="card-body">
                                @if ($m = Session::get('success'))
                                    <div class="alert alert-success">
                                         {{ $m }} 
                                    </div>
                                @endif
                                <table class="table table-bordered responsive text-center" id="datatable1">
                                    <thead>
                                    <tr>
                                        <th class="text-left">@lang('web.name')</th>
                                        <th>@lang('web.email')</th>
                                        <th>@lang('web.role')</th>
                                        <th>@lang('web.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data['users'] as $user)
                                        <tr>
                                            <td class="text-left">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->user_type == 1)
                                                    Admin
                                                @elseif ($user->user_type == 3)
                                                    Recruiter
                                                @else
                                                    Applicant
                                                @endif
                                            </td>
                                            <td>
                                                <a href=" {{route('user.edit', $user->id)}} " class="btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                                <a href=" {{route('user.delete', $user->id)}} " class="btn-sm btn-danger" id="delete" ><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
