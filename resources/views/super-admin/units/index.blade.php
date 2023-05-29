@extends('super-admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$page}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('super.admin.units.create') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i> Add {{$page}}
                    </a>
                </ul>
                <div class="clearfix"></div>
            </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Short Name</th>
                                    <th>Division</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>61</td>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>
                                        <span class="btn btn-sm btn-success">Edit</span>
                                        <span class="btn btn-sm btn-danger">Delete</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>63</td>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>
                                        <span class="btn btn-sm btn-success">Edit</span>
                                        <span class="btn btn-sm btn-danger">Delete</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>66</td>
                                    <td>Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>
                                        <span class="btn btn-sm btn-success">Edit</span>
                                        <span class="btn btn-sm btn-danger">Delete</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>
                                        <span class="btn btn-sm btn-success">Edit</span>
                                        <span class="btn btn-sm btn-danger">Delete</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection
