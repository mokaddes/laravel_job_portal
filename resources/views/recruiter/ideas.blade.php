@extends('layouts.applicant.app_applicant')
@section('content')
<div class="ideas_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">ideas</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">ideas</li>
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
                                    <h3 class="card-title">General Settings</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <div class="form-group">
                                        <label>choose your language</label>
                                        <select class="form-control">
                                                <option style="display:none;">Select language</option>
                                                <option>English</option>
                                                <option>French</option>
                                                <option>German</option>
                                                <option>Italian</option>
                                                <option>Polish</option>
                                                <option>Russian</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose your time zone</label>
                                        <select class="form-control">
                                                <option style="display:none;">Select time zone</option>
                                                <option>Anadyr Time	</option>
                                                <option>Aqtobe Time	</option>
                                                <option>Argentina Time	</option>
                                                <option>Arabia Standard Time</option>
                                                <option>Atlantic Time</option>
                                                <option>Azores Time</option>
                                                <option>Bravo Time Zone</option>
                                            </select>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Save on computer</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Email notifications</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label>Receive email notifications</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="email">
                                                <label class="form-check-label" for="email">if selected, you will be informed by e-mail about new applications. </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>mail body</label>
                                            <textarea name="" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Automatically send confirmation of receipt</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="confirmation">
                                                <label class="form-check-label" for="confirmation">if selected, you will be informed by e-mail about new applications. </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Text of the confirmation email</label>
                                            <textarea name="" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Text of the invitation email</label>
                                            <textarea name="" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Mail text for accept</label>
                                            <textarea name="" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Body of the rejection email</label>
                                            <textarea name="" class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>send all mails in copy (BCC) to my e-mail address</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="email-ads">
                                                <label class="form-check-label" for="email-ads">Click to get a copy of all emails.</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center mb-3">
                                        <h4>Customize application form</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5 class="text-center mb-3"><strong>Facts</strong></h5>
                                            <div class="form-group">
                                                <label>Should the candidate provide information about his willingness to travel?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="facts">
                                                    <label class="form-check-label" for="facts">Traveling</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Should the candidate name his earliest possible starting date?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="eariest">
                                                    <label class="form-check-label" for="eariest">Earliest starting date</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Ask the applicant to state their salary expectations.</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="salary">
                                                    <label class="form-check-label" for="salary">salary expectations</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Ask the applicant for a driver's license.</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="driving">
                                                    <label class="form-check-label" for="driving">driving licence</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="text-center mb-3"><strong>Social Profiles</strong></h5>
                                            <div class="form-group">
                                                <label>Allow users to attach their Facebook profile.</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="fb">
                                                    <label class="form-check-label" for="fb">Facebook</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Allow users to attach their Xing profile.</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="xing">
                                                    <label class="form-check-label" for="xing">Xing</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Allow users to attach their LinkedIn profile.</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="lin">
                                                    <label class="form-check-label" for="lin">LinkedIn</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Save on computer</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">orders
                                        <br/><span>bill address</span></h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <div class="form-group">
                                        <label>company name</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Street</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>houseNumber</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Postal code</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>location</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>region</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>country</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>VAT ID</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>salutation</label>
                                        <select class="form-control">
                                            <option>Mister</option>
                                            <option>Mrs</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>contact person</label>
                                        <input type="number" name="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail address</label>
                                        <input type="text" name="" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Save on computer</button>
                                    </div>
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
