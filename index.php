<?php 
	session_start();
	if(isset($_SESSION['align_username'])){
       
            header("Location: modules/dashboard/?node=1&currentitem=0"); 
            echo "<meta http-equiv='refresh' content='0; URL=modules/dashboard/?node=1&currentitem=0' />"; 
       
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CanCern | Log in</title>
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="assets/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="assets/plugins/iCheck/minimal/orange.css">
    </head>
    <body class="hold-transition login-page" style="background-image: url('assets/img/align_ai.jpg');background-size: cover;background-repeat: no-repeat;    overflow-y: hidden;">
        <div class="login-box">
            <div class="login-logo">
                <h2 style="color: white;"><b>CanCern | Log in</b></h2>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="config/useridentity.php" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" name="txtUserName" class="form-control">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="txtPassword" type="password" class="form-control">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                </br> 
                <p style="font-size:14px;color:red;text-align:center;"><?php 
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
				</p>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="assets/plugins/iCheck/icheck.min.js"></script>
        <script>
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_minimal-orange',
              radioClass: 'iradio_minimal-orange',
              increaseArea: '0%' // optional
            });
          });
        </script>
    </body>
</html>