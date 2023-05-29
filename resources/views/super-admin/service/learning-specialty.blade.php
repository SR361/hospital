@extends('super-admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$page}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <i class="fa fa-plus"></i> Add Learning Specialty
                    </button>
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
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Medical</td>
                                        <td>
                                            <span class="btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Surgical</td>
                                        <td>
                                            <span class="btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Paediatric</td>
                                        <td>
                                            <span class="btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Critical Care</td>
                                        <td>
                                            <span class="btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Women Health</td>
                                        <td>
                                            <span class="btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Procedural</td>
                                        <td>
                                            <span class="btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</span>
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add {{ $page }}</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name</label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="first-name" required="required" class="form-control ">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
