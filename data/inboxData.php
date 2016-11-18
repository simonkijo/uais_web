<?php
	if(getField('status') == 'lecturer' || getField('status') == 'student'){
		$i_myself = getField('fname')." ".getField('mname')." ".getField('sname');
		
		$qry = "SELECT `inbox_pk`,`subject`,`time`,`sender` FROM `1948040_uais`.`".getField('id_no')."` WHERE `read_`='unread' ORDER BY `time` DESC";
		$_ru = mysql_query($qry);
		while($row = mysql_fetch_array($_ru)){
			$inbox_pk_i[] = $row['inbox_pk'];
			$subject_i[] = $row['subject'];
			$time_i[] = $row['time'];
			$sender_i[] = $row['sender'];
		}
		
		for($i=0;$i<count($inbox_pk_i);$i++){
			if($sender_i[$i] != $i_myself){
				$inbox_pk[] = $inbox_pk_i[$i];
				$subject_[] = $subject_i[$i];
				$time[] = $time_i[$i];
			}
		}
		
	}
	
?>