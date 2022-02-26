@extends('layouts.applicant.app_applicant')
@section('applicant.profile', 'active')
@section('content')
@push('header_script')
    <style>
        input[type="file"] {height: 45px;}
        .applicant_profile .btn-group {
            margin: 5px 7px;
        }
    </style>
@endpush
@php
    $socail = App\Models\SocailProfile::where('user_id',Auth::user()->id)->first();
@endphp
<div class="dashboard_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profile</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('applicant_dashboard') }}">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">@lang('web.profile')</li>
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header mb-2">
                                 <h5>basic data</h5>
                             </div>
                             <div class="card-body">
                                @if (isset($profile))
                                <form action=" {{ route('applicant.profile_update', $profile->id ?? '') }} " method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                     <div class="form-group">
                                         <label for="firstname">First Name</label>
                                         <input type="text" name="first_name" class="form-control" value=" {{ $profile->first_name ?? '' }} ">
                                         @error('first_name')
                                         <div class="text text-danger">{{ $message }}</div>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                         <label for="lastname">Last Name</label>
                                         <input type="text" name="last_name" class="form-control" value=" {{ $profile->last_name ?? '' }} ">
                                         @error('last_name')
                                         <div class="text text-danger">{{ $message }}</div>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                         <label for="username">User Name</label>
                                         <input type="text" name="username" class="form-control" value="{{ $profile->username ?? '' }}">
                                         @error('username')
                                         <div class="text text-danger">{{ $message }}</div>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                         <label for="email">Email</label>
                                         <input type="text" name="email" class="form-control" value="{{ $profile->email ?? '' }}" >
                                         @error('email')
                                         <div class="text text-danger">{{ $message }}</div>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                         <label for="profile">Profile Image</label>
                                         <input type="file" name="image" class="form-control">
                                     </div>
                                     <div class="form-group">
                                          <button type="submit" class="btn btn-info">Update</button>
                                     </div>
                                </form>
                                @else
                                    Create Your <a href=" {{ route('applicant.resume') }} ">resume</a> first .
                                @endif
                             </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="card applicant_profile">
                            <form action="#" method="post">
                                <div class="card-header mb-2">
                                    <h5>Social Profiles</h5>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-flat">Facebook</button>
                                        <button type="button" class="btn btn-secondary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                          <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modaldemo1" >Manage profile</a>
                                              {{-- <a class="dropdown-item" href="#" >Remove profile</a>
                                              <a class="dropdown-item" href="#"  >View profile data </a> --}}
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-flat">Twitter</button>
                                        <button type="button" class="btn btn-secondary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                          <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modaldemo2">Manage profile</a>
                                              {{-- <a class="dropdown-item" href="#">Remove profile</a>
                                              <a class="dropdown-item" href="#">View profile data </a> --}}
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-flat">Linkedin</button>
                                        <button type="button" class="btn btn-secondary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                          <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modaldemo3">Manage profile</a>
                                              {{-- <a class="dropdown-item" href="#">Remove profile</a>
                                              <a class="dropdown-item" href="#">View profile data </a> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>

            {{-- Add Fb Modal --}}
            <div id="modaldemo1" class="modal fade">
                <div class="modal-dialog" role="document">
                  <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                      <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Facebook Profile</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action=" {{ route('applicant.socail_add') }} " method="post">
                        <div class="modal-body pd-20">

                            @csrf
                            <input type="hidden" name="part" value="facebook">
                            <div class="form-group">
                                <label for="facebook" class="control-label">Facebook profile link</label>
                                <input type="text" name="facebook" id="facebook" class="form-control" value=" {{$socail->facebook ?? ''}} ">
                            </div>

                        </div><!-- modal-body -->
                        <div class="modal-footer">
                      <button type="submit" class="btn btn-info pd-x-20">Save Data</button>
                      <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                  </div>
                </div><!-- modal-dialog -->
              </div><!-- modal -->
          </div>
           {{-- Add Twitter Modal --}}
           <div id="modaldemo2" class="modal fade">
            <div class="modal-dialog" role="document">
              <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Twitter Profile</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action=" {{ route('applicant.socail_add') }} " method="post">
                    <div class="modal-body pd-20">

                        @csrf
                        <input type="hidden" name="part" value="twitter">
                        <div class="form-group">
                            <label for="twitter" class="control-label">Twitter profile link</label>
                            <input type="text" name="twitter" id="twitter" class="form-control" value=" {{$socail->twitter ?? ''}} ">
                        </div>

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                  <button type="submit" class="btn btn-info pd-x-20">Save Data</button>
                  <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div>
                </form>
              </div>
            </div><!-- modal-dialog -->
          </div><!-- modal -->
      </div>

                <div id="modaldemo3" class="modal fade">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content tx-size-sm">
                            <div class="modal-header pd-x-20">
                            <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Linkedin Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action=" {{ route('applicant.socail_add') }} " method="post">
                                <div class="modal-body pd-20">

                                    @csrf
                                    <input type="hidden" name="part" value="linkedin">
                                    <div class="form-group">
                                        <label for="linkedin" class="control-label">Linkedin profile link</label>
                                        <input type="text" name="linkedin" id="linkedin" class="form-control" value=" {{$socail->linkedin ?? ''}} ">
                                    </div>

                                </div><!-- modal-body -->
                                <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Save Data</button>
                            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- modal-dialog -->
                </div><!-- modal -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
@endsection
