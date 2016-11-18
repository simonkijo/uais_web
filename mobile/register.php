<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $fname = strtolower($_POST['fname']);
        $mname = strtolower($_POST['mname']);
        $sname = strtolower($_POST['sname']);
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $nat = $_POST['nat'];
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];
        
        $id_no = null;
        $status = null;
        
        if(!empty($fname) && !empty($mname) && !empty($sname) && !empty($phone) && !empty($email) && !empty($gender) && !empty($nat) && !empty($uname) && !empty($pwd)){
                $query = "SELECT `id_no`,`status` FROM `1948040_uais`.`users` WHERE `fname`='".mysql_real_escape_string($fname)."' AND `mname`='".mysql_real_escape_string($mname)."' AND `sname`='".mysql_real_escape_string($sname)."'";
                $run = mysql_query($query);
                
                $id_no = mysql_result($run,0,'id_no');
                $status = mysql_result($run,0,'status');
                
                if($id_no !=null && $status !=null){
                        if($status == "student"){
                                $reg = "SELECT `phone_no`,`email`,`gender`,`nationality`,`username` FROM `1948040_uais`.`users` WHERE `id_no`='".$id_no."'";
                                $reg_run = mysql_query($reg);
                                $pno = mysql_result($reg_run,0,'phone_no');
                                $eml = mysql_result($reg_run,0,'email');
                                $gnder = mysql_result($reg_run,0,'gender');
                                $natl = mysql_result($reg_run,0,'nationality');
                                $usern = mysql_result($reg_run,0,'username');
                                if($pno !="" && $eml !="" && $gnder !="" && $natl !="" && $usern !=""){
                                        $response[] = array("id_no"=>"3","status"=>"registered");
                                }else{
                                        $update = "UPDATE `1948040_uais`.`users` SET `phone_no`='".$phone."', `email`='".$email."', `gender`='".$gender."', `nationality`='".$nat."', `username`='".$uname."', `password`='".hashPassword($pwd)."' WHERE `id_no`='".$id_no."'";
                                        $run_u = mysql_query($update);
                                        if($run_u){
                                             $response[] = array("id_no"=>"0","status"=>"success");   
                                        }else{
                                             $response[] = array("id_no"=>"1","status"=>"fail");
                                        }
                                }
                        }else if($status == "lecturer"){
                                $response[] = array("id_no"=>"2","status"=>"fail"); 
                        }
                }else{
                        $response[] = array("id_no"=>$id_no,"status"=>$status);
                }
                print(json_encode($response));
        }
?>