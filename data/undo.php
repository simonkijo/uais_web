<?php 
	if(isset($_POST['delete_'])){
		if(isset($_POST['sms']) && !empty($_POST['sms'])){
			$sms_tr = $_POST['sms'];
			
			for($i=0;$i<count($sms_tr);$i++){
				$tr = "UPDATE `1948040_uais`.`".getField('id_no')."` SET `trash`='untrash' WHERE `inbox_pk`='".$sms_tr[$i]."'";
				$tr_r = mysql_query($tr);
				$c_success_tr[] = $sms_tr[$i];
			}
			if($tr_r){
				$success = 'success';
				$c_su_tr = count($c_success_tr);
			}else{$success = 'fail';}
			
		}else if(!isset($_POST['sms']) && empty($_POST['sms'])){
			$del_error[0] = 'del_error';
			return $del_error;
		}
	}
?>