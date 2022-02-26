@extends('layouts.applicant.app_applicant')
@section('applicant.applications', 'active')
@section('content')
<div class="application_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Your sent applications </h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('applicant_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.applications')</li>
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
                                            <th>@lang('web.sent_on')</th>
                                            <th>@lang('web.company_name')</th>
                                            <th>@lang('web.title')</th>
                                            <th>@lang('web.status')</th>
                                            <th>@lang('web.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $item)
                                            <tr>
                                                <td>{{ format_date($item->apply_date )}}</td>
                                                <td> {{ $item->company_name }} </td>
                                                <td> {{ $item->job_title }} </td>
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
@endsection
