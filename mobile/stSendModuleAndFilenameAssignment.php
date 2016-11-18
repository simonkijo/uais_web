<?php
        include('../config/config.php');
        include('../config/functions.php'); 
        
        $filename = $_POST['filename'];
        $module = $_POST['module'];
        $filename = preg_replace('/\s+/', '_', $filename); //replace space with underscore
        
        $id = idGenerator(); 
        $sender = "student";
        date_default_timezone_set('Africa/Nairobi');
        $date_ = date('d-m-Y');
        
        if(!empty($filename) && !empty($module)){
              
              $query = "SELECT `programme` FROM `1948040_uais`.`module` WHERE `module`='".$module."'";
              $run = mysql_query($query);
              $prog = mysql_result($run,0,'programme');
              
              if($prog != ""){
                      $insert = "INSERT INTO `assignment` VALUES('".$id."','".$filename."','".$prog."','".$module."','','".$sender."','".$date_."')";
                      $run_i = mysql_query($insert);
              }
              
        }
?>