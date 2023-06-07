@extends('super-admin.layouts.app')
@section('content')
<style>
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
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
                            <select name="" class="form-control mr-5 ls_id">
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
                        <table id="capacity-datatable" class="table table-striped table-bordered bulk_action" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Units</th>
                                    <th>Capacity</th>
                                    <th>Option</th>
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
        let ls_id = $('.ls_id').val();
        let capacity = 0;
        let capacityid = null;
        datatable();
        $('.ls_id').change(function(){
            ls_id = $('.ls_id').val();
            $('#capacity-datatable').DataTable().ajax.reload();
        })

        function capacityupdate(capacity_id,e){
            capacity = e.value;
            capacityid = capacity_id;
            setTimeout(updateCapacity, 4000);
        }

        function updateCapacity(){
            $.ajax({
                url: "{{ route('unitscapacity.update',[1]) }}",
                type: "POST",
                data: {
                    _method : 'PATCH',
                    _token: "{{ csrf_token() }}",
                    capacity_id: capacityid,
                    capacity: capacity
                },
                success: function(response) {
                    if (response.success == true) {
                        Swal.fire({
                            toast : true,
                            position: 'bottom-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 4000
                        })
                    }
                }
            });

        }

        function datatable(){
            var table = $("#capacity-datatable").DataTable({
                "pagingType": "full_numbers",
                "processing": true,
                "serverSide": true,
                "order": [2, 'desc'],
                "ajax": {
                    "url": base_url + "/unitscapacity/datatable",
                    "dataType": "json",
                    "type": "POST",
                    data: function(data) {
                        data.ls_id = ls_id;
                        data._token = token;
                    }
                },
                columnDefs: [{
                    "targets": [0,1,3],
                    "orderable": false
                }]
            });
        }


    </script>
@endpush
