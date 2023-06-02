@extends('super-admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                {{-- <h2>{{$page}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('units.create') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i> Add {{$page}}
                    </a>
                </ul> --}}
                <div class="row">
                    <div class="col-md-1">
                        <h2>{{$page}}</h2>
                    </div>
                    <div class="col-md-9 d-flex justify-content-center">
                        <ul class="nav navbar-right panel_toolbox mr-5">
                            <select name="" class="form-control mr-5 ls_id">
                                <option value="">Select Learning Specialty</option>
                                @foreach($learning as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </ul>
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <a href="{{ route('units.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> Add {{$page}}
                        </a>
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
                                    <th>Division</th>
                                    <th>Name</th>
                                    <th>Short Name</th>
                                    <th>LS</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
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
@push('script')
    <script>
        let ls_id = $('.ls_id').val();
        datatable();

        $('.ls_id').change(function(){
            ls_id = $('.ls_id').val();
            $('#units-datatable').DataTable().ajax.reload();
        })

        function datatable(){
            var table = $("#units-datatable").DataTable({
                "pagingType": "full_numbers",
                "processing": true,
                "serverSide": true,
                "order": [2, 'desc'],
                "ajax": {
                    "url": base_url + "/units/datatable",
                    "dataType": "json",
                    "type": "POST",
                    data: function(data) {
                        data.ls_id = ls_id;
                        data._token = token;
                    }
                },
                columnDefs: [{
                    "targets": [0,1,4,6],
                    "orderable": false
                }]
            });
        }

        function confirmDeletion(url){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {"_token": token},
                        success: function(data) {
                            $('#units-datatable').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            )
                            table.ajax.reload();
                        }
                    });
                }
            })
        }
    </script>
@endpush
