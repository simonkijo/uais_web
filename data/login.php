<?php 
	if(isset($_POST['sign_in'])){
		$uname = $_POST['uname'];
		$pwd = $_POST['pwd'];
		
		if(!empty($uname) && !empty($pwd)){
			$query = "SELECT `id_no`,`status` FROM `1948040_uais`.`users` WHERE `username`='".mysql_real_escape_string($uname)."' AND `password`='".hashPassword(mysql_real_escape_string($pwd))."'";
			$run = mysql_query($query);
			$id_no = mysql_result($run,0,'id_no');
			$status = mysql_result($run,0,'status');
			
			if($id_no !='' && $status !=''){
				$_SESSION['id_'] = $id_no;
				
				if($status == 'student' || $status == 'lecturer'){
					header('Location:academics.php');
				}else if($status == 'admin'){
					header('Location:adminCourseBachelor.php');
				}
			}else{
				$error = "invalid";
			}
		}
	}
?>