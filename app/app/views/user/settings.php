<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>User Settings | Members Area | XenaPedia</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url(); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/dashboard.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php include('include/main-menu.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('include/left-menu.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">User Settings</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<p class="alert alert-danger">'); ?>
          <?php
            $atts = array('id' => 'user_settings', 'role' => 'form');
            echo form_open('user/settings', $atts);
          ?>
            <input class="form-control" type="password" id="current_password" name="current_password" placeholder="Current Password" required>
            <input class="form-control" type="password" id="password" name="password" placeholder="New Password" required>
            <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="New Password Again" required>
            <br>
            <button class="btn btn-lg btn-primary" type="submit">Save New Settings</button>
          <?php echo form_close(); ?>
					<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo base_url(); ?>assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
      var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

      function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
          confirm_password.setCustomValidity('');
        }
      }

      password.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;
    </script>
  </body>
</html>
