@extends('super-admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-1">
                        <h2>{{$page}}</h2>
                    </div>
                    <div class="col-md-11 d-flex justify-content-center">
                        <ul class="nav navbar-right panel_toolbox mr-5">
                            <select name="" class="form-control mr-5">
                                <option value="">Select Learning Specialty</option>
                                @foreach($learning as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="units-datatable" class="table table-striped table-bordered bulk_action" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Units</th>
                                    <th>Capacity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 1 @endphp
                                @foreach($traineecapacity as $row)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <td>{{$row->units->name}}</td>
                                        <td><input type="number" value="{{$row->capcaity}}"></td>
                                    </tr>
                                    @php $index++ @endphp
                                @endforeach
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
