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
                            <li class="breadcrumb-item active">Edit Category</li>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-md-10 container-fluid" style="margin-top:20px">
                            <form action=" {{route('jobcategories.update', $jobcategory->pk_no)}} " method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="form-layout mg-t-25">
                                      <div class="row mg-b-25">
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">Category Name: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" value=" {{ $jobcategory->name }} ">
                                          </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">Category Code: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="code"  value=" {{ $jobcategory->code }} ">
                                          </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                          <div class="form-group">
                                            <label class="form-control-label">URL Slug: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="url_slug"  value=" {{ $jobcategory->url_slug }} ">
                                          </div>
                                        </div><!-- col-4 -->

                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Order ID <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="text" name="order_id"  value=" {{ $jobcategory->order_id }} ">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Total Post: <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="text" name="total_post"  value=" {{ $jobcategory->total_post }} ">
                                            </div>
                                        </div><!-- col-4 -->

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                              <label class="form-control-label">Active Post: <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="active_post" name="active_post" value=" {{ $jobcategory->active_post }} ">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">SEO Description: <span class="tx-danger">*</span></label>
                                              <input class="form-control" type="text" name="seo_des"  value=" {{ $jobcategory->seo_des }} ">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                              <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                                              <textarea class="form-control" name="description" id="summernote" >{{ $jobcategory->description }}</textarea>
                                            </div>
                                          </div><!-- col-4 -->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                              <label class="form-control-label">Comments: <span class="tx-danger">*</span></label>
                                              <textarea class="form-control" name="comments" id="summernote" >{{ $jobcategory->comments }}</textarea>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                                    <input type="file" name="logo" onchange="readURL(this);">
                                                    <img class="d-none" src="#" id="one">
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
                                                <input type="checkbox" value="1" name="is_top"
                                                @if ($jobcategory->is_top == 1)
                                                    {{ "checked" }}
                                                @endif
                                                >
                                                <span>Is Top?</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="ckbox">
                                                <input type="checkbox" value="1" name="is_new"
                                                @if ($jobcategory->is_new == 1)
                                                    {{ "checked" }}
                                                @endif >
                                                <span>Is New?</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="ckbox">
                                                <input type="checkbox" value="1" name="is_feature"
                                                @if ($jobcategory->is_feature == 1)
                                                    {{ "checked" }}
                                                @endif >
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
