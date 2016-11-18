<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Admin</title>
<?php
	include('config/config.php');
	include('config/functions.php');
	
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
		<li class="treeview active">
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
      <h1>Image Upload<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="adminCourseBachelor.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Image Upload</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
			    <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Images</h3>
					</div>
					
					<div class="row" style="margin:1%;">
						<div class="col-md-12">
							<p>Drag multiple files to the box below for multi upload or click to select files.</p>
							<form action="upload.php" class="dropzone"></form>
							<br/><br/><br/>
						</div>
					</div>
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
