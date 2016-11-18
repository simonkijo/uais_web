<?php 
	if(isset($_POST['st_save_b'])){
		$programme = "Bachelor Degree";
		$cs = $_POST['course'];
		$year = $_POST['year'];
		$semester = $_POST['semester'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$sname = $_POST['sname'];
		$role = $_POST['role'];
		
		$count_fname = 0; $count_mname = 0; $count_sname = 0; $count_role = 0; 
		
		if($cs == '' || $year=='' || $semester==''){
			$error[2] = 'no_selection';
			return  $error;
		}
		for($i=0;$i<count($fname);$i++){
			if($fname[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$fname[$i])){
					$count_fname += count($fname[$i]);
					$fname_[] = strtolower($fname[$i]);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_fname == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($mname);$i++){
			if($mname[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$mname[$i])){
					$count_mname += count($mname[$i]);
					$mname_[] = strtolower($mname[$i]);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_mname == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($sname);$i++){
			if($sname[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$sname[$i])){
					$count_sname += count($sname[$i]);
					$sname_[] = strtolower($sname[$i]);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_sname == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($role);$i++){
			if($role[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$role[$i])){
					$count_role += count($role[$i]);
					$role_[] = $role[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_role == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		//insert time for either year or semester
		$qys_ = "SELECT `date_` FROM `1948040_uais`.`save_time`";
		$r_st = mysql_query($qys_);
		while($row = mysql_fetch_array($r_st)){
			$dat[] = $row['date_'];
		}
		
		date_default_timezone_set('Africa/Nairobi');
		$time = time();
		$date = date("d-m-Y");
		$sem_time = 9676800; // 16 weeks in secs (16*7*24*60*60secs)
		
		if(!in_array($date,$dat)){
			$qs = "INSERT INTO `1948040_uais`.`save_time` VALUES('".idGenerator()."','".$sem_time."','".$time."','".$date."')";
			$rs = mysql_query($qs);
		}
		//end of insert time for either year or semester
		for($i=0;$i<count($fname_);$i++){
			$id_ = idGenerator();
			$q_u = "INSERT INTO `1948040_uais`.`users` VALUES('".$id_."','".$fname_[$i]."','".$mname_[$i]."','".$sname_[$i]."','','','','','','','student')";
			$q_lec = "INSERT INTO `1948040_uais`.`st_role` VALUES('".idGenerator()."','".$id_."','".$cs."','".$programme."','".$role_[$i]."','".$year."','".$semester."','".$date."')";
			$r_u = mysql_query($q_u);
			$r_lec = mysql_query($q_lec);
			$r_inbox_b = mysql_query(createInbox($id_));
		}
		if($r_u && $r_lec && $r_inbox_b){
			$success = "success";
			unset($_POST['year']); unset($_POST['semester']); unset($_POST['course']);
		}else{$success = "fail";}
	}
	if(isset($_POST['st_save_d'])){
		$programme = "Ordinary Diploma";
		$cs = $_POST['course'];
		$year = $_POST['year'];
		$semester = $_POST['semester'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$sname = $_POST['sname'];
		$role = $_POST['role'];
		
		$count_fname = 0; $count_mname = 0; $count_sname = 0; $count_role = 0; 
		
		if($cs == '' || $year=='' || $semester==''){
			$error[2] = 'no_selection';
			return  $error;
		}
		for($i=0;$i<count($fname);$i++){
			if($fname[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$fname[$i])){
					$count_fname += count($fname[$i]);
					$fname_[] = strtolower($fname[$i]);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_fname == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($mname);$i++){
			if($mname[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$mname[$i])){
					$count_mname += count($mname[$i]);
					$mname_[] = strtolower($mname[$i]);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_mname == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($sname);$i++){
			if($sname[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$sname[$i])){
					$count_sname += count($sname[$i]);
					$sname_[] = strtolower($sname[$i]);
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_sname == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($role);$i++){
			if($role[$i] != ''){
				if(preg_match('/^[A-Za-z ]+$/',$role[$i])){
					$count_role += count($role[$i]);
					$role_[] = $role[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_role == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		//insert time for either year or semester
		$qys_ = "SELECT `date_` FROM `1948040_uais`.`save_time`";
		$r_st = mysql_query($qys_);
		while($row = mysql_fetch_array($r_st)){
			$dat[] = $row['date_'];
		}
		
		date_default_timezone_set('Africa/Nairobi');
		$time = time();
		$date = date("d-m-Y");
		$sem_time = 9676800; // 16 weeks in secs (16*7*24*60*60secs)
		
		if(!in_array($date,$dat)){
			$qs = "INSERT INTO `1948040_uais`.`save_time` VALUES('".idGenerator()."','".$sem_time."','".$time."','".$date."')";
			$rs = mysql_query($qs);
		}
		//end of insert time for either year or semester
		for($i=0;$i<count($fname_);$i++){
			$id_ = idGenerator();
			$q_u = "INSERT INTO `1948040_uais`.`users` VALUES('".$id_."','".$fname_[$i]."','".$mname_[$i]."','".$sname_[$i]."','','','','','','','student')";
			$q_lec = "INSERT INTO `1948040_uais`.`st_role` VALUES('".idGenerator()."','".$id_."','".$cs."','".$programme."','".$role_[$i]."','".$year."','".$semester."','".$date."')";
			$r_u = mysql_query($q_u);
			$r_lec = mysql_query($q_lec);
			$r_inbox_d = mysql_query(createInbox($id_));
		}
		if($r_u && $r_lec && $r_inbox_d){
			$success = "success";
			unset($_POST['year']); unset($_POST['semester']); unset($_POST['course']);
		}else{$success = "fail";}
	}
?>