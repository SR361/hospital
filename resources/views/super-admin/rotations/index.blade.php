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
                            <select name="" class="form-control mr-5 rotation-select-input">
                                {{-- <option value="">Select Rotation</option> --}}
                                <option value="1st-rotation">1st Rotation</option>
                                <option value="2nd-rotation">2nd Rotation</option>
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
                        <table id="ls-datatable" class="table table-striped table-bordered bulk_action" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Learning Specialty</th>
                                    <th>Capacity</th>
                                    <th>Group</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('script')
    <script>
        let rotation_id = $('.rotation-select-input').val();
        // let capacity = 0;
        // let capacityid = null;
        datatable();
        $('.rotation-select-input').change(function(){
            ls_id = $('.ls_id').val();
            $('#ls-datatable').DataTable().ajax.reload();
        })

        function datatable(){
            var table = $("#ls-datatable").DataTable({
                "pagingType": "full_numbers",
                "processing": true,
                "serverSide": true,
                "order": [1, 'desc'],
                "ajax": {
                    "url": base_url + "/rotation/datatable",
                    "dataType": "json",
                    "type": "POST",
                    data: function(data) {
                        data.rotation_id = rotation_id;
                        data._token = token;
                    }
                },
                columnDefs: [{
                    "targets": [0,2,3],
                    "orderable": false
                }]
            });
        }


    </script>
@endpush
