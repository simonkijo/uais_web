<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $sms_id = $_POST['sms_id'];
        $sms_table = $_POST['sms_table'];
        
       
        if(!empty($sms_id) && !empty($sms_table)){
                for($i=0; $i<count($sms_id); $i++){
                        $query = "UPDATE `1948040_uais`.`".$sms_table."` SET `trash`='trash' WHERE `inbox_pk`='".$sms_id[$i]."'";
                        $run = mysql_query($query);
                }
        }
?>