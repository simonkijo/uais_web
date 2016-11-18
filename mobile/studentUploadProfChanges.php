<?php  
        include('../config/config.php');
	include('../config/functions.php');
        
        $stId = $_POST['stId'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];
       
        if(!empty($stId) && !empty($phone) && !empty($email) && !empty($uname) && !empty($pwd)){
                $q_ch = "UPDATE `1948040_uais`.`users` SET `phone_no`='".$phone."', `email`='".$email."', `username`='".$uname."', `password`='".hashPassword($pwd)."' WHERE `id_no`='".$stId."'";
                $run_ch = mysql_query($q_ch);
                
                if($run_ch){
                        $query = "SELECT `fname`,`mname`,`sname`,`phone_no`,`email`,`gender`,`nationality`,`username` FROM `1948040_uais`.`users` WHERE `id_no`='".$stId."' ";
                        $run = mysql_query($query);
                        
                        while($row=mysql_fetch_assoc($run)){
                            $response[] = $row;    
                        }
                }
                
                print(json_encode($response));
                
        }
?>