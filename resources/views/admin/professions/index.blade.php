@extends('layouts.admin.app_admin')
@section('admin.web_settings', 'menu-is-opening menu-open')
@section('profession.index', 'active')
@section('content')
<div class="dashboard_page">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Professions</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{ route('admin_dashboard') }} ">@lang('web.home')</a></li>
                            <li class="breadcrumb-item active">Professions</li>
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
                        <div class="float-left btn btn-primary">Professions List</div>
                        <div class="float-right">
                            <a href="#" class=" btn btn-success" data-toggle="modal" data-target="#modaldemo3">Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <span> {{$message}} </span>
                            </div>
                        @endif
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap text-center">
                              <thead>
                                <tr>
                                  <th class="text-center">No</th>
                                  <th class="text-center">Professions Name</th>
                                  <th class="text-center">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($professions as $profession)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td> {{ $profession->name }} </td>
                                    <td>
                                        <form action="{{ route('professions.destroy', $profession->id) }}" method="POST" id="form">


                                            <a class="btn btn-primary" href="{{ route('professions.edit', $profession->id) }}">Edit</a>

                                            @csrf
                                            @method('DELETE')

                                            <a href=" {{ URL::to('profession/delete/' .$profession->id) }} " class="btn btn-danger" id="delete">Delete</a>

                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                              </tbody>
                            </table>
                          </div><!-- table-wrapper -->

                        </div><!-- card -->
                      </div><!-- sl-pagebody -->

                      {{-- Add Modal --}}
                      <div id="modaldemo3" class="modal fade">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content tx-size-sm">
                              <div class="modal-header pd-x-20">
                                <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action=" {{ route('professions.store') }} " method="post">
                                  <div class="modal-body pd-20">

                                      @csrf
                                      <div class="form-group">
                                          <label for="name" class="control-label">Profession Name</label>
                                          <input type="text" name="name" id="name" class="form-control" placeholder="Add Name">
                                          @if ($errors->has('name'))
                                          <p class="text text-danger p-1">
                                              {{ $errors->first('name') }}
                                          </p>
                                      @endif
                                      </div>

                                  </div><!-- modal-body -->
                                  <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">Save Data</button>
                                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                                  </div>
                              </form>
                            </div>
                          </div><!-- modal-dialog -->
                        </div><!-- modal -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>


    </div>
</div>
@endsection
