<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Inbox</title>
<?php 
	include('config/config.php');
	include('config/functions.php');
	include('data/lecturerAssignedModule.php');
	include('data/inboxData.php');
	include('data/readData.php');
	include('data/outboxData.php');
	include('data/trashData.php');
	
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
					<li class="active"><a href="inbox.php"><i class="fa fa-inbox"></i> Inbox
					  <span class="label label-primary pull-right"><?php echo count($subject_);?></span></a></li>
					<li><a href="read.php"><i class="fa fa-envelope-o"></i> Read
						<span class="label bg-green pull-right"><?php echo count($_subject_);?></span></a></li>
					<li><a href="outbox.php"><i class="fa fa-envelope"></i> Outbox
						<span class="label bg-yellow pull-right"><?php echo count($_subject_o);?></span></a></li>
					<li><a href="trash.php"><i class="fa fa-trash"></i> Trash
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
				  <h3 class="box-title">Inbox</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive mailbox-messages">
						<table class="table table-hover table-striped">
						  <thead>
							<tr><th></th> <th></th></tr>
						  </thead>
						  <tbody>
<?php
			if(count($subject_) == 0){
				echo '<tr>
						<td></td>
						<td>No message</td>
					</tr>';
			}
			for($i=0;$i<count($subject_);$i++){
					echo  '<tr>
							<td class="mailbox-name"><a href="read-sms.php?id='.$inbox_pk[$i].'">'.$subject_[$i].'</a></td>
							<td class="mailbox-date">'.$time[$i].'</td>
						  </tr>';
			}
?>						  
						  </tbody>
						</table>
						<!-- /.table -->
					</div>
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
