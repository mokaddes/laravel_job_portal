@extends('layouts.app')

@section('content')

@php
    $today = date('Y-m-d');
    $live_job = App\Models\JobPost::where('status', 1)->where('publish_date', '<=', $today)->where('job_post.deadline', '>=', $today)->count();
    $vacancy = App\Models\JobPost::where('status', 1)->where('publish_date', '<=', $today)->where('job_post.deadline', '>=', $today)->get()->sum('vacancy');

    // $new_jobs = \DB::table('job_post')->where('status',1)->where('job_post.deadline', '>=', date('Y-m-d'))->orderBy('publish_date', 'ASC')->take(15)->count();

@endphp
    <!-- find job -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="banner-title pt-5 mb-3">
                        <h3>@lang('web.find_the_right_job')</h3>
                    </div>
                    <form action="{{ route('search') }}" method="get">
                        <div class="row g-1">
                            <div class="col-lg-6">
                                <input type="text" name="search" class="form-control"
                                       placeholder="@lang('web.search_by_keyword')">
                            </div>
                            <div class="col-lg-4">
                                <select class="form-select" aria-label="Default select example" name="organization">
                                    <option value="" disabled selected>@lang('web.organization_type')</option>
                                    @foreach($data['organizations'] as $key => $org)
                                        <option value="{{ $org }}">{{ $org }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 mb-3">
                                <button type="submit" class="btn btn-success">@lang('web.search') </button>
                            </div>
                        </div>
                    </form>
                    <div class="counter">
                        <div class="row">
                            <div class="col-6 col-sm-3 col-md-3">
                                <div class="live-job mb-3">
                                    <a href=" {{ route('search') }} ">
                                        <div class="d-flex position-relative">
                                            <div class="counter-icon">
                                                <i class="fa fa-chart-line"></i>
                                            </div>
                                            <div class="jobs-content">
                                                <h5 class="mt-0">@lang('web.live_jobs') </h5>
                                                <span>{{ $live_job }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-3 col-md-3">
                                <div class="live-job mb-3">
                                    <a href="{{ route('search') }}">
                                        <div class="d-flex position-relative">
                                            <div class="counter-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="jobs-content">
                                                <h5 class="mt-0">@lang('web.vacancies') </h5>
                                                <span>{{ $vacancy }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-3 col-md-3">
                                <div class="live-job mb-3">
                                    <a href="{{ route('search') }}">
                                        <div class="d-flex position-relative">
                                            <div class="counter-icon">
                                                <i class="fas fa-landmark"></i>
                                            </div>
                                            <div class="jobs-content">
                                                <h5 class="mt-0">@lang('web.companies') </h5>
                                                <span>{{ count($data['organizations'] ?? []) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-3 col-md-3">
                                <div class="live-job mb-3">
                                    <a href="{{ route('search', ['new_jobs' => 'newjobs']) }}">
                                        <div class="d-flex position-relative">
                                            <div class="counter-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="jobs-content">
                                                <h5 class="mt-0">@lang('web.new_jobs') </h5>
                                                <span>{{ $data['new_jobs']->count() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="banner-right">
                        <div class="banner-right-title">
                            <h3>@lang('web.location')</h3>
                        </div>
                        <div class="jobs-list mb-2">
                            <ul>
                                @foreach($data['locations'] as $location)
                                <li>
                                    <a href="{{ route('search', ['location' => $location->url_slug]) }}">{{ $location->name }}
                                        ({{\DB::table('job_post')->where('status',1)->where('job_post.deadline', '>=', date('Y-m-d'))->where('location',  $location->name)->count();}})</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- <div class="banner-right-title">
                            <h3>@lang('web.quick_links')</h3>
                        </div>
                        <div class="quick-links">
                            <ul>
                                <li>
                                    <a href="#"> <i class="fa fa-angle-double-right"></i>Employer List</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-angle-double-right"></i>Employer List</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-angle-double-right"></i>Employer List</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-angle-double-right"></i>Employer List</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-angle-double-right"></i>Employer List</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>


<!-- category -->
<div class="browse-category mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                @if(isset($data['categories']) && count($data['categories']))
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fa fa-list"></i> @lang('web.browse_category')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-0">
                            @php($i = 0) @php($count = count($data['categories']))
                            @foreach($data['categories'] as $category)
                            @if($i % 4 == 0)
                            <div class="col-sm-6 col-md-4 mb-2">
                                <ul>
                                    @endif
                                    <li>
                                        <a href="{{ route('search', ['category' => $category->url_slug]) }}"><i class="fa fa-angle-right"></i> {{ $category->name }}
                                            ({{ \DB::table('job_post')->where('status',1)->where('job_post.deadline', '>=', date('Y-m-d'))->where('job_category_id',  $category->pk_no)->count(); }})</a>
                                    </li>
                                    @if(($i % 4 == 0 && $i != 0) || $count - 1 == $i)
                                </ul>
                            </div>
                            @endif
                            @php($i++)
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @if(isset($data['popular']) && count($data['popular']))
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>@lang('web.popular_jobs')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-0">
                            @php($i = 0) @php($count = count($data['popular']))
                            @foreach($data['popular'] as $category)
                                @if($i % 4 == 0)
                                    <div class="col-sm-6 col-md-4 mb-2">
                                        <ul>
                                            @endif
                                            <li>
                                                <a href="{{ route('search', ['category' => $category->pk_no]) }}"><i class="fa fa-angle-right"></i> {{ $category->name }}
                                                    ({{ $category->active_post ?? '3333' }})</a>
                                            </li>
                                            @if(($i % 4 == 0 && $i != 0) || $count - 1 == $i)
                                        </ul>
                                    </div>
                                @endif
                            @php($i++)
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="">
                            <h4> @lang('web.latest_jobs') </h4>
                            <a href=" {{ route('search') }} " class="badge bg-danger float-end">@lang('web.view_all')</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="jobs-slider">
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @php($count = count($data['latest_jobs'] ?? []))
                                    @foreach($data['latest_jobs'] as $key => $job)
                                    @if($key == 0 || $key % 3 == 0)
                                    @if($key != 0)
                                </div>
                                @endif
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    @endif
                                    <div class="slider-item">
                                        <a href="{{ route('details', $job->url_slug) }}">
                                            <span class="title">{{Str::limit($job->title, 30, '...')}} </span>
                                        </a>
                                    </div>
                                    @if($key == $count - 1)
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
