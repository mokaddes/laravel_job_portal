@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('jobcategories.index', 'active')

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
                            <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item"><a href=" {{ route('jobcategories.index') }} ">Job Category</a></li>
                            <li class="breadcrumb-item active">New Category</li>
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
                        <div class="float-left btn btn-success">Add New Job Category</div>
                        <div class="float-right">
                            <a href=" {{ route('jobcategories.index') }} " class=" btn btn-success">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <span> {{$message}} </span>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="col-md-10 container-fluid" style="margin-top:20px">
                            <form action=" {{route('jobcategories.store')}} " method="post" enctype="multipart/form-data">
                                @csrf

                                    <div class="form-layout mg-t-25">
                                      <div class="row mg-b-25">
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">Category Name: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" placeholder="Enter Category Name">
                                          </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">Category Code: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="code"  placeholder="Enter Category Code">
                                          </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">URL Slug: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="url_slug"  placeholder="Enter Slug">
                                          </div>
                                        </div><!-- col-4 -->

                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Order ID <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="text" name="order_id"  placeholder="Enter Odrer ID">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Total Post: <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="text" name="total_post"  placeholder="Enter total post no">
                                            </div>
                                        </div><!-- col-4 -->

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                              <label class="form-control-label">Active Post: <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="active_post" name="active_post" placeholder="Enter active post no">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">SEO Description: <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="text" name="seo_des"  placeholder="Enter SEO Description">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                                              <textarea class="form-control" name="description" id="summernote" placeholder="Enter Category Descriptions"></textarea>
                                            </div>
                                          </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                              <label class="form-control-label">Comments: <span class="tx-danger">*</span></label>
                                              <textarea class="form-control" name="comments" id="summernote" placeholder="Enter Comments"></textarea>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                                    <label for="" class="control-label">
                                                    <input type="file" name="logo" onchange="readURL(this);">
                                                    <img class="d-none" src="#" id="one">
                                                    </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Icon: <span class="tx-danger">*</span></label>
                                                    <input type="file" name="icon" onchange="readURL2(this);">
                                                    <img class="d-none" src="#"  id="two">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Banner: <span class="tx-danger">*</span></label>
                                                <input type="file" name="banner" onchange="readURL3(this);">
                                                <img class="d-none" src="#"  id="three">
                                            </div>
                                        </div>
                                      </div><!-- row -->
                                      <hr>
                                      <br><br>
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label class="ckbox">
                                                <input type="checkbox" value="1" name="is_top">
                                                <span>Is Top?</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="ckbox">
                                                <input type="checkbox" value="1" name="is_new">
                                                <span>Is New?</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="ckbox">
                                                <input type="checkbox" value="1" name="is_feature">
                                                <span>Is Feature?</span>
                                            </label>
                                        </div>
                                      </div>
                                      <br>
                                      <br>
                                      <div class="form-layout-footer">
                                        <button class="btn btn-info mg-r-5">Submit Form</button>
                                        <button class="btn btn-secondary">Cancel</button>
                                      </div><!-- form-layout-footer -->
                                    </div><!-- form-layout -->
                                </div><!-- card -->
                            </form>
                        </div>
                      </div><!-- sl-pagebody -->


                </div>
            </div>
            <!-- /.container-fluid -->
        </div>


    </div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
<script type="text/javascript">
    function readURL(input){
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#one')
            .attr('src', e.target.result)
            .width(80)
            .height(80)
            .removeClass("d-none");
        };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script type="text/javascript">
    function readURL2(input){
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#two')
            .attr('src', e.target.result)
            .width(80)
            .height(80)
            .removeClass("d-none");
        };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script type="text/javascript">
    function readURL3(input){
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#three')
            .attr('src', e.target.result)
            .width(80)
            .height(80)
            .removeClass("d-none");
        };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
