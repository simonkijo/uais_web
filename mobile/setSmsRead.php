<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $sms_id = $_POST['sms_id'];
        $sms_table = $_POST['sms_table'];
        
       
        if(!empty($sms_id) && !empty($sms_table)){
                 $query = "UPDATE `1948040_uais`.`".$sms_table."` SET `read_`='read' WHERE `inbox_pk`='".$sms_id."'";
                $run = mysql_query($query);
        }
?>