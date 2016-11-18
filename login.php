<?php 
	include('config/config.php');
	include('config/functions.php');
	include('data/login.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--shortcut icon-->
  <link rel="shortcut icon" type="image/ico" href="dist/img/ico.jpg">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/uais.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<!--error sms -->
	<div class="row">
		<div class="col-md-3"></div>
<?php 
if((isset($_GET['response']) && !empty($_GET['response'])) || !empty($error)){
	if($_GET['response'] == 'success'){
		echo '<div class="col-md-6">
					<div class="alert alert-success alert-dismissible a_remove">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> SUCCESSFULLY !</h4>
						You have registered successfull. You may login now
					</div>
				</div>';
	}
	if($_GET['response'] == 'registered'){
		echo '<div class="col-md-6">
					<div class="alert alert-info alert-dismissible a_remove">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-info"></i> INFORMATION !</h4>
						You are already registered. You may login now
					</div>
				</div>';
	}
	if($error == 'invalid'){
		echo '<div class="col-md-6">
					<div class="alert alert-danger alert-dismissible a_remove">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
						Invalid Username or Password
					</div>
				</div>';
	}
}
?>
	</div>
	<!--end error-->
<div class="login-box">
  <div class="login-logo">
    <b>UAIS</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form method="post">
      <div class="form-group has-feedback a_uname_error">
        <input type="text" class="form-control i_uname" name="uname" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		<span class="help-block uname_error"></span>
      </div>
      <div class="form-group has-feedback a_pwd_error">
        <input type="password" class="form-control i_pwd" name="pwd" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		<span class="help-block pwd_error"></span>
      </div>
	  <div class="form-group has-feedback">
		<div class="col-xs-8">
			<a href="recover.php">I forgot my password</a><br>
			<a href="register.php" class="text-center">A new Student/Lecturer</a>
		</div>
	  </div>
      <div class="row">
		<div class="col-xs-4"></div>
        <div class="col-xs-4">
          <button type="submit" name="sign_in" class="btn btn-primary btn_sign_in">Sign In</button>
        </div>
		<div class="col-xs-4"></div>
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!--front-end validation-->
<script src="dist/js/loginValidation.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
