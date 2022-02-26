@extends('layouts.applicant.app_applicant')
@section('content')
<div class="resume_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Resume</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Resume</li>
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
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Basic Data</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" name="firstname" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" name="lastname" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="lastname" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <input type="file" name="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Employment history</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Beginning:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>End:</label>
                                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2">
                                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>company name</label>
                                        <input type="text" name="lastname" class="form-control">
                                    </div>
                                    <div class="from-group">
                                        <label>description</label>
                                        <textarea name="" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Desired Employment</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group" data-select2-id="53">
                                        <label>Desired type of employment</label>
                                        <select class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                                  <option>Temporary work</option>
                                                  <option>Permanent employment</option>
                                                  <option>Project work</option>
                                                  <option>Free collaboration</option>
                                                  <option>Internship</option>
                                                  <option>Texas</option>
                                                  <option>Washington</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Desired position</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Preferred Job Location</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Traveling</label>
                                        <select class="form-control">
                                                <option style="display:none;">Select Traveling</option>
                                                <option>Yes</option>
                                                <option>Conditional</option>
                                                <option>No</option>
                                              </select>
                                    </div>
                                    <div class="form-group">
                                        <label>salary expectations</label>
                                        <input type="number" name="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Education history</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Beginning:</label>
                                        <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate3">
                                            <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>End:</label>
                                        <div class="input-group date" id="reservationdate4" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate4">
                                            <div class="input-group-append" data-target="#reservationdate4" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Discharge note</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Company name</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="from-group">
                                        <label>description</label>
                                        <textarea name="" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Native language</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group" data-select2-id="55">
                                        <label>Language</label>
                                        <select class="select3 select2-hidden-accessible" multiple="" data-placeholder="Select Language" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option>English</option>
                                                <option>Hinde</option>
                                                <option>Afrikaans</option>
                                                <option>Arabisch</option>
                                                <option>Bulgarisch</option>
                                                <option>Irisch</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Additional Language Skills</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Language</label>
                                        <select class="form-control">
                                            <option style="display:none;">Select Language</option>
                                            <option>English</option>
                                            <option>Hinde</option>
                                            <option>Afrikaans</option>
                                            <option>Arabisch</option>
                                            <option>Bulgarisch</option>
                                            <option>Irisch</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Understand</label>
                                        <select class="form-control">
                                            <option>I can understand familiar words and very basic phrases related to myself, my family or concrete things around me when people speak slowly and clearly.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>To speak</label>
                                        <select class="form-control">
                                            <option>I can understand familiar words and very basic phrases related to myself, my family or concrete things around me when people speak slowly and clearly.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Participate in conversations</label>
                                        <select class="form-control">
                                            <option>I can understand familiar words and very basic phrases related to myself, my family or concrete things around me when people speak slowly and clearly.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Coherent speaking</label>
                                        <select class="form-control">
                                            <option>I can understand familiar words and very basic phrases related to myself, my family or concrete things around me when people speak slowly and clearly.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>To write</label>
                                        <select class="form-control">
                                            <option>I can understand familiar words and very basic phrases related to myself, my family or concrete things around me when people speak slowly and clearly.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Investments</h5>
                                </div>
                                <div class="card-body">
                                    <input type="file" name="" class="form-control">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-danger">Save on computer</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.row -->
            </form>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@endsection
