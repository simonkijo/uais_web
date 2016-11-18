<?php 
	if(isset($_POST['send'])){
		//compose message lecturer
		if(getField('status') == 'lecturer'){
			if($count_ >=2){
				$mod_ = $_POST['module_title1'];
				$to = $_POST['to'];
				$subject = $_POST['subject'];
				$message = $_POST['message'];
				$from = getAnyField('lec_md_title','title').'. '.capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('sname'));
				
				if($mod_ == '' || $to == '' || $subject == '' || $message == ''){
					if($mod_ ==''){
						$err ='no_module';
					}else if($to ==''){
						$err ='no_to';
					}else if($subject ==''){
						$err ='no_subject';
					}else if($message ==''){
						$err ='no_message';
					}
					$error[0] = $err;
					return $error;
				}
				
				$q_mod = "SELECT `cs`,`year`,`semester`,`programme` FROM `1948040_uais`.`module` WHERE `module`='".$mod_."'";
				$r_mod = mysql_query($q_mod);
				$cos = mysql_result($r_mod,0,'cs');
				$yar = mysql_result($r_mod,0,'year');
				$semster = mysql_result($r_mod,0,'semester');
				$program = mysql_result($r_mod,0,'programme');
				
				$q_id = "SELECT `id_no`,`role` FROM `1948040_uais`.`st_role` WHERE `cs`='".$cos."' AND `year`='".$yar."' AND `semester`='".$semster."' AND `programme`='".$program."'";
				$r_id = mysql_query($q_id);
				while($row = mysql_fetch_array($r_id)){
					$_id_[] = $row['id_no'];
					$_role_[] = $row['role'];
				}
				if($to == 'Students'){
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					for($i=0;$i<count($_id_);$i++){
						$query = "INSERT INTO `1948040_uais`.`".$_id_[$i]."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
						$run = mysql_query($query);
					}
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module_title1']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Class Representative'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Class Representative'){
							$_id_1[] = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					for($i=0;$i<count($_id_1);$i++){
						$query = "INSERT INTO `1948040_uais`.`".$_id_1[$i]."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
						$run = mysql_query($query);
					}
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module_title1']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}
				
			}else if($count_ == 1){
				$mod_ = $module_[0];
				$to = $_POST['to'];
				$subject = $_POST['subject'];
				$message = $_POST['message'];
				$from = getAnyField('lec_md_title','title').'. '.capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('sname'));
				
				if($mod_ == '' || $to == '' || $subject == '' || $message == ''){
					if($mod_ ==''){
						$err ='no_module';
					}else if($to ==''){
						$err ='no_to';
					}else if($subject ==''){
						$err ='no_subject';
					}else if($message ==''){
						$err ='no_message';
					}
					$error[0] = $err;
					return $error;
				}
				$q_mod = "SELECT `cs`,`year`,`semester`,`programme` FROM `1948040_uais`.`module` WHERE `module`='".$mod_."'";
				$r_mod = mysql_query($q_mod);
				$cos = mysql_result($r_mod,0,'cs');
				$yar = mysql_result($r_mod,0,'year');
				$semster = mysql_result($r_mod,0,'semester');
				$program = mysql_result($r_mod,0,'programme');
				
				$q_id = "SELECT `id_no`,`role` FROM `1948040_uais`.`st_role` WHERE `cs`='".$cos."' AND `year`='".$yar."' AND `semester`='".$semster."' AND `programme`='".$program."'";
				$r_id = mysql_query($q_id);
				while($row = mysql_fetch_array($r_id)){
					$_id_[] = $row['id_no'];
					$_role_[] = $row['role'];
				}
				if($to == 'Students'){
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					for($i=0;$i<count($_id_);$i++){
						$query = "INSERT INTO `1948040_uais`.`".$_id_[$i]."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
						$run = mysql_query($query);
					}
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module_title1']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Class Representative'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Class Representative'){
							$_id_1[] = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					for($i=0;$i<count($_id_1);$i++){
						$query = "INSERT INTO `1948040_uais`.`".$_id_1[$i]."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
						$run = mysql_query($query);
					}
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$mod_."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module_title1']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}
			}
		}
		//end of compose message lecturer
		//student and also class representative
		if(getAnyField('st_role','role') =='Class Representative' && getField('status')== 'student' && !isset($_GET['r']) && empty($_GET['r'])){
			$_d = $_POST['module'];
			$to = $_POST['to'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			$from = getAnyField('st_role','role').', '.getAnyField('st_role','cs').', '.getAnyField('st_role','programme');
			
			if($_d == ''){
				$error[2] = 'no_md';
				return $error;
			}else if($to ==''){
				$error[0] = 'no_to';
				return $error;
			}else if($subject ==''){
				$error[0] = 'no_subject';
				return $error;
			}else if($message ==''){
				$error[0] = 'no_message';
				return $error;
			}else{
				
				$q_mod = "SELECT `cs`,`year`,`semester`,`programme` FROM `1948040_uais`.`module` WHERE `module`='".$_d."'";
				$r_mod = mysql_query($q_mod);
				$cos = mysql_result($r_mod,0,'cs');
				$yar = mysql_result($r_mod,0,'year');
				$semster = mysql_result($r_mod,0,'semester');
				$program = mysql_result($r_mod,0,'programme');
				
				$q_id = "SELECT `id_no`,`role` FROM `1948040_uais`.`st_role` WHERE `cs`='".$cos."' AND `year`='".$yar."' AND `semester`='".$semster."' AND `programme`='".$program."'";
				$r_id = mysql_query($q_id);
				while($row = mysql_fetch_array($r_id)){
					$_id_[] = $row['id_no'];
					$_role_[] = $row['role'];
				}
				if($to == 'President'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'President'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
					
				}else if($to == 'Prime Minister'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Prime Minister'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Sports Minister'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Sports Minister'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Food Minister'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Food Minister'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Lecturer'){
					$query_l = "SELECT `id_no`,`module` FROM `1948040_uais`.`lec_md_title` WHERE `cs`='".getAnyField('st_role','cs')."' AND `programme`='".getAnyField('st_role','programme')."'";
					$run_l = mysql_query($query_l);
					while($row = mysql_fetch_array($run_l)){
						$id_l[] = $row['id_no'];
						$module_l[] = printJSONDATA($row['module']);
					}
					for($i=0;$i<count($module_l);$i++){
						for($j=0;$j<count($module_l[$i]);$j++){
							if($module_l[$i][$j] == $_d){
								$id_l_ = $id_l[$i];
							}
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$id_l_."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','".$_d."','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
					
				}
				
			}
			
		}
		//end of student and also class representative
		//student
		if(getAnyField('st_role','role') !='Class Representative' && getField('status') == 'student' && !isset($_GET['r']) && empty($_GET['r']) ){
			$to = $_POST['to'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			$from = capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('sname')).', '.getAnyField('st_role','cs').', '.getAnyField('st_role','programme');
			
			if($to ==''){
				$error[0] = 'no_to';
				return $error;
			}else if($subject ==''){
				$error[0] = 'no_subject';
				return $error;
			}else if($message ==''){
				$error[0] = 'no_message';
				return $error;
			}else{
				
				$q_id = "SELECT `id_no`,`role` FROM `1948040_uais`.`st_role` WHERE `cs`='".getAnyField('st_role','cs')."' AND `year`='".getAnyField('st_role','year')."' AND `semester`='".getAnyField('st_role','semester')."' AND `programme`='".getAnyField('st_role','programme')."'";
				$r_id = mysql_query($q_id);
				while($row = mysql_fetch_array($r_id)){
					$_id_[] = $row['id_no'];
					$_role_[] = $row['role'];
				}
				if($to == 'President'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'President'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
					
				}else if($to == 'Prime Minister'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Prime Minister'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Sports Minister'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Sports Minister'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Food Minister'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Food Minister'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}else if($to == 'Class Representative'){
					for($i=0;$i<count($_role_);$i++){
						if($_role_[$i] == 'Class Representative'){
							$_id_1 = $_id_[$i];
						}
					}
					date_default_timezone_set('Africa/Nairobi');
					$dat = date('H:i:s');
                                        $tim = date('d-m-Y');
					$g_id = idGenerator();
					$query = "INSERT INTO `1948040_uais`.`".$_id_1."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run = mysql_query($query);
					//insert into his/her own inbox for outbox
					$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
					$run_ot = mysql_query($query_ot);
					//end of insert into his/her own inbox for outbox
					if($run && $run_ot){
						$success = 'success';
						unset($_POST['module']); unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']);
					}else{$success = 'fail';}
				}
			}
		}
		//end of student
		//for reply
		if(isset($_GET['r']) && !empty($_GET['r'])){
			$r_ = $_GET['r'];
			$to = $_POST['to'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			if(getField('status') == 'lecturer'){
				$from = getAnyField('lec_md_title','title').'. '.capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('sname'));
			}else if(getField('status') == 'student'){
				$from = capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('sname')).', '.getAnyField('st_role','cs').', '.getAnyField('st_role','programme');
			}
			
			
			if($to ==''){
				$error[0] = 'no_to';
				return $error;
			}else if($subject ==''){
				$error[0] = 'no_subject';
				return $error;
			}else if($message ==''){
				$error[0] = 'no_message';
				return $error;
			}else{
				
				date_default_timezone_set('Africa/Nairobi');
				$dat = date('H:i:s');
                                $tim = date('d-m-Y');
				$g_id = idGenerator();
				$query = "INSERT INTO `1948040_uais`.`".$r_."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
				$run = mysql_query($query);
				//insert into his/her own inbox for outbox
				$query_ot = "INSERT INTO `1948040_uais`.`".getField('id_no')."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$message."','".$dat."','".$tim."','unread','untrash','','".getField('id_no')."','".getField('fname')." ".getField('mname')." ".getField('sname')."')";
				$run_ot = mysql_query($query_ot);
				//end of insert into his/her own inbox for outbox
				if($run && $run_ot){
					$success = 'success';
					unset($_POST['to']); unset($_POST['subject']); unset($_POST['message']); unset($_GET['r']);
				}else{$success = 'fail';}
			}
		}
		//end of reply
	}
?>