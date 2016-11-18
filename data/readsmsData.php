<?php 
	if(isset($_GET['id']) && !empty($_GET['id'])){
		$id = $_GET['id'];
		$_myself = getField('fname')." ".getField('mname')." ".getField('sname');
		
		$query = "SELECT `sender`,`reply`,`from_`,`subject`,`sms`,`time` FROM `1948040_uais`.`".getField('id_no')."` WHERE `inbox_pk`='".$id."'";
		$run = mysql_query($query);
		
		$_from = mysql_result($run,0,'from_');
		$_subject = mysql_result($run,0,'subject');
		$_sms = mysql_result($run,0,'sms');
		$_time = mysql_result($run,0,'time');
		$_reply = mysql_result($run,0,'reply');
		$_sender = mysql_result($run,0,'sender');
		
		if($run){
			if($_sender != $_myself){
				$_q = "UPDATE `1948040_uais`.`".getField('id_no')."` SET `read_`='read' WHERE `inbox_pk`='".$id."'";
				$_r = mysql_query($_q);
			}
		}
	}
?>