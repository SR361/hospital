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
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left units-form"
                            action="{{ route('units.update',[$units->id]) }}"
                            redirecturl="{{ route('units.index') }}"
                            method="post">
                            @method('PATCH')
                            <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Division</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" name="division_id" tabindex="-1">
                                        <option value="">Select Division</option>
                                        @foreach($division as $row)
                                            <option @if($row->id == $units->division_id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input value="{{$units->name}}" type="text" id="first-name" name="name" required="required" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Short Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input value="{{$units->short_name}}" type="text" id="last-name" name="short_name" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">LS</label>
                                @php
                                    $ls = json_decode($units->ls);
                                    $ls = implode(',',$ls);
                                    $ls = explode(',',$ls);
                                @endphp
                                <div class="checkbox mt-2">
                                    <label>
                                        <input type="checkbox" name="ls[]" value="Medical" class="flat"
                                        @if(in_array('Medical',$ls)) checked @endif> Medical
                                    </label>
                                </div>
                                <div class="checkbox mt-2 ml-2">
                                    <label>
                                        <input type="checkbox" name="ls[]" value="Surgical" class="flat"
                                        @if(in_array('Surgical',$ls)) checked @endif> Surgical
                                    </label>
                                </div>
                                <div class="checkbox mt-2 ml-2">
                                    <label>
                                        <input type="checkbox" name="ls[]" value="Paediatric" class="flat"
                                        @if(in_array('Paediatric',$ls)) checked @endif> Paediatric
                                    </label>
                                </div>
                                <div class="checkbox mt-2 ml-2">
                                    <label>
                                        <input type="checkbox" name="ls[]" value="Critical Care" class="flat"
                                        @if(in_array('Critical Care',$ls)) checked @endif> Critical Care
                                    </label>
                                </div>
                                <div class="checkbox mt-2 ml-2">
                                    <label>
                                        <input type="checkbox" name="ls[]" value="Women Health" class="flat"
                                        @if(in_array('Women Health',$ls)) checked @endif> Women Health
                                    </label>
                                </div>
                                <div class="checkbox mt-2 ml-2">
                                    <label>
                                        <input type="checkbox" name="ls[]" value="Procedural" class="flat"
                                        @if(in_array('Procedural',$ls)) checked @endif> Procedural
                                    </label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
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
        $('.units-form').submit(function(e) {
            e.preventDefault();
            var frm = $(".units-form");
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
    </script>
@endpush
