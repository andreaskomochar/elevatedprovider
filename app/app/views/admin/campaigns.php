<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Elastic email | Admin Area | XenaPedia</title>

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
          <h1 class="page-header">Elastic email Campaigns</h1>

      

       <div class="row">
            <div class="col-xs-6 col-sm-3">
              <h3>Total Campaigns: </h3>
              <span class="metric"><?php echo $this->Campaign_model->count_campaigns(); ?></span>
            </div>
        
          </div> <hr>

                    
          <h3 class="sub-header">List of EE Campaigns - Last 5 Added:</h3>                                  
                
              <table class="table table-striped">
				<tr>
					<th>Channel ID</th>
					<th>Name</th>
					<th>Clicked</th>
					<th>Open</th>
					<th>Recipient</th>
					<th>Sent</th>
					<th>Failed</th>
					<th>Unsubscribed</th>
					<th>Date Added</th>
					<th>Last Activity</th>
					
				</tr>
		
		<?php
			foreach ($campaigns as $key) {
				echo "<tr>";
				echo "<td>".$key['ee_channelid']."</td>";
				echo "<td>".$key['ee_name']."</td>";				
				echo "<td>".$key['ee_clicked']."</td>";				
				echo "<td>".$key['ee_open']."</td>";				
				echo "<td>".$key['ee_recipient']."</td>";				
				echo "<td>".$key['ee_sent']."</td>";				
				echo "<td>".$key['ee_failed']."</td>";				
				echo "<td>".$key['ee_unsubscribed']."</td>";				
				echo "<td>".$key['ee_dateadded']."</td>";				
				echo "<td>".$key['ee_lastactive']."</td>";				
				echo "</tr>";
			}
		?>
		
	</table>
              
            
          </div>
        </div>

<div class="row">

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <h1 class="page-header">Cake Campaigns</h1>

      

       <div class="row">
            <div class="col-xs-6 col-sm-3">
              <h3>Total Campaigns: </h3>
              <span class="metric"><?php echo $this->Campaign_model->count_cake_campaigns(); ?></span>
            </div>

            <div class="col-xs-6 col-sm-3">
              <h4>Upload Cake Campaigns from CSV file </h4>
              <?php echo form_open_multipart('admin/upload/do_upload_cake');?>
                        <input type="file" name="userfile"><br><br>
                        <input type="submit" name="submit" value="Add CSV" class="btn btn-primary">
              <?php echo form_close(); ?>
            </div>
        
          </div> <hr>

                    
          <h3 class="sub-header">List of Cake Campaigns</h3>                                  
                
              <table class="table table-striped">
        <tr>
          <th>Affiliate Name</th>
          <th>Creative</th>
          <th>Campaign</th>
          <th>Sub ID</th>
          <th>Sub ID 2</th>
          <th>Sub ID 3</th>
          <th>Sub ID 4</th>
          <th>Sub ID 5</th>
          <th>Click Date</th>


        </tr>
    
    <?php
      foreach ($cake as $key) {
        echo "<tr>";
        echo "<td>".$key['Creative']."</td>";  
        echo "<td>".$key['Campaign']."</td>";  
        echo "<td>".$key['Creative']."</td>";             
        echo "<td>".$key['Sub ID']."</td>";             
        echo "<td>".$key['Sub ID 2']."</td>";             
        echo "<td>".$key['Sub ID 3']."</td>";             
        echo "<td>".$key['Sub ID 4']."</td>";             
        echo "<td>".$key['Sub ID 5']."</td>";             
        echo "<td>".$key['Click_Date']."</td>";  
        echo "</tr>";
      }
    ?>
    
  </table>
              
            
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
