<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $stId = $_POST['stId'];
       
        if(!empty($stId)){
                $query = "SELECT `fname`,`mname`,`sname`,`phone_no`,`email`,`gender`,`nationality`,`username` FROM `1948040_uais`.`users` WHERE `id_no`='".$stId."' ";
                $run = mysql_query($query);
                
                while($row=mysql_fetch_assoc($run)){
                    $response[] = $row;    
                }
                
                print(json_encode($response));
                
        }
?>