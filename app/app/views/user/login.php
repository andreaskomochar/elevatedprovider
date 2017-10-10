<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Sign In | XenaPedia</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url(); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <script src='//www.google.com/recaptcha/api.js'></script>
  </head>

  <body>

    <div class="container">
      <?php
        $atts = array('id' => 'login_form', 'class' => 'form-signin', 'role' => 'form');
        echo form_open('user/login', $atts);
      ?>
      <h2 class="form-signin-heading">Please sign in</h2>
        <?php if($this->session->flashdata('success')) : ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')) : ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
        <?php endif; ?>
        <?php echo validation_errors('<p class="alert alert-danger">'); ?>
        <div class="input-group">
        <label for="name" class="sr-only">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Name" aria-describedby="xena-addon" required autofocus>
        <span class="input-group-addon" id="xena-addon">@XenaInteractive.com</span>
        </div>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
       <div class="g-recaptcha" data-sitekey="6LcDwRgUAAAAAPs_bA_yjHa3c9aPw5aflmGAqDAE"></div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <?php echo form_close(); ?>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
