<?php 
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "1948040_uais";
	$error_sms = "Sorry something went wrong, cannot connect to the server";
	
	if(!mysql_connect($host,$user,$pass) || !mysql_select_db($db)){
		die($error_sms);
	}
?>