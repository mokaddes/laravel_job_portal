@extends('layouts.admin.app_admin')

@section('admin.organizations', 'menu-is-opening menu-open')
@section('admin.organization_overview', 'active')

@section('content')
<div class="companies_overview_page">
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
                            <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.organization')</li>
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
                                <div class="float-left btn btn-success">@lang('web.organization_list')</div>
                                <div class="float-right">
                                    <a href="{{ route('admin.organization_add') }}" class=" btn btn-success" >@lang('web.add_new')</a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($m = Session::get('success'))
                                    <div class="alert alert-success">
                                        <span> {{ $m }} </span>
                                    </div>
                                @endif
                                <table class="table responsive table-bordered" id="datatable1">
                                    <thead>
                                        <tr>
                                            <th>@lang('web.organization')</th>
                                            <th>@lang('web.location')</th>
                                            <th>@lang('web.street')</th>
                                            <th>@lang('web.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organizations as $item)
                                        <tr>
                                            <td>
                                                {{-- IDE <br/> Switching Company by <a href="#">CROSS Solution</a> --}}
                                                {{ $item->org_name }}
                                            </td>
                                            <td>{{ $item->location }} </td>
                                            <td>{{ $item->street }}</td>
                                            <td>
                                                <a href=" {{ route('admin.organization.edit', $item->id) }} " class="btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
                                                <a href=" {{ route('admin.organization.delete', $item->id) }}" id="delete" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="card-footer">
                                <ul class="pagination pagination m-0 float-right">
                                    {{ $organizations->links('pagination::bootstrap-4') }}
                                </ul>
                            </div> --}}
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
