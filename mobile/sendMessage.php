<?php  
    include('../config/config.php');
	include('../config/functions.php');
        
        $table = $_POST['table'];
        $subject = $_POST['subject'];
        $sms = $_POST['message'];
        $to = $_POST['to'];
        $from = $_POST['from'];
        $reply = $_POST['reply'];
        $sender = $_POST['sender'];
        
        if(!empty($table) && !empty($subject) && !empty($sms) && !empty($to) && !empty($from) && !empty($reply) && !empty($sender)){
                date_default_timezone_set('Africa/Nairobi');
                $tim = date('H:i:s');
                $dat = date('d-m-Y');
                $g_id = idGenerator(); 
                
                $query = "INSERT INTO `1948040_uais`.`".$table."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$sms."','".$tim."','".$dat."','unread','untrash','','".$reply."','".$sender."')";
                $run = mysql_query($query);
                //insert into his/her own inbox for outbox
                $query_ot = "INSERT INTO `1948040_uais`.`".$reply."` VALUES('".$g_id."','".$to."','".$from."','".$subject."','".$sms."','".$tim."','".$dat."','unread','untrash','','".$reply."','".$sender."')";
                $run_ot = mysql_query($query_ot);
                
                if($run && $run_ot){
                     $response[] = array("success"=>"sent");   
                }else{
                     $response[] = array("success"=>"fail");
                }
                
        }
        print(json_encode($response));
        
?>