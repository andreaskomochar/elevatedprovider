<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Edit Offer | Admin Area | XenaPedia</title>

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
          <h1 class="page-header">Edit Offer</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<p class="alert alert-danger">'); ?>
          <?php
            $atts = array('id' => 'offer_edit', 'role' => 'form');
            echo form_open('admin/edit/offer/'.$offer->offer_id, $atts);
          ?>
            <select class="form-control" id="vertical" name="vertical" required>
              <option value="">Please select a vertical</option>
              <?php foreach($verticals as $vertical) : ?>
                <option value="<?php echo $vertical->vertical_id; ?>"<?php if($offer->vertical_id == $vertical->vertical_id) echo ' selected'; ?>><?php echo $vertical->vertical ?></option>
              <?php endforeach; ?>
            </select>
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Tags</h3>
              </div>
              <div class="panel-body">
                <?php foreach ($tags as $tag) : ?>
                  <input type="checkbox" name="tags[]" value="<?php echo $tag->tag_id ?>"<?php if(in_array($tag->tag_id,$selected_tags)) echo ' checked'; ?>><span class="label label-<?php echo $tag->tag_color_class ?>"><?php echo $tag->tag ?></span></input>
                <?php endforeach; ?>
              </div>
            </div>
            <br>
            <input value="<?php echo $offer->offer_code ?>" class="form-control" id="code" name="code" placeholder="Offer Code" maxlength="250" required>
            <br>
            <input value="<?php echo $offer->offer ?>" class="form-control" id="offer" name="offer" placeholder="Offer Name / Description" maxlength="250" required>
            <br>
            <button class="btn btn-lg btn-primary" type="submit">Edit Offer</button>
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
  </body>
</html>
