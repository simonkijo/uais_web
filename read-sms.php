<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Read-Sms</title>
<?php
	include('config/config.php');
	include('config/functions.php');
	include('data/lecturerAssignedModule.php');
	include('data/readsmsData.php');
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
                <li><a href="inbox.php"><i class="fa fa-inbox"></i> Inbox
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
              <h3 class="box-title">Read Message</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<div class="mailbox-read-info">
					<h3><?php echo $_subject;?></h3>
					<h5>From: <?php echo $_from;?>
					  <span class="mailbox-read-time pull-right"><?php echo $_time;?></span></h5>
				</div>
				
				<div class="mailbox-read-message">
					<?php echo $_sms;?>
				</div>
            </div>
            <!-- /.box-body -->
<?php
	if($_sender != $_myself){
	echo	'<div class="box-footer">
			  <div class="pull-right">
				<a href="compose.php?r='.$_reply.'" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Reply</a>
			  </div>
			</div>';
	}
?>			
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
