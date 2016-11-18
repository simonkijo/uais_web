<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        //$uname = "daniel";
        //$email = "simonkijo@ymail.com";
        
        if(!empty($uname) && !empty($email)){
                $query = "SELECT `username`,`email` FROM `1948040_uais`.`users` WHERE `username`='".mysql_real_escape_string($uname)."' AND `email`='".mysql_real_escape_string($email)."'";
                $run = mysql_query($query);
                $num_rows = mysql_num_rows($run);
                
                if($num_rows == 0){
                        $response[] = array("success"=>"invalid");
                }else if($num_rows == 1){
                        $username = mysql_result($run,0,'username');
                        $email_ = mysql_result($run,0,'email');
                        
                        
                        $generated_password = substr(md5(rand(999,99999)),0,9);
                        $hash_password = hashPassword($generated_password);
                        
                        
                        $query1 = "UPDATE `1948040_uais`.`users` SET `password`='".$hash_password."' WHERE `username`='".$username."' AND `email`='".$email_."'";
                        $query_run = mysql_query($query1);
                        
                        $m = mail($email_,'Password Reset','You are new Password is '.$generated_password.'','From:uais@uais.co.nf');
                        if($m){
                            $response[] = array("success"=>"success");
                        }else{
                            $response[] = array("success"=>"fail");
                        }
                       
                }
                print(json_encode($response));
        }
?>