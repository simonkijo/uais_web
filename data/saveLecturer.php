<?php 
	if(isset($_POST['lec_save_b'])){
		$programme = "Bachelor Degree";
		$c_s = $_POST['course'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$sname = $_POST['sname'];
		$title = $_POST['title'];
		
		$count_fname = 0; $count_mname = 0; $count_sname = 0; $count_md_title = 0; $count_title = 0; 
		
		for($i=0;$i<count($fname);$i++){
			for($j=0;$j<count($_POST['md_title_'.$i]);$j++){
				$c_[$i][$j] = $_POST['md_title_'.$i][$j];
				if(empty($c_[$i][$j])){
					unset($c_[$i][$j]);
				}
			}
		}
		for($i=0;$i<count($c_);$i++){
			if($c_[$i] !=null){
				$count_md_title +=($i+1);
				$md_title_[] = toJson($c_[$i]);
			}else{
				if($count_md_title == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
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
		
		for($i=0;$i<count($title);$i++){
			if($title[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$title[$i])){
					$count_title += count($title[$i]);
					$title_[] = $title[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_title == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($fname_);$i++){
			$id_ = idGenerator();
			$q_u = "INSERT INTO `1948040_uais`.`users` VALUES('".$id_."','".$fname_[$i]."','".$mname_[$i]."','".$sname_[$i]."','','','','','','','lecturer')";
			$q_lec = "INSERT INTO `1948040_uais`.`lec_md_title` VALUES('".idGenerator()."','".$id_."','".$md_title_[$i]."','".$title_[$i]."','".$c_s."','".$programme."')";
			$r_u = mysql_query($q_u);
			$r_lec = mysql_query($q_lec);
			$r_inbox_b = mysql_query(createInbox($id_));
		}
		if($r_u && $r_lec && $r_inbox_b){
			$success = "success";
			unset($_POST['course']);
		}else{$success = "fail";}
	}
	if(isset($_POST['lec_save_d'])){
		$programme = "Ordinary Diploma";
		$c_s = $_POST['course'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$sname = $_POST['sname'];
		$md_title = $_POST['md_title'];
		$title = $_POST['title'];
		
		$count_fname = 0; $count_mname = 0; $count_sname = 0; $count_md_title = 0; $count_title = 0;

		for($i=0;$i<count($fname);$i++){
			for($j=0;$j<count($_POST['md_title_'.$i]);$j++){
				$c_[$i][$j] = $_POST['md_title_'.$i][$j];
				if(empty($c_[$i][$j])){
					unset($c_[$i][$j]);
				}
			}
		}
		for($i=0;$i<count($c_);$i++){
			if($c_[$i] !=null){
				$count_md_title +=($i+1);
				$md_title_[] = toJson($c_[$i]);
			}else{
				if($count_md_title == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
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
		
		for($i=0;$i<count($title);$i++){
			if($title[$i] != ''){
				if(preg_match('/^[A-Za-z]+$/',$title[$i])){
					$count_title += count($title[$i]);
					$title_[] = $title[$i];
				}else{
					$error[1] = 'invalid';
					return  $error;
				}
			}else{
				//if all fields are empty, print error sms
				if($count_title == 0){
					$error[0] = 'empty';
					return  $error;
				}
			}
		}
		for($i=0;$i<count($fname_);$i++){
			$id_ = idGenerator();
			$q_u = "INSERT INTO `1948040_uais`.`users` VALUES('".$id_."','".$fname_[$i]."','".$mname_[$i]."','".$sname_[$i]."','','','','','','','lecturer')";
			$q_lec = "INSERT INTO `1948040_uais`.`lec_md_title` VALUES('".idGenerator()."','".$id_."','".$md_title_[$i]."','".$title_[$i]."','".$c_s."','".$programme."')";
			$r_u = mysql_query($q_u);
			$r_lec = mysql_query($q_lec);
			$r_inbox_d = mysql_query(createInbox($id_));
		}
		if($r_u && $r_lec && $r_inbox_d){
			$success = "success";
			unset($_POST['course']);
		}else{$success = "fail";}
	}
?>