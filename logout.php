<?php 
	require("config/functions.php");
	
	session_destroy();
	header('Location:login.php');
?>