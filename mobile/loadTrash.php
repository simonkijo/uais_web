<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $stId = $_POST['stId'];
       
        if(!empty($stId)){
                 $query = "SELECT `from_`,`subject`,`sms`,`time`,`date_`,`reply`,`sender`,`inbox_pk` FROM `1948040_uais`.`".$stId."` WHERE `trash`='trash' ORDER BY `time` DESC";
                $run = mysql_query($query);
                
                while($row=mysql_fetch_assoc($run)){
                      $response[] = $row;    
                }
              
                if(count($response) == 0){
                        $response_[] = array("sms_"=>"no_sms");
                        print(json_encode($response_));
                }else if(count($response) >= 1){
                        print(json_encode($response));
                }
                
        }
        
?>