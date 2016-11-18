<?php 
	if(getField('status') == 'lecturer' || getField('status') == 'student'){
		$qryo = "SELECT `inbox_pk`,`subject`,`time` FROM `1948040_uais`.`".getField('id_no')."` WHERE `trash`='untrash' AND `sender`='".getField('fname')." ".getField('mname')." ".getField('sname')."' ORDER BY `time` DESC";
		$_ruo = mysql_query($qryo);
		while($row = mysql_fetch_array($_ruo)){
			$_inbox_pk_o[] = $row['inbox_pk'];
			$_subject_o[] = $row['subject'];
			$_time_o[] = $row['time'];
		}
	}
	
?>