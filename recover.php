<?php 
	include('config/config.php');
	include('config/functions.php');
	//include('data/recover.php');
        
        if(isset($_POST['recover'])){
		$uname = $_POST['uname'];
		$email = $_POST['email'];
		
		if(!empty($uname) && !empty($email)){
			$query = "SELECT `username`,`email` FROM `1948040_uais`.`users` WHERE `username`='".mysql_real_escape_string($uname)."' AND `email`='".mysql_real_escape_string($email)."'";
			$run = mysql_query($query);
			$num_rows = mysql_num_rows($run);
			
			if($num_rows == 0){
				$error = "invalid";
			}else if($num_rows == 1){
				$username = mysql_result($run,0,'username');
				$email_ = mysql_result($run,0,'email');
				
				//generate new pwd and notify user
				//changePassword($username,$email_);
                                
                                $generated_password = substr(md5(rand(999,99999)),0,9);
                                $hash_password = hashPassword($generated_password);
                                
                                
                                $query1 = "UPDATE `1948040_uais`.`users` SET `password`='".$hash_password."' WHERE `username`='".$username."' AND `email`='".$email_."'";
                                $query_run = mysql_query($query1);
                                
                                /*$m = mail($email_,'Password Reset','You are new Password is '.$generated_password.'','From:simonkijo@gmail.com');
                                if($m){
                                    $success = 'success';    
                                }else{
                                        echo 'Email not sent';
                                }*/
                                
                                //SMTP needs accurate times, and the PHP time zone MUST be set
                                //This should be done in your php.ini, but this is how to do it if you don't have access to that
                                date_default_timezone_set('Etc/UTC');
                                
                                require 'PHPMailer/PHPMailerAutoload.php';
                                
                                
                                //Create a new PHPMailer instance
                                $mail = new PHPMailer;
                                // Set PHPMailer to use the sendmail transport
                                //$mail->isSendmail();
                                //Tell PHPMailer to use SMTP
                                $mail->isSMTP();
                                
                                //Enable SMTP debugging
                                // 0 = off (for production use)
                                // 1 = client messages
                                // 2 = client and server messages
                                $mail->SMTPDebug = 2;
                                
                                //Ask for HTML-friendly debug output
                                $mail->Debugoutput = 'html';
                                
                                //Set the hostname of the mail server
                                $mail->Host = 'smtp.gmail.com';
                                // use
                                // $mail->Host = gethostbyname('smtp.gmail.com');
                                // if your network does not support SMTP over IPv6
                                
                                //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                                $mail->Port = 25;
                                
                                //Set the encryption system to use - ssl (deprecated) or tls
                                $mail->SMTPSecure = 'tls';
                                
                                //Whether to use SMTP authentication
                                $mail->SMTPAuth = true;
                                //Custom connection options
                                $mail->SMTPOptions = array (
                                    'ssl' => array(
                                        'verify_peer'  => true,
                                        'verify_depth' => 3,
                                        'allow_self_signed' => true,
                                        'peer_name' => 'smtp.gmail.com',
                                        'cafile' => '/etc/ssl/ca_cert.pem',
                                    )
                                );
                                
                                //Username to use for SMTP authentication - use full email address for gmail
                                $mail->Username = "simonkijo@gmail.com";
                                
                                //Password to use for SMTP authentication
                                $mail->Password = "hdsdsoone";
                                
                                //Set who the message is to be sent from
                                $mail->setFrom('uais@uais.co.nf', 'uais uais');
                                
                                //Set an alternative reply-to address
                                $mail->addReplyTo('replyto@example.com', 'First Last');
                                
                                //Set who the message is to be sent to
                                $mail->addAddress($email_);
                                
                                //Set the subject line
                                $mail->Subject = 'Password Reset';
                                
                                //Read an HTML message body from an external file, convert referenced images to embedded,
                                //convert HTML into a basic plain-text alternative body
                                $mail->msgHTML('<body><p>You are new Password is '.$generated_password.'</p></body>');
                                
                                //Replace the plain text body with one created manually
                                $mail->AltBody = 'This is a plain-text message body';
                                
                                //send the message, check for errors
                                if (!$mail->send()) {
                                    echo "Mailer Error: " . $mail->ErrorInfo;
                                } else {
                                    echo "Message sent!";
                                    $success = 'success';
                                }
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Recover Password</title>
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
if(!empty($error)){
	if($error == 'invalid'){
		echo '<div class="col-md-6">
					<div class="alert alert-danger alert-dismissible a_remove">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
						Invalid Username or E-mail
					</div>
				</div>';
	}
}else if(!empty($success)){
       if($success == 'success'){
               echo	'<div class="col-md-6">
                                <div class="alert alert-success alert-dismissible a_remove">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-check"></i> SUCCESSFULLY !</h4>
                                        Successfully, Password has been sent to your email
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
      <div class="form-group has-feedback a_email_error">
        <input type="email" class="form-control i_email" name="email" placeholder="E-mail">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		<span class="help-block email_error"></span>
      </div>
	  <div class="form-group has-feedback">
		<div class="col-xs-8">
			<br>
			<a href="login.php" class="text-center">Login</a>
		</div>
	  </div>
      <div class="row">
		<div class="col-xs-4"></div>
        <div class="col-xs-4">
          <button type="submit" name="recover" class="btn btn-primary btn_recover">Recover</button>
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
<script src="dist/js/recoverValidation.js"></script>
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
