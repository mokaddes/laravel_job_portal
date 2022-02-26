@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('industry.index', 'active')
@section('content')
<div class="dashboard_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Industry</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Industry</li>
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
                        <div class="float-left btn btn-success">Industry Edit</div>
                        <div class="float-right">
                            <a href=" {{ route('industry.index') }} " class=" btn btn-success">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <span> {{$message}} </span>
                            </div>
                        @endif
                        <div class="col-md-10 container-fluid" style="margin-top:20px">
                            <form action=" {{ route('industry.update', $industry->id) }} " method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name" class="control-label">prodession Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{$industry->name}}">
                                    @if ($errors->has('name'))
                                            <p class="text text-danger p-1">
                                                {{ $errors->first('name') }}
                                            </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success form-contol">Submit</button>
                                </div>
                            </form>
                        </div>
                      </div><!-- sl-pagebody -->


                </div>
            </div>
            <!-- /.container-fluid -->
        </div>


    </div>
</div>
@endsection
