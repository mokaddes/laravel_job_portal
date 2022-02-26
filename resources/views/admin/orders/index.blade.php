@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('orders.index', 'active')
@section('content')
<div class="companies_overview_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                                <div class="float-left btn btn-success">Order List</div>
                                <div class="float-right">
                                    <a href="{{ route('orders.create') }}" class=" btn btn-success" >Add New</a>
                                </div>
                            </div>
                            <div class="card-body">

                                @if ($m = Session::get('success'))
                                    <div class="alert alert-success">
                                         {{ $m }} 
                                    </div>
                                @endif
                                <table id="datatable1" class="table display responsive nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>Order Email</th>
                                            <th>Contact No</th>
                                            <th>Company</th>
                                            <th>Country</th>
                                            <th>Action</th>
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
                                                <a href=" {{ route('orders.edit', $item->id) }}" class="btn-sm btn-warning">Edit</a>
                                                <a href=" {{ route('admin.orders.delete', $item->id) }} " class="btn-sm btn-danger" id="delete">Delete</a>

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
