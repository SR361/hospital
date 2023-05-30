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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Medical</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Surgical</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Paediatric</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Critical Care</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Women Health</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Procedural</td>
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
