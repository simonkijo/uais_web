<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Trash</title>
<?php 
	include('config/config.php');
	include('config/functions.php');
	include('data/lecturerAssignedModule.php');
	include('data/inboxData.php');
	include('data/undo.php');
	include('data/trashData.php');
	include('data/readData.php');
	include('data/outboxData.php');
	
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
		<li class="active treeview">
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
      <h1>Messages<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="academics.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Message</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-3">
			  <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Compose</a>
			  <div class="box box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">Folders</h3>
				  <div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				  </div>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">
					<li><a href="inbox.php"><i class="fa fa-inbox"></i> Inbox
					  <span class="label label-primary pull-right"><?php echo count($subject_);?></span></a></li>
					<li><a href="read.php"><i class="fa fa-envelope-o"></i> Read
						<span class="label bg-green pull-right"><?php echo count($_subject_);?></span></a></li>
					<li><a href="outbox.php"><i class="fa fa-envelope"></i> Outbox
						<span class="label bg-yellow pull-right"><?php echo count($_subject_o);?></span></a></li>
					<li class="active"><a href="trash.php"><i class="fa fa-trash"></i> Trash
						<span class="label bg-red pull-right"><?php echo count($_subject_t);?></span></a></li>
				  </ul>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /. box -->
			</div>
			<!-- /.col -->
			<div class="col-md-9">
			  <div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Trash</h3>
				</div>
				<!-- /.box-header -->
				
				<!--error sms -->
				<div class="row">
					<div class="col-md-3"></div>
<?php
		if((isset($del_error) && !empty($del_error)) || (isset($success) && !empty($success))){
			if($del_error[0] == 'del_error'){
			echo	'<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please select message to undo
						</div>
					</div>';
			}
			if($success == 'success'){
				echo '<div class="col-md-6">
						<div class="alert alert-success alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> SUCCESS !</h4>
							'.$c_su_tr.' Successfully Undone
						</div>
					</div>';
			}
			if($success == 'fail'){
				echo  '<div class="col-md-6">
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
<?php		
		if(count($_subject_t) != 0){				
		echo	'<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="callout callout-info">
							<p>After 30 days, messages will be deleted automatically</p>
						</div>
					</div>
				</div>';
		}
?>				
				<div class="box-body no-padding">
					<form method="post">
					<div class="mailbox-controls">
<?php		
		if(count($_subject_t) != 0){
			echo	'<div class="btn-group">
						<!-- Check all button -->
						<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
						<button type="submit" name="delete_" class="btn btn-default btn-sm" title="Undo"><i class="fa fa-undo"></i></button>
					</div>';
		}
?>
					</div>
					<div class="table-responsive mailbox-messages">
						<table class="table table-hover table-striped">
						  <thead>
							<tr><th></th><th></th> <th></th></tr>
						  </thead>
						  <tbody>
<?php
			if(count($_subject_t) == 0){
				echo '<tr>
						<td></td>
						<td>No message</td>
						<td></td>
					</tr>';
			}
			for($i=0;$i<count($_subject_t);$i++){
					echo  '<tr>
							<td><input type="checkbox" class="addAttr_'.$i.'" value="'.$_inbox_pk_t[$i].'"></td>
							<td class="mailbox-name">'.$_subject_t[$i].'</td>
							<td class="mailbox-date">'.$_time_t[$i].'</td>
						  </tr>';
			}
?>						  
						  </tbody>
						</table>
						<!-- /.table -->
					</div>
					</form>
				</div>
				<!-- /.box-body -->
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
