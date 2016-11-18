<?php 
	//academic uploads lecturer
	if(isset($_POST['au_tab'])){
		if($count_ >=2){
			$mod_ = $_POST['module_title1'];
		}else if($count_ == 1){
			$mod_ = $module_[0];
		}
		
		$f_ = $_FILES['file1']['name'];
		$f_title = $_POST['filename1'];
		$f_content = $_POST['editor1'];
		$_c = 0;
		
		foreach($f_ as $_){
			if($_ ==''){
				$error_f = 'empty';
			}else{
				$_c += 1;
			}
		}
		if($f_title=='' && $f_content==''){
			$error_e = 'empty';
		}else if($f_title !='' && $f_content !=''){
			$content = 'content';
		}else if($f_title =='' && $f_content !=''){
			$error_e_t = 'empty_t';
		}else if($f_title !='' && $f_content ==''){
			$error_e_c = 'empty_c';
		}
		
		if($error_f =='empty' && $error_e =='empty'){
			$error[0] = 'empty';
			return $error;
		}else if($error_e_t == 'empty_t'){
			$error[1] = 'empty_t';
			return $error;
		}else if($error_e_c == 'empty_c'){
			$error[2] = 'empty_c';
			return $error;
		}else if($content !='' || $_c !=0){
			
			if($content !=''){
				if($mod_ ==''){
					$error[3] = 'no_selected';
					return $error;
				}else{
                                        //file convert to pdf and upload
					include("pdf/mpdf.php");
					$f_titlePDF = ''.preg_replace('/\s+/', '_', $f_title).'.pdf';
					
					$mpdf=new mPDF('utf-8','A4','','Times New Roman',20,5,10,10,5,10);  //mPDF('utf-8','A4-L','font-size','font-family',margin-left,margin-right,margin-top,margin-bottom,margin-header,margin-footer) units are in millimeter
					$html = '<html><head>
							<title>'.$f_titlePDF.'</title>
							</head><body>';
					$html .= ''.$f_content.'</body></html>';
					$mpdf->WriteHTML($html);
					$mpdf->Output('uploads/academic_notes/'.$f_titlePDF,'F');  //saves a file to server
					//end of convert to pdf and upload
                                        
					date_default_timezone_set('Africa/Nairobi');
					$date_ = date('d-m-Y');
					$programme = getAnyField('lec_md_title','programme');
					$q_ = "INSERT INTO `1948040_uais`.`academic_notes` VALUES('".idGenerator()."','".$f_titlePDF."','".$programme."','".$mod_."','','".$date_."')";
					$r_ = mysql_query($q_);
					
					if($r_){
						$success = 'success';
						unset($_POST['filename1']);
						unset($_POST['editor1']);
					}
				}
			}
			if($_c !=0){
				if($mod_ ==''){
					$error[3] = 'no_selected';
					return $error;
				}else{
					$valid_formats = array("zip","ppt","pptx","doc","docx","xls","xlsx","pdf","rar","png","jpg","mp4","3gp");
					$max_file_size = 1024*(1024*1024*1024); // 1TB
					$path = "uploads/academic_notes/"; // Upload directory
					$count = 0;
					// Loop $_FILES to execute all files
					foreach ($_FILES['file1']['name'] as $f => $name) {
						if ($_FILES['file1']['error'][$f] == 4) {
							continue; // Skip file if any error found
						}
						if ($_FILES['file1']['error'][$f] == 0) {	           
							if ($_FILES['file1']['size'][$f] > $max_file_size) {
								$message[0] = "$name is too large!.";
								continue; // Skip large files
							}
							elseif( !@in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $valid_formats) ){
								$message[1] = "$name is not a valid format";
								$info_ext = $valid_formats;
								continue; // Skip invalid file formats
							}
							else{ // No error found! Move uploaded files
                                                                $name = preg_replace('/\s+/', '_', $name);
								if(@move_uploaded_file($_FILES["file1"]["tmp_name"][$f], $path.$name)){
									$count++; // Number of successfully uploaded files
									date_default_timezone_set('Africa/Nairobi');
									$date_ = date('d-m-Y');
									$programme = getAnyField('lec_md_title','programme');
									$q_f = "INSERT INTO `1948040_uais`.`academic_notes` VALUES('".idGenerator()."','".$name."','".$programme."','".$mod_."','','".$date_."')";
									$r_f = mysql_query($q_f);
									
									if($r_f){
										$success = "success";
									}else{$success='fail';}
								}
							}
						}
					}	
				}
			}
		}
	}
	//end of academic uploads lecturer
	
	//send assignment lecturer
	if(isset($_POST['assignment_tab'])){
		if($count_ >=2){
			$mod_ = $_POST['module_title2'];
		}else if($count_ == 1){
			$mod_ = $module_[0];
		}
		
		$f_ = $_FILES['file2']['name'];
		$f_title = $_POST['filename2'];
		$f_content = $_POST['editor2'];
		$_c = 0;
		
		foreach($f_ as $_){
			if($_ ==''){
				$error_f = 'empty';
			}else{
				$_c += 1;
			}
		}
		if($f_title=='' && $f_content==''){
			$error_e = 'empty';
		}else if($f_title !='' && $f_content !=''){
			$content = 'content';
		}else if($f_title =='' && $f_content !=''){
			$error_e_t = 'empty_t';
		}else if($f_title !='' && $f_content ==''){
			$error_e_c = 'empty_c';
		}
		
		if($error_f =='empty' && $error_e =='empty'){
			$error[0] = 'empty';
			return $error;
		}else if($error_e_t == 'empty_t'){
			$error[1] = 'empty_t';
			return $error;
		}else if($error_e_c == 'empty_c'){
			$error[2] = 'empty_c';
			return $error;
		}else if($content !='' || $_c !=0){
			
			if($content !=''){
				if($mod_ ==''){
					$error[3] = 'no_selected';
					return $error;
				}else{
                                        //file convert to pdf and upload
					include("pdf/mpdf.php");
					$f_titlePDF = ''.preg_replace('/\s+/', '_', $f_title).'.pdf';
					
					$mpdf=new mPDF('utf-8','A4','','',20,5,10,10,5,10);  //mPDF('utf-8','A4-L','font-size','font-family',margin-left,margin-right,margin-top,margin-bottom,margin-header,margin-footer) units are in millimeter
					$html = '<html><head>
							<title>'.$f_titlePDF.'</title>
							</head><body>';
					$html .= ''.$f_content.'</body></html>';
					$mpdf->WriteHTML($html);
					$mpdf->Output('uploads/assignment/'.$f_titlePDF,'F');  //saves a file to server
					//end of convert to pdf and upload
                                        
					date_default_timezone_set('Africa/Nairobi');
					$date_ = date('d-m-Y');
					$programme = getAnyField('lec_md_title','programme');
					$q_ = "INSERT INTO `1948040_uais`.`assignment` VALUES('".idGenerator()."','".$f_titlePDF."','".$programme."','".$mod_."','','lecturer','".$date_."')";
					$r_ = mysql_query($q_);
					
					if($r_){
						$success = 'success';
						unset($_POST['filename2']);
						unset($_POST['editor2']);
					}
				}
			}
			if($_c !=0){
				if($mod_ ==''){
					$error[3] = 'no_selected';
					return $error;
				}else{
					$valid_formats = array("zip","ppt","pptx","doc","docx","xls","xlsx","pdf","rar","png","jpg","mp4","3gp");
					$max_file_size = 1024*(1024*1024*1024); // 1TB
					$path = "uploads/assignment/"; // Upload directory
					$count = 0;
					
					// Loop $_FILES to execute all files
					foreach ($_FILES['file2']['name'] as $f => $name) {
						if ($_FILES['file2']['error'][$f] == 4) {
							continue; // Skip file if any error found
						}
						if ($_FILES['file2']['error'][$f] == 0) {	           
							if ($_FILES['file2']['size'][$f] > $max_file_size) {
								$message[0] = "$name is too large!.";
								continue; // Skip large files
							}
							elseif( !@in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $valid_formats) ){
								$message[1] = "$name is not a valid format";
								$info_ext = $valid_formats;
								continue; // Skip invalid file formats
							}
							else{ // No error found! Move uploaded files
                                                                $name = preg_replace('/\s+/', '_', $name);
								if(@move_uploaded_file($_FILES["file2"]["tmp_name"][$f], $path.$name)){
									$count++; // Number of successfully uploaded files
									date_default_timezone_set('Africa/Nairobi');
									$date_ = date('d-m-Y');
									$programme = getAnyField('lec_md_title','programme');
									$q_f = "INSERT INTO `1948040_uais`.`assignment` VALUES('".idGenerator()."','".$name."','".$programme."','".$mod_."','','lecturer','".$date_."')";
									$r_f = mysql_query($q_f);
									
									if($r_f){
										$success = "success";
									}else{$success='fail';}
								}
							}
						}
					}
					
				}
			}
		}
		
	}
	//end of send assignment lecturer
	//view assignment lecturer
	if($count_ >=2){
		if(isset($_POST['va_show'])){
			$mod_ = $_POST['module_title'];
			$programme = getAnyField('lec_md_title','programme');
			$sender = "student";
			
			if($mod_ == ''){
				$error[3] = 'no_selected';
				return $error;
			}else{
				$qr_ = "SELECT `assign_pk`,`filename`,`content_notes`,`time_` FROM `1948040_uais`.`assignment` WHERE `programme`='".$programme."' AND `module`='".$mod_."' AND `sender`='".$sender."' ORDER BY `time_` DESC";
				$rn_ = mysql_query($qr_);
				while($row = mysql_fetch_array($rn_)){
					$filename_[] = $row['filename'];
					$content_notes_[] = $row['content_notes'];
					$assign_pk[] = $row['assign_pk'];
					$time_l[] = $row['time_'];
				}
				if(count($filename_) == 0){
					$error[5] = 'nothing';
					return $error;
				}else{
					for($i=0;$i<count($content_notes_);$i++){
						if($content_notes_[$i] !=''){
							$c_notes[] = $content_notes_[$i];
							$_fn[] = $filename_[$i];
							$assign_pk_[] = $assign_pk[$i];
							$time_l_[] = $time_l[$i];
						}else{
							$_fn_[] = $filename_[$i];
							$time_l_1[] = $time_l[$i];
						}
					}
				}
			}
		}
	}else if($count_ == 1){
		$mod_ = $module_[0];
		$programme = getAnyField('lec_md_title','programme');
		$sender = "student";
		
		$qr_1 = "SELECT `assign_pk`,`filename`,`content_notes`,`time_` FROM `1948040_uais`.`assignment` WHERE `programme`='".$programme."' AND `module`='".$mod_."' AND `sender`='".$sender."' ORDER BY `time_` DESC";
		$rn_1 = mysql_query($qr_1);
		while($row = mysql_fetch_array($rn_1)){
			$filename_[] = $row['filename'];
			$content_notes_[] = $row['content_notes'];
			$assign_pk[] = $row['assign_pk'];
			$time_l[] = $row['time_'];
		}
		/*if(count($filename_) == 0){
			$error[5] = 'nothing';
			return $error;
		}else{*/
			for($i=0;$i<count($content_notes_);$i++){
				if($content_notes_[$i] !=''){
					$c_notes[] = $content_notes_[$i];
					$_fn[] = $filename_[$i];
					$assign_pk_[] = $assign_pk[$i];
					$time_l_[] = $time_l[$i];
				}else{
					$_fn_[] = $filename_[$i];
					$time_l_1[] = $time_l[$i];
				}
			}
		//}
	}
	//end of view assignment lecturer
	
	//academic download student
	if(isset($_POST['sac_show'])){
		$y_ad = $_POST['year_ad'];
		$s_ad = $_POST['semester_ad'];
		$_cs_ = getAnyField('st_role','cs');
		$pg_ = getAnyField('st_role','programme');
		
		if($y_ad=='' || $s_ad==''){
			$error[4] = 'no_selected';
			return $error;
		}else{
			$qe = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$_cs_."' AND `year`='".$y_ad."' AND `semester`='".$s_ad."' AND `programme`='".$pg_."'";
			$ri_ = mysql_query($qe);
			while($row = mysql_fetch_array($ri_)){
				$mo_[] = $row['module'];
			}
			
			for($i=0;$i<count($mo_);$i++){
				$qey_ = "SELECT `notes_pk`,`filename`,`content_notes`,`module`,`time_` FROM `1948040_uais`.`academic_notes` WHERE `module`='".$mo_[$i]."' ORDER BY `time_` DESC";
				$run_ = mysql_query($qey_);
				while($row = mysql_fetch_array($run_)){
					$filen_[$mo_[$i]][] = $row['filename'];
					$cont_[$mo_[$i]][] = $row['content_notes'];
					$notes_pk[$mo_[$i]][] = $row['notes_pk'];
					$modul_[$mo_[$i]][] = $row['module'];
					$_time[$mo_[$i]][] = $row['time_'];
				}
			}
			if(count($filen_) == 0){
				$error[5] = 'nothing';
				return $error;
			}else{
				for($j=0;$j<count($mo_);$j++){
					for($i=0;$i<count($cont_[$mo_[$j]]);$i++){
						if($cont_[$mo_[$j]][$i] != ''){
							$_filen_[$mo_[$j]][] = $filen_[$mo_[$j]][$i];
							$_notes_pk[$mo_[$j]][] = $notes_pk[$mo_[$j]][$i];
							$_modul_[$mo_[$j]][] = $modul_[$mo_[$j]][$i];
							$_time_[$mo_[$j]][] = $_time[$mo_[$j]][$i];
						}else{
							$_filen_1[$mo_[$j]][] = $filen_[$mo_[$j]][$i];
							$_modul_1[$mo_[$j]][] = $modul_[$mo_[$j]][$i];
							$_time_1[$mo_[$j]][] = $_time[$mo_[$j]][$i];
						}
					}
				}
				
			}
		}
	}
	//end of academic download
	//view assignment student
	if(isset($_POST['sva_show'])){
		$y_va = $_POST['year_va'];
		$s_va = $_POST['semester_va'];
		$_cs_ = getAnyField('st_role','cs');
		$pg_ = getAnyField('st_role','programme');
		
		if($y_va=='' || $s_va==''){
			$error[4] = 'no_selected';
			return $error;
		}else{
			$qeva = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$_cs_."' AND `year`='".$y_va."' AND `semester`='".$s_va."' AND `programme`='".$pg_."'";
			$ri_va = mysql_query($qeva);
			while($row = mysql_fetch_array($ri_va)){
				$mo_va[] = $row['module'];
			}
			
			for($i=0;$i<count($mo_va);$i++){
				$qey_va = "SELECT `assign_pk`,`filename`,`content_notes`,`module`,`time_` FROM `1948040_uais`.`assignment` WHERE `module`='".$mo_va[$i]."' AND `sender`='lecturer' ORDER BY `time_` DESC";
				$run_va = mysql_query($qey_va);
				$c_ = mysql_num_rows($run_va);
				while($row = mysql_fetch_array($run_va)){
					$filen_va[$mo_va[$i]][] = $row['filename'];
					$cont_va[$mo_va[$i]][] = $row['content_notes'];
					$assign_pk[$mo_va[$i]][] = $row['assign_pk'];
					$modul_va[$mo_va[$i]][] = $row['module'];
					$_time_va[$mo_va[$i]][] = $row['time_'];
				}
			}
			if(count($filen_va) == 0){
				$error[5] = 'nothing';
				return $error;
			}else{
				for($j=0;$j<count($mo_va);$j++){
					for($i=0;$i<count($cont_va[$mo_va[$j]]);$i++){
						if($cont_va[$mo_va[$j]][$i] != ''){
							$_f_va[$mo_va[$j]][] = $filen_va[$mo_va[$j]][$i];
							$_a_pk[$mo_va[$j]][] = $assign_pk[$mo_va[$j]][$i];
							$_m_va[$mo_va[$j]][] = $modul_va[$mo_va[$j]][$i];
							$_tm_va[$mo_va[$j]][] = $_time_va[$mo_va[$j]][$i];
						}else{
							$_f_1_va[$mo_va[$j]][] = $filen_va[$mo_va[$j]][$i];
							$_m_1_va[$mo_va[$j]][] = $modul_va[$mo_va[$j]][$i];
							$_tm_va_1[$mo_va[$j]][] = $_time_va[$mo_va[$j]][$i];
						}
					}
				}
			}
		}
	}
	//end of view assignment student
	//send assignment student
	if(isset($_POST['ssa_show'])){
		$y_sa = $_POST['year_sa'];
		$s_sa = $_POST['semester_sa'];
		$_cs_ = getAnyField('st_role','cs');
		$pg_ = getAnyField('st_role','programme');
		
		if($y_sa=='' || $s_sa==''){
			$error[4] = 'no_selected';
			return $error;
		}else{
			$qesa = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$_cs_."' AND `year`='".$y_sa."' AND `semester`='".$s_sa."' AND `programme`='".$pg_."'";
			$ri_sa = mysql_query($qesa);
			while($row = mysql_fetch_array($ri_sa)){
				$_mod_[] = $row['module'];
			}
		}
	}
	if(isset($_POST['assign_response'])){
		$mod_ = $_POST['module_title3'];
		
		$f_ = $_FILES['file3']['name'];
		$f_title = $_POST['filename3'];
		$f_content = $_POST['editor3'];
		$_c = 0;
		
		foreach($f_ as $_){
			if($_ ==''){
				$error_f = 'empty';
			}else{
				$_c += 1;
			}
		}
		
		if($f_title=='' && $f_content==''){
			$error_e = 'empty';
		}else if($f_title !='' && $f_content !=''){
			$content = 'content';
		}else if($f_title =='' && $f_content !=''){
			$error_e_t = 'empty_t';
		}else if($f_title !='' && $f_content ==''){
			$error_e_c = 'empty_c';
		}
		
		if($error_f =='empty' && $error_e =='empty'){
			$error[0] = 'empty';
			return $error;
		}else if($error_e_t == 'empty_t'){
			$error[1] = 'empty_t';
			return $error;
		}else if($error_e_c == 'empty_c'){
			$error[2] = 'empty_c';
			return $error;
		}else if($content !='' || $_c !=0){
			
			if($content !=''){
				if($mod_ ==''){
					$error[3] = 'no_selected';
					return $error;
				}else{
                                        //file convert to pdf and upload
					include("pdf/mpdf.php");
					$f_titlePDF = ''.preg_replace('/\s+/', '_', $f_title).'.pdf';
					
					$mpdf=new mPDF('utf-8','A4','','',20,5,10,10,5,10);  //mPDF('utf-8','A4-L','font-size','font-family',margin-left,margin-right,margin-top,margin-bottom,margin-header,margin-footer) units are in millimeter
					$html = '<html><head>
							<title>'.$f_titlePDF.'</title>
							</head><body>';
					$html .= ''.$f_content.'</body></html>';
					$mpdf->WriteHTML($html);
					$mpdf->Output('uploads/assignment/'.$f_titlePDF,'F');  //saves a file to server
					//end of convert to pdf and upload
                                        
					date_default_timezone_set('Africa/Nairobi');
					$date_ = date('d-m-Y');
					$programme = getAnyField('st_role','programme');
					$q_ = "INSERT INTO `1948040_uais`.`assignment` VALUES('".idGenerator()."','".$f_titlePDF."','".$programme."','".$mod_."','','student','".$date_."')";
					$r_ = mysql_query($q_);
					
					if($r_){
						$success = 'success';
						unset($_POST['filename3']);
						unset($_POST['editor3']);
					}
				}
			}
			if($_c !=0){
				if($mod_ ==''){
					$error[3] = 'no_selected';
					return $error;
				}else{
					$valid_formats = array("zip","ppt","pptx","doc","docx","xls","xlsx","pdf","rar","png","jpg","mp4","3gp");
					$max_file_size = 1024*(1024*1024*1024); // 1TB
					$path = "uploads/assignment/"; // Upload directory
					$count = 0;
					// Loop $_FILES to execute all files
					foreach ($_FILES['file3']['name'] as $f => $name) {
						if ($_FILES['file3']['error'][$f] == 4) {
							continue; // Skip file if any error found
						}
						if ($_FILES['file3']['error'][$f] == 0) {	           
							if ($_FILES['file3']['size'][$f] > $max_file_size) {
								$message[0] = "$name is too large!.";
								continue; // Skip large files
							}
							elseif( !@in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $valid_formats) ){
								$message[1] = "$name is not a valid format";
								$info_ext = $valid_formats;
								continue; // Skip invalid file formats
							}
							else{ // No error found! Move uploaded files
                                                                $name = preg_replace('/\s+/', '_', $name);
								if(@move_uploaded_file($_FILES["file3"]["tmp_name"][$f], $path.$name)){
									$count++; // Number of successfully uploaded files
									date_default_timezone_set('Africa/Nairobi');
									$date_ = date('d-m-Y');
									$programme = getAnyField('st_role','programme');
									$q_f = "INSERT INTO `1948040_uais`.`assignment` VALUES('".idGenerator()."','".$name."','".$programme."','".$mod_."','','student','".$date_."')";
									$r_f = mysql_query($q_f);
									
									if($r_f){
										$success = "success";
									}else{$success='fail';}
								}
							}
						}
					}	
				}
			}
		}
		
	}
	//end of send assignment student
?>