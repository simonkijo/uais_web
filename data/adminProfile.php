<?php 
	if(isset($_POST['save_a'])){
		$fname = strtolower($_POST['fname']);
		$mname = strtolower($_POST['mname']);
		$sname = strtolower($_POST['sname']);
		$phone_no = $_POST['phone_no'];
		$email = $_POST['email'];
		$nationality = $_POST['nationality'];
		$gender = $_POST['gender'];
		$uname = $_POST['uname'];
		$pwd = $_POST['pwd'];
		
		if(!empty($fname) && !empty($mname) && !empty($sname) && !empty($nationality) && !empty($gender) && !empty($phone_no) && !empty($email) && !empty($uname) && !empty($pwd)){
			$query = "UPDATE `1948040_uais`.`users` SET `fname`='".$fname."', `mname`='".$mname."', `sname`='".$sname."', `nationality`='".$nationality."', `gender`='".$gender."', `phone_no`='".$phone_no."', `email`='".$email."', `username`='".$uname."', `password`='".hashPassword($pwd)."' WHERE `id_no`='".getField('id_no')."'";
			$run = mysql_query($query);
			if($run){
				header('Location:adminProfile.php?response=success');
			}else{
				header('Location:adminProfile.php?response=fail');
			}
		}
	}
?>