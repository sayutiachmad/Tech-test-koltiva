<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo (isset($top_title) ? "".$top_title : "");?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->

  <!-- Picker  -->
  <link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/clock-picker/clockpicker.css" rel="stylesheet">

  <!-- datatables -->

  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/core/css/dataTables.bootstrap4.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/plugin/Buttons-1.5.2/css/buttons.bootstrap4.min.css"> -->

  <!-- confirmation -->
  <link href="<?php echo base_url();?>assets/plugins/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">

  <!-- bootstrap select -->
  <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/select2/css/select2.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet">

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">

  <?php if($style!=null) echo $style;?>
  
  <?php if($head_tag!=null) $this->load->view($head_tag);?>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm accent-primary <?php echo ($sidebar_collapse ? 'sidebar-collapse' : '');?>" data-user-name="<?php echo $sess_data[SESSION_USER_FULLNAME]?>" data-user-role="<?php echo $sess_data[SESSION_USER_ROLE];?>">

    <div class="wrapper">

      <!-- Navbar -->
      <?php $this->load->view('top_bar/top_menu'); ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <?php $this->load->view('top_bar/icon_bar'); ?>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <?php $this->load->view('side_bar/side_profile'); ?>

          <!-- Sidebar Menu -->
          <?php $this->load->view('side_bar/side_menu');?>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $title;?> <small><?php echo $titlesmall;?></small></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <?php echo $breadcrumb;?>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <?php $this->load->view($sub_view);?>
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy;<?php echo date('Y');?> <a href="<?php echo base_url();?>">IT Team WMU</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 0.0.1
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    
    <!-- moment -->
    <script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
    
    <!-- picker -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/clock-picker/clockpicker.js"></script>


    <!-- bootstrap notify -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- datatables -->
    <script src="<?php echo base_url();?>assets/plugins/datatables/datatables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/datatables/core/js/dataTables.bootstrap4.min.js"></script><!-- 
    <script src="<?php echo base_url();?>assets/plugins/datatables/plugin/Buttons-1.5.2/js/buttons.bootstrap4.min.js"></script> -->
    
    <!-- form validation -->
    <script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- confirmation -->
    <script src="<?php echo base_url();?>assets/plugins/jquery-confirm/jquery-confirm.min.js"></script>

    <!-- bootstrap select -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/js/adminlte.js"></script>

    <!-- custom script -->
    <script src="<?php echo base_url();?>assets/js/notifications.js"></script>
    <script src="<?php echo base_url();?>assets/js/custom_script.js"></script>

    <script type="text/javascript">var base_url="<?php echo base_url();?>";</script>

    <?php if($script!=null) echo $script;?>

    <?php if($foot_tag!=null) $this->load->view($foot_tag);?>

</body>
</html>
