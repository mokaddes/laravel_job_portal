@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('admin.jobs', 'active')

<?php
$status = request('status') ?? 1;

?>

@section('content')
<div class="jobs_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('web.all_job_advertisement')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.jobs')</li>
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
               {{-- <form class="mb-4">
                   <div class="row">
                       <div class="col-7 col-md-5">
                           <input type="text" name="job_search" class="form-control" placeholder="@lang('web.search_for_position_or_company')">
                       </div>
                       <div class="col-5 col-md-7">
                           <button type="submit" class="btn btn-success">@lang('web.seek')</button>
                           <a href=" {{ route('admin.jobs') }} " class="btn btn-primary">@lang('web.clear_filters')</a>
                       </div>
                   </div>
               </form> --}}

                <div class="card">
                    <div class="card-header">

                        <form class="form-inline d-none d-sm-inline-block">
                            <div class="input-group">
                                <input class="bg-light form-control border-0 small d-none" type="text" name="all" value="all">
                                <div class="input-group-append">
                                    <a href=" {{ route('admin.jobs') }} " class="btn btn-outline-success {{ $status == 1 ? 'active' : '' }}">@lang('web.show_all_job')</a>
                                </div>
                            </div>
                        </form>

{{--                        <form class="form-inline d-none d-sm-inline-block">--}}
{{--                            <div class="input-group">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <a href=" {{ route('admin.jobs') }}?status=my_jobs" class="btn btn-outline-primary  {{ $status == 'my_jobs' ? 'active' : '' }}">@lang('web.show_my_job')</a>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}


                        <form class="form-inline d-none d-sm-inline-block">
                            <div class="input-group">
                                <input class="bg-light form-control border-0 small d-none" type="text" name="active" value="active">
                                <div class="input-group-append">
                                    <a href=" {{ route('admin.jobs') }}?status=active" class="btn btn-outline-info {{ $status == 'active' ? 'active' : '' }} ">@lang('web.active')</a>

                                </div>
                            </div>
                        </form>

                        <form class="form-inline d-none d-sm-inline-block">
                            <div class="input-group">
                                <input class="bg-light form-control border-0 small d-none" type="text" name="inactive" value="inactive">
                                <div class="input-group-append">
                                    <a href=" {{ route('admin.jobs') }}?status=inactive" class="btn btn-outline-danger {{ $status == 'inactive' ? 'active' : '' }}">@lang('web.inactive')</a>

                                </div>
                            </div>
                        </form>
                        <form class="form-inline d-none d-sm-inline-block">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <a href=" {{ route('admin.jobs') }}?status=draft" class="btn btn-outline-primary  {{ $status == 'draft' ? 'active' : '' }}">Draft Job</a>
                                </div>
                            </div>
                        </form>
                        {{-- <div class="float-right"><a href="{{ route('adminjobs.create') }}" class="btn btn-success {{ $status == 'jobs_create' ? 'active' : '' }}">@lang('web.create_a_job')</a></div> --}}
                    </div>
                    <div class="card-body">
                        <table id="datatable1" class="table display table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('web.date_of_receipt')</th>
                                    <th>@lang('web.ad_title')</th>
                                    <th>@lang('web.location')</th>
                                    <th>@lang('web.company_name')</th>
                                    <th>@lang('web.reference')</th>
                                    <th>@lang('web.applications')</th>
                                    <th>@lang('web.status')</th>
                                    <th>@lang('web.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($job as $key=>$row)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $row->created_at->format('d/m/y') }}</td>
                                    <td>
                                        {{-- <span class="badge badge-warning">Chnaged</span> --}}
                                        <a href="#">{{ $row->title }}</a>
                                    </td>
                                    <td>{{ $row->location }}</td>
                                    <td>{{ $row->company }}</td>
                                    <td>{{ $row->code }}</td>
                                    <td>
                                        <span class="badge badge-dark">
                                            @php
                                                    $application = \DB::table('applications')->where('job_id', $row->id)->count();
                                            @endphp
                                            @if (isset($application) && $application > 0 )
                                                {{$application}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if( $row->status == 0)
                                         <span class="badge badge-secondary">Draft</span>
                                        @elseif($row->status == 1)
                                         <span class="badge badge-success">Active</span>
                                        @elseif($row->status == 2)
                                         <span class="badge badge-info" title="Inactive by admin">Inactive</span>
                                        @elseif($row->status == 3)
                                         <span class="badge badge-info" title="Inactive by owner">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="#" class="btn-sm btn-success"><i class="fa fa-user"></i></a> --}}
                                        {{-- <a href="#" class="btn-sm btn-info"><i class="fa fa-history"></i></a> --}}
                                        <a href="{{Route("adminjobs.edit",$row->id)}}" class="btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @if ($row->status == 1)
                                            <a class="btn-sm btn-primary" href="{{ route('adminjobs.inactive', $row->id) }}"><i class="fa fa-thumbs-up"></i></a>
                                        @else
                                            <a class="btn-sm btn-warning" href="{{ route('adminjobs.active', $row->id) }}"><i class="fa fa-thumbs-down"></i></a>
                                        @endif
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
@endsection
