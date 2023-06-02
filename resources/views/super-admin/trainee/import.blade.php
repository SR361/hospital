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
                    <div class="col-md-12">
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left import-form"
                            action="{{ route('super.admin.trainee.import.store') }}"
                            redirecturl="{{ route('trainee.index') }}"
                            method="post">
                            {{-- @csrf --}}
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Import</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" id="first-name" name="upload_csv" required="required" class="form-control-file">
                                    <a href="{{ asset('csv/template/trainee-template.csv') }}" class="text-danger">DOWNLOAD CSV FOR FORMAT</a>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $('.import-form').submit(function(e) {
            e.preventDefault();
            var frm = $(".import-form");
            var data = new FormData(this);
            var redirecturl = $(this).attr("redirecturl");

            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data : data,
                contentType: false,
                processData: false,
                dataType : 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                        setTimeout(function() {
                            location.href = redirecturl;
                        }, 3000);
                        //$('#division-datatable').DataTable().ajax.reload();
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
                        timer: 9000
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
                            timer: 9000
                        })
                    });
                    errorsHtml += '</div>';
                    $('.division-form-errors').html(errorsHtml);
                }
            });
        });
    </script>
@endpush
