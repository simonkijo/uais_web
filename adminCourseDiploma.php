<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Admin</title>
<?php 
	include('config/config.php');
	include('config/functions.php');
	include('data/adminCourse.php');
	
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
		<li class="active treeview">
			<a href="#"><i class="fa fa-book"></i> <span>Academic Programme</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li><a href="#"><i class="fa fa-circle-o"></i>Bachelor Degree <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
					<ul class="treeview-menu">
						<li><a href="adminCourseBachelor.php"><i class="fa fa-circle-o"></i> Course</a></li>
						<li><a href="adminModuleBachelor.php"><i class="fa fa-circle-o"></i> Module</a></li>
					</ul>
				</li>
				<li class="active"><a href="#"><i class="fa fa-circle-o"></i>Ordinary Diploma <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
					<ul class="treeview-menu">
						<li class="active"><a href="adminCourseDiploma.php"><i class="fa fa-circle-o"></i> Course</a></li>
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
					  <h3 class="box-title">Course</h3>
					</div>
					<!--error sms -->
					<div class="row">
						<div class="col-md-3"></div>
<?php 
			if((isset($error) && !empty($error)) || (isset($success) && !empty($success))){
				if($error[0] == 'empty_cs'){
					  echo '<div class="col-md-6">
								<div class="alert alert-danger alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
									Please fill the course name
								</div>
							</div>';
				}else if($error[2] == 'empty_csd'){
					  echo '<div class="col-md-6">
								<div class="alert alert-danger alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
									Please fill the course duration
								</div>
							</div>';
				}else if($error[1] == 'invalid'){
					  echo '<div class="col-md-6">
								<div class="alert alert-danger alert-dismissible a_remove">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
									Alphabetical Letters Only
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
			}
?>
					</div>
					<!--end error-->
					<!-- course table-->
					<form method="post">
						<div class="row" style="margin-top:2%;">
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<table class="table table-hover tble_admin_">
								  <thead>
									<tr><th>Course Name</th> <th>Course Duration</th></tr>
								  </thead>
								  <tbody>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][0];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][0] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][0].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][1];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][1] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][1].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][2];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][2] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][2].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][3];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][3] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][3].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][4];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][4] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][4].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][5];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][5] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][5].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][6];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][6] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][6].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][7];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][7] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][7].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][8];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][8] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][8].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][9];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][9] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][9].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][10];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][10] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][10].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][11];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][11] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][11].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][12];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][12] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][12].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][13];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][13] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][13].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
											</select>
										</div>
									</td>
								  </tr>
								  <tr>
									<td>
										<input type="text" class="form-control i_remove" name="course_name[]" style="width:80%;" value="<?php if(isset($error) && !empty($error)){echo $_POST['course_name'][14];} ?>">
									</td>
									<td>
										<div class="form-group">
											<select class="form-control select2 i_remove" name="course_duration[]" style="width:100%;">
								<?php
										if(isset($error) && !empty($error)){
											if($_POST['course_duration'][14] == ''){
												echo '<option selected="selected" value="">Select Course duration</option>';
											}else{
												echo '<option selected="selected">'.$_POST['course_duration'][14].'</option>';
											}
										}else{
											echo '<option selected="selected" value="">Select Course duration</option>';
										}
								?>			  
											  <option>Three Year</option>
											  <option>Four Year</option>
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
									  <button type="submit" name="co_save_d" class="btn btn-primary">Save</button>
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
