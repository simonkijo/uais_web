<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Profile</title>
<?php
	include('config/config.php');
	include('config/functions.php');
	include('data/adminProfile.php');
	
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
		<li class="active treeview">
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
<!--error sms -->
			<div class="row">
				<div class="col-md-3"></div>
<?php 
	if(isset($_GET['response']) && !empty($_GET['response'])){
		if($_GET['response'] == 'fail'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Sorry, something went wrong. Please Try again
						</div>
					</div>';
			//removes get global variable
			$location = 'adminProfile.php';
			echo '<META HTTP-EQUIV="refresh" CONTENT="7;URL='.$location.'">';
		}
		if($_GET['response'] == 'success'){
			echo '<div class="col-md-6">
						<div class="alert alert-success alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> SUCCESS !</h4>
							Changes have been saved successfully
						</div>
					</div>';
			//removes get global variable
			$location = 'adminProfile.php';
			echo '<META HTTP-EQUIV="refresh" CONTENT="5;URL='.$location.'">';
		}
	}
?>
			</div>
			<!--end error-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>My Profile<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="adminCourseBachelor.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-primary">
					<div class="box-body box-profile">
					  <img class="profile-user-img img-responsive img-circle" src="<?php echo photoProfile(getField('fname').'_'.getField('mname').'_'.getField('sname').'.jpg');?>" alt="User profile picture">

					  <h3 class="profile-username text-center"><?php echo capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('mname')).' '.capitalFirstLetter(getField('sname'));?></h3>

					  <p class="text-muted text-center">System Admin</p>

					  <ul class="list-group list-group-unbordered">
						<li class="list-group-item">
						  <b>Phone Number</b> <a class="pull-right"><?php echo getField('phone_no');?></a>
						</li>
						<li class="list-group-item">
						  <b>Email</b> <a class="pull-right"><?php echo getField('email');?></a>
						</li>
						<li class="list-group-item">
						  <b>Gender</b> <a class="pull-right"><?php echo getField('gender');?></a>
						</li>
						<li class="list-group-item">
						  <b>Nationality</b> <a class="pull-right"><?php echo getField('nationality');?></a>
						</li>
						<li class="list-group-item">
						  <b>Username</b> <a class="pull-right"><?php echo getField('username');?></a>
						</li>
					  </ul>
					</div>
				</div>
			</div>
			
			<div class="col-md-9">
			  <div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
				</ul>
				<div class="tab-content">
				  <div class="active tab-pane" id="settings">
					<form class="form-horizontal" method="post">
					  <div class="form-group a_fname_error">
						<div class="col-sm-9">
						  <input type="text" class="form-control i_fname" name="fname" placeholder="First Name" value="<?php echo getField('fname');?>">
						  <span class="help-block fname_error"></span>
						</div>
					  </div>
					  <div class="form-group a_mname_error">
						<div class="col-sm-9">
						  <input type="text" class="form-control i_mname" name="mname" placeholder="Middle Name" value="<?php echo getField('mname');?>">
						  <span class="help-block mname_error"></span>
						</div>
					  </div>
					  <div class="form-group a_sname_error">
						<div class="col-sm-9">
						  <input type="text" class="form-control i_sname" name="sname" placeholder="Surname" value="<?php echo getField('sname');?>">
						  <span class="help-block sname_error"></span>
						</div>
					  </div>
					  <div class="form-group a_phone_no_error">
						<div class="col-sm-9">
						  <input type="text" class="form-control i_phone_no" name="phone_no" placeholder="Phone Number" value="<?php echo getField('phone_no');?>">
						  <span class="help-block phone_no_error"></span>
						</div>
					  </div>
					  <div class="form-group a_email_error">
						<div class="col-sm-9">
						  <input type="email" class="form-control i_email" name="email" placeholder="Email" value="<?php echo getField('email');?>">
						  <span class="help-block email_error"></span>
						</div>
					  </div>
					  <div class="form-group a_nationality_error">
						<div class="col-sm-9">
						  <input type="text" class="form-control i_nationality" name="nationality" placeholder="Nationality" value="<?php echo getField('nationality');?>">
						  <span class="help-block nationality_error"></span>
						</div>
					  </div>
					  <div class="form-group a_gender_error">
						<div class="col-sm-9">
							<label>
							  <input type="radio" name="gender" value="Male" class="minimal" checked>
							  Male
							</label>
							<label>
							  <input type="radio" name="gender" value="Female" class="minimal">
							  Female
							</label>
						</div>
					  </div>
					  <div class="form-group a_uname_error">
						<div class="col-sm-9">
						  <input type="text" class="form-control i_uname" name="uname" placeholder="Username" value="<?php echo getField('username');?>">
						  <span class="help-block uname_error"></span>
						</div>
					  </div>
					  <div class="form-group a_pwd_error">
						<div class="col-sm-9">
						  <input type="password" class="form-control i_pwd" name="pwd" placeholder="Password">
						  <span class="help-block pwd_error"></span>
						</div>
					  </div>
					  <div class="form-group a_repwd_error">
						<div class="col-sm-9">
						  <input type="password" class="form-control i_repwd" name="repwd" placeholder="Retype Password">
						  <span class="help-block repwd_error"></span>
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" name="save_a" class="btn btn-primary btn_save_admin">Save Changes</button>
						</div>
					  </div>
					</form>
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
