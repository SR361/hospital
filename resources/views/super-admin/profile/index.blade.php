@extends('super-admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2> {{$page}}</h2>
                {{-- <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul> --}}
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Setting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form id="demo-form2" class="profile-form" data-parsley-validate class="form-horizontal form-label-left"
                            action="{{ route('profile.update',[$profile->id]) }}"
                            redirecturl="{{ route('profile.index') }}"
                            method="post"
                            >
                            @csrf
                            @method('PATCH')
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="name" required="required" class="form-control" value="{{$profile->name}}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Email</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="email" name="email" required="required" class="form-control" disabled value="{{$profile->email}}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Image</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" name="image" class="form-control-file images-input">
                                    {{-- <img id="blah" src="#" alt="your image" class="images-input w-50 mt-2 " style="display: none;"/> --}}
                                    <img id="blah" src="{{ $profile->image }}" alt="your image" class=" w-50 mt-2 " />
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form id="demo-form2" class="change-password" data-parsley-validate class="form-horizontal form-label-left"
                            action="{{ route('profile.change.password') }}"
                            redirecturl="{{ route('profile.index') }}"
                            method="post"
                            >
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Current Password</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="password" name="current_password" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">New Password</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="password" name="new_password" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Confirm Password</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="password" name="new_confirm_password" required="required" class="form-control">
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
        $('.profile-form').submit(function(e) {
            e.preventDefault();
            var frm = $(".profile-form");
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

        $('.change-password').submit(function(e) {
            e.preventDefault();
            var frm = $(".change-password");
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
                    }else{
                        Swal.fire({
                            toast : true,
                            position: 'bottom-end',
                            icon: 'warning',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 9000
                        })
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
    </script>
@endpush
