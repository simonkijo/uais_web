<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UAIS | Compose</title>
<?php
	include('config/config.php');
	include('config/functions.php');
	include('data/lecturerAssignedModule.php');
	include('data/inboxData.php');
	include('data/studentCourseDuration.php');
	include('data/composeData.php');
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
<!--error sms -->
			<div class="row">
				<div class="col-md-3"></div>
<?php 
	if((isset($error) && !empty($error)) || (isset($success) && !empty($success))){
		if($error[0] == 'no_module'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please select a module
						</div>
					</div>';
		}
		if($error[0] == 'no_to'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please select a recipient
						</div>
					</div>';
		}
		if($error[0] == 'no_subject'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please write subject
						</div>
					</div>';
		}
		if($error[0] == 'no_message'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please write message
						</div>
					</div>';
		}
		if($error[1] == 'no_selected'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please select a year and semester. Then click button "Show" to load modules
						</div>
					</div>';
		}
		if($error[2] == 'no_md'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Please select a module
						</div>
					</div>';
		}
		
		if($success == 'success'){
			echo '<div class="col-md-6">
						<div class="alert alert-success alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> SUCCESS !</h4>
							Message sent successfully
						</div>
					</div>';
		}
		if($success == 'fail'){
			  echo '<div class="col-md-6">
						<div class="alert alert-danger alert-dismissible a_remove">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> ERROR !</h4>
							Sorry something went wrong, please try again
						</div>
					</div>';
		}
	}
?>
			</div>
			<!--end error-->
		<div class="row">
			<div class="col-md-3">
			  <a href="inbox.php" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
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
			<form method="post">			
			  <div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Compose New Message</h3>
				</div>
				<!-- /.box-header -->
					<div class="box-body">
<?php 
		if($count_ >=2){
			echo	'<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control select2" name="module_title1" style="width: 100%;">';
							if(isset($_POST['module_title1']) && !empty($_POST['module_title1'])){		  
								echo  '<option selected="selected">'.$_POST['module_title1'].'</option>';
							}else{
								echo  '<option selected="selected" value="">Select a Module</option>';
							}
							if(isset($module_) && !empty($module_)){
								foreach($module_ as $_md){
									echo  '<option>'.$_md.'</option>';
								}
							}	
						echo		'</select>
								</div>
							</div>
						</div>';
		}
		if(getField('status') == 'student' && getAnyField('st_role','role') == 'Class Representative' && !isset($_GET['r']) && empty($_GET['r'])){
			echo	'<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control select2" name="module" style="width: 100%;">';
							if(isset($_POST['module']) && !empty($_POST['module'])){		  
								echo  '<option selected="selected">'.$_POST['module'].'</option>';
							}else{
								echo  '<option selected="selected" value="">Select a Module</option>';
							}
							if(isset($_module_) && !empty($_module_)){
								foreach($_module_ as $_md){
									echo  '<option>'.$_md.'</option>';
								}
							}	
						echo		'</select>
								</div>
							</div>
						</div>';
		}
?>
						<div class="form-group">
							<select class="form-control select2" name="to">
<?php
				if((isset($_POST['to']) && !empty($_POST['to'])) || (isset($_GET['r']) && !empty($_GET['r']))){
					$re_ = $_GET['r'];
					$wr = "SELECT `fname`,`sname` FROM `1948040_uais`.`users` WHERE `id_no`='".$re_."'";
					$te = mysql_query($wr);
					$wf = mysql_result($te,0,'fname');
					$ws = mysql_result($te,0,'sname');
					if(empty($wf) || empty($ws)){
						echo '<option selected="selected">'.$_POST['to'].'</option>';
					}else{
						echo '<option selected="selected">'.$wf.' '.$ws.'</option>';
					}
				}else{
					echo '<option selected="selected" value="">To:</option>';
				}
				if(getField('status') == 'lecturer'){
					echo	  '<option>Students</option>
							  <option>Class Representative</option>';
				}else if(getField('status') == 'student'){
					if(getAnyField('st_role','role') == 'Class Representative'){
						echo '<option>Lecturer</option>
							  <option>President</option>
							  <option>Prime Minister</option>
							  <option>Sports Minister</option>
							  <option>Food Minister</option>';
					}else if(getAnyField('st_role','role') == 'President'){
						echo  '<option>Prime Minister</option>
							  <option>Sports Minister</option>
							  <option>Food Minister</option>
							  <option>Class Representative</option>';
					}else if(getAnyField('st_role','role') == 'Prime Minister'){
						echo  '<option>President</option>
							  <option>Sports Minister</option>
							  <option>Food Minister</option>
							  <option>Class Representative</option>';
					}else if(getAnyField('st_role','role') == 'Sports Minister'){
						echo  '<option>President</option>
							  <option>Prime Minister</option>
							  <option>Food Minister</option>
							  <option>Class Representative</option>';
					}else if(getAnyField('st_role','role') == 'Food Minister'){
						echo  '<option>President</option>
							  <option>Prime Minister</option>
							  <option>Sports Minister</option>
							  <option>Class Representative</option>';
					}else{
						echo  '<option>President</option>
							  <option>Prime Minister</option>
							  <option>Sports Minister</option>
							  <option>Food Minister</option>
							  <option>Class Representative</option>';
					}
					
				}
?>							  
							</select>
						</div>
					  <div class="form-group">
						<input type="text" class="form-control" name="subject" placeholder="Subject:" value="<?php echo $_POST['subject'];?>">
					  </div>
					  <div class="form-group">
							<textarea id="compose_textarea" class="form-control" name="message" style="height:300px;">
					<?php 
						echo $_POST['message'];
					?>		  
							</textarea>
					  </div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					  <div class="pull-right">
						<button type="submit" name="send" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
					  </div>
					</div>
			  </div>
			  
			  </form>
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
