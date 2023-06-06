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
                            <table id="trainee-datatable" class="table table-striped table-bordered bulk_action" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Training Program</th>
                                        <th>University/college/institution</th>
                                        <th>Start Date And End Date</th>
                                        <th>Duration or Training</th>
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
        var table = $("#trainee-datatable").DataTable({
            "pagingType": "full_numbers",
            "processing": true,
            "serverSide": true,
            "order": [1, 'desc'],
            "ajax": {
                "url": base_url + "/trainee/datatable",
                "dataType": "json",
                "type": "POST",
                data: function(data) {
                    data._token = token;
                }
            },
            columnDefs: [{
                "targets": [0,3,6,7],
                "orderable": false
            }]
        });
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
