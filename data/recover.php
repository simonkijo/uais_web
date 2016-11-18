<?php 
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
				changePassword($username,$email_);
			}
		}
	}
?>