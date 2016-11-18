<?php 
	include('config/config.php');
	include('config/functions.php');
	include('data/register.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Registration</title>
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
<body class="hold-transition register-page">
<!--error sms -->
	<div class="row">
		<div class="col-md-3"></div>
<?php 
if(isset($_GET['response']) && !empty($_GET['response'])){
	if($_GET['response'] == 'fail'){
		echo '<div class="col-md-6">
					<div class="alert alert-danger alert-dismissible a_remove">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
						Sorry something went wrong, Please try again
					</div>
				</div>';
	}
	if($_GET['response'] == 'not_admitted'){
		echo '<div class="col-md-6">
					<div class="alert alert-danger alert-dismissible a_remove">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
						Sorry, You are not admitted. Please see admission officer
					</div>
				</div>';
	}
}
?>
	</div>
	<!--end error-->
<div class="register-box" style="margin-top:2%;">
  <div class="register-logo">
    <b>UAIS</b>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">User Registration</p>
    <form method="post">
      <div class="form-group has-feedback a_fname_error">
        <input type="text" class="form-control i_fname" name="fname" placeholder="First Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		<span class="help-block fname_error"></span>
      </div>
	  <div class="form-group has-feedback a_mname_error">
        <input type="text" class="form-control i_mname" name="mname" placeholder="Middle Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		<span class="help-block mname_error"></span>
      </div>
	  <div class="form-group has-feedback a_sname_error">
        <input type="text" class="form-control i_sname" name="sname" placeholder="Surname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		<span class="help-block sname_error"></span>
      </div>
	  <div class="form-group has-feedback a_phone_no_error">
        <input type="text" class="form-control i_phone_no" name="phone_no" placeholder="Phone Number">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
		<span class="help-block phone_no_error"></span>
      </div>
      <div class="form-group has-feedback a_email_error">
        <input type="email" class="form-control i_email" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		<span class="help-block email_error"></span>
      </div>
	  <div class="form-group">
		<label>
		  <input type="radio" name="gender" value="Male" class="minimal" checked>
		  Male
		</label>
		<label>
		  <input type="radio" name="gender" value="Female" class="minimal">
		  Female
		</label>
	  </div>
	  <div class="form-group has-feedback a_nationality_error">
        <input type="text" class="form-control i_nationality" name="nationality" placeholder="Nationality">
        <span class="glyphicon glyphicon-flag form-control-feedback"></span>
		<span class="help-block nationality_error"></span>
      </div>
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
      <div class="form-group has-feedback a_repwd_error">
        <input type="password" class="form-control i_repwd" name="repwd" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
		<span class="help-block repwd_error"></span>
      </div>
      <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-sm-offset-2 col-sm-6">
          <button type="submit" name="register" class="btn btn-primary btn_register">Register</button>
        </div>
      </div>
    </form>
    <a href="login.php" class="text-center">Login</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!--front-end validation-->
<script src="dist/js/registerValidation.js"></script>
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
