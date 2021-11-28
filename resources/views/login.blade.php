<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('login') }}"><b>Current Affairs</b> /Admin</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Log in to start your session</p>

                <form method="post" id="loginform">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> --}}
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>



    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

</body>

<script type="text/javascript">
    $(document).ready(function(){
      $('#loginform').submit(function(e) {
          e.preventDefault();
        //  start_loader();
        var isValid = true;
        if($('input[name="username"]').val().trim()==''){
           swal({
               title: "Notice",
               text: 'Username and Password is Required',
               type: "warning",
               showCancelButton: false,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "OK",
               cancelButtonText:false,
               closeOnConfirm: false,
               closeOnCancel: false,
                 dangerMode: true,
           });
          isValid = false;
        }
        if($('input[name="password"]').val().trim()==''){
          isValid = false;
          swal({
               title: "Notice",
               text: 'Username and Password is Required',
               type: "warning",
               showCancelButton: false,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "OK",
               cancelButtonText:false,
               closeOnConfirm: false,
               closeOnCancel: false,
                 dangerMode: true,
           });
        }
        if(isValid){
            $.ajax({
                url: "{{ url('/admin/checklogin') }}",
                type: "POST",
                data: $("#loginform").serialize(),
                success: function(data) {
                    // stop_loader();
                    if(data.status=='success'){

                        swal({
                               title: "Login Successfully",
                               text: "",
                               type: "success",
                               showCancelButton: false,
                               confirmButtonColor: "#DD6B55",
                               confirmButtonText: "Ok",
                               cancelButtonText:false,
                               closeOnConfirm: false,
                               closeOnCancel: false
                           });
                          setTimeout(() => {
                              window.location = data.redirect;
                          }, 500);
               }else if(data.status=='fail'){
                     $('input[name=username]').css('border','2px solid red');
                     $('input[name=password]').css('border','2px solid red');
                       swal({
                           title: "Notice",
                           text: data.msg,
                           type: "warning",
                           showCancelButton: false,
                           confirmButtonColor: "#DD6B55",
                           confirmButtonText: "Ok",
                           cancelButtonText:false,
                           closeOnConfirm: false,
                           closeOnCancel: false,
                             dangerMode: true,
                       });
              }else{
                       swal({
                           title: "Notice",
                           text: "Server Error",
                           type: "warning",
                           showCancelButton: false,
                           confirmButtonColor: "#DD6B55",
                           confirmButtonText: "Ok",
                           cancelButtonText:false,
                           closeOnConfirm: false,
                           closeOnCancel: false,
                             dangerMode: true,
                       });

              }


                },

            });
             return false;
        }
         // your code here
      });

  })
  </script>

</html>
