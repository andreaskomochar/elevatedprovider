<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Edit Creative | Admin Area | XenaPedia</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    <script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
      selector:'textarea',
      height: 500,
      plugins: "code"
    });</script>
    <script src="//code.jquery.com/jquery-3.1.0.slim.min.js" integrity="sha256-cRpWjoSOw5KcyIOaZNo4i6fZ9tKPhYYb6i5T9RSVJG8=" crossorigin="anonymous"></script>
  </head>

  <body>

    <?php include('include/main-menu.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('include/left-menu.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Edit Creative</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<p class="alert alert-danger">'); ?>
          <?php
            $atts = array('id' => 'creative_edit', 'role' => 'form');
            $hidden = array(
              'current_offer_id' => $creative->offer_id,
              'current_creative_code' => $creative->creative_code);
            echo form_open('admin/edit/creative/'.$creative->creative_id, $atts, $hidden);
          ?>
            <select id="offer_id" name="offer_id" class="form-control" required>
              <option value="">Please select an offer which this creative belongs to</option>
              <?php foreach($offers as $offer) : ?>
                <option value="<?php echo $offer->offer_id; ?>"<?php if($creative->offer_id == $offer->offer_id) echo ' selected'; ?>><?php echo "$offer->offer ($offer->offer_code)"; ?></option>
              <?php endforeach; ?>
            </select>
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Tags</h3>
              </div>
              <div class="panel-body">
                <?php if(isset($creative->creative_tags)) $selected_tags = explode(',',$creative->creative_tags); else $selected_tags = FALSE; ?>
                <?php foreach ($tags as $tag) : ?>
                  <input type="checkbox" name="tags[]" value="<?php echo $tag->tag_id ?>"<?php if($selected_tags && in_array($tag->tag_id,$selected_tags)) echo ' checked'; ?>><span class="label label-<?php echo $tag->tag_color_class ?>"><?php echo $tag->tag ?></span></input>
                <?php endforeach; ?>
              </div>
            </div>
            <input value="<?php echo $creative->creative_code ?>" id="code" name="code" placeholder="Code of creative" class="form-control" required>
            <br>&nbsp;
            <p>You can view, edit and / or copy the HTML source code via <strong>Tools -> Source Code</strong> in the top menu of the following text area...</p>
            <textarea id="creative" name="creative"><?php echo $creative->creative ?></textarea>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Edit Creative</button>
          <?php echo form_close(); ?>
					<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo base_url(); ?>assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
