<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Tags | Admin Area | XenaPedia</title>

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
          <h1 class="page-header">Tags</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<p class="alert alert-danger">'); ?>
          <h2 class="sub-header">Add Tag</h2>
          <?php
            $atts = array('id' => 'tag_add', 'role' => 'form');
            echo form_open('admin/creatives/tags', $atts);
          ?>
            <input id="tag" name="tag" class="form-control" placeholder="Tag to add" required>
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Tag Color Options</h3>
              </div>
              <div class="panel-body">
                <input type="radio" name="color" value="primary" checked required><span class="label label-primary">Blue</span></input>
                <input type="radio" name="color" value="info" required><span class="label label-info">Light Blue</span></input>
                <input type="radio" name="color" value="default" required><span class="label label-default">Grey</span></input>
                <input type="radio" name="color" value="success" required><span class="label label-success">Green</span></input>
                <input type="radio" name="color" value="warning" required><span class="label label-warning">Yellow</span></input>
                <input type="radio" name="color" value="danger" required><span class="label label-danger">Red</span></input>
              </div>
            </div>
            <button class="btn btn-lg btn-primary" type="submit">Add Tag</button>
          <?php echo form_close(); ?>

          <h2 class="sub-header">List of all Tags</h2>
          <?php if($tags) : ?>
            <p>Click tag to edit it.</p>
            <p>
              <?php foreach ($tags as $tag) : ?>
                <?php echo anchor('admin/edit/tag/'.$tag->tag_id,'<span class="label label-'.$tag->tag_color_class.'">'.$tag->tag.'</span>'); ?>
              <?php endforeach; ?>
            </p>
          <?php else : ?>
            <p>No tags found</p>
          <?php endif; ?>
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
