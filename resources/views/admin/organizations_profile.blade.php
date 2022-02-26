@extends('layouts.admin.app_admin')
@section('content')
<div class="organizations_profile_page">
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Organizations Profile</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Organizations Profile</li>
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
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Organizations Profile</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Organization</th>
                                            <th>City</th>
                                            <th>Street</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>
                                                <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="image" style="margin-right:5px;">
                                                <a href="#">Mr. YAWIK Administrator Frankfurt am Main</a>
                                            </td>
                                            <td>87456 München</td>
                                            <td>Musterstraße 15</td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>
                                                <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="image" style="margin-right:5px;">
                                                <a href="#">Mr. YAWIK Administrator Frankfurt am Main</a>
                                            </td>
                                            <td>87456 München</td>
                                            <td>Musterstraße 15</td>
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
    <!-- /.content-wrapper -->
</div>
@endsection
