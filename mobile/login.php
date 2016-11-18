<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];
        
        $id_no = null;
        $status = null;
        
        if(!empty($uname) && !empty($pwd)){
                $query = "SELECT `id_no`,`status`,`fname`,`mname`,`sname` FROM `1948040_uais`.`users` WHERE `username`='".mysql_real_escape_string($uname)."' AND `password`='".hashPassword(mysql_real_escape_string($pwd))."'";
                $run = mysql_query($query);
                $id_no = mysql_result($run,0,'id_no');
                $status = mysql_result($run,0,'status');
                $fname = mysql_result($run,0,'fname');
                $mname = mysql_result($run,0,'mname');
                $sname = mysql_result($run,0,'sname');
                
                if($id_no !=null && $status !=null){
                        $response[] = array("id_no"=>$id_no,"status"=>$status,"fname"=>$fname ,"mname"=>$mname ,"sname"=>$sname);
                }else{
                        $response[] = array("id_no"=>$id_no,"status"=>$status);
                }
                print(json_encode($response));
        }
?>