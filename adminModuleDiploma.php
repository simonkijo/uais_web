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
	include('data/determineCourseDuration.php');
	include('data/saveModule.php');
	
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
						<li><a href="adminCourseDiploma.php"><i class="fa fa-circle-o"></i> Course</a></li>
						<li class="active"><a href="adminModuleDiploma.php"><i class="fa fa-circle-o"></i> Module</a></li>
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
					  <h3 class="box-title">Module</h3>
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
					<form method="post">
					<div class="row" style="margin-left:5%;margin-top:2%;">
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
								  <button type="submit" name="md_show_d" class="btn btn-primary">Show</button>
								</div>
							</div>
						</div>
					</div>
					<!-- Smart Wizard -->
<?php	
		if((isset($d_) && !empty($d_)) || ($error[0] !='' || $error[1] != '')){
			if($error[0] !='' || $error[1] != ''){
				$course_ = $_POST['course'];
		
				for($i=0;$i<count($course);$i++){
					if($course[$i] == $course_){
						$d_ = $course_duration[$i];
					}
				}
			}
			echo	'<div id="wizard" class="form_wizard wizard_horizontal">
						<ul class="wizard_steps">
							<li>
								<a href="#step-1">
									<span class="step_no">1</span>
									<span class="step_descr">1<sup>st</sup> Year</span>
								</a>
							</li>
							<li>
								<a href="#step-2">
									<span class="step_no">2</span>
									<span class="step_descr">2<sup>nd</sup> Year</span>
								</a>
							</li>';
				if($d_ == 'Three Year'){			
					echo	'<li>
								<a href="#step-3">
									<span class="step_no">3</span>
									<span class="step_descr">3<sup>rd</sup> Year</span>
								</a>
							</li>';
				}else{
					echo	'<li>
								<a href="#step-3">
									<span class="step_no">3</span>
									<span class="step_descr">3<sup>rd</sup> Year</span>
								</a>
							</li>
							<li>
								<a href="#step-4">
									<span class="step_no">4</span>
									<span class="step_descr">4<sup>th</sup> Year</span>
								</a>
							</li>';
				}
							
				echo	'</ul>
						<div id="step-1">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<table class="table table-hover tble_admin_">
									  <thead>
										<tr><th>First Semester</th> <th>Second Semester</th></tr>
									  </thead>
									  <tbody>
									  <tr>
										<td>	
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][0].'" style="width:80%;">
								        </td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][0].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][1].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][1].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][2].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][2].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][3].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][3].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][4].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][4].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][5].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][5].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][6].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][6].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][7].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][7].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][8].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][8].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][9].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][9].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][10].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][10].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][11].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][11].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][12].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][12].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][13].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][13].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_1_1[]" value="'.$_POST['module_1_1'][14].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_1_2[]" value="'.$_POST['module_1_2'][14].'" style="width:80%;">
										</td>
									  </tr>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="step-2">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<table class="table table-hover tble_admin_">
									  <thead>
										<tr><th>First Semester</th> <th>Second Semester</th></tr>
									  </thead>
									  <tbody>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][0].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][0].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][1].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][1].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][2].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][2].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][3].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][3].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][4].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][4].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][5].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][5].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][6].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][6].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][7].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][7].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][8].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][8].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][9].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][9].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][10].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][10].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][11].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][11].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][12].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][12].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][13].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][13].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_2_1[]" value="'.$_POST['module_2_1'][14].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_2_2[]" value="'.$_POST['module_2_2'][14].'" style="width:80%;">
										</td>
									  </tr>
									  </tbody>
									</table>
								</div>
							</div>
						</div>';
			if($d_ == 'Three Year'){			
				echo	'<div id="step-3">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<table class="table table-hover tble_admin_">
									  <thead>
										<tr><th>First Semester</th> <th>Second Semester</th></tr>
									  </thead>
									  <tbody>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][0].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][0].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][1].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][1].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][2].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][2].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][3].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][3].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][4].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][4].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][5].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][5].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][6].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][6].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][7].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][7].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][8].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][8].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][9].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][9].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][10].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][10].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][11].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][11].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][12].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][12].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][13].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][13].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][14].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][14].'" style="width:80%;">
										</td>
									  </tr>
									  </tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" name="sv_d" class="btn btn-primary">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>';
			}else{	
				echo	'<div id="step-3">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<table class="table table-hover tble_admin_">
									  <thead>
										<tr><th>First Semester</th> <th>Second Semester</th></tr>
									  </thead>
									  <tbody>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][0].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][0].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][1].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][1].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][2].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][2].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][3].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][3].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][4].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][4].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][5].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][5].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][6].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][6].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][7].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][7].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][8].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][8].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][9].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][9].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][10].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][10].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][11].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][11].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][12].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][12].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][13].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][13].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_3_1[]" value="'.$_POST['module_3_1'][14].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_3_2[]" value="'.$_POST['module_3_2'][14].'" style="width:80%;">
										</td>
									  </tr>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="step-4">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<table class="table table-hover tble_admin_">
									  <thead>
										<tr><th>First Semester</th> <th>Second Semester</th></tr>
									  </thead>
									  <tbody>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][0].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][0].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][1].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][1].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][2].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][2].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][3].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][3].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][4].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][4].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][5].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][5].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][6].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][6].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][7].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][7].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][8].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][8].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][9].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][9].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][10].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][10].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][11].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][11].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][12].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][12].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][13].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][13].'" style="width:80%;">
										</td>
									  </tr>
									  <tr>
										<td>
											<input type="text" class="form-control" name="module_4_1[]" value="'.$_POST['module_4_1'][14].'" style="width:80%;">
										</td>
										<td>
											<input type="text" class="form-control" name="module_4_2[]" value="'.$_POST['module_4_2'][14].'" style="width:80%;">
										</td>
									  </tr>
									  </tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" name="sv_d" class="btn btn-primary">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>';
			}	
			echo	'</div>';
		}
?>					
					</form>
					<!-- End SmartWizard Content -->
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
