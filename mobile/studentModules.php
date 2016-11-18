<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $stId = $_POST['stId'];
       
        if(!empty($stId)){
                $query = "SELECT `year`,`semester`,`cs`,`programme` FROM `1948040_uais`.`st_role` WHERE `id_no`='".$stId."' ";
                $run = mysql_query($query);
                
                $year = mysql_result($run,0,'year');
                $semester = mysql_result($run,0,'semester');
                $course = mysql_result($run,0,'cs');
                $programme = mysql_result($run,0,'programme');
                
                if($year !="" && $semester !="" && $course !="" && $programme !=""){
                        $q_data = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$course."' AND `programme`='".$programme."' AND `year`='".$year."' AND `semester`='".$semester."'";
                        $run_data = mysql_query($q_data);
                        while($row=mysql_fetch_assoc($run_data)){
                            $response[] = $row;    
                        }
                        
                }else{
                        $response[] = array("year"=>$year,"semester"=>$semester,"course"=>$course,"programme"=>$programme);
                }
                
                print(json_encode($response));
                
        }
?>