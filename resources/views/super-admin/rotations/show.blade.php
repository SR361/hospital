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
                </div>
                <div class="clearfix"></div>
            </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="rotation-datatable" class="table table-striped table-bordered bulk_action" style="width:100%">
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
        $('#rotation-datatable').DataTable();
        // let rotation_id = $('.rotation-select-input').val();

        // datatable();
        // $('.rotation-select-input').change(function(){
        //     ls_id = $('.ls_id').val();
        //     $('#ls-datatable').DataTable().ajax.reload();
        // })

        // function datatable(){
        //     var table = $("#ls-datatable").DataTable({
        //         "pagingType": "full_numbers",
        //         "processing": true,
        //         "serverSide": true,
        //         "order": [1, 'desc'],
        //         "ajax": {
        //             "url": base_url + "/rotation/datatable",
        //             "dataType": "json",
        //             "type": "POST",
        //             data: function(data) {
        //                 data.rotation_id = rotation_id;
        //                 data._token = token;
        //             }
        //         },
        //         columnDefs: [{
        //             "targets": [0,2,3],
        //             "orderable": false
        //         }]
        //     });
        // }


    </script>
@endpush
