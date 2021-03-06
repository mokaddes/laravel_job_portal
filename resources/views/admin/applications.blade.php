@extends('layouts.admin.app_admin')
@section('admin.application', 'active')
@section('content')
<div class="dashboard_page">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('web.applications')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.applications')</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <form action=" {{ route('admin.applications') }}" >
                    <div class="row gutters-1">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="@lang('web.search_query')">
                            </div>
                        </div>
                        <div class="col-sm-5 col-lg-2">
                            <div class="form-group">
                                <select class="form-control" name="title">
                                    <option value="">@lang('web.enter_ad_title')</option>
                                    @foreach ($applications as $item)
                                        <option>{{$item->job_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5 col-lg-2">
                            <div class="form-group">
                                <select class="form-control" name="status">
                                    <option value="">Everyone</option>
                                    <option value="1">Not View</option>
                                    <option value="2">Viewed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 col-lg-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">@lang('web.search')</button>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <div class="form-group">
                                <a href=" {{ route('admin.applications') }} " class="btn btn-outline-dark">@lang('web.clear_filters')</a>
                            </div>
                        </div>
                    </div>
                </form>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>@lang('web.applications')</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatable1" class="table responsive table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('web.applicant')</th>
                                            <th>@lang('web.email')</th>
                                            <th>@lang('web.company_name')</th>
                                            <th>@lang('web.title')</th>
                                            <th>@lang('web.recruiters') @lang('web.name')</th>
                                            <th>@lang('web.resume')</th>
                                            <th>@lang('web.apply_date')</th>
                                            <th>@lang('web.status')</th>
                                            <th>@lang('web.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $item)
                                            <tr>
                                                <td> {{ $item->applicant_name }} </td>
                                                <td> {{ $item->email }} </td>
                                                <td> {{ $item->company_name }} </td>
                                                <td> {{ $item->job_title }} </td>
                                                <td>
                                                    @foreach ($users as $user)
                                                        @if ($item->recruiter_id == $user->id)
                                                            {{ $user->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($resume as $cv)
                                                        @if ($item->resume_id == $cv->id)
                                                            <a href=" {{ asset($cv->cv) }} " target="_blank" class="btn-sm btn-primary" >@lang('web.download')</a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ format_date($item->apply_date )}}</td>
                                                <td>
                                                    @if ($item->status == 2)
                                                        <div class="badge badge-success">
                                                            @lang('web.viewed')
                                                        </div>
                                                    @else
                                                        <div class="badge badge-warning">
                                                            @lang('web.not') @lang('web.viewed')
                                                        </div>
                                                    @endif
                                                </td>
                                                @foreach ($jobs as $job)
                                                    @if ($item->job_id == $job->id)
                                                        <td> <a href="{{ route('details', $job->url_slug) }}" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a> </td>
                                                    @endif
                                                @endforeach

                                                {{-- @if ($item->job_id == $jobs->id)
                                                <td>

                                                </td>

                                                @endif --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="card-footer">
                                <ul class="pagination pagination float-right">
                                    <li class="page-item"><a class="page-link" href="#">??</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">??</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
@endsection
