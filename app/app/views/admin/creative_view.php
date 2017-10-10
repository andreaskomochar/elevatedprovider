<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>View Creative | Admin Area | XenaPedia</title>

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
    <script src="//code.jquery.com/jquery-3.1.0.slim.min.js" integrity="sha256-cRpWjoSOw5KcyIOaZNo4i6fZ9tKPhYYb6i5T9RSVJG8=" crossorigin="anonymous"></script>
  </head>

  <body>

    <?php include('include/main-menu.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('include/left-menu.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">View Creative</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <ul class="list-group">
            <li class="list-group-item">Creative ID: <?php echo $creative->creative_id ?></li>
            <li class="list-group-item">Creative Code: <?php echo $creative->creative_code ?></li>
            <li class="list-group-item">Creative Tags:
              <?php
              if(isset($creative->creative_tags)) {
        				$selected_tags = explode(',',$creative->creative_tags);
        			} else {
                $selected_tags = FALSE;
              }
              if($selected_tags) {
                foreach ($selected_tags as $tag) {
                  echo '<span class="label label-'.$tags[$tag - 1]->tag_color_class.'">'.$tags[$tag - 1]->tag.'</span> ';
                }
              } else {
                echo 'No tags';
              }
              ?>
            </li>
            <li class="list-group-item">Vertical: <?php echo $vertical->vertical ?></li>
            <li class="list-group-item">Offer: <?php echo $offer->offer ?> (<?php echo $offer->offer_code ?>)</li>
            <li class="list-group-item">Last Edit: <?php echo date('Y-m-d h:i A', strtotime($creative->creative_edited) ); ?></li>
            <li class="list-group-item">Creation Date: <?php echo date('Y-m-d h:i A', strtotime($creative->creative_created) ); ?></li>
          </ul>
          <ul class="nav nav-tabs">
            <li role="presentation"<?php if(!$html) echo' class="active"'; ?>><?php echo anchor('admin/creatives/view/'.$creative->creative_id, 'View Formatted Creative'); ?></li>
            <li role="presentation"<?php if($html) echo' class="active"'; ?>><?php echo anchor('admin/creatives/view/'.$creative->creative_id.'/html', 'View HTML'); ?></li>
          </ul>
          <p>
          <?php if(!$html) : ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <?php echo $creative->creative; ?>
              </div>
            </div>
          <?php else : ?>
            <textarea id="html" style="height:250px;width:100%;" onclick="this.focus();this.select()" readonly="readonly"><?php echo $creative->creative; ?></textarea>
          <?php endif; ?>
          </p>
          <h2 class="sub-header">List of all Subject Lines on Offer "<?php echo $offer->offer ?>"</h2>
          <?php if($subject_lines) : ?>
          <p>The following subject lines have the word "<strong><?php echo $search ?></strong>" found in one of these parameters: subject line, offer code, offer description or vertical name.</p>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Subject Line</th>
                  <th>Offer (Offer Code)</th>
                  <th>Vertical</th>
                  <th>Last Edit</th>
                  <th>Creation Date</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($subject_lines as $subject_line) : ?>
                <tr>
                  <td><?php echo $subject_line->subject_id; ?></td>
                  <td><?php echo $subject_line->subject; ?></td>
                  <td><?php echo $subject_line->offer; ?> (<?php echo $subject_line->offer_code; ?>)</td>
                  <td><?php echo $subject_line->vertical; ?></td>
                  <td><?php echo date('l, Y-m-d h:i A', strtotime($subject_line->subject_edited) ); ?></td>
                  <td><?php echo date('l, Y-m-d h:i A', strtotime($subject_line->subject_created) ); ?></td>
                  <td><?php echo anchor('admin/edit/subject/'.$subject_line->subject_id,'Edit'); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else : ?>
            <p>There are no Subject Lines containing the word "<strong><?php echo $search ?></strong>" on Offers found</p>
          <?php endif; ?>
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
