<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        /*$stId = $_POST['stId'];
        if(!empty($stId)){
                $query = "SELECT `role` FROM `1948040_uais`.`st_role` WHERE `id_no`='".$stId."'";
                $run = mysql_query($query);
                
                while($row=mysql_fetch_assoc($run)){
                    $response[] = $row;    
                }
                
                print(json_encode($response));
                
        }*/
        
        $query = "SELECT `role`,`id_no`,`cs`,`programme`,`year`,`semester` FROM `1948040_uais`.`st_role`";
        $run = mysql_query($query);
        
        while($row=mysql_fetch_assoc($run)){
            $response[] = $row;    
        }
        
        print(json_encode($response));
?>