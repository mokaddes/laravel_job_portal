@extends('layouts.recruiter.app_recruiter')
@section('content')
<div class="companies_profile_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">company profile</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">company profile</li>
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
                <form action="#" method="post" class="mb-4">
                    <div class="row">
                        <div class="col-7 col-md-5">
                            <input type="text" name="" class="form-control" placeholder="search query">
                        </div>
                        <div class="col-5 col-md-7">
                            <button type="submit" class="btn btn-success">Seek</button>
                            <button type="submit" class="btn btn-primary">Clear Filters</button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>company</th>
                                            <th>Location</th>
                                            <th>Street</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>IDE <br/> Switching Company by <a href="#">CROSS Solution</a>
                                            </td>
                                            <td>41063 Moenchengladbach </td>
                                            <td>Eclipse 6</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <ul class="pagination pagination m-0 float-right">
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
@endsection
