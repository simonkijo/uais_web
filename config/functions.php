<?php 
	error_reporting('E_NOTICE');
	ob_start();
	session_start();
	//for checking if user is logged in
	function logged_in(){
		if(isset($_SESSION['id_']) && !empty($_SESSION['id_'])){
			return true;
		}else{
			return false;
		}
	}
	//get any field from logged in user.
	function getField($field){
		$query = "SELECT `$field` FROM `1948040_uais`.`users` WHERE `id_no`='".$_SESSION['id_']."'";
		if($query_run = @mysql_query($query)){
			if($query_result = @mysql_result($query_run,0, $field)){
				return $query_result;
			}
		}		
	}
	//get any field, by supplying table name
	function getAnyField($tablename,$field){
		$query = "SELECT `$field` FROM `1948040_uais`.`$tablename` WHERE `id_no`='".$_SESSION['id_']."'";
		$query_run = @mysql_query($query);
		if($query_result = @mysql_result($query_run,0, $field)){
			return $query_result;
		}
	}
	//id generator
	function idGenerator(){
		$year = date('Y');
		$f_c = substr($year,0,1);
		$f_sc = substr($year,1,1);
		$l_2 = substr($year,2,3);
		$n = substr(mt_rand(),0,8);
		
		if(strlen($n) == '7'){
			$v = $n.substr(mt_rand(),0,1);
			return $l_2.$f_sc.$f_c.$v;
		}else{
			return $l_2.$f_sc.$f_c.$n;
		}
	}
	//password encypt
	function hashPassword($pass){
		$hash = md5($pass);
		return $hash;
	}
	//first letter capital
	function capitalFirstLetter($string){
		$c = strtoupper(substr($string,0,1));
		$len = strlen($string);
		for($i=1;$i<$len;$i++){
			$c .= substr($string,$i,1);
		}
		return $c;
	}
	//for profile photo
	function photoProfile($image_name){
		$dir = "../uais/dist/img";
		
		// Open a directory, and read its contents
		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				$files[] = $file;
			}
			closedir($dh);
		  }
		}
		if(in_array($image_name,$files)){
			$path = 'dist/img/'.$image_name;
		}else{
			$path = 'dist/img/empty_photo.png';
		}
		return $path;
    }
	//convert to json
	function toJson($parameter){
		$p_ = json_encode($parameter);
		return $p_;
	}
	//decode json array
	function printJSONDATA($para){
		$th = json_decode($para);
		foreach($th as $t){
			$json_data[] = $t;
		}
		return $json_data;
	}
	//get data from db to generate pdf
	function query($lmt,$tbl,$filename,$colmn,$clm_value){
		$qy_ = "SELECT `content_notes` FROM `1948040_uais`.`$tbl` WHERE `filename`='".$filename."' AND `$colmn`='".$clm_value."' AND `programme`='".getAnyField($lmt,'programme')."'";
		$ru_ = mysql_query($qy_);
		$result = mysql_result($ru_,0,'content_notes');
		return $result;
	}
	
	//generate new pass and send to email
	function changePassword($uname,$mail){
		$generated_password = substr(md5(rand(999,99999)),0,9);
		$hash_password = hashPassword($generated_password);
		
		mail(''.$mail.'','Password Recovery','You are new Password is '.$generated_password.'','From: noreply@uais.com');
		
		$query = "UPDATE `1948040_uais`.`users` SET `password`='".$hash_password."' WHERE `username`='".$uname."' AND `email`='".$mail."'";
		$query_run = @mysql_query($query);
		
		if($query_run){
			echo	'<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alert alert-success alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> SUCCESSFULLY !</h4>
							Successfully, Password has been sent to your email
						</div>
					</div>';
		}else{
			echo   '<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Something went wrong, Please try again
						</div>
					</div>';
		}
	}
	//change year or semester if semester end
	function changeSemesterOrYear($current_time,$constant_time,$year,$semester,$course_duration){
		if($current_time >= $constant_time){
			if($year == 'First Year' && $semester == 'First Semester'){
				$year_ = 'First Year'; $semester_ = 'Second Semester';
			}else if($year == 'First Year' && $semester == 'Second Semester'){
				$year_ = 'Second Year'; $semester_ = 'First Semester';
			}else if($year == 'Second Year' && $semester == 'First Semester'){
				$year_ = 'Second Year'; $semester_ = 'Second Semester';
			}else if($year == 'Second Year' && $semester == 'Second Semester'){
				$year_ = 'Third Year'; $semester_ = 'First Semester';
			}else if($year == 'Third Year' && $semester == 'First Semester'){
				$year_ = 'Third Year'; $semester_ = 'Second Semester';
			}else{
				if($course_duration == 'Four Year'){
					if($year == 'Third Year' && $semester == 'Second Semester'){
						$year_ = 'Forth Year'; $semester_ = 'First Semester';
					}else if($year == 'Forth Year' && $semester == 'First Semester'){
						$year_ = 'Forth Year'; $semester_ = 'Second Semester';
					}
				}
			}
			
			if($semester_ !='' && $year_ !=''){
				$qt = "UPDATE `1948040_uais`.`save_time` SET `current_time_`='".$current_time."' WHERE `date_`='".getAnyField('st_role','date_')."'";
				$rty = mysql_query($qt);
			}
		}
		
		if($semester_ !='' && $year_ !=''){
			$query = "UPDATE `1948040_uais`.`st_role` SET `year`='".$year_."', `semester`='".$semester_."' WHERE `id_no`='".getField('id_no')."'";
			$run = mysql_query($query);
		}
	}
	//for creating inbox
	function createInbox($id){
		$ctable = "CREATE TABLE `".$id."` (
			  `inbox_pk` varchar(12) NOT NULL PRIMARY KEY,
			  `t_o` varchar(45) DEFAULT NULL,
			  `from_` varchar(100) DEFAULT NULL,
			  `subject` varchar(100) DEFAULT NULL,
			  `sms` longtext,
			  `time` varchar(45) DEFAULT NULL,
              `date_` varchar(45) DEFAULT NULL,
			  `read_` varchar(6) DEFAULT NULL,
			  `trash` varchar(7) DEFAULT NULL,
			  `module` varchar(100) DEFAULT NULL,
			  `reply` varchar(12) DEFAULT NULL,
			  `sender` varchar(100) DEFAULT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		return $ctable;
	}
	
?>