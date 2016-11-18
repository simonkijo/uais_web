<?php 
	if(isset($_POST['lec_show_b'])){
		$cs_ = $_POST['course'];
		
		if($cs_ == ''){
			$error[2] = 'no_selection';
			return  $error;
		}else{
			$query = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$cs_."'";
			$run = mysql_query($query);
			while($row = mysql_fetch_array($run)){
				$md[] = $row['module'];
			}
		}
	}
	
	if(isset($_POST['lec_show_d'])){
		$cs_ = $_POST['course'];
		
		if($cs_ == ''){
			$error[2] = 'no_selection';
			return  $error;
		}else{
			$query = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$cs_."'";
			$run = mysql_query($query);
			while($row = mysql_fetch_array($run)){
				$md[] = $row['module'];
			}
		}
	}
?>