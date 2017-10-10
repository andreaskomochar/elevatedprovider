<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Users | Admin Area | XenaPedia</title>

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
          <h1 class="page-header">Users</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<p class="alert alert-danger">'); ?>

          <div class="row">
            <div class="col-xs-6 col-sm-3">
              <span class="metric"><?php echo $this->User_model->count_all_users(); ?></span>
              <h4>Total users</h4>
              <span class="text-muted">Total users in the database</span>
            </div>
            <div class="col-xs-6 col-sm-3">
              <span class="metric"><?php echo $this->User_model->count_active_users(); ?></span>
              <h4>Active users</h4>
              <span class="text-muted">Active users who can login</span>
            </div>
            <div class="col-xs-6 col-sm-3">
              <span class="metric"><?php echo $this->User_model->count_admin_users(); ?></span>
              <h4>Administrators</h4>
              <span class="text-muted">Users with administrator rights</span>
            </div>
            <div class="col-xs-6 col-sm-3">
              <span class="metric"><?php echo $this->User_model->count_disabled_users(); ?></span>
              <h4>Disabled users</h4>
              <span class="text-muted">Number of disabled accounts</span>
            </div>
          </div>

          <h2 class="sub-header">List of all users</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
        					<th>User ID</th>
        					<th>First Name</th>
        					<th>Last Name</th>
        					<th>Email</th>
        					<th>Admin?</th>
        					<th>Edit</th>
                  <th>Created</th>
                  <th>Last Edit</th>
        				</tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                  <td><?php echo $user->id; ?></td>
                  <td><?php echo $user->first_name; ?></td>
                  <td><?php echo $user->last_name; ?></td>
                  <td><?php echo '<a href="mailto:'.$user->email.'" title="Send email to '.$user->first_name.' '.$user->last_name.'">'.$user->email.'</a>'; ?></td>
                  <td><?php if($user->is_admin > 0) echo "Yes"; else echo "No"; ?> (<a href="<?php echo base_url(); ?>index.php/admin/users/admin/<?php echo $user->id; ?>" title="<?php if($user->is_admin > 0) echo "Disable"; else echo "Enable"; echo " $user->first_name $user->last_name administrator rights"; ?>"><?php if($user->is_admin > 0) echo "UNSET"; else echo "Set"; ?> as Admin</a>)</td>
                  <td><a href="<?php echo base_url(); ?>index.php/admin/users/edit/<?php echo $user->id; ?>" title="Edit <?php echo "$user->first_name $user->last_name"; ?>">Edit user</a> | <a href="<?php echo base_url(); ?>index.php/admin/users/active/<?php echo $user->id; ?>" title="<?php if ($user->is_disabled > 0) echo 'Enable'; else echo 'Disable'; echo " $user->first_name $user->last_name" ?>"><?php if ($user->is_disabled > 0) : ?>Enable user<?php else : ?>Disable user<?php endif; ?></a><?php if($user->is_disabled > 0) echo " (DISABLED)"; ?></td>
                  <td><?php echo date('Y-m-d h:i A', strtotime($user->user_created) ); ?></td>
                  <td><?php echo date('Y-m-d h:i A', strtotime($user->user_edited) ); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
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
  </body>
</html>
