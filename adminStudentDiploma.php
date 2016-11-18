<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Admin</title>
<?php
	include('config/config.php');
	include('config/functions.php');
	include('data/loadCourseDiploma.php');
	include('data/saveStudent.php');
	
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
        <li class="treeview">
			<a href="#"><i class="fa fa-book"></i> <span>Lecturer Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li><a href="adminLecturerBachelor.php"><i class="fa fa-circle-o"></i>Bachelor Degree</a></li>
				<li><a href="adminLecturerDiploma.php"><i class="fa fa-circle-o"></i>Ordinary Diploma</a></li>
			</ul>
		</li>
		<li class="active treeview">
			<a href="#"><i class="fa fa-book"></i> <span>Student Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li><a href="adminStudentBachelor.php"><i class="fa fa-circle-o"></i>Bachelor Degree</a></li>
				<li class="active"><a href="adminStudentDiploma.php"><i class="fa fa-circle-o"></i>Ordinary Diploma</a></li>
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
      <h1>Ordinary Diploma<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="adminCourseBachelor.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ordinary Diploma</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
			    <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Student</h3>
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
									Please select a course, year and semester
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
							<div class="col-md-3">
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
									<select class="form-control select2" name="year" style="width:100%;">
<?php						
						if(isset($_POST['year']) && !empty($_POST['year'])){
								echo	'<option selected="selected">'.$_POST['year'].'</option>';
						}else{
								echo	'<option selected="selected" value="">Select a Year</option>';
						}
?>										
										<option>First Year</option>
										<option>Second Year</option>
										<option>Third Year</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<select class="form-control select2" name="semester" style="width:100%;">
<?php						
						if(isset($_POST['semester']) && !empty($_POST['semester'])){
								echo	'<option selected="selected">'.$_POST['semester'].'</option>';
						}else{
								echo	'<option selected="selected" value="">Select a Semester</option>';
						}
?>										
										<option>First Semester</option>
										<option>Second Semester</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin:1%;">
							<div class="col-md-12">
								<table class="table table-hover tble_admin">
								  <thead>
									<tr><th>First Name</th> <th>Middle Name</th> <th>Surname</th><th>Role</th></tr>
								  </thead>
								  <tbody>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][0];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][0];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][0];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][0] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][0].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][1];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][1];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][1];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][1] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][1].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][2];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][2];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][2];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][2] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][2].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][3];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][3];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][3];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][3] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][3].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][4];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][4];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][4];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][4] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][4].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][5];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][5];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][5];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][5] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][5].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][6];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][6];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][6];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][6] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][6].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][7];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][7];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][7];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][7] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][7].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][8];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][8];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][8];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][8] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][8].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][9];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][9];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][9];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][9] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][9].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][10];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][10];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][10];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][10] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][10].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][11];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][11];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][11];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][11] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][11].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][12];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][12];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][12];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][12] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][12].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][13];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][13];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][13];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][13] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][13].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][14];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][14];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][14];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][14] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][14].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][15];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][15];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][15];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][15] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][15].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][16];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][16];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][16];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][16] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][16].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][17];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][17];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][17];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][17] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][17].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][18];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][18];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][18];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][18] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][18].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][19];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][19];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][19];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][19] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][19].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][20];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][20];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][20];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][20] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][20].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][21];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][21];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][21];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][21] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][21].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][22];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][22];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][22];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][22] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][22].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][23];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][23];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][23];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][23] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][23].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][24];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][24];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][24];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][24] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][24].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][25];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][25];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][25];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][25] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][25].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][26];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][26];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][26];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][26] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][26].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][27];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][27];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][27];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][27] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][27].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][28];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][28];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][28];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][28] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][28].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][29];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][29];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][29];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][29] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][29].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][30];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][30];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][30];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][30] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][30].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][31];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][31];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][31];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][31] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][31].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][32];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][32];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][32];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][32] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][32].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][33];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][33];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][33];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][33] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][33].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][34];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][34];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][34];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][34] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][34].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][35];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][35];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][35];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][35] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][35].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][36];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][36];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][36];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][36] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][36].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][37];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][37];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][37];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][37] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][37].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][38];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][38];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][38];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][38] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][38].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][39];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][39];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][39];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][39] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][39].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][40];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][40];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][40];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][40] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][40].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][41];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][41];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][41];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][41] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][41].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][42];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][42];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][42];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][42] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][42].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][43];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][43];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][43];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][43] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][43].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][44];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][44];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][44];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][44] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][44].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][45];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][45];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][45];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][45] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][45].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][46];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][46];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][46];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][46] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][46].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][47];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][47];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][47];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][47] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][47].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][48];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][48];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][48];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][48] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][48].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][49];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][49];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][49];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][49] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][49].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][50];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][50];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][50];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][50] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][50].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][51];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][51];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][51];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][51] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][51].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][52];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][52];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][52];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][52] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][52].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][53];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][53];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][53];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][53] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][53].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][54];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][54];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][54];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][54] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][54].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][55];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][55];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][55];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][55] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][55].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][56];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][56];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][56];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][56] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][56].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][57];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][57];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][57];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][57] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][57].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][58];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][58];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][58];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][58] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][58].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][59];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][59];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][59];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][59] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][59].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][60];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][60];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][60];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][60] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][60].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][61];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][61];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][61];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][61] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][61].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][62];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][62];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][62];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][62] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][62].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][63];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][63];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][63];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][63] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][63].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][64];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][64];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][64];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][64] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][64].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][65];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][65];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][65];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][65] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][65].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][66];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][66];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][66];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][66] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][66].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][67];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][67];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][67];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][67] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][67].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][68];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][68];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][68];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][68] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][68].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][69];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][69];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][69];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][69] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][69].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][70];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][70];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][70];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][70] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][70].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][71];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][71];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][71];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][71] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][71].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][72];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][72];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][72];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][72] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][72].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][73];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][73];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][73];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][73] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][73].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][74];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][74];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][74];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][74] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][74].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][75];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][75];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][75];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][75] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][75].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][76];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][76];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][76];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][76] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][76].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][77];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][77];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][77];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][77] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][77].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][78];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][78];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][78];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][78] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][78].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][79];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][79];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][79];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][79] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][79].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][80];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][80];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][80];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][80] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][80].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][81];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][81];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][81];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][81] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][81].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][82];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][82];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][82];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][82] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][82].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][83];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][83];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][83];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][83] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][83].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][84];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][84];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][84];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][84] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][84].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][85];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][85];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][85];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][85] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][85].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][86];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][86];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][86];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][86] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][86].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][87];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][87];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][87];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][87] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][87].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][88];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][88];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][88];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][88] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][88].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][89];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][89];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][89];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][89] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][89].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][90];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][90];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][90];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][90] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][90].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][91];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][91];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][91];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][91] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][91].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][92];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][92];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][92];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][92] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][92].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][93];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][93];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][93];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][93] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][93].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][94];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][94];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][94];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][94] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][94].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][95];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][95];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][95];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][95] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][95].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][96];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][96];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][96];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][96] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][96].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][97];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][97];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][97];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][97] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][97].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][98];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][98];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][98];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][98] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][98].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control" name="fname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['fname'][99];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="mname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['mname'][99];}?>" style="width:100%;">
									</td>
									<td>
										<input type="text" class="form-control" name="sname[]" value="<?php if(isset($error) && !empty($error)){echo $_POST['sname'][99];}?>" style="width:100%;">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2" name="role[]" style="width:100%;">
									<?php		  
										if(isset($error) && !empty($error)){
											if($_POST['role'][99] == ''){
												echo '<option selected="selected" value="">Select a Role</option>';
											}else{
												echo '<option selected="selected">'.$_POST['role'][99].'</option>';
											}
											
										}else{
											echo '<option selected="selected" value="">Select a Role</option>';
										}
									?>
											  <option>None</option>
											  <option>President</option>
											  <option>Prime Minister</option>
											  <option>Food Minister</option>
											  <option>Sports Minister</option>
											  <option>Class Representative</option>
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
									  <button type="submit" name="st_save_d" class="btn btn-primary">Save</button>
									</div>
								</div>
							</div>
						</div>
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
