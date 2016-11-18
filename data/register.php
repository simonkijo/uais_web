<?php 
	if(isset($_POST['register'])){
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$sname = $_POST['sname'];
		$phone_no = $_POST['phone_no'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$nationality = $_POST['nationality'];
		$uname = $_POST['uname'];
		$pwd = $_POST['pwd'];
		
		if(!empty($fname) && !empty($mname) && !empty($sname) && !empty($phone_no) && !empty($email) && !empty($gender) && !empty($nationality) && !empty($uname) && !empty($pwd)){
			//check if registered
			$fname_ = strtolower($fname);
			$mname_ = strtolower($mname);
			$sname_ = strtolower($sname);
			
			$query = "SELECT `id_no`,`fname`,`mname`,`sname`,`phone_no`,`email`,`gender`,`nationality`,`username`,`password` FROM `1948040_uais`.`users` WHERE `fname`='".$fname_."' AND `mname`='".$mname_."' AND `sname`='".$sname_."'";
			$run = mysql_query($query);
			$_id_no = mysql_result($run,0, 'id_no');
			$_fname = mysql_result($run,0, 'fname');
			$_mname = mysql_result($run,0, 'mname');
			$_sname = mysql_result($run,0, 'sname');
			$_phone_no = mysql_result($run,0, 'phone_no');
			$_email = mysql_result($run,0, 'email');
			$_gender = mysql_result($run,0, 'gender');
			$_nationality = mysql_result($run,0, 'nationality');
			$_username = mysql_result($run,0, 'username');
			$_password = mysql_result($run,0, 'password');
			 
			if($_id_no !='' && $_fname !='' && $_mname !='' && $_sname !='' && $_phone_no !='' && $_email !='' && $_gender !='' && $_nationality !='' && $_username !='' && $_password !=''){
				header('Location:login.php?response=registered');
			}else{
				if($_fname == $fname_ && $_mname == $mname_ && $_sname == $sname_){
					$query_ = "UPDATE `1948040_uais`.`users` SET `phone_no`='".$phone_no."', `email`='".$email."', `gender`='".$gender."', `nationality`='".$nationality."', `username`='".$uname."', `password`='".hashPassword($pwd)."' WHERE `id_no`='".$_id_no."'";
					if(mysql_query($query_)){
						header('Location:login.php?response=success');
					}else{
						header('Location:register.php?response=fail');
					}
				}else{
					header('Location:register.php?response=not_admitted');
				}
			}
		}
	}
?>