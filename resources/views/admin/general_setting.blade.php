@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('admin.general_settings', 'active')

@section('content')
<div class="organizations_insert_page">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">General Settings</li>
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
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">

                    <form action="{{ route('general-settings.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5>@lang('web.general_settings')</h5>
                            </div>
                            <div class="card-body">
                                @if ($m = Session::get('success'))
                                    <div class="alert alert-success">
                                        <span> {{ $m }} </span>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>@lang('web.site_name')</label>
                                    @if(isset($setting))
                                        <input type="text" name="site_name" class="form-control" value="{{$setting->site_name}}">
                                    @else
                                        <input type="text" name="site_name" value="{{ old('site_name') }}"  class="form-control">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('web.app_mode')</label>
                                    @if(isset($setting))
                                    <select name="app_mode" class="select2" style="width: 100%;">
                                        {{-- <option value="{{$setting->app_mode}}">{{$setting->app_mode}}</option> --}}
                                        <option value="Local" {{$setting->app_mode == 'Local'? 'selected': ''}}>Local</option>
                                        <option value="Live"  {{$setting->app_mode == 'Live'? 'selected': ''}}>Live</option>
                                    </select>
                                    @else
                                    <select name="app_mode" class="select2" style="width: 100%;">
                                        <option value="">@lang('web.select')</option>
                                        <option value="Local">@lang('web.local')</option>
                                        <option value="Live">@lang('web.live')</option>
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('web.language')</label>
                                    <select name="site_lang_id" class="select2" style="width: 100%;">
                                        <option value="">@lang('web.select')</option>
                                        @foreach ($languages as $lang)
                                        <option value="{{ $lang->id }}" {{ $global->lang_id == $lang->id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('web.time_zone')</label>
                                    <select name="time_zone_id" class="form-control">
                                        <option value="">@lang('web.select')</option>
                                        @foreach ($zones as $item)
                                        <option value="{{ $item->zone_id }}" {{ $global->zone_id == $item->zone_id ? 'selected' : '' }}>{{ $item->zone_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('web.site_logo')</label>
                                    <input type="file" name="site_logo" class="form-control">
                                    @if(isset($setting))
                                        <span class="badge badge-primary">@lang('web.old') @lang('web.image')</span>
                                        <img src="{{ URL::to($setting->site_logo) }}" alt="" width="80px" height="70px">
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">@lang('web.submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
@endsection
