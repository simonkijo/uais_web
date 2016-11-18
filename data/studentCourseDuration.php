<?php
	$_q = "SELECT `cs_duration` FROM `1948040_uais`.`course` WHERE `cs_name`='".getAnyField('st_role','cs')."' AND `programme`='".getAnyField('st_role','programme')."'";
	$_r_ = mysql_query($_q);
	$_cs_d_ = mysql_result($_r_,0,'cs_duration');
?>