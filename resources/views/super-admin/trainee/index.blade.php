@extends('super-admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$page}}</h2>
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
                                        <th>Gender</th>
                                        <th>Training Program</th>
                                        <th>University/collage/institution</th>
                                        <th>Start Date And End Date</th>
                                        <th>Duration or Training</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Tiger Nixon</td>
                                        <td>Male</td>
                                        <td>Internship</td>
                                        <td>King Saud University</td>
                                        <td>1 Jun 2022 / 1 Jan 2023</td>
                                        <td>52 Weeks</td>
                                        <td>
                                            <span class="btn btn-sm btn-success">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Garrett Winters</td>
                                        <td>Female</td>
                                        <td>Internship</td>
                                        <td>Princess Nourah University</td>
                                        <td>1 Jun 2022 / 1 Jan 2023</td>
                                        <td>52 Weeks</td>
                                        <td>
                                            <span class="btn btn-sm btn-success">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Ashton Cox</td>
                                        <td>Female</td>
                                        <td>Internship</td>
                                        <td>Military Hospital</td>
                                        <td>2 Feb 2022 / 31 Jan 2023</td>
                                        <td>2 Years</td>
                                        <td>
                                            <span class="btn btn-sm btn-success">Edit</span>
                                            <span class="btn btn-sm btn-danger">Delete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Cedric Kelly</td>
                                        <td>Male</td>
                                        <td>Internship</td>
                                        <td>King Saud University</td>
                                        <td>1 Jun 2022 / 1 Jan 2023</td>
                                        <td>52 Weeks</td>
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
