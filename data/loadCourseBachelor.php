<?php 
	$query = "SELECT `cs_name`,`cs_duration` FROM `1948040_uais`.`course` WHERE `programme`='Bachelor Degree'";
	$run = mysql_query($query);
	while($row = mysql_fetch_array($run)){
		$course[] = $row['cs_name'];
		$course_duration[] = $row['cs_duration'];
	}
?>