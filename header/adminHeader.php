<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>U</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UAIS</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo photoProfile(getField('fname').'_'.getField('mname').'_'.getField('sname').'.jpg');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('sname'));?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo photoProfile(getField('fname').'_'.getField('mname').'_'.getField('sname').'.jpg');?>" class="img-circle" alt="User Image">

                <p><?php echo capitalFirstLetter(getField('fname')).' '.capitalFirstLetter(getField('sname'));?><small>System Admin</small></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="adminProfile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Log Out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar" title="USER MANUAL AND HELP"><i class="fa fa-question"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>