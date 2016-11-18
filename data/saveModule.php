<?php 
	if(isset($_POST['sv_b'])){
		$cs = $_POST['course'];
		$programme = 'Bachelor Degree';
		
		$md_1_1 = $_POST['module_1_1'];
		$md_1_2 = $_POST['module_1_2'];
		$md_2_1 = $_POST['module_2_1'];
		$md_2_2 = $_POST['module_2_2'];
		$md_3_1 = $_POST['module_3_1'];
		$md_3_2 = $_POST['module_3_2'];
		$md_4_1 = $_POST['module_4_1'];
		$md_4_2 = $_POST['module_4_2'];
		
		$count_md_1_1 = 0; $count_md_1_2 = 0; $count_md_2_1 = 0; $count_md_2_2 = 0;
		$count_md_3_1 = 0; $count_md_3_2 = 0; $count_md_4_1 = 0; $count_md_4_2 = 0;
		
		for($i=0;$i<count($md_1_1);$i++){
			if($md_1_1[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_1_1[$i])){
					$count_md_1_1 += count($md_1_1[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','First Year','First Semester','".$md_1_1[$i]."','".$programme."')";
					$run_1_1 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_1_1 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_1_2);$i++){
			if($md_1_2[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_1_2[$i])){
					$count_md_1_2 += count($md_1_2[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','First Year','Second Semester','".$md_1_2[$i]."','".$programme."')";
					$run_1_2 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_1_2 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_2_1);$i++){
			if($md_2_1[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_2_1[$i])){
					$count_md_2_1 += count($md_2_1[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Second Year','First Semester','".$md_2_1[$i]."','".$programme."')";
					$run_2_1 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_2_1 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_2_2);$i++){
			if($md_2_2[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_2_2[$i])){
					$count_md_2_2 += count($md_2_2[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Second Year','Second Semester','".$md_2_2[$i]."','".$programme."')";
					$run_2_2 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_2_2 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_3_1);$i++){
			if($md_3_1[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_3_1[$i])){
					$count_md_3_1 += count($md_3_1[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Third Year','First Semester','".$md_3_1[$i]."','".$programme."')";
					$run_3_1 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_3_1 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_3_2);$i++){
			if($md_3_2[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_3_2[$i])){
					$count_md_3_2 += count($md_3_2[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Third Year','Second Semester','".$md_3_2[$i]."','".$programme."')";
					$run_3_2 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_3_2 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		//if errors happen reload
		if(isset($error) && !empty($error)){
			$course_ = $_POST['course'];
	
			for($i=0;$i<count($course);$i++){
				if($course[$i] == $course_){
					$d_ = $course_duration[$i];
				}
			}
		}
		//end of errors happen reload
		if($d_ == 'Four Year'){
			for($i=0;$i<count($md_4_1);$i++){
				if($md_4_1[$i] != ''){
					if(preg_match('/^[A-Za-z ]+$/',$md_4_1[$i])){
						$count_md_4_1 += count($md_4_1[$i]);
						$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Forth Year','First Semester','".$md_4_1[$i]."','".$programme."')";
						$run_4_1 = mysql_query($query);
					}else{
						$error[1] = 'invalid';
						return  $error;
					}
				}else{
					//if all fields are empty, print error sms
					if($count_md_4_1 == 0){
						$error[0] = 'empty';
						return  $error;
					}
				}
			}
			for($i=0;$i<count($md_4_2);$i++){
				if($md_4_2[$i] != ''){
					if(preg_match('/^[A-Za-z ]+$/',$md_4_2[$i])){
						$count_md_4_2 += count($md_4_2[$i]);
						$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Forth Year','Second Semester','".$md_4_2[$i]."','".$programme."')";
						$run_4_2 = mysql_query($query);
					}else{
						$error[1] = 'invalid';
						return  $error;
					}
				}else{
					//if all fields are empty, print error sms
					if($count_md_4_2 == 0){
						$error[0] = 'empty';
						return  $error;
					}
				}
			}
		}
		if(($run_1_1 && $run_1_2 && $run_2_1 && $run_2_2 && $run_3_1 && $run_3_2) || ($run_4_1 && $run_4_2)){
			$success = 'success';
		}
		
	}
	if(isset($_POST['sv_d'])){
		$cs = $_POST['course'];
		$programme = 'Ordinary Diploma';
		$md_1_1 = $_POST['module_1_1'];
		$md_1_2 = $_POST['module_1_2'];
		$md_2_1 = $_POST['module_2_1'];
		$md_2_2 = $_POST['module_2_2'];
		$md_3_1 = $_POST['module_3_1'];
		$md_3_2 = $_POST['module_3_2'];
		$md_4_1 = $_POST['module_4_1'];
		$md_4_2 = $_POST['module_4_2'];
		
		$count_md_1_1 = 0; $count_md_1_2 = 0; $count_md_2_1 = 0; $count_md_2_2 = 0;
		$count_md_3_1 = 0; $count_md_3_2 = 0; $count_md_4_1 = 0; $count_md_4_2 = 0;
		
		for($i=0;$i<count($md_1_1);$i++){
			if($md_1_1[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_1_1[$i])){
					$count_md_1_1 += count($md_1_1[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','First Year','First Semester','".$md_1_1[$i]."','".$programme."')";
					$run_1_1 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_1_1 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_1_2);$i++){
			if($md_1_2[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_1_2[$i])){
					$count_md_1_2 += count($md_1_2[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','First Year','Second Semester','".$md_1_2[$i]."','".$programme."')";
					$run_1_2 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_1_2 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_2_1);$i++){
			if($md_2_1[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_2_1[$i])){
					$count_md_2_1 += count($md_2_1[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Second Year','First Semester','".$md_2_1[$i]."','".$programme."')";
					$run_2_1 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_2_1 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_2_2);$i++){
			if($md_2_2[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_2_2[$i])){
					$count_md_2_2 += count($md_2_2[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Second Year','Second Semester','".$md_2_2[$i]."','".$programme."')";
					$run_2_2 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_2_2 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_3_1);$i++){
			if($md_3_1[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_3_1[$i])){
					$count_md_3_1 += count($md_3_1[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Third Year','First Semester','".$md_3_1[$i]."','".$programme."')";
					$run_3_1 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_3_1 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($md_3_2);$i++){
			if($md_3_2[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$md_3_2[$i])){
					$count_md_3_2 += count($md_3_2[$i]);
					$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Third Year','Second Semester','".$md_3_2[$i]."','".$programme."')";
					$run_3_2 = mysql_query($query);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_md_3_2 == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		//if errors happen reload
		if(isset($error) && !empty($error)){
			$course_ = $_POST['course'];
	
			for($i=0;$i<count($course);$i++){
				if($course[$i] == $course_){
					$d_ = $course_duration[$i];
				}
			}
		}
		//end of errors happen reload
		if($d_ == 'Four Year'){
			for($i=0;$i<count($md_4_1);$i++){
				if($md_4_1[$i] != ''){
					if(preg_match('/^[A-Za-z ]+$/',$md_4_1[$i])){
						$count_md_4_1 += count($md_4_1[$i]);
						$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Forth Year','First Semester','".$md_4_1[$i]."','".$programme."')";
						$run_4_1 = mysql_query($query);
					}else{
						$error[1] = 'invalid';
						return  $error;
					}
				}else{
					//if all fields are empty, print error sms
					if($count_md_4_1 == 0){
						$error[0] = 'empty';
						return  $error;
					}
				}
			}
			for($i=0;$i<count($md_4_2);$i++){
				if($md_4_2[$i] != ''){
					if(preg_match('/^[A-Za-z ]+$/',$md_4_2[$i])){
						$count_md_4_2 += count($md_4_2[$i]);
						$query = "INSERT INTO `1948040_uais`.`module` VALUES('".idGenerator()."','".$cs."','Forth Year','Second Semester','".$md_4_2[$i]."','".$programme."')";
						$run_4_2 = mysql_query($query);
					}else{
						$error[1] = 'invalid';
						return  $error;
					}
				}else{
					//if all fields are empty, print error sms
					if($count_md_4_2 == 0){
						$error[0] = 'empty';
						return  $error;
					}
				}
			}
		}
		if(($run_1_1 && $run_1_2 && $run_2_1 && $run_2_2 && $run_3_1 && $run_3_2) || ($run_4_1 && $run_4_2)){
			$success = 'success';
		}
		
	}
?>