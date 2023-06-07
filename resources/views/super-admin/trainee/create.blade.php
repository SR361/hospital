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
                        <form id="demo-form2" class="trainee-form" data-parsley-validate class="form-horizontal form-label-left"
                            action="{{ route('trainee.store') }}"
                            redirecturl="{{ route('trainee.index') }}"
                            method="post"
                            >
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="name" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Image</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" name="image" class="form-control-file images-input">
                                    <img id="blah" src="#" alt="your image" class="images-input w-50 mt-2 " style="display: none;"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                <div class="radio mt-2 mr-2">
                                    <label>
                                        <input type="radio" class="flat" name="gender" value="male"> Male
                                    </label>
                                </div>
                                <div class="radio mt-2">
                                    <label>
                                        <input type="radio" class="flat" name="gender" value="female"> Female
                                    </label>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Training Program</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" tabindex="-1" name="training_id">
                                        <option value="">Select Training</option>
                                        @foreach($training as $row)
                                            <option value="{{ $row->id}}"> {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Location</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="location" required="required" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Learning Specialty</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control learning-specialty-select" tabindex="-1" name="ls_id">
                                        <option value="">Select Learning Specialty</option>
                                        @foreach($learning as $row)
                                            <option value="{{ $row->id}}"> {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Units</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control units-select" name="units_id" tabindex="-1">
                                        <option value="">Select Units</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="item form-group">
                                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">University/college/institution</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control" type="text" name="university">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Start Date <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input name="start_date" id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                    <script>
                                        function timeFunctionLong(input) {
                                            setTimeout(function() {
                                                input.type = 'text';
                                            }, 60000);
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">End Date <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input name="end_date" id="enndate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'"
                                    onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                    <script>
                                        function timeFunctionLong(input) {
                                            setTimeout(function() {
                                                input.type = 'text';
                                            }, 60000);
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{URL::previous()}}" class="btn btn-primary">Back</a>
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
        $('.trainee-form').submit(function(e) {
            e.preventDefault();
            var frm = $(".trainee-form");
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                    $('#blah').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".images-input").change(function(){
            readURL(this);
        });

        // $('.learning-specialty-select').change(function(){
        //     var ls_id = $(this).val();

        //     $.ajax({
        //         url: "{{ route('super.admin.ls.units') }}",
        //         type: "POST",
        //         data: {
        //             _token: "{{ csrf_token() }}",
        //             ls_id: ls_id,
        //         },
        //         success: function(response) {
        //             if (response.success == true) {
        //                 $('.units-select').html(response.data);
        //             }
        //         }
        //     });
        // })
    </script>
@endpush
