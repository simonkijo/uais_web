<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Profile</title>
<?php
	include('config/config.php');
	include('config/functions.php');
	include('data/profile.php');
	
	include('header/head.php');
	include('header/header.php');
	
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
          <a href="academics.php"><i class="fa fa-book"></i> <span>Academic Materials</span></a>
        </li>
		<li class="treeview">
          <a href="compose.php"><i class="fa fa-envelope"></i> <span>Message</span></a>
        </li>
		<li class="header">PROFILE SETTINGS</li>
		<li class="active treeview">
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
			$location = 'profile.php';
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
			$location = 'profile.php';
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
        <li><a href="academics.php"><i class="fa fa-dashboard"></i> Home</a></li>
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

					  <p class="text-muted text-center"><?php echo capitalFirstLetter(getField('status'));?></p>

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
						  <button type="submit" name="save_sl" class="btn btn-primary btn_save">Save Changes</button>
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
