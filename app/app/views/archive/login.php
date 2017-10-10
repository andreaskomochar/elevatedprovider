<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login | Admin Area</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
</head>
<body>

<div id="container">
	<h1>Admin Area Login</h1>

	<div id="body">
		<p>Enter your username and password to login to the Admin Area</p>

		<p>ADMIN LOGIN FORM</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
