
@extends('layouts.app')

@section('content')

@php
    $application = \DB::table('applications')->where('applicant_id', Auth::user()->id ?? '')->where('job_id', $data['job']->id)->first();
@endphp
  <div class="deatils_page">
    <div class="job-details mt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-last mb-3">
                    <div class="card">
                        <div class="job-summary card-header">
                            <h4>Job Summary</h4>
                        </div>
                        <div class="summary-list card-body">
                            <ul>
                                <li><strong>Published on:</strong> {{ format_date($data['job']->publish_date) }}</li>
                                <li><strong>Employment Status:</strong> {{ $data['job']->employment_type }}</li>
                                <li><strong>Experience:</strong> {{ $data['job']->experience_requirement ? $data['job']->experience_requirement . ' years' : 'N/A' }}</li>
                                <li><strong>Job Location:</strong> {{ $data['job']->location ?? '' }}</li>
                                <li><strong>Salary:</strong> {{ $data['job']->currency }} {{ number_format($data['job']->salary, 2) }} ({{ $data['job']->time_interval_unit }})</li>
                                <li><strong>Application Deadline:</strong> {{ format_date($data['job']->deadline) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-lg-first">
                    <div class="details-content card">
                        <div class="card-header">
                            <h4>{{ $data['job']->title }}</h4> <br/>
                            <span class="badge bg-danger">{{ $data['job']->company }}</span>
                            <h6 class="float-end">
                                <a href=" {{ route('search', ['organization' => $data['job']->company ] ) }} ">View all jobs of this Company</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{$message}}
                                </div>
                            @endif
                            <div class="details-article mt-3">
                                <h4>Job Context</h4>
                                <p>{!! $data['job']->context !!}</p>
                            </div>
                            <div class="details-article mt-3">
                                <h4>Job Responsibilities</h4>
                                <p>{!! $data['job']->responsiblities !!}</p>
                            </div>
                            <div class="details-article mt-3">
                                <h4>Employment Status</h4>
                                <ul>
                                    <li>{{ $data['job']->employment_type }}</li>
                                </ul>
                            </div>
                            <div class="details-article mt-3">
                                <h4>Workplace Status</h4>
                                <ul>
                                    <li>Work at office</li>
                                </ul>
                            </div>
                            <div class="details-article mt-3">
                                <h4>Educational Requirements</h4>
                                <ul>
                                    <li>Bachelor of Science (BSc)</li>
                                </ul>
                            </div>
                            <div class="details-article mt-3">
                                <h4>Salary</h4>
                                <ul>
                                    <li>{{ $data['job']->currency }} {{ number_format($data['job']->salary ?? 0, 2) }}</li>
                                </ul>
                            </div>
                            <div class="details-article mt-3">
                                <h4>Compensation & Other Benefits</h4>
                                <ul>
                                    <li>Salary Review: Yearly</li>
                                </ul>
                            </div>
                            <div class="apply_job text-center">
                                <h4>Read Before Apply</h4>
                                <ul>
                                    <li>1. Writing clean and modular codes</li>
                                    <li>2. Back-End development using Laravel.</li>
                                    <li>3. Front-End data handling using Jquery, Vue.js/ React.js.</li>
                                    <li>4. Understanding and performing database queries using Eloquent</li>
                                    <li>5. Debugging and resolving technical issues</li>
                                    <li>6. Collaborating with other developers and project managers to complete given tasks </li>
                                    <li>7. Adapting and learning new technologies adopted by the company from time to time</li>
                                </ul>
                                <h6><strong>You can also send your updated CV with an online portfolio to career.lazychat@gmail.com, Subject line- "Laravel Developer- Bdjobs”.</strong></h6>
                                <h5><strong>*Photograph</strong> must be enclosed with the resume.</h5>

                                    @if (Auth::user())
                                        @if ( Auth::user()->user_type == 2)
                                            @if (isset($application) )
                                                <div class="alert alert-success">
                                                    You are already Applied
                                                </div>
                                            @elseif ($data['job']->deadline < date('Y-m-d'))
                                                <div class="alert alert-warning">
                                                    Application time is over
                                                </div>
                                            @else
                                                <form action=" {{ route('apply') }} " method="post">
                                                    @csrf
                                                    <input type="hidden" name="job_id" value=" {{ $data['job']->id }} ">

                                                    <button type="submit" class="btn btn-success">Apply Online</button>
                                                </form>
                                            @endif
                                        @else
                                            {{-- <div class="alert alert-warning">
                                                You are not elligable to apply
                                            </div> --}}
                                        @endif
                                   @else
                                        <a href=" {{ route('login') }} " class="btn btn-success">Apply Online</a>
                                    @endif
                                <h6>Application Deadline : {{ format_date($data['job']->deadline) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
