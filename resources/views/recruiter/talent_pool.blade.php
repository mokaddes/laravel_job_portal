@extends('layouts.recruiter.app_recruiter')

@section('recruiter.talent_pool', 'active')


@section('content')
<div class="lent_pool_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Overview of all CVs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Overview of all CVs</li>
                        </ol>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" name="" class="form-control" placeholder="Search query">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="form-group">
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="3">Location</option>
                                <option data-select2-id="34">Alaska</option>
                                <option data-select2-id="35">California</option>
                                <option data-select2-id="36">Delaware</option>
                                <option data-select2-id="37">Tennessee</option>
                                <option data-select2-id="38">Texas</option>
                                <option data-select2-id="39">Washington</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="form-group">
                            <select class="form-control">
                                <option>5 km</option>
                                <option>10 km</option>
                                <option>15 km</option>
                                <option>20 km</option>
                                <option>25 km</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-2">
                        <button class="btn btn-primary">Seek</button>
                        <button class="btn btn-outline-dark">Clear Filters</button>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Surname</th>
                                            <th>Career</th>
                                            <th>desired position</th>
                                            <th>Preferred Job Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Fikri Farhan</td>
                                            <td>
                                                Education: 3.5 years
                                                <br/> Professional experience: 3.8 years
                                            </td>
                                            <td>Front End Developer</td>
                                            <td>Frankfurt am Main</td>
                                            <td>
                                                <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fikri Farhan</td>
                                            <td>
                                                Education: 3.5 years
                                                <br/> Professional experience: 3.8 years
                                            </td>
                                            <td>Front End Developer</td>
                                            <td>Frankfurt am Main</td>
                                            <td>
                                                <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fikri Farhan</td>
                                            <td>
                                                Education: 3.5 years
                                                <br/> Professional experience: 3.8 years
                                            </td>
                                            <td>Front End Developer</td>
                                            <td>Frankfurt am Main</td>
                                            <td>
                                                <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
</div>
@endsection
