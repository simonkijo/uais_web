<?php
        $valid_formats = array("zip","ppt","pptx","doc","docx","xls","xlsx","pdf","rar","png","jpg","mp4","3gp");
        $max_file_size = 1024*(1024*1024*1024); // 1TB
        $path = "../uploads/assignment/"; // Upload directory
        
        // Loop $_FILES to execute all files
        foreach ($_FILES['files']['name'] as $f => $name) {
                if ($_FILES['files']['error'][$f] == 4) {
                        continue; // Skip file if any error found
                }
                if ($_FILES['files']['error'][$f] == 0) {	           
                        if ($_FILES['files']['size'][$f] > $max_file_size) {
                                $message[0] = "$name is too large!.";
                                continue; // Skip large files
                        }
                        elseif( !@in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $valid_formats) ){
                                $message[1] = "$name is not a valid format";
                                continue; // Skip invalid file formats
                        }
                        else{ // No error found! Move uploaded files
                                $name = preg_replace('/\s+/', '_', $name);
                               move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name);
                        }
                }
        }
?>