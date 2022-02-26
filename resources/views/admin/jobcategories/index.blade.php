@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('jobcategories.index', 'active')
@section('content')
<div class="dashboard_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Job Category</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">Job Category</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        {{-- Main Content --}}
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left btn btn-primary">Job Category List</div>
                        <div class="float-right">
                            <a href=" {{ route('jobcategories.create') }} " class=" btn btn-success">Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                 {{$message}} 
                            </div>
                        @endif
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap text-center">
                              <thead>
                                <tr>
                                  <th class="text-center">No</th>
                                  <th class="text-center">Code</th>
                                  <th class="text-center">Name</th>
                                  <th class="text-center">Logo</th>
                                  <th class="text-center">Order ID</th>
                                  <th class="text-center">Active Post</th>
                                  <th class="text-center">Total Post</th>
                                  <th class="text-center">Status</th>
                                  <th class="text-center">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td> {{ $category->code }} </td>
                                    <td> {{ $category->name }} </td>
                                    <td>
                                        <img src="{{URL::to($category->logo)}}" alt="" width="50px" height="50px">
                                    </td>
                                    <td> {{ $category->order_id }} </td>
                                    <td> {{ $category->active_post }} </td>
                                    <td> {{ $category->total_post }} </td>
                                   <td>
                                        @if( $category->is_active == 0)
                                            <span class="badge badge-secondary">waiting for approval</span>
                                        @elseif($category->is_active == 1)
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('jobcategories.destroy', $category->pk_no) }}" method="POST" id="form">

                                            <a class="btn btn-sm btn-primary" href="{{ route('jobcategories.show', $category->pk_no) }}"><i class="fa fa-eye"></i></a>

                                            <a class="btn btn-sm btn-primary" href="{{ route('jobcategories.edit', $category->pk_no) }}"><i class="fa fa-edit"></i></a>

                                            @csrf
                                            @method('DELETE')

                                            {{-- <button class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></button> --}}
                                            <a href="{{ URL::to('jobcategory/delete/'. $category->pk_no) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                                            @if ($category->is_active == 1)
                                                    <a class="btn btn-sm btn-primary" href="{{ route('jobcategories.inactive', $category->pk_no) }}"><i class="fa fa-thumbs-up"></i></a>
                                            @else
                                                    <a class="btn btn-sm btn-warning" href="{{ route('jobcategories.active', $category->pk_no) }}"><i class="fa fa-thumbs-down"></i></a>
                                            @endif

                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                              </tbody>
                            </table>
                          </div><!-- table-wrapper -->

                        </div><!-- card -->
                      </div><!-- sl-pagebody -->

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>


    </div>
</div>
@endsection
