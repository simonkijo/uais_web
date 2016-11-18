<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Admin</title>
<?php
	include('config/config.php');
	include('config/functions.php');
	include('data/loadCourseBachelor.php');
	include('data/loadModule.php');
	include('data/saveLecturer.php');
	
	include('header/head.php');
	include('header/adminHeader.php');
	
	if(logged_in()){
		
	}else{
		header('Location:login.php');
	}
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
		<li class="header">ACADEMICS MANAGEMENT</li>
		<li class="treeview">
			<a href="#"><i class="fa fa-book"></i> <span>Academic Programme</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li><a href="#"><i class="fa fa-circle-o"></i>Bachelor Degree <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
					<ul class="treeview-menu">
						<li><a href="adminCourseBachelor.php"><i class="fa fa-circle-o"></i> Course</a></li>
						<li><a href="adminModuleBachelor.php"><i class="fa fa-circle-o"></i> Module</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-circle-o"></i>Ordinary Diploma <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
					<ul class="treeview-menu">
						<li><a href="adminCourseDiploma.php"><i class="fa fa-circle-o"></i> Course</a></li>
						<li><a href="adminModuleDiploma.php"><i class="fa fa-circle-o"></i> Module</a></li>
					</ul>
				</li>
			</ul>
		</li>
        <li class="active treeview">
			<a href="#"><i class="fa fa-book"></i> <span>Lecturer Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li class="active"><a href="adminLecturerBachelor.php"><i class="fa fa-circle-o"></i>Bachelor Degree</a></li>
				<li><a href="adminLecturerDiploma.php"><i class="fa fa-circle-o"></i>Ordinary Diploma</a></li>
			</ul>
		</li>
		<li class="treeview">
			<a href="#"><i class="fa fa-book"></i> <span>Student Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li><a href="adminStudentBachelor.php"><i class="fa fa-circle-o"></i>Bachelor Degree</a></li>
				<li><a href="adminStudentDiploma.php"><i class="fa fa-circle-o"></i>Ordinary Diploma</a></li>
			</ul>
		</li>
		<li class="header">PROFILE SETTINGS</li>
		<li class="treeview">
          <a href="adminProfile.php"><i class="fa fa-user"></i> <span>Profile</span></a>
        </li>
		<li class="treeview">
          <a href="imageUpload.php"><i class="fa fa-file"></i> <span>Image Upload</span></a>
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
      <h1>Bachelor Degree<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="adminCourseBachelor.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bachelor Degree</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
			    <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Lecturers</h3>
					</div>
					<!--error sms -->
					<div class="row">
						<div class="col-md-3"></div>
<?php 
			if((isset($error) && !empty($error)) || (isset($success) && !empty($success))){
				if($error[2] == 'no_selection'){
					echo '<div class="col-md-6">
								<div class="alert alert-danger alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
									Please select a course
								</div>
							</div>';
				}
				if($error[0] == 'empty'){
					  echo '<div class="col-md-6">
								<div class="alert alert-danger alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
									Please fill the fields
								</div>
							</div>';
				}else if($error[1] == 'invalid'){
					  echo '<div class="col-md-6">
								<div class="alert alert-danger alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
									Alphabetical Letters Only and No Space
								</div>
							</div>';
				}
				if($success == 'success'){
					echo '<div class="col-md-6">
								<div class="alert alert-success alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> SUCCESS !</h4>
									Saved Successfully
								</div>
							</div>';
				}
				if($success == 'fail'){
					echo '<div class="col-md-6">
								<div class="alert alert-danger alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
									Sorry something went wrong, Please try again
								</div>
							</div>';
				}
			}
?>
					</div>
					<!--end error-->
					<!-- course table-->
					<form method="post">
						<div class="row" style="margin-left:5%;margin-top:1%;">
							<div class="col-md-5">
								<div class="form-group">
									<select class="form-control select2" name="course" style="width:100%;">
					<?php
							if(isset($_POST['course']) && !empty($_POST['course'])){
								echo '<option selected="selected">'.$_POST['course'].'</option>';
							}else{
								echo '<option selected="selected" value="">Select a Course</option>';
							}
							if(isset($course) && !empty($course)){
								foreach($course as $c){
									echo '<option>'.$c.'</option>';
								}
							}
					?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" name="lec_show_b" class="btn btn-primary">Show</button>
									</div>
								</div>
							</div>
						</div>
<?php
		if((isset($md) && !empty($md)) || ($error[0] !='' || $error[1] != '')){
				if($error[0] !='' || $error[1] != ''){
					$cs_ = $_POST['course'];
					$query = "SELECT `module` FROM `1948040_uais`.`module` WHERE `cs`='".$cs_."'";
					$run = mysql_query($query);
					while($row = mysql_fetch_array($run)){
						$md[] = $row['module'];
					}
				}
				echo	'<div class="row" style="margin:1%;">
							<div class="col-md-12">
								<table class="table table-hover tble_admin_">
								  <thead>
									<tr><th>First Name</th> <th>Middle Name</th> <th>Surname</th><th>Module Title</th><th>Title</th></tr>
								  </thead>
								  <tbody>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][0].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][0].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][0].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_0[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_0']) && !empty($_POST['md_title_0'])){
											foreach($_POST['md_title_0'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][0]) && !empty($_POST['title'][0])){
												echo '<option selected="selected">'.$_POST['title'][0].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][1].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][1].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][1].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_1[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_1']) && !empty($_POST['md_title_1'])){
											foreach($_POST['md_title_1'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][1]) && !empty($_POST['title'][1])){
												echo '<option selected="selected">'.$_POST['title'][1].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][2].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][2].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][2].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_2[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_2']) && !empty($_POST['md_title_2'])){
											foreach($_POST['md_title_2'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][2]) && !empty($_POST['title'][2])){
												echo '<option selected="selected">'.$_POST['title'][2].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][3].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][3].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][3].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_3[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_3']) && !empty($_POST['md_title_3'])){
											foreach($_POST['md_title_3'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][3]) && !empty($_POST['title'][3])){
												echo '<option selected="selected">'.$_POST['title'][3].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][4].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][4].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][4].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_4[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_4']) && !empty($_POST['md_title_4'])){
											foreach($_POST['md_title_4'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][4]) && !empty($_POST['title'][4])){
												echo '<option selected="selected">'.$_POST['title'][4].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][5].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][5].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][5].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_5[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_5']) && !empty($_POST['md_title_5'])){
											foreach($_POST['md_title_5'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][5]) && !empty($_POST['title'][5])){
												echo '<option selected="selected">'.$_POST['title'][5].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][6].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][6].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][6].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_6[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_6']) && !empty($_POST['md_title_6'])){
											foreach($_POST['md_title_6'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][6]) && !empty($_POST['title'][6])){
												echo '<option selected="selected">'.$_POST['title'][6].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][7].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][7].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][7].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_7[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_7']) && !empty($_POST['md_title_7'])){
											foreach($_POST['md_title_7'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][7]) && !empty($_POST['title'][7])){
												echo '<option selected="selected">'.$_POST['title'][7].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][8].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][8].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][8].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_8[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_8']) && !empty($_POST['md_title_8'])){
											foreach($_POST['md_title_8'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][8]) && !empty($_POST['title'][8])){
												echo '<option selected="selected">'.$_POST['title'][8].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][9].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][9].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][9].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_9[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_9']) && !empty($_POST['md_title_9'])){
											foreach($_POST['md_title_9'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][9]) && !empty($_POST['title'][9])){
												echo '<option selected="selected">'.$_POST['title'][9].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][10].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][10].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][10].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_10[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_10']) && !empty($_POST['md_title_10'])){
											foreach($_POST['md_title_10'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][10]) && !empty($_POST['title'][10])){
												echo '<option selected="selected">'.$_POST['title'][10].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][11].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][11].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][11].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_11[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_11']) && !empty($_POST['md_title_11'])){
											foreach($_POST['md_title_11'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][11]) && !empty($_POST['title'][11])){
												echo '<option selected="selected">'.$_POST['title'][11].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][12].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][12].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][12].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_12[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_12']) && !empty($_POST['md_title_12'])){
											foreach($_POST['md_title_12'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][12]) && !empty($_POST['title'][12])){
												echo '<option selected="selected">'.$_POST['title'][12].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][13].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][13].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][13].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_13[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_13']) && !empty($_POST['md_title_13'])){
											foreach($_POST['md_title_13'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][13]) && !empty($_POST['title'][13])){
												echo '<option selected="selected">'.$_POST['title'][13].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][14].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][14].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][14].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_14[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_14']) && !empty($_POST['md_title_14'])){
											foreach($_POST['md_title_14'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][14]) && !empty($_POST['title'][14])){
												echo '<option selected="selected">'.$_POST['title'][14].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][15].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][15].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][15].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_15[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_15']) && !empty($_POST['md_title_15'])){
											foreach($_POST['md_title_15'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][15]) && !empty($_POST['title'][15])){
												echo '<option selected="selected">'.$_POST['title'][15].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][16].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][16].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][16].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_16[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_16']) && !empty($_POST['md_title_16'])){
											foreach($_POST['md_title_16'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][16]) && !empty($_POST['title'][16])){
												echo '<option selected="selected">'.$_POST['title'][16].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][17].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][17].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][17].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_17[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_17']) && !empty($_POST['md_title_17'])){
											foreach($_POST['md_title_17'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][17]) && !empty($_POST['title'][17])){
												echo '<option selected="selected">'.$_POST['title'][17].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][18].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][18].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][18].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_18[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_18']) && !empty($_POST['md_title_18'])){
											foreach($_POST['md_title_18'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][18]) && !empty($_POST['title'][18])){
												echo '<option selected="selected">'.$_POST['title'][18].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][19].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][19].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][19].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_19[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_19']) && !empty($_POST['md_title_19'])){
											foreach($_POST['md_title_19'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][19]) && !empty($_POST['title'][19])){
												echo '<option selected="selected">'.$_POST['title'][19].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][20].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][20].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][20].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_20[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_20']) && !empty($_POST['md_title_20'])){
											foreach($_POST['md_title_20'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][20]) && !empty($_POST['title'][20])){
												echo '<option selected="selected">'.$_POST['title'][20].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][21].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][21].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][21].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_21[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_21']) && !empty($_POST['md_title_21'])){
											foreach($_POST['md_title_21'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][21]) && !empty($_POST['title'][21])){
												echo '<option selected="selected">'.$_POST['title'][21].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][22].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][22].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][22].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_22[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_22']) && !empty($_POST['md_title_22'])){
											foreach($_POST['md_title_22'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][22]) && !empty($_POST['title'][22])){
												echo '<option selected="selected">'.$_POST['title'][22].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][23].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][23].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][23].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_23[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_23']) && !empty($_POST['md_title_23'])){
											foreach($_POST['md_title_23'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][23]) && !empty($_POST['title'][23])){
												echo '<option selected="selected">'.$_POST['title'][23].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][24].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][24].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][24].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_24[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_24']) && !empty($_POST['md_title_24'])){
											foreach($_POST['md_title_24'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][24]) && !empty($_POST['title'][24])){
												echo '<option selected="selected">'.$_POST['title'][24].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][25].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][25].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][25].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_25[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_25']) && !empty($_POST['md_title_25'])){
											foreach($_POST['md_title_25'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][25]) && !empty($_POST['title'][25])){
												echo '<option selected="selected">'.$_POST['title'][25].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][26].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][26].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][26].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_26[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_26']) && !empty($_POST['md_title_26'])){
											foreach($_POST['md_title_26'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][26]) && !empty($_POST['title'][26])){
												echo '<option selected="selected">'.$_POST['title'][26].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][27].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][27].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][27].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_27[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_27']) && !empty($_POST['md_title_27'])){
											foreach($_POST['md_title_27'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][27]) && !empty($_POST['title'][27])){
												echo '<option selected="selected">'.$_POST['title'][27].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][28].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][28].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][28].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_28[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_28']) && !empty($_POST['md_title_28'])){
											foreach($_POST['md_title_28'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][28]) && !empty($_POST['title'][28])){
												echo '<option selected="selected">'.$_POST['title'][28].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][29].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][29].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][29].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_29[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_29']) && !empty($_POST['md_title_29'])){
											foreach($_POST['md_title_29'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][29]) && !empty($_POST['title'][29])){
												echo '<option selected="selected">'.$_POST['title'][29].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][30].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][30].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][30].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_30[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_30']) && !empty($_POST['md_title_30'])){
											foreach($_POST['md_title_30'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][30]) && !empty($_POST['title'][30])){
												echo '<option selected="selected">'.$_POST['title'][30].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][31].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][31].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][31].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_31[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_31']) && !empty($_POST['md_title_31'])){
											foreach($_POST['md_title_31'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][31]) && !empty($_POST['title'][31])){
												echo '<option selected="selected">'.$_POST['title'][31].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][32].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][32].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][32].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_32[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_32']) && !empty($_POST['md_title_32'])){
											foreach($_POST['md_title_32'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][32]) && !empty($_POST['title'][32])){
												echo '<option selected="selected">'.$_POST['title'][32].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][33].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][33].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][33].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_33[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_33']) && !empty($_POST['md_title_33'])){
											foreach($_POST['md_title_33'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][33]) && !empty($_POST['title'][33])){
												echo '<option selected="selected">'.$_POST['title'][33].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][34].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][34].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][34].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_34[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_34']) && !empty($_POST['md_title_34'])){
											foreach($_POST['md_title_34'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][34]) && !empty($_POST['title'][34])){
												echo '<option selected="selected">'.$_POST['title'][34].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][35].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][35].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][35].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_35[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_35']) && !empty($_POST['md_title_35'])){
											foreach($_POST['md_title_35'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][35]) && !empty($_POST['title'][35])){
												echo '<option selected="selected">'.$_POST['title'][35].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][36].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][36].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][36].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_36[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_36']) && !empty($_POST['md_title_36'])){
											foreach($_POST['md_title_36'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][36]) && !empty($_POST['title'][36])){
												echo '<option selected="selected">'.$_POST['title'][36].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][37].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][37].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][37].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_37[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_37']) && !empty($_POST['md_title_37'])){
											foreach($_POST['md_title_37'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][37]) && !empty($_POST['title'][37])){
												echo '<option selected="selected">'.$_POST['title'][37].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][38].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][38].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][38].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_38[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_38']) && !empty($_POST['md_title_38'])){
											foreach($_POST['md_title_38'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][38]) && !empty($_POST['title'][38])){
												echo '<option selected="selected">'.$_POST['title'][38].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][39].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][39].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][39].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_39[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_39']) && !empty($_POST['md_title_39'])){
											foreach($_POST['md_title_39'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][39]) && !empty($_POST['title'][39])){
												echo '<option selected="selected">'.$_POST['title'][39].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][40].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][40].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][40].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_40[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_40']) && !empty($_POST['md_title_40'])){
											foreach($_POST['md_title_40'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][40]) && !empty($_POST['title'][40])){
												echo '<option selected="selected">'.$_POST['title'][40].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][41].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][41].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][41].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_41[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_41']) && !empty($_POST['md_title_41'])){
											foreach($_POST['md_title_41'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][41]) && !empty($_POST['title'][41])){
												echo '<option selected="selected">'.$_POST['title'][41].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][42].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][42].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][42].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_42[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_42']) && !empty($_POST['md_title_42'])){
											foreach($_POST['md_title_42'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][42]) && !empty($_POST['title'][42])){
												echo '<option selected="selected">'.$_POST['title'][42].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][43].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][43].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][43].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_43[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_43']) && !empty($_POST['md_title_43'])){
											foreach($_POST['md_title_43'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][43]) && !empty($_POST['title'][43])){
												echo '<option selected="selected">'.$_POST['title'][43].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][44].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][44].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][44].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_44[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_44']) && !empty($_POST['md_title_44'])){
											foreach($_POST['md_title_44'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][44]) && !empty($_POST['title'][44])){
												echo '<option selected="selected">'.$_POST['title'][44].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][45].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][45].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][45].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_45[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_45']) && !empty($_POST['md_title_45'])){
											foreach($_POST['md_title_45'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][45]) && !empty($_POST['title'][45])){
												echo '<option selected="selected">'.$_POST['title'][45].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][46].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][46].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][46].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_46[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_46']) && !empty($_POST['md_title_46'])){
											foreach($_POST['md_title_46'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][46]) && !empty($_POST['title'][46])){
												echo '<option selected="selected">'.$_POST['title'][46].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][47].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][47].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][47].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_47[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_47']) && !empty($_POST['md_title_47'])){
											foreach($_POST['md_title_47'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][47]) && !empty($_POST['title'][47])){
												echo '<option selected="selected">'.$_POST['title'][47].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][48].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][48].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][48].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_48[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_48']) && !empty($_POST['md_title_48'])){
											foreach($_POST['md_title_48'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][48]) && !empty($_POST['title'][48])){
												echo '<option selected="selected">'.$_POST['title'][48].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][49].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][49].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][49].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_49[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_49']) && !empty($_POST['md_title_49'])){
											foreach($_POST['md_title_49'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][49]) && !empty($_POST['title'][49])){
												echo '<option selected="selected">'.$_POST['title'][49].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][50].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][50].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][50].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_50[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_50']) && !empty($_POST['md_title_50'])){
											foreach($_POST['md_title_50'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][50]) && !empty($_POST['title'][50])){
												echo '<option selected="selected">'.$_POST['title'][50].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][51].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][51].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][51].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_51[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_51']) && !empty($_POST['md_title_51'])){
											foreach($_POST['md_title_51'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][51]) && !empty($_POST['title'][51])){
												echo '<option selected="selected">'.$_POST['title'][51].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][52].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][52].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][52].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_52[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_52']) && !empty($_POST['md_title_52'])){
											foreach($_POST['md_title_52'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][52]) && !empty($_POST['title'][52])){
												echo '<option selected="selected">'.$_POST['title'][52].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][53].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][53].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][53].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_53[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_53']) && !empty($_POST['md_title_53'])){
											foreach($_POST['md_title_53'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][53]) && !empty($_POST['title'][53])){
												echo '<option selected="selected">'.$_POST['title'][53].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][54].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][54].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][54].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_54[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_54']) && !empty($_POST['md_title_54'])){
											foreach($_POST['md_title_54'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][54]) && !empty($_POST['title'][54])){
												echo '<option selected="selected">'.$_POST['title'][54].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][55].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][55].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][55].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_55[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_55']) && !empty($_POST['md_title_55'])){
											foreach($_POST['md_title_55'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][55]) && !empty($_POST['title'][55])){
												echo '<option selected="selected">'.$_POST['title'][55].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][56].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][56].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][56].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_56[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_56']) && !empty($_POST['md_title_56'])){
											foreach($_POST['md_title_56'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][56]) && !empty($_POST['title'][56])){
												echo '<option selected="selected">'.$_POST['title'][56].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][57].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][57].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][57].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_57[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_57']) && !empty($_POST['md_title_57'])){
											foreach($_POST['md_title_57'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][57]) && !empty($_POST['title'][57])){
												echo '<option selected="selected">'.$_POST['title'][57].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][58].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][58].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][58].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_58[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_58']) && !empty($_POST['md_title_58'])){
											foreach($_POST['md_title_58'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][58]) && !empty($_POST['title'][58])){
												echo '<option selected="selected">'.$_POST['title'][58].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][59].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][59].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][59].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_59[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_59']) && !empty($_POST['md_title_59'])){
											foreach($_POST['md_title_59'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][59]) && !empty($_POST['title'][59])){
												echo '<option selected="selected">'.$_POST['title'][59].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][60].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][60].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][60].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_60[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_60']) && !empty($_POST['md_title_60'])){
											foreach($_POST['md_title_60'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][60]) && !empty($_POST['title'][60])){
												echo '<option selected="selected">'.$_POST['title'][60].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][61].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][61].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][61].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_61[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_61']) && !empty($_POST['md_title_61'])){
											foreach($_POST['md_title_61'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][61]) && !empty($_POST['title'][61])){
												echo '<option selected="selected">'.$_POST['title'][61].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][62].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][62].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][62].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_62[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_62']) && !empty($_POST['md_title_62'])){
											foreach($_POST['md_title_62'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][62]) && !empty($_POST['title'][62])){
												echo '<option selected="selected">'.$_POST['title'][62].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][63].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][63].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][63].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_63[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_63']) && !empty($_POST['md_title_63'])){
											foreach($_POST['md_title_63'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][63]) && !empty($_POST['title'][63])){
												echo '<option selected="selected">'.$_POST['title'][63].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][64].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][64].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][64].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_64[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_64']) && !empty($_POST['md_title_64'])){
											foreach($_POST['md_title_64'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][64]) && !empty($_POST['title'][64])){
												echo '<option selected="selected">'.$_POST['title'][64].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][65].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][65].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][65].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_65[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_65']) && !empty($_POST['md_title_65'])){
											foreach($_POST['md_title_65'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][65]) && !empty($_POST['title'][65])){
												echo '<option selected="selected">'.$_POST['title'][65].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][66].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][66].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][66].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_66[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_66']) && !empty($_POST['md_title_66'])){
											foreach($_POST['md_title_66'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][66]) && !empty($_POST['title'][66])){
												echo '<option selected="selected">'.$_POST['title'][66].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][67].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][67].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][67].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_67[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_67']) && !empty($_POST['md_title_67'])){
											foreach($_POST['md_title_67'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][67]) && !empty($_POST['title'][67])){
												echo '<option selected="selected">'.$_POST['title'][67].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][68].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][68].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][68].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_68[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_68']) && !empty($_POST['md_title_68'])){
											foreach($_POST['md_title_68'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][68]) && !empty($_POST['title'][68])){
												echo '<option selected="selected">'.$_POST['title'][68].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][69].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][69].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][69].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_69[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_69']) && !empty($_POST['md_title_69'])){
											foreach($_POST['md_title_69'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][69]) && !empty($_POST['title'][69])){
												echo '<option selected="selected">'.$_POST['title'][69].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][70].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][70].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][70].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_70[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_70']) && !empty($_POST['md_title_70'])){
											foreach($_POST['md_title_70'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][70]) && !empty($_POST['title'][70])){
												echo '<option selected="selected">'.$_POST['title'][70].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][71].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][71].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][71].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_71[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_71']) && !empty($_POST['md_title_71'])){
											foreach($_POST['md_title_71'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][71]) && !empty($_POST['title'][71])){
												echo '<option selected="selected">'.$_POST['title'][71].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][72].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][72].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][72].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_72[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_72']) && !empty($_POST['md_title_72'])){
											foreach($_POST['md_title_72'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][72]) && !empty($_POST['title'][72])){
												echo '<option selected="selected">'.$_POST['title'][72].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][73].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][73].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][73].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_73[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_73']) && !empty($_POST['md_title_73'])){
											foreach($_POST['md_title_73'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][73]) && !empty($_POST['title'][73])){
												echo '<option selected="selected">'.$_POST['title'][73].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][74].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][74].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][74].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_74[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_74']) && !empty($_POST['md_title_74'])){
											foreach($_POST['md_title_74'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][74]) && !empty($_POST['title'][74])){
												echo '<option selected="selected">'.$_POST['title'][74].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][75].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][75].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][75].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_75[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_75']) && !empty($_POST['md_title_75'])){
											foreach($_POST['md_title_75'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][75]) && !empty($_POST['title'][75])){
												echo '<option selected="selected">'.$_POST['title'][75].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][76].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][76].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][76].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_76[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_76']) && !empty($_POST['md_title_76'])){
											foreach($_POST['md_title_76'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][76]) && !empty($_POST['title'][76])){
												echo '<option selected="selected">'.$_POST['title'][76].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][77].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][77].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][77].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_77[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_77']) && !empty($_POST['md_title_77'])){
											foreach($_POST['md_title_77'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][77]) && !empty($_POST['title'][77])){
												echo '<option selected="selected">'.$_POST['title'][77].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][78].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][78].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][78].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_78[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_78']) && !empty($_POST['md_title_78'])){
											foreach($_POST['md_title_78'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][78]) && !empty($_POST['title'][78])){
												echo '<option selected="selected">'.$_POST['title'][78].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][79].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][79].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][79].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_79[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_79']) && !empty($_POST['md_title_79'])){
											foreach($_POST['md_title_79'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][79]) && !empty($_POST['title'][79])){
												echo '<option selected="selected">'.$_POST['title'][79].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][80].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][80].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][80].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_80[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_80']) && !empty($_POST['md_title_80'])){
											foreach($_POST['md_title_80'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][80]) && !empty($_POST['title'][80])){
												echo '<option selected="selected">'.$_POST['title'][80].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][81].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][81].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][81].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_81[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_81']) && !empty($_POST['md_title_81'])){
											foreach($_POST['md_title_81'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][81]) && !empty($_POST['title'][81])){
												echo '<option selected="selected">'.$_POST['title'][81].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][82].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][82].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][82].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_82[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_82']) && !empty($_POST['md_title_82'])){
											foreach($_POST['md_title_82'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][82]) && !empty($_POST['title'][82])){
												echo '<option selected="selected">'.$_POST['title'][82].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][83].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][83].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][83].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_83[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_83']) && !empty($_POST['md_title_83'])){
											foreach($_POST['md_title_83'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][83]) && !empty($_POST['title'][83])){
												echo '<option selected="selected">'.$_POST['title'][83].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][84].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][84].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][84].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_84[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_84']) && !empty($_POST['md_title_84'])){
											foreach($_POST['md_title_84'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][84]) && !empty($_POST['title'][84])){
												echo '<option selected="selected">'.$_POST['title'][84].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][85].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][85].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][85].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_85[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_85']) && !empty($_POST['md_title_85'])){
											foreach($_POST['md_title_85'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][85]) && !empty($_POST['title'][85])){
												echo '<option selected="selected">'.$_POST['title'][85].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][86].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][86].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][86].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_86[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_86']) && !empty($_POST['md_title_86'])){
											foreach($_POST['md_title_86'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][86]) && !empty($_POST['title'][86])){
												echo '<option selected="selected">'.$_POST['title'][86].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][87].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][87].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][87].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_87[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_87']) && !empty($_POST['md_title_87'])){
											foreach($_POST['md_title_87'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][87]) && !empty($_POST['title'][87])){
												echo '<option selected="selected">'.$_POST['title'][87].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][88].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][88].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][88].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_88[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_88']) && !empty($_POST['md_title_88'])){
											foreach($_POST['md_title_88'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][88]) && !empty($_POST['title'][88])){
												echo '<option selected="selected">'.$_POST['title'][88].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][89].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][89].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][89].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_89[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_89']) && !empty($_POST['md_title_89'])){
											foreach($_POST['md_title_89'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][89]) && !empty($_POST['title'][89])){
												echo '<option selected="selected">'.$_POST['title'][89].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][90].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][90].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][90].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_90[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_90']) && !empty($_POST['md_title_90'])){
											foreach($_POST['md_title_90'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][90]) && !empty($_POST['title'][90])){
												echo '<option selected="selected">'.$_POST['title'][90].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][91].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][91].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][91].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_91[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_91']) && !empty($_POST['md_title_91'])){
											foreach($_POST['md_title_91'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][91]) && !empty($_POST['title'][91])){
												echo '<option selected="selected">'.$_POST['title'][91].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][92].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][92].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][92].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_92[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_92']) && !empty($_POST['md_title_92'])){
											foreach($_POST['md_title_92'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][92]) && !empty($_POST['title'][92])){
												echo '<option selected="selected">'.$_POST['title'][92].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][93].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][93].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][93].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_93[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_93']) && !empty($_POST['md_title_93'])){
											foreach($_POST['md_title_93'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][93]) && !empty($_POST['title'][93])){
												echo '<option selected="selected">'.$_POST['title'][93].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][94].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][94].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][94].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_94[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_94']) && !empty($_POST['md_title_94'])){
											foreach($_POST['md_title_94'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][94]) && !empty($_POST['title'][94])){
												echo '<option selected="selected">'.$_POST['title'][94].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][95].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][95].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][95].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_95[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_95']) && !empty($_POST['md_title_95'])){
											foreach($_POST['md_title_95'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][95]) && !empty($_POST['title'][95])){
												echo '<option selected="selected">'.$_POST['title'][95].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][96].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][96].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][96].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_96[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_96']) && !empty($_POST['md_title_96'])){
											foreach($_POST['md_title_96'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][96]) && !empty($_POST['title'][96])){
												echo '<option selected="selected">'.$_POST['title'][96].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][97].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][97].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][97].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_97[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_97']) && !empty($_POST['md_title_97'])){
											foreach($_POST['md_title_97'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][97]) && !empty($_POST['title'][97])){
												echo '<option selected="selected">'.$_POST['title'][97].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][98].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][98].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][98].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_98[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_98']) && !empty($_POST['md_title_98'])){
											foreach($_POST['md_title_98'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][98]) && !empty($_POST['title'][98])){
												echo '<option selected="selected">'.$_POST['title'][98].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="'.$_POST['fname'][99].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="'.$_POST['mname'][99].'" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="'.$_POST['sname'][99].'" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="md_title_99[]" multiple="multiple" style="width:100%;">';
										if(isset($_POST['md_title_99']) && !empty($_POST['md_title_99'])){
											foreach($_POST['md_title_99'] as $h){
												if($h !=''){
													echo '<option selected="selected">'.$h.'</option>';
												}else{
													echo '<option selected="selected" value="">Select a Module</option>';
												}
											}
										}else{
											echo '<option selected="selected" value="">Select a Module</option>';
										}
										foreach($md as $m){
											echo '<option>'.$m.'</option>';
										}
								echo		'</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="title[]" style="width:100%;">';
											if(isset($_POST['title'][99]) && !empty($_POST['title'][99])){
												echo '<option selected="selected">'.$_POST['title'][99].'</option>';
											}else{
												echo '<option selected="selected" value="">Select a Title</option>';
											}
									echo	  '<option>Dr</option>
											  <option>Prof</option>
											  <option>Sir</option>
											  <option>Madam</option>
											  <option>Mr</option>
											  <option>Mrs</option>
											</select>
										</div>
									</td>
								  </tr>
								  </tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-3" style="margin-bottom:2%;">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" name="lec_save_b" class="btn btn-primary">Save</button>
									</div>
								</div>
							</div>
						</div>';
		}
?>						
					</form>
					<!-- End course table-->
			    </div>
			</div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
	include('footer/footer.php');
	include('footer/helpManual.php');
	include('footer/footerScript.php');
?>
