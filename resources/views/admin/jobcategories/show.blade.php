@extends('layouts.admin.app_admin')
@section('content')
<div class="dashboard_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Job Category</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Job Category</li>
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
                        <div class="float-left btn btn-success">Edit Job Category</div>
                        <div class="float-right">
                            <a href=" {{ route('jobcategories.index') }} " class=" btn btn-success">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-10 container-fluid" style="margin-top:20px">
                                    <div class="form-layout mg-t-25">
                                      <div class="row mg-b-25">
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">Category Name:</label>
                                            <span>{{ $jobcategory->name }}</span>
                                          </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">Category Code: </label>
                                            <span>{{ $jobcategory->code }}</span>
                                          </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">URL Slug:</label>
                                            <span>{{ $jobcategory->url_slug }}</span>
                                          </div>
                                        </div><!-- col-4 -->

                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Order ID </label>
                                              <span>{{ $jobcategory->order_id }}</span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Total Post: </label>
                                              <span>{{ $jobcategory->total_post }}</span>
                                            </div>
                                        </div><!-- col-4 -->

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                              <label class="form-control-label">Active Post: </label>
                                              <span>{{ $jobcategory->active_post }}</span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">SEO Description: </label>
                                              <br>
                                              <span>{{ $jobcategory->seo_des }}</span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Description: </label>
                                              <br>
                                              <span>{{ $jobcategory->description }}</span>
                                            </div>
                                          </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                              <label class="form-control-label">Comments: </label>
                                              <br>
                                              <span>{{ $jobcategory->comments }}</span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Logo: </label>
                                                <br>
                                                <img width="80px" height="70px" class="" src=" {{ asset($jobcategory->logo) }} " id="one">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Icon: </label>
                                                <br>
                                                <img width="80px" height="70px" class="" src=" {{ asset($jobcategory->icon) }} " id="one">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Banner: </label>
                                                <br>
                                                <img width="80px" height="70px" class="" src=" {{ asset($jobcategory->banner) }} " id="one">
                                            </div>
                                        </div>
                                      </div><!-- row -->
                                      <hr>
                                      <br><br>
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label class="form-control-label">Is Top? </label>
                                                @if ($jobcategory->is_top == 1)
                                                    Active
                                                @else
                                                    Not Active
                                                @endif

                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-control-label">Is New? </label>
                                                @if ($jobcategory->is_new == 1)
                                                    Active
                                                @else
                                                    Not Active
                                                @endif
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-control-label">Is Feature? </label>
                                                @if ($jobcategory->is_feature == 1)
                                                    Active
                                                @else
                                                    Not Active
                                                @endif
                                        </div>
                                      </div>
                        </div>
                      </div><!-- sl-pagebody -->


                </div>
            </div>
            <!-- /.container-fluid -->
        </div>


    </div>
</div>
@endsection
