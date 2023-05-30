@extends('super-admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$page}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <button class="btn btn-sm btn-success add-division-btn" >
                        <i class="fa fa-plus"></i> Add Division
                    </button>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="division-datatable" class="table table-striped table-bordered bulk_action" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SR no.</th>
                                        <th>Name</th>
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
<div class="modal fade addDivisionModal" id="" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add {{ $page }}</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left division-form" action="{{ route('divisions.store') }}" method="post">
                    @method('PATCH')
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Division</label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="name" class="form-control division-name-input">
                            <input type="hidden" name="id" class="division-id-input">
                            <div id="division-form-errors"></div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div> --}}
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        let editing = false;
        $('.add-division-btn').click(function(){
            $('.division-name-input').val('');
            $('#myModalLabel').text('Add '+"{{$page}}")
            var url = base_url+'/divisions';
            $('.division-form').attr('action',url);
            $('[name="_method"]').val('POST');
            $('.addDivisionModal').modal('show');
        })

        $(document).on("click",".division-edit-btn",function() {
            editing = true;
            var name = $(this).data('name');
            var divisionid = $(this).data('id');
            $('.division-name-input').val(name);
            $('.division-id-input').val(divisionid);
            $('#myModalLabel').text('Edit '+"{{$page}}")
            var url = base_url+'/divisions/'+divisionid;
            $('.division-form').attr('action',url);
            $('[name="_method"]').val('PATCH');
            $('.addDivisionModal').modal('show');
        });

        $('.division-form').submit(function(e) {
            e.preventDefault();
            var frm = $(".division-form");
            var url = frm.attr('action');
            var data = new FormData(this);

            $.ajax({
                type: frm.attr('method'),
                url: url,
                data : data,
                contentType: false,
                processData: false,
                dataType : 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success == true) {
                        $('.addDivisionModal').modal('hide');

                        Swal.fire({
                            toast : true,
                            position: 'bottom-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 4000
                        })
                        $('#division-datatable').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;

                    Swal.fire({
                        toast : true,
                        position: 'bottom-end',
                        icon: 'warning',
                        title: errors.message,
                        showConfirmButton: false,
                        timer: 4000
                    })

                    errorsHtml = '<div class="text-danger">';
                    $.each(errors.errors, function(k, v) {
                        errorsHtml += v + ', ';
                        Swal.fire({
                            toast : true,
                            position: 'bottom-end',
                            icon: 'warning',
                            title: v,
                            showConfirmButton: false,
                            timer: 4000
                        })
                    });
                    errorsHtml += '</div>';
                    $('.division-form-errors').html(errorsHtml);
                }
            });
        });
        // $('#division-datatable').DataTable();
        var table = $("#division-datatable").DataTable({
            "pagingType": "full_numbers",
            "processing": true,
            "serverSide": true,
            "order": [0, 'desc'],
            "ajax": {
                "url": base_url + "/divisions/datatable",
                "dataType": "json",
                "type": "POST",
                data: function(data) {
                    data._token = token;
                }
            },
            columnDefs: [{
                "targets": [1],
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
                            $('#division-datatable').DataTable().ajax.reload();
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
