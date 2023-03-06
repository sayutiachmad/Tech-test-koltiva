<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WMU Order Management | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/login/login_alt.css">
  
</head>
<body data-page-base="<?php echo base_url();?>">
  <section>
    <div class="imgBx">
      <img src="assets/images/bg-login.jpg">
    </div>
    <div class="contentBx">
      <div class="formBx">
        <h2>Login</h2>

        <div class="alert alert-danger alert-dismissible" id="alert_login" style="display: none;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <i class="icon fas fa-ban"></i>
          <span id="alert_content"></span>
        </div>

        <form id="login-form">
          <div class="inputBx">
            <span>Email</span>
            <input type="text" name="lg_email_" autofocus>
            <label class="text-danger error-placement"></label>
          </div>
          <div class="inputBx">
            <span>Password</span>
            <input type="password" name="lg_password_">
          </div>
          <div class="inputBx">
            <input type="submit" name="" value="Sign in" id="btn_submit">
          </div>
        </form>
    </div>

  </section>
</body>
!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- JQuery Validation -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Custom Script -->
<script src="<?php echo base_url();?>assets/js/login/login.js"></script>
</html>


