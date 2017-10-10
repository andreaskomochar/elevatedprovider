<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>"<?php echo $search ?>" | Search Results | Members Area | Xenapedia</title>

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
          <h1 class="page-header">Search Results for "<?php echo $search ?>"</h1>
          <h2 class="sub-header">List of found Creatives</h2>
          <?php if($creatives) : ?>
          <p>The following creatives have the word "<strong><?php echo $search ?></strong>" found in one of these parameters: creative code, offer code, creative body, offer description or vertical name.</p>
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
          <?php else : ?>
            <p>There are no creatives containing the word "<strong><?php echo $search ?></strong>" found.</p>
          <?php endif; ?>
          <h2 class="sub-header">List of found Offers</h2>
          <?php if($offers) : ?>
          <p>The following offers have the word "<strong><?php echo $search ?></strong>" found in one of these parameters: offer code, offer description or vertical name.</p>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Offer ID</th>
                  <th>Offer Code</th>
                  <th>Vertical</th>
                  <th>Offer Name / Short Description</th>
                  <th>Offer Tags</th>
                  <th>Last edit</th>
                  <th>Creation date</th>
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
                      if(null !== $offer->offer_tags) {
                        $tags_used = explode(',',$offer->offer_tags);
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
                  <td><?php echo date('Y-m-d h:i A', strtotime($offer->offer_edited) ); ?></td>
                  <td><?php echo date('Y-m-d h:i A', strtotime($offer->offer_created) ); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else : ?>
            <p>There are no offers containing the word "<strong><?php echo $search ?></strong>" found.</p>
          <?php endif; ?>
          <h2 class="sub-header">List of found Subject Lines on Offers</h2>
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
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else : ?>
            <p>There are no Subject Lines containing the word "<strong><?php echo $search ?></strong>" on Offers found</p>
          <?php endif; ?>
          <br>&nbsp;
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
