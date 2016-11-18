<?php 
	if(isset($_POST['delete_'])){
		if(isset($_POST['sms']) && !empty($_POST['sms'])){
			$sms_ = $_POST['sms'];
			
			//insert time for deleting sms on trash
			$qys_ = "SELECT `session_id` FROM `1948040_uais`.`sms_delete_time` WHERE `session_id`='".getField('id_no')."'";
			$r_st = mysql_query($qys_);
			$_session_id = mysql_result($r_st,0,'session_id');
			
			if($_session_id == null){
				date_default_timezone_set('Africa/Nairobi');
				$time = time();
				$date = date("d-m-Y");
				$sms_delete_time = 2592000; // 30 days in secs (30*24*60*60secs)
				
				$qs = "INSERT INTO `1948040_uais`.`sms_delete_time` VALUES('".idGenerator()."','".$sms_delete_time."','".$time."','".$date."','".getField('id_no')."')";
				$rs = mysql_query($qs);
			}
			//end of insert time for deleting sms on trash
			
			for($i=0;$i<count($sms_);$i++){
				$all = "UPDATE `1948040_uais`.`".getField('id_no')."` SET `trash`='trash' WHERE `inbox_pk`='".$sms_[$i]."'";
				$all_r = mysql_query($all);
				$c_success[] = $sms_[$i];
			}
			if($all_r){
				$success = 'success';
				$c_su = count($c_success);
			}else{$success = 'fail';}
			
		}else if(!isset($_POST['sms']) && empty($_POST['sms'])){
			$del_error[0] = 'del_error';
			return $del_error;
		}
	}
?>