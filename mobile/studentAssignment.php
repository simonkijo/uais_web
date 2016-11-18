<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $stId = $_POST['stId'];
        //$stId = 160216840564;
       
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
                            $response[] = $row["module"];    
                        }
                        for($i=0;$i<count($response);$i++){
                             $q_m = "SELECT `filename` FROM `1948040_uais`.`assignment` WHERE `module`='".$response[$i]."' AND `sender`='lecturer' ORDER BY `time_` DESC"; 
                             $run_m = mysql_query($q_m);
                             while($row=mysql_fetch_array($run_m)){
                                     $data[$response[$i]][] = $row["filename"];
                             }
                        }
                        if(count($data) == 0){
                           for($i=0;$i<count($response);$i++){
                                   for($j=0;$j<1;$j++){
                                           $data_[$j][$response[$i]] = "No file";
                                   }
                           } 
                       }else if(count($data) != 0){
                            for($i=0;$i<count($response);$i++){
                                    for($j=0;$j<count($data[$response[$i]]);$j++){
                                         $data_[$j][$response[$i]] = $data[$response[$i]][$j];
                                    }
                            }
                       } 
                        
                }else{
                        $response[] = array("year"=>$year,"semester"=>$semester,"course"=>$course,"programme"=>$programme);
                }
                print(json_encode($data_));
        }
?>