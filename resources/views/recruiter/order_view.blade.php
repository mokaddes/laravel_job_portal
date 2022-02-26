@extends('layouts.recruiter.app_recruiter')

@section('recruiter.organizations', 'menu-is-opening menu-open')
@section('recruiter.organization_overview', 'active')

@section('content')
<div class="companies_overview_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('web.orders')</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.orders')</li>
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
                                <div class="float-left btn btn-success">@lang('web.orders_list')</div>
                                <div class="float-right">
                                    <a href="{{ route('recruiter.orders') }}" class=" btn btn-success" >@lang('web.add_new')</a>
                                </div>
                            </div>
                            <div class="card-body">

                                @if ($m = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p> {{ $m }} </p>
                                    </div>
                                @endif
                                <table id="datatable1" class="table display responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>@lang('web.orders') @lang('web.email')</th>
                                            <th>@lang('web.contact_no')</th>
                                            <th>@lang('web.company')</th>
                                            <th>@lang('web.country')</th>
                                            <th>@lang('web.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                        <tr>
                                            <td>
                                                {{-- IDE <br/> Switching Company by <a href="#">CROSS Solution</a> --}}
                                                {{ $item->email }}
                                            </td>
                                            <td>{{ $item->contact_persion }} </td>
                                            <td>{{ $item->company }}</td>
                                            <td>{{ $item->country }}</td>
                                            <td>
                                                <a href=" {{ route('recruiter.order.edit', $item->id) }} " class="btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                                <a href=" {{ route('recruiter.order.delete', $item->id) }} " class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <ul class="pagination pagination m-0 float-right">
                                    {{-- {{ $orders->links('pagination::bootstrap-4') }} --}}
                                </ul>
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
