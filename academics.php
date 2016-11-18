<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Academics</title>
<?php 
	include('config/config.php');
	include('config/functions.php');
	include('data/lecturerAssignedModule.php');
	include('data/studentCourseDuration.php');
	include('data/academicsData.php');
	
	include('header/head.php');
	include('header/header.php');
                
	if(logged_in()){
		//change year or semester if semester end
		$qys = "SELECT `semester_time`,`current_time_` FROM `1948040_uais`.`save_time` WHERE `date_`='".getAnyField('st_role','date_')."'";
		$rus = mysql_query($qys);
		$s_t = mysql_result($rus,0,'semester_time');
		$c_t = mysql_result($rus,0,'current_time_');
		$co_t = $s_t + $c_t;
		date_default_timezone_set('Africa/Nairobi');
		$cu_t = time();
		$_y_ = getAnyField('st_role','year');
		$_s_ = getAnyField('st_role','semester');
		$cse_du = $_cs_d_;
		
		changeSemesterOrYear($cu_t,$co_t,$_y_,$_s_,$cse_du);
		//end of change year or semester if semester end
		
		//delete sms on trash
		$qys_del = "SELECT `sms_time`,`current_time_` FROM `1948040_uais`.`sms_delete_time` WHERE `session_id`='".getField('id_no')."'";
		$r_del = mysql_query($qys_del);
		$sms_time = mysql_result($r_del,0,'sms_time');
		$current_tm = mysql_result($r_del,0,'current_time_');
		$total = $sms_time + $current_tm;
		
		if($total != 0){
			date_default_timezone_set('Africa/Nairobi');
			$cu_tm = time();
			if($cu_tm >= $total){
				$delt = "DELETE FROM `1948040_uais`.`".getField('id_no')."` WHERE `trash`='trash'";
				$update = "UPDATE `1948040_uais`.`sms_delete_time` SET `current_time_`='".$cu_tm."', `date_`='".date('d-m-Y')."' WHERE `session_id`='".getField('id_no')."'";
				$delt_r = mysql_query($delt);
				$update_r = mysql_query($update);
			}
		}
		//end of delete sms on trash
	}else{
		header('Location:login.php');
	}
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
		<li class="header">ACADEMICS MANAGEMENT</li>
        <li class="active treeview">
          <a href="academics.php"><i class="fa fa-book"></i> <span>Academic Materials</span></a>
        </li>
		<li class="treeview">
          <a href="compose.php"><i class="fa fa-envelope"></i> <span>Message</span></a>
        </li>
		<li class="header">PROFILE SETTINGS</li>
		<li class="treeview">
          <a href="profile.php"><i class="fa fa-user"></i> <span>Profile</span></a>
        </li>
		<li class="treeview">
          <a href="logout.php"><i class="fa fa-lock"></i> <span>Log Out</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Academic Materials<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="academics.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Academic Materials</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<!--error sms -->
			<div class="row">
				<div class="col-md-3"></div>
<?php 
	if((isset($error) && !empty($error)) || (isset($success) && !empty($success)) || (isset($message) && !empty($message))){
		if($error[0] == 'empty'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							You have two options. Either choose "File Uploader" or "Editor Uploader" to upload file
						</div>
					</div>';
		}
		if($error[1] == 'empty_t'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please write filename
						</div>
					</div>';
		}
		if($error[2] == 'empty_c'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please write content of the file
						</div>
					</div>';
		}
		if($error[3] == 'no_selected'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please select a module
						</div>
					</div>';
		}
		if($error[4] == 'no_selected'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please select a Year and Semester
						</div>
					</div>';
		}
		if($error[5] == 'nothing'){
			  echo '<div class="col-md-6">
						<div class="alert alert-info alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-info"></i> INFORMATION !</h4>
							Nothing Uploaded yet
						</div>
					</div>';
		}
		if($success == 'success'){
			echo '<div class="col-md-6">
						<div class="alert alert-success alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> SUCCESS !</h4>
							'.$count.' Uploaded Successfully
						</div>
					</div>';
		}
		if($success == 'fail'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Sorry something went wrong, please try again
						</div>
					</div>';
		}
		if($message[0] != ''){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							'.$message[0].'
						</div>
					</div>';
		}
		if($message[1] != ''){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							'.$message[1].' <br> Valid file formats are: ';
					foreach($info_ext as $i_){
						echo $i_.', ';
					}		
				echo	'</div>
					</div>';
		}
	}
?>
			</div>
			<!--end error-->
		<div class="row">
			<!--start of lecturer-->
<?php
	if(getField('status') == 'lecturer'){
	echo    '<div class="col-md-12">
			  <div class="nav-tabs-custom">
				<ul class="nav nav-tabs" id="myTab">
				  <li class="active"><a href="#academics_materials" data-toggle="tab" name="tab_l">Academic Uploads</a></li>
				  <li><a href="#assignments" data-toggle="tab" name="tab_l">Send Assignment</a></li>
				  <li><a href="#view_assignments" data-toggle="tab" name="tab_l">View Assignment</a></li>
				</ul>
				<div class="tab-content">
				  <div class="tab-pane active active_1" id="academics_materials">
						<form method="post" enctype="multipart/form-data">';
			if($count_ >=2){			
				echo	'<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control select2" name="module_title1" style="width: 100%;">';
							if(isset($_POST['module_title1']) && !empty($_POST['module_title1'])){		  
								echo  '<option selected="selected">'.$_POST['module_title1'].'</option>';
							}else{
								echo  '<option selected="selected" value="">Select a Module</option>';
							}
							if(isset($module_) && !empty($module_)){
								foreach($module_ as $_md){
									echo  '<option>'.$_md.'</option>';
								}
							}	
						echo		'</select>
								</div>
							</div>
						</div>';
			}	
			echo		   '<div class="row">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs" id="myTab_l_au">
										  <li class="active"><a href="#file_uploader" data-toggle="tab" name="tab_l_au">File Uploader</a></li>
										  <li><a href="#editor_uploader" data-toggle="tab" name="tab_l_au">Editor Uploader</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active active_1" id="file_uploader">
												<section id="new">
												  <h4 class="page-header"></h4>
												  <div class="row">
														<div class="col-xs-6">
															<div class="form-group">
																<div class="btn btn-default btn-file">
																  <i class="fa fa-file"></i> Choose files
																  <input type="file" name="file1[]" multiple="multiple" id="file_ct" onchange="countFileChosenInAcademicUploads()">
																</div>
																<p class="help-block" id="file_ct_txt"></p>
															</div>
														</div>
												  </div>
												</section>
											</div>
											
											<div class="tab-pane" id="editor_uploader">
												<section id="new">
												  <h4 class="page-header"></h4>
												  <div class="row">
														<div class="col-xs-6">
															<div class="form-group has-feedback">
																<input type="text" class="form-control" name="filename1" placeholder="write filename" value="'.$_POST['filename1'].'">
																<span class="glyphicon glyphicon-file form-control-feedback"></span>
															</div>
														</div>
												  </div>
												  <div class="row">
														<div class="box-body pad">
															<textarea class="editor1" name="editor1" rows="10" cols="80">
															'.$_POST['editor1'].'
															</textarea>
														</div>
												  </div>
												</section>
											</div>
											
										</div>
									</div>
								</div>
						    </div>
						  
						    <div class="row">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" name="au_tab" class="btn btn-primary">Upload</button>
									</div>
								</div>
						    </div>
						
						</form>
				  </div>
				  <div class="tab-pane" id="assignments">
						<form method="post" enctype="multipart/form-data">';
			if($count_ >=2){			
			echo		'<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control select2" name="module_title2" style="width: 100%;">';
							if(isset($_POST['module_title2']) && !empty($_POST['module_title2'])){		  
								echo  '<option selected="selected">'.$_POST['module_title2'].'</option>';
							}else{
								echo  '<option selected="selected" value="">Select a Module</option>';
							}
							if(isset($module_) && !empty($module_)){
								foreach($module_ as $_md){
									echo  '<option>'.$_md.'</option>';
								}
							}	
						echo		'</select>
								</div>
							</div>
						</div>';
			}			
				echo		'<div class="row">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs" id="myTab_l_sa">
										  <li class="active"><a href="#file_uploader_1" data-toggle="tab" name="tab_l_sa">File Uploader</a></li>
										  <li><a href="#editor_uploader_1" data-toggle="tab" name="tab_l_sa">Editor Uploader</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active active_1" id="file_uploader_1">
												<section id="new">
													<h4 class="page-header"></h4>
													<div class="row">
														<div class="col-xs-6">
															<div class="form-group">
																<div class="btn btn-default btn-file">
																  <i class="fa fa-file"></i> Choose files
																  <input type="file" name="file2[]" multiple="multiple" id="file_ct2" onchange="countFileChosenInAssignment()">
																</div>
																<p class="help-block" id="file_ct_txt2"></p>
															</div>
														</div>
													</div>
												</section>
											</div>
											
											<div class="tab-pane" id="editor_uploader_1">
												<section id="new">
													<h4 class="page-header"></h4>
													<div class="row">
														<div class="col-xs-6">
															<div class="form-group has-feedback">
																<input type="text" class="form-control" name="filename2" placeholder="write filename" value="'.$_POST['filename2'].'">
																<span class="glyphicon glyphicon-file form-control-feedback"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="box-body pad">
															<textarea class="editor2" name="editor2" rows="10" cols="80">'.$_POST['editor2'].'</textarea>
														</div>
													</div>
												</section>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
						    <div class="row">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" name="assignment_tab" class="btn btn-primary">Upload</button>
									</div>
								</div>
						    </div>
						
						</form>
				  </div>
				  <div class="tab-pane" id="view_assignments">';
		if($count_ >=2){			
			echo	'<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control select2" name="module_title" style="width: 100%;">';
							if(isset($_POST['module_title']) && !empty($_POST['module_title'])){		  
								echo  '<option selected="selected">'.$_POST['module_title'].'</option>';
							}else{
								echo  '<option selected="selected" value="">Select a Module</option>';
							}
							if(isset($module_) && !empty($module_)){
								foreach($module_ as $_md){
									echo  '<option>'.$_md.'</option>';
								}
							}	
						echo		'</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" name="va_show" class="btn btn-primary">Show</button>
									</div>
								</div>
							</div>
						</div>
					</form>';
			}
		if(isset($filename_) && !empty($filename_)){	
			echo	'<div class="box-body">
						<div class="table-responsive mailbox-messages">
							<table class="table table-hover table-striped tble">
							  <thead>
								<tr><th></th> <th></th> <th></th></tr>
							  </thead>
							  <tbody>';
				for($i=0;$i<count($_fn_);$i++){		  
					echo	  '<tr>
								<td class="mailbox-subject">'.$_fn_[$i].'</td>
								<td class="mailbox-subject">'.$time_l_1[$i].'</td>
								<td class="mailbox-name"><a href="download.php?folder=assignment&filename='.$_fn_[$i].'">Download</a></td>
							  </tr>';
				}	
				/*for($i=0;$i<count($_fn);$i++){		  
					echo	  '<tr>
								<td class="mailbox-subject">'.$_fn[$i].'</td>
								<td class="mailbox-subject">'.$time_l_[$i].'</td>
								<td class="mailbox-name"><a target="_blank" href="view.php?filename='.$_fn[$i].'&id='.$assign_pk_[$i].'&colname=assign_pk&tbl=assignment&lmt=lec_md_title">View</a></td>
							  </tr>';
				}*/
					echo	  '</tbody>
							</table>
						</div>
					</div>';
		}else if(count($filename_) == 0){
                        if($count_ ==1){
			echo	'<div class="box-body">
						<div class="table-responsive mailbox-messages">
							<table class="table table-hover table-striped tble">
							  <thead>
								<tr><th></th>  </tr>
							  </thead>
							  <tbody>';
								echo '<tr><td>Nothing uploaded yet</td>  </tr>';
					echo	  '</tbody>
							</table>
						</div>
					</div>';
                                        }
		}	
		echo	  '</div>
				</div>
			  </div>
			</div>';
	}
?>			
			<!--end of lecturer-->
			<!--start of student -->
<?php
	if(getField('status') == 'student'){
	echo	'<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs" id="myTab">
					  <li class="active"><a href="#academic_download" data-toggle="tab" name="tab">Academic Downloads</a></li>
					  <li><a href="#view_assignment" data-toggle="tab" name="tab">View Assignment</a></li>
					  <li><a href="#send_assignment" data-toggle="tab" name="tab">Send Assignment</a></li>
					</ul>
					<div class="tab-content">
					    <div class="tab-pane active" id="academic_download">
							
							<div class="row">
								<div class="col-md-2"></div>
								<form method="post">
								<div class="col-md-3">
									<div class="form-group">
										<select class="form-control select2" name="year_ad" style="width:100%;">';
								if(isset($_POST['year_ad']) && !empty($_POST['year_ad'])){
									echo  '<option selected="selected">'.$_POST['year_ad'].'</option>';
								}else{		
									echo  '<option selected="selected" value="">Select a Year</option>';
								}		  
									echo  '<option>First Year</option>
										  <option>Second Year</option>
										  <option>Third Year</option>';
								if($_cs_d_ == 'Four Year'){		  
									echo  '<option>Forth Year</option>';
								}	  
								echo	'</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<select class="form-control select2" name="semester_ad" style="width:100%;">';
								if(isset($_POST['semester_ad']) && !empty($_POST['semester_ad'])){
									echo  '<option selected="selected">'.$_POST['semester_ad'].'</option>';
								}else{		
									echo  '<option selected="selected" value="">Select a Semester</option>';
								}		  
									echo  '<option>First Semester</option>
										  <option>Second Semester</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">	
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" name="sac_show" class="btn btn-primary">Show</button>
										</div>
									</div>
								</div>
								</form>
							</div>';
			if(isset($filen_) && !empty($filen_)){				
					echo	'<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-9">
								  <div class="box box-solid">
									<div class="box-body">
									  <div class="box-group" id="accordion">';
					for($i=0;$i<count($mo_);$i++){
								echo	'<div class="panel box box-primary">
										  <div class="box-header with-border">
											<h4 class="box-title">
											  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_'.$i.'">'
												 .capitalFirstLetter($mo_[$i]).'
												
											  </a>
											</h4>
										  </div>
										  <div id="collapseOne_'.$i.'" class="panel-collapse collapse">
											<div class="box-body">
												<div class="table-responsive mailbox-messages">
													<table class="table table-hover table-striped tble">
													  <thead>
														<tr><th></th> <th></th> <th></th> </tr>
													  </thead>
													  <tbody>';
										/*for($j=0;$j<count($_filen_[$mo_[$i]]);$j++){	//&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-primary pull-right">13 new</span>		  
												echo	'<tr>
															<td>'.$_filen_[$mo_[$i]][$j].'</td> 
															<td>'.$_time_[$mo_[$i]][$j].'</td> 
															<td><a target="_blank" href="view.php?filename='.$_filen_[$mo_[$i]][$j].'&id='.$_notes_pk[$mo_[$i]][$j].'&colname=notes_pk&tbl=academic_notes&lmt=st_role">View </a></td>
														</tr>';
										}*/
										for($j=0;$j<count($_filen_1[$mo_[$i]]);$j++){			  
												echo	'<tr>
															<td>'.$_filen_1[$mo_[$i]][$j].'</td> 
															<td>'.$_time_1[$mo_[$i]][$j].'</td>
															<td><a href="download.php?folder=academic_notes&filename='.$_filen_1[$mo_[$i]][$j].'">Download </a></td>
														</tr>';
										}
											echo	   '</tbody>
													</table>
												</div>
											</div>
										  </div>
										</div>';
							
					}		
							echo	  '</div>
									  
									</div>
								  </div>
								</div>
							</div>';
			}		
				echo	'</div>
						<div class="tab-pane" id="view_assignment">
							
							<div class="row">
								<div class="col-md-2"></div>
								<form method="post">
								<div class="col-md-3">
									<div class="form-group">
										<select class="form-control select2" name="year_va" style="width:100%;">';
								if(isset($_POST['year_va']) && !empty($_POST['year_va'])){
									echo  '<option selected="selected">'.$_POST['year_va'].'</option>';
								}else{		
									echo  '<option selected="selected" value="">Select a Year</option>';
								}		  
									echo  '<option>First Year</option>
										  <option>Second Year</option>
										  <option>Third Year</option>';
								if($_cs_d_ == 'Four Year'){		  
									echo  '<option>Forth Year</option>';
								}	  
								echo	'</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<select class="form-control select2" name="semester_va" style="width:100%;">';
								if(isset($_POST['semester_va']) && !empty($_POST['semester_va'])){
									echo  '<option selected="selected">'.$_POST['semester_va'].'</option>';
								}else{		
									echo  '<option selected="selected" value="">Select a Semester</option>';
								}		  
									echo  '<option>First Semester</option>
										  <option>Second Semester</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">	
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" name="sva_show" class="btn btn-primary">Show</button>
										</div>
									</div>
								</div>
								</form>
							</div>';
			if(isset($filen_va) && !empty($filen_va)){				
					echo	'<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-9">
								  <div class="box box-solid">
									<div class="box-body">
									  <div class="box-group" id="accordion">';
					for($i=0;$i<count($mo_va);$i++){
								echo	'<div class="panel box box-primary">
										  <div class="box-header with-border">
											<h4 class="box-title">
											  <a data-toggle="collapse" data-parent="#accordion" href="#collapseAssign_'.$i.'">'
												 .capitalFirstLetter($mo_va[$i]).'
												
											  </a>
											</h4>
										  </div>
										  <div id="collapseAssign_'.$i.'" class="panel-collapse collapse">
											<div class="box-body">
												<div class="table-responsive mailbox-messages">
													<table class="table table-hover table-striped tble">
													  <thead>
														<tr><th></th> <th></th> <th></th> </tr>
													  </thead>
													  <tbody>';
										/*for($j=0;$j<count($_f_va[$mo_va[$i]]);$j++){	//&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-primary pull-right">13 new</span>		  
												echo	'<tr>
															<td>'.$_f_va[$mo_va[$i]][$j].'</td> 
															<td>'.$_tm_va[$mo_va[$i]][$j].'</td> 
															<td><a target="_blank" href="view.php?filename='.$_f_va[$mo_va[$i]][$j].'&id='.$_a_pk[$mo_va[$i]][$j].'&colname=assign_pk&tbl=assignment&lmt=st_role">View </a></td>
														</tr>';
										}*/
										for($j=0;$j<count($_f_1_va[$mo_va[$i]]);$j++){		  
												echo	'<tr>
															<td>'.$_f_1_va[$mo_va[$i]][$j].'</td> 
															<td>'.$_tm_va_1[$mo_va[$i]][$j].'</td>
															<td><a href="download.php?folder=assignment&filename='.$_f_1_va[$mo_va[$i]][$j].'">Download </a></td>
														</tr>';
										}
											echo	   '</tbody>
													</table>
												</div>
											</div>
										  </div>
										</div>';
							
					}		
							echo	  '</div>
									  
									</div>
								  </div>
								</div>
							</div>';
			}
							
				echo	'</div>
						<div class="tab-pane" id="send_assignment">
							<form method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-3">
									<div class="form-group">
										<select id="year" class="form-control select2" name="year_sa" style="width:100%;">';
								if(isset($_POST['year_sa']) && !empty($_POST['year_sa'])){
									echo  '<option selected="selected">'.$_POST['year_sa'].'</option>';
								}else{		
									echo  '<option selected="selected" value="">Select a Year</option>';
								}		  
									echo  '<option>First Year</option>
										  <option>Second Year</option>
										  <option>Third Year</option>';
								if($_cs_d_ == 'Four Year'){		  
									echo  '<option>Forth Year</option>';
								}	  
								echo	'</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<select id="semester" class="form-control select2" name="semester_sa" style="width:100%;">';
								if(isset($_POST['semester_sa']) && !empty($_POST['semester_sa'])){
									echo  '<option selected="selected">'.$_POST['semester_sa'].'</option>';
								}else{		
									echo  '<option selected="selected" value="">Select a Semester</option>';
								}		  
									echo  '<option>First Semester</option>
										  <option>Second Semester</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">	
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" name="ssa_show" class="btn btn-primary show_">Show</button>
										</div>
									</div>
								</div>
							</div>';
			if((isset($error) && !empty($error)) || isset($_POST['assign_response']) || (isset($success) && !empty($success)) || (isset($message) && !empty($message))){
				$y_sa = $_POST['year_sa'];
				$s_sa = $_POST['semester_sa'];
				$_cs_ = getAnyField('st_role','cs');
				$pg_ = getAnyField('st_role','programme');
				
				$qesa = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$_cs_."' AND `year`='".$y_sa."' AND `semester`='".$s_sa."' AND `programme`='".$pg_."'";
				$ri_sa = mysql_query($qesa);
				while($row = mysql_fetch_array($ri_sa)){
					$_mod_[] = $row['module'];
				}
			}							
					echo	'<div class="row hide_">
								<div class="col-md-5">
									<div class="form-group">
										<select class="form-control select2" name="module_title3" style="width: 100%;">';
								if(isset($_POST['module_title3']) && !empty($_POST['module_title3'])){
									echo  '<option selected="selected">'.$_POST['module_title3'].'</option>';
								}else{		
									echo  '<option selected="selected" value="">Select a Module</option>';
								}
						if(isset($_mod_) && !empty($_mod_)){
							foreach($_mod_ as $_md_){
									echo  '<option>'.$_md_.'</option>';
							}
						}			  
								echo	'</select>
									</div>
								</div>
							</div>
							
							<section id="new" class="hide_">
								<div class="row">
									<div class="col-md-12">
										<div class="nav-tabs-custom">
											<ul class="nav nav-tabs" id="myTab_1">
											  <li class="active"><a href="#file_uploader_2" data-toggle="tab" name="tab_1">File Uploader</a></li>
											  <li><a href="#editor_uploader_2" data-toggle="tab" name="tab_1">Editor Uploader</a></li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane active active_1" id="file_uploader_2">
													<h4 class="page-header"></h4>
													<div class="row">
														<div class="col-xs-6">
															<div class="form-group">
																<div class="btn btn-default btn-file">
																  <i class="fa fa-file"></i> Choose files
																  <input type="file" name="file3[]" multiple="multiple" id="file_ct2" onchange="countFileChosenInAssignment()">
																</div>
																<p class="help-block" id="file_ct_txt2"></p>
															</div>
														</div>
													</div>
												</div>
												
												<div class="tab-pane" id="editor_uploader_2">
													<h4 class="page-header"></h4>
													<div class="row">
														<div class="col-xs-6">
															<div class="form-group has-feedback">
																<input type="text" class="form-control" name="filename3" placeholder="write filename" value="'.$_POST['filename3'].'">
																<span class="glyphicon glyphicon-file form-control-feedback"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="box-body pad">
															<textarea class="editor3" name="editor3" rows="10" cols="80">'.$_POST['editor3'].'</textarea>
														</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
							    </div>
								
							    <div class="row">
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" name="assign_response" class="btn btn-primary">Upload</button>
										</div>
									</div>
							    </div>
								
							</section>
							
							</form>';
				echo	'</div>
					</div>
				</div>
			</div>';
	}
?>			
		</div>  <!--end of student-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
	include('footer/footer.php');
	include('footer/helpManual.php');
	
	if(getField('status') == "student"){
		include('footer/footerScript.php');
	}else if(getField('status') == "lecturer"){
		include('footer/footerScript_l.php');
	}
?>
