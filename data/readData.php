<?php 
	if(getField('status') == 'lecturer' || getField('status') == 'student'){
		$qry2 = "SELECT `inbox_pk`,`subject`,`time` FROM `1948040_uais`.`".getField('id_no')."` WHERE `read_`='read' AND `trash`='untrash' ORDER BY `time` DESC";
		$_ru2 = mysql_query($qry2);
		while($row = mysql_fetch_array($_ru2)){
			$_inbox_pk_[] = $row['inbox_pk'];
			$_subject_[] = $row['subject'];
			$_time_[] = $row['time'];
		}
	}
	
?>