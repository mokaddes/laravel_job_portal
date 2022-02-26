@extends('layouts.admin.app_admin')
@section('admin.job_board', 'active')
@push('header_script')
    {{-- <link rel="stylesheet" href="{{asset('assets/css/main.css')}}"> --}}
    <style>
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }
            .category-sidebar .card-header h4 {
            font-size: 17px;
            color: #222;
            font-weight: 600;
        }

        .category-sidebar .form-control {
            height: 42px;
            border: 1px solid #e1e1e1;
            border-radius: 2px;
            outline: none;
            box-shadow: none;
        }

        .category-sidebar .sidebar-list ul li {
            display: block;
            border-bottom: 1px solid #f5f3f3;
            padding: 6px 0px;
        }

        .category-sidebar .sidebar-list ul li a {
            color: #666;
            font-weight: 500;
            -moz-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .category-sidebar .sidebar-list ul li a:hover {
            color: #000;
            font-size: 15px;
        }
    </style>
@endpush

@section('content')
<div class="dashboard_page">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Public Job Opportunities</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                        <li class="breadcrumb-item active">@lang('web.jobboard')</li>
                    </ol>
                </div>
            </div>
            <form action=" {{ route('admin.jobboard') }} ">
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search query">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="form-group">
                            <select name="location" class="form-control select2 " style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach($data['locations'] as $location)
                                    <option value=" {{ $location->url_slug }} "> {{ $location->name }} </option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="form-group">
                            <select name="length" class="form-control">
                                <option>5 km</option>
                                <option>10 km</option>
                                <option>15 km</option>
                                <option>20 km</option>
                                <option>25 km</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-3">
                        <button type="submit" class="btn btn-primary">search</button>
                        <a href=" {{route('admin.jobboard')}} " class="btn btn-outline-dark">Clear filters</a>
                    </div>

                </div>
            </form>
            {{-- <div class="mt-2">
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-default"><i class="fa fa-envelope"></i> job by email</button>
            </div>
            <br>
            @if ($m = Session::get('success'))
                <div class="alert alert-success">
                    <span> {{ $m }} </span>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Subscribe to Job-Mail free of charge and always be informed automatically</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                        </div>
                        <div class="modal-body">
                            <form action=" {{ route('admin.jobboard.subscribe') }} " method="post">
                                @csrf
                                <div class="form-group">
                                    <label>search</label>
                                    <input type="text" name="search_key" class="form-control" value=" {{ $data['subscriber']->search_key ?? '' }} ">
                                </div>
                                <div class="form-group">
                                    <label>location</label>
                                    <select name="location" class="form-control select3 select3-hidden-accessible" style="width: 100%;" data-select3-id="2" tabindex="-1" aria-hidden="true">
                                        @foreach($data['locations'] as $location)
                                            <option value=" {{ $location->url_slug }} " {{ $data['subscriber']->location ?? '' == $location->url_slug ? 'selected': '' }}> {{ $location->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>perimeter</label>
                                    <select class="form-control" name="perimeter">
                                        <option value="5" {{ $data['subscriber']->perimeter ?? '' == 5 ? 'selected': '' }}>5 km</option>
                                        <option value="10" {{ $data['subscriber']->perimeter ?? '' == 10 ? 'selected': '' }}>10 km</option>
                                        <option value="15" {{ $data['subscriber']->perimeter ?? '' == 15 ? 'selected': '' }}>15 km</option>
                                        <option value="20" {{ $data['subscriber']->perimeter ?? '' == 20 ? 'selected': '' }}>20 km</option>
                                        <option value="25" {{ $data['subscriber']->perimeter ?? '' == 25 ? 'selected': '' }}>25 km</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value=" {{ $data['subscriber']->email ?? '' }} ">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Subscribe to</button>
                            </div>
                            </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div> --}}

            <!-- /.row -->
            <div class="row mt-5">
                <div class="col-sm-3">
                    <div class="category-sidebar position-sticky">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Search for keyword</h4>
                            </div>
                            <div class="card-body search-form">
                                <form action="{{ route('admin.jobboard') }}" method="get">
                                    <div class="input-group has-validation">
                                        <input type="text" name="search" class="form-control" value="{{ request()->get('search') }}" placeholder="Search for keyword
                                        " required>
                                        <button type="submit" class="input-group-text btn btn-secondary">Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Category</h4>
                            </div>
                            <div class="card-body">
                                <div class="sidebar-list category-list">
                                    <ul>
                                        @foreach($data['categories'] as $category)
                                        <li>
                                            <a href="{{ route('admin.jobboard', ['category' => $category->url_slug]) }}"><i class="fa fa-angle-right"></i> {{ $category->name }}
                                                ({{ \DB::table('job_post')->where('status',1)->where('job_post.deadline', '>=', date('y-m-d'))->where('job_category_id',  $category->pk_no)->count() }})</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Industry</h4>
                            </div>
                            <div class="card-body">
                                <div class="sidebar-list industry-list">
                                    <ul>
                                        @foreach($data['industries'] as $id => $industry)
                                        <li>
                                            <a href="{{ route('admin.jobboard', ['industry' => $industry]) }}">{{ $industry }}
                                                ({{ \DB::table('job_post')->where('status',1)->where('job_post.deadline', '>=', date('y-m-d'))->where('industries',  $industry)->count(); }})
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Location</h4>
                            </div>
                            <div class="card-body">
                                <div class="sidebar-list location-list">
                                    <ul>
                                        @foreach($data['locations'] as $location)
                                        <li>
                                            <a href="{{ route('admin.jobboard', ['location' => $location->url_slug]) }}">{{ $location->name }}
                                                ({{\DB::table('job_post')->where('status',1)->where('deadline', '>=', date('y-m-d'))->where('location',  $location->name)->count();}})</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header">
                            <h5>Job Board</h5>
                            <span style="float: right">Total job found ({{count($data['jobs'])}}) <a href=" {{ route('admin.jobboard') }} ">View All</a></span>
                        </div>
                        <div class="card-body">
                            <table id="datatable1" class="table responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title of the job / Company Name</th>
                                        <th>Location / Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($data['jobs']) && count($data['jobs']))
                                       @foreach($data['jobs'] as $job)

                                       <tr>
                                           <td>
                                               <a href="{{ route('details', $job->url_slug) }}">{{ $job->title }}</a> / {{ $job->company }}
                                           </td>
                                           <td>{{ $job->location }} /  {{ date('d F Y', strtotime($job->deadline));}}</td>
                                           <td>
                                            <a href="{{ route('details', $job->url_slug) }}" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>

                                           </td>
                                       </tr>
                                       @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="card-footer">
                            <ul class="pagination pagination m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">«</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

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
@push('footer_script')
@endpush
