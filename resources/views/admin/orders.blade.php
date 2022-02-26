@extends('layouts.admin.app_admin')
@section('content')
<div class="orders_page">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">List of your orders</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">orders</li>
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
                                <input type="text" name="" class="form-control" placeholder="search address parts or order numbers">
                            </div>
                            <div class="col-5 col-md-7">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Products</th>
                                        <th>Invoice Address</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-toggle="modal" data-target="#modal-default">
                                        <td>3/29/16, 12:48 PM</td>
                                        <td>job <br/> 2016-1 </td>
                                        <td>
                                            <ul>
                                                <li>AWIK</li>
                                                <li>Your Homepage</li>
                                            </ul>
                                        </td>
                                        <td>adasd</td>
                                        <td>-€1.19</td>
                                    </tr>
                                    <tr data-toggle="modal" data-target="#modal-default">
                                        <td>3/29/16, 12:48 PM</td>
                                        <td>job <br/> 2016-1 </td>
                                        <td>
                                            <ul>
                                                <li>AWIK</li>
                                                <li>Your Homepage</li>
                                            </ul>
                                        </td>
                                        <td>adasd</td>
                                        <td>-€1.19</td>
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
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
</div>
@endsection
