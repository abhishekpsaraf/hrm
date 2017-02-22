<?php 
echo $this->session->userdata('username');
if(isset($message))
{
	echo $message;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Company | Log in</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/font-awesome.css">
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/ionicons.css">
	
	


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b>Admin -HR</b>Management</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform","method"=>"post");
          echo form_open("loginController/loginCheck", $attributes);?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="txt_username" name="txt_username" placeholder="Username" value="<?php echo set_value('txt_username'); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Password" value="<?php echo set_value('txt_password'); ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
       <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>-->
        </div>
        <!-- /.col -->
       
     <div class="social-auth-links text-center">
      <button type="submit" id="btn_login" name="btn_login" class="btn btn-primary btn-block btn-flat" value="Login">Sign In</button>
    </div>
        <!-- /.col -->
      </div>
    <?php echo form_close(); ?>
    <?php echo $this->session->flashdata('msg'); ?>

    
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="index.php/CompanyController" class="text-center">Company Sign Up</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src=".<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src=".<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  /*$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });*/
</script>
</body>
</html>

