<?php 
	if(getField('status') == 'lecturer' || getField('status') == 'student'){
		$qry_tr = "SELECT `inbox_pk`,`subject`,`time` FROM `1948040_uais`.`".getField('id_no')."` WHERE `trash`='trash' ORDER BY `time` DESC";
		$_ru_tr = mysql_query($qry_tr);
		while($row = mysql_fetch_array($_ru_tr)){
			$_inbox_pk_t[] = $row['inbox_pk'];
			$_subject_t[] = $row['subject'];
			$_time_t[] = $row['time'];
		}
	}
?>