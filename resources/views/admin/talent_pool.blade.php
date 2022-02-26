@extends('layouts.admin.app_admin')
@section('admin.talent_pool', 'active')
@section('content')
<div class="lent_pool_page">
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Talent Pool</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@lang('web.home')</a></li>
                                <li class="breadcrumb-item active">Talent Pool</li>
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Talent Pool</h5>
                                        </div>
                                        <div class="col-6">
                                            <div class="float-right">
                                                <a href="create-resume.html">
                                                    <button class="btn btn-danger">@lang('web.create_resume')</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" style="margin-bottom: 30px;">
                                        <div class="col-md-12">
                                            <form class="form-inline" action="/action_page.php">
                                                <div class="form-group">
                                                  <input type="text" class="form-control" id="text" placeholder="@lang('web.search')" name="custom_key" autocomplete="off" autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <select class="form-control" id="location" name="location">
                                                        <option value="Dhaka"> Dhaka</option>
                                                        <option value="Bhola"> Bhola</option>
                                                    </select>
                                                </div>
                                                 <div class="form-group">
                                                    <select class="form-control" id="distance" placeholder="Select distance" name="distance">
                                                        <option value="5">5 km</option>
                                                        <option value="10">10 km</option>
                                                        <option value="15">15 km</option>
                                                        <option value="20">20 km</option>
                                                        <option value="30">30 km</option>
                                                        <option value="40">40 40</option>
                                                    </select>
                                                  </div>

                                                <div class="form-group">
                                                    <button type="button" class="btn btn-default">@lang('web.clear')</button>
                                                    <button type="submit" class="btn btn-default">@lang('web.submit')</button>
                                                  </div>

                                              </form>
                                        </div>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>@lang('web.name')</th>
                                                <th>@lang('web.career')</th>
                                                <th>@lang('web.desired_work')</th>
                                                <th>@lang('web.desired_location')</th>
                                                <th>@lang('web.actions')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>Fikri Farhan</td>
                                                <td>education: 3.5 years work experience: 3.8 years</td>
                                                <td>Frontend Developer</td>
                                                <td>Frankfurt am Main</td>
                                                <td>
                                                    <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>02</td>
                                                <td>Fikri Farhan</td>
                                                <td>education: 3.5 years work experience: 3.8 years</td>
                                                <td>Frontend Developer</td>
                                                <td>Frankfurt am Main</td>
                                                <td>
                                                    <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>03</td>
                                                <td>Fikri Farhan</td>
                                                <td>education: 3.5 years work experience: 3.8 years</td>
                                                <td>Frontend Developer</td>
                                                <td>Frankfurt am Main</td>
                                                <td>
                                                    <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <ul class="pagination pagination float-right">
                                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
