<?php 
	if(isset($_POST['save_sl'])){
		$phone_no = $_POST['phone_no'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$pwd = $_POST['pwd'];
		
		if(!empty($phone_no) && !empty($email) && !empty($uname) && !empty($pwd)){
			$query = "UPDATE `1948040_uais`.`users` SET `phone_no`='".$phone_no."', `email`='".$email."', `username`='".$uname."', `password`='".hashPassword($pwd)."' WHERE `id_no`='".getField('id_no')."'";
			$run = mysql_query($query);
			if($run){
				header('Location:profile.php?response=success');
			}else{
				header('Location:profile.php?response=fail');
			}
		}
	}
?>