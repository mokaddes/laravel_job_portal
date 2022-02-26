@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('orders.index', 'active')
@section('content')
<div class="jobs_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
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
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <form action="{{ route('orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                             <div class="card">
                                <div class="card-header">
                                    <h5>orders</h5>
                                </div>
                                <div class="card-body">
                                    @if ($m = Session::get('success'))
                                        <div class="alert alert-success">
                                            <span> {{ $m }} </span>
                                        </div>
                                    @endif
                                    {{-- @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif --}}
                                    <div class="form-group">
                                        <label>Company</label>
                                        <select class="form-control" name="company">
                                            <option value=" {{ $order->company }} ">{{ $order->company }}</option>
                                            @foreach ($industry as $company)
                                                <option value=" {{ $company->org_name }} ">{{ $company->org_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company'))
                                            <p class="text text-danger p-1">
                                                {{ $errors->first('company') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Street</label>
                                        <input type="text" name="street" class="form-control" value=" {{ $order->street }} ">
                                    </div>
                                    <div class="form-group">
                                        <label>houseNumber</label>
                                        <input type="text" name="house_no" class="form-control" value=" {{ $order->house_no }} ">
                                    </div>
                                    <div class="form-group">
                                        <label>Postalcode</label>
                                        <input type="text" name="postal_code" class="form-control" value=" {{ $order->postal_code }} ">
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" value=" {{ $order->city }} ">
                                    </div>
                                    <div class="form-group">
                                        <label>Region</label>
                                        <input type="text" name="region" class="form-control" value=" {{ $order->region }} ">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control" name="country">
                                            <option value=" {{ $order->country }} ">{{ $order->country }}</option>
                                            @foreach ($countries as $country)
                                                <option value=" {{ $country->country_name }} ">{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country'))
                                            <p class="text text-danger p-1">
                                                {{ $errors->first('country') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Value added tax ID</label>
                                        <input type="text" name="tax_id" class="form-control" value=" {{ $order->tax_id }} ">
                                    </div>
                                    <div class="form-group">
                                        <label>Salutation</label>
                                        <select class="form-control" name="salutation">
                                            <option>{{ $order->salutation }}</option>
                                            <option>Mister</option>
                                            <option>Mrs</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_persion" class="form-control" value=" {{ $order->contact_persion }} ">
                                        @if ($errors->has('contact_persion'))
                                            <p class="text text-danger p-1">
                                                {{ $errors->first('contact_persion') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control" value=" {{ $order->email }} ">
                                        @if ($errors->has('email'))
                                            <p class="text text-danger p-1">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Save on computer</button>
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
</div>
@endsection
