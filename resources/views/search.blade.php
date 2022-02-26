@extends('layouts.app')

@section('content')
    <div class="search_page">
        <div class="category-jobs mt-4 mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="category-sidebar position-sticky">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Search for keyword</h4>
                                </div>
                                <div class="card-body search-form">
                                    <form action="{{ route('search') }}" method="get">
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
                                                <a href="{{ route('search', ['category' => $category->url_slug]) }}"><i class="fa fa-angle-right"></i> {{ $category->name }}
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
                                                <a href="{{ route('search', ['industry' => $industry]) }}">{{ $industry }}
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
                                                <a href="{{ route('search', ['location' => $location->url_slug]) }}">{{ $location->name }}
                                                    ({{\DB::table('job_post')->where('status',1)->where('deadline', '>=', date('y-m-d'))->where('location',  $location->name)->count();}})</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card mb-3">
                                <div class="card-header">
                                    <h4>Other Filter</h4>
                                </div>
                                <div class="card-body">
                                    <div class="filter-list">
                                        <div class="gender mb-3">
                                            <h6><strong>Gender</strong></h6>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                       id="male" checked>
                                                <label class="form-check-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                       id="female">
                                                <label class="form-check-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                       id="others">
                                                <label class="form-check-label" for="others">
                                                    Others
                                                </label>
                                            </div>
                                        </div>
                                        <div class="filter-form">
                                            <form action="" method="post">
                                                <div class="row g-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Job Nature</label>
                                                        <select class="form-select" name="jobnature"
                                                                aria-label="Default select example">
                                                            <option value="1">Any</option>
                                                            <option value="2">Full Time</option>
                                                            <option value="3">Part Time</option>
                                                            <option value="4">Intern</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Job Level</label>
                                                        <select class="form-select" name="joblebel"
                                                                aria-label="Default select example">
                                                            <option value="1">Any</option>
                                                            <option value="2">Entry Level</option>
                                                            <option value="3">Mid Level</option>
                                                            <option value="4">Top Level</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Experience Range</label>
                                                        <select class="form-select" name="jobexpreience"
                                                                aria-label="Default select example">
                                                            <option value="1">Any</option>
                                                            <option value="2">Below 1 year</option>
                                                            <option value="3">1 - < 3 years</option>
                                                            <option value="4">3 - < 5 years</option>
                                                            <option value="5">5 - < 10 years</option>
                                                            <option value="5">Over 10 years</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Age Range</label>
                                                        <select class="form-select" name="agerange"
                                                                aria-label="Default select example">
                                                            <option value="1">Any</option>
                                                            <option value="2">Below 20 years</option>
                                                            <option value="3">20 - < 30 years</option>
                                                            <option value="4">30 - < 40 years</option>
                                                            <option value="5">40 - < 50 years</option>
                                                            <option value="5">Over 50 years</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success mt-3">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card category-right">
                            <div class="card-header">
                                <div class="category-right-header">
                                    <span>Click at the job title to view details. Total job found ({{count($data['jobs'])}}) <a href=" {{ route('search') }} ">View All</a> </span>
                                    <div class="float-end">
                                        <form action="">
                                            <label for=""><i class="fa fa-calendar"></i> Deadline</label>
                                            <select class="form-select form-control" aria-label="Default select example" onchange="window.location.href=this.value;">
                                                <option value="">Choose </option>
                                                <option value="{{ route('search', ['deadline' => 'today']) }}">Today</option>
                                                <option value="{{ route('search', ['deadline' => 'tomorrow']) }}">Tomorrow</option>
                                                <option value="{{ route('search', ['deadline' => 'next_two_day']) }}">Next 2 days</option>
                                                <option value="{{ route('search', ['deadline' => 'next_three_day']) }}">Next 3 days</option>
                                                <option value="{{ route('search', ['deadline' => 'next_four_day']) }}">Next 4 days</option>
                                                <option value="{{route('search')}}">All</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(isset($data['jobs']) && count($data['jobs']))
                                    @foreach($data['jobs'] as $job)
                                        <div class="job-list mb-3">
                                            <div class="job-info">
                                                <h3><a href="{{ route('details', $job->url_slug) }}">{{ $job->title }}</a>
                                                </h3>
                                                <span class="badge bg-danger">{{ $job->company }}</span>
                                                <div class="job_deadline">
                                                    <h6><i class="fa fa-calendar"></i>Deadline: @if (isset($job->deadline))
                                                        {{ date('d F Y', strtotime($job->deadline));}}
                                                    @endif </h6>
                                                </div>
                                                <div class="address-info">
                                                    <ul>
                                                        <li><i class="fa fa-map-marker-alt"></i> {{ $job->location }}</li>
                                                        <li><i class="fas fa-user-graduate"></i> {{ $job->qualification }}</li>
                                                        <li><i class="fa fa-medal"></i> {{ $job->experience_requirement }} year(s)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            @endif
                            <!-- pagination -->
                                {{-- <nav class="float-end mt-4">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav> --}}

                                    <div class="pull-right" style="float: right">
                                        {!! $data['jobs']->links() !!}
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
