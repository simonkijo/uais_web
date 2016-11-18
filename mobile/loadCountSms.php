<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $stId = $_POST['stId'];
        
       
        if(!empty($stId)){
                 $query = "SELECT `read_`,`trash`,`reply` FROM `1948040_uais`.`".$stId."` ";
                $run = mysql_query($query);
                
                while($row=mysql_fetch_assoc($run)){
                    $response[] = $row;    
                }
                
                print(json_encode($response));
                
        }
?>