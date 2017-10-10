<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Creatives | Members Area | XenaPedia</title>

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
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <h1 class="page-header">Creatives</h1>

          <div class="row">
            <div class="col-xs-6 col-sm-3">
              <span class="metric"><?php echo $this->Creative_model->count_creatives(); ?></span>
              <h4>Total Creatives</h4>
              <span class="text-muted">Total number of creatives in the database</span>
            </div>
            <div class="col-xs-6 col-sm-3">
              <span class="metric"><?php echo $this->Creative_model->count_verticals(); ?></span>
              <h4>Total Verticals</h4>
              <span class="text-muted">Total different verticals</span>
            </div>
            <div class="col-xs-6 col-sm-3">
              <span class="metric">$0.00<?php // echo $this->User_model->count_disabled_users(); ?></span>
              <h4>Average revenue</h4>
              <span class="text-muted">Average revenue per creative</span>
            </div>
            <div class="col-xs-6 col-sm-3">
              <span class="metric">$0.00<?php // echo $this->User_model->count_disabled_users(); ?></span>
              <h4>Average revenue</h4>
              <span class="text-muted">Average revenue per vertical</span>
            </div>
          </div>

          <h2 class="sub-header">List of all Creatives</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Creative ID</th>
                  <th>Vertical</th>
                  <th>Offer</th>
                  <th>Creative Code</th>
                  <th>Creative Tags</th>
                  <th>Last Edit</th>
                  <th>Creation Date</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($creatives as $creative) : ?>
                <tr>
                  <td><?php echo $creative->creative_id; ?></td>
                  <td><?php echo $creative->vertical; ?></td>
                  <td><?php echo $creative->offer; ?> (<?php echo $creative->offer_code; ?>)</td>
                  <td><?php echo $creative->creative_code; ?></td>
                  <td>
                    <?php
                      if(null !== $creative->creative_tags) {
                        $tags_used = explode(',',$creative->creative_tags);
                      } else {
                        $tags_used = FALSE;
                      }
                      if($tags_used) {
                        foreach ($tags_used as $tag) {
                          echo '<span class="label label-'.$tags[$tag - 1]->tag_color_class.'">'.$tags[$tag - 1]->tag.'</span> ';
                        }
                      } else {
                        echo 'No tags';
                      }
                    ?>
                  </td>
                  <td><?php echo date('Y-m-d h:i A', strtotime($creative->creative_edited) ); ?></td>
                  <td><?php echo date('Y-m-d h:i A', strtotime($creative->creative_created) ); ?></td>
                  <td><?php echo anchor('user/creatives/view/'.$creative->creative_id, 'View'); ?> | <?php echo anchor('user/creatives/view/'.$creative->creative_id.'/html', 'HTML'); ?></td>
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
