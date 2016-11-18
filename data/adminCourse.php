<?php 
	if(isset($_POST['co_save_b'])){
		$programme = "Bachelor Degree";
		$course_n = $_POST['course_name'];
		$course_d = $_POST['course_duration'];
		
		$count_cs = 0;
		$count_csd = 0;
		$course_n_ = Array();
		$course_d_ = Array();
		
		for($i=0;$i<count($course_n);$i++){
			if($course_n[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$course_n[$i])){
					$count_cs += count($course_n[$i]);
					$course_n_[] = $course_n[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_cs == 0){
					$error[0] = 'empty_cs';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($course_d);$i++){
			if($course_d[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$course_d[$i])){
					$count_csd += count($course_d[$i]);
					$course_d_[] = $course_d[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_csd == 0){
					$error[2] = 'empty_csd';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($course_n_);$i++){
			$query = "INSERT INTO `1948040_uais`.`course` VALUES('".idGenerator()."','".$course_n_[$i]."','".$course_d_[$i]."','".$programme."')";
			$run = mysql_query($query);
		}
		if($run){
			$success = 'success';
		}
	}else if(isset($_POST['co_save_d'])){
		$programme = "Ordinary Diploma";
		$course_n = $_POST['course_name'];
		$course_d = $_POST['course_duration'];
		
		$count_cs = 0;
		$count_csd = 0;
		$course_n_ = Array();
		$course_d_ = Array();
		
		for($i=0;$i<count($course_n);$i++){
			if($course_n[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$course_n[$i])){
					$count_cs += count($course_n[$i]);
					$course_n_[] = $course_n[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_cs == 0){
					$error[0] = 'empty_cs';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($course_d);$i++){
			if($course_d[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$course_d[$i])){
					$count_csd += count($course_d[$i]);
					$course_d_[] = $course_d[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_csd == 0){
					$error[2] = 'empty_csd';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($course_n_);$i++){
			$query = "INSERT INTO `1948040_uais`.`course` VALUES('".idGenerator()."','".$course_n_[$i]."','".$course_d_[$i]."','".$programme."')";
			$run = mysql_query($query);
		}
		if($run){
			$success = 'success';
		}
	}
?>