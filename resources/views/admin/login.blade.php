<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hospital | Login</title>
        <!-- Bootstrap -->
        <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('admin/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- Animate.css -->
        <link href="{{ asset('admin/vendors/animate.css/animate.min.css') }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset('admin/build/css/custom.min.css')}}" rel="stylesheet">
    </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="{{ route('admin.login.post') }}">
                @csrf
                <h1>Login Form</h1>
                <div>
                    <input name="email" type="text" class="form-control" placeholder="Username" required="" />
                    <span style="color:red" class="help-block is-invalid">
                        @if(Session::has('emailError'))
                            {{Session::get('emailError')}}
                        @endif
                    </span>
                </div>
                <div>
                    <input name="password" type="password" class="form-control" placeholder="Password" required="" />
                    <span style="color:red" class="help-block is-invalid">
                        @if(Session::has('passwordError'))
                            {{Session::get('passwordError')}}
                        @endif
                    </span>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary submit" href="index.html">Log in</button>
                </div>
                <div class="clearfix"></div>
                {{-- <div class="separator">
                    <p class="change_link">New to site?
                        <a href="#signup" class="to_register"> Create Account </a>
                    </p>
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                    </div>
                </div> --}}
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                <h1>Create Account</h1>
                <div>
                    <input type="text" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                    <input type="email" class="form-control" placeholder="Email" required="" />
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                    <a class="btn btn-default submit" href="index.html">Submit</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">Already a member ?
                    <a href="#signin" class="to_register"> Log in </a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                    </div>
                </div>
                </form>
            </section>
        </div>
      </div>
    </div>
  </body>
</html>
