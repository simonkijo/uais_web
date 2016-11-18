<?php
$ds          = DIRECTORY_SEPARATOR; 
 
$storeFolder = 'dist';   
$storeSubFolder = 'img';   
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                       
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds . $storeSubFolder . $ds;  
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  
 
    move_uploaded_file($tempFile,$targetFile); 
     
}
?>