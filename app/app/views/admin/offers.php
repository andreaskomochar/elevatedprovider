<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Offers | Admin Area | XenaPedia</title>

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
          <h1 class="page-header">Offers</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<p class="alert alert-danger">'); ?>
          <h2 class="sub-header">Add Offer</h2>
          <?php
            $atts = array('id' => 'offer_add', 'role' => 'form');
            echo form_open('admin/creatives/offers', $atts);
          ?>
            <select class="form-control" id="vertical" name="vertical" required>
              <option value="">Please select a vertical</option>
              <?php foreach($verticals as $vertical) : ?>
                <option value="<?php echo $vertical->vertical_id ?>"><?php echo $vertical->vertical ?></option>
              <?php endforeach; ?>
            </select>
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Tags</h3>
              </div>
              <div class="panel-body">
                <?php foreach ($tags as $tag) : ?>
                  <input type="checkbox" name="tags[]" value="<?php echo $tag->tag_id ?>"><span class="label label-<?php echo $tag->tag_color_class ?>"><?php echo $tag->tag ?></span></input>
                <?php endforeach; ?>
              </div>
            </div>
            <input class="form-control" id="code" name="code" placeholder="Offer Code" maxlength="250" required>
            <br>
            <input class="form-control" id="offer" name="offer" placeholder="Offer Name / Description" maxlength="250" required>
            <br>
            <button class="btn btn-lg btn-primary" type="submit">Add Offer</button>
          <?php echo form_close(); ?>

          <h2 class="sub-header">List of all Offers</h2>
          <?php if($offers) : ?>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Offer ID</th>
                  <th>Offer Code</th>
                  <th>Vertical</th>
                  <th>Offer Name / Short Description</th>
                  <th>Tags</th>
                  <th>Last edit</th>
                  <th>Creation date</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($offers as $offer) : ?>
                <tr>
                  <td><?php echo $offer->offer_id; ?></td>
                  <td><?php echo $offer->offer_code; ?></td>
                  <td><?php echo $offer->vertical; ?></td>
                  <td><?php echo $offer->offer; ?></td>
                  <td>
                    <?php
                      if($offer->offer_tags !== null) {
                        $tags_used = explode(',',$offer->offer_tags);
                      }
                      if(isset($tags_used)) {
                        foreach ($tags_used as $tag) {
                          echo '<span class="label label-'.$tags[$tag - 1]->tag_color_class.'">'.$tags[$tag - 1]->tag.'</span> ';
                        }
                      } else {
                        echo 'No tags';
                      }
                    ?>
                  </td>
                  <td><?php echo date('Y-m-d h:i A', strtotime($offer->offer_edited) ); ?></td>
                  <td><?php echo date('Y-m-d h:i A', strtotime($offer->offer_created) ); ?></td>
                  <td><?php echo anchor('admin/edit/offer/'.$offer->offer_id,'Edit'); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else : ?>
            <p>No offers found</p>
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
