
<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">

      <a href="javascript:;" class="user-profile dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
        <?php echo $sess_data[SESSION_USER_FULLNAME];?>
    
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <a href="<?php echo base_url('profile');?>" class="dropdown-item"><i class="fas fa-user float-right"></i> Profile</a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url('auth/auth_logout');?>" class="dropdown-item"><i class="fas fa-sign-out-alt float-right"></i> Log Out</a>

      </div>
    </li>
  </ul>
</nav>