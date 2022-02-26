<?php

$dashboard_route = 'applicant_dashboard';

if(Auth::user() && Auth::user()->user_type == 1 ){
    $dashboard_route = 'admin_dashboard';
}
if(Auth::user() && Auth::user()->user_type == 3 ){
    $dashboard_route = 'recruiter_dashboard';
}
$langs = \Config::get('static_array.lang');
$to_date = date('Y-m-d');
$todays_jobs = \DB::table('job_post')->where('status',1)->where('publish_date', $to_date)->where('deadline', '>=', $to_date)->count();

?>

<div class="header bg-light shadow-sm p-1 bg-body rounded">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">MyYAWIK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <a href="{{ route('search', ['today_job' => 'today']) }}" type="button" class="btn-sm btn-warning position-relative" style="margin-right:5px;">
                            @lang("web.today's_jobs_posts")
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                              {{ $todays_jobs ?? '' }}
                            </span>
                        </a>
                        <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('jobboard') }}">@lang('web.jobboard')</a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route($dashboard_route) }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">@if( Auth::user()) {{ Auth::user()->name }} @else <i class="fa fa-user" aria-hidden="true"></i>  @endif </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @auth
                                    <li><a class="dropdown-item" href="{{ route($dashboard_route) }}">@lang('web.dashboard')</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('web.logout')
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('login') }}">@lang('web.sign_in')</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">@lang('web.sign_up')</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLang" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $langs[app()->getLocale()] ?? 'English' }}</a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownLang">
                                @if($langs)
                                    @foreach($langs as $ke => $lang )
                                        <li><a class="dropdown-item {{ ($langs[app()->getLocale()] ?? 'English') == $lang ? 'bg-secondary' : '' }}" href="{{ route('changelang',$ke) }}">{{ $lang }}</a></li>
                                    @endforeach
                                @endif
                            </ul>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
