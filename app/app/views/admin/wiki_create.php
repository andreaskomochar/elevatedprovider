<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">


    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet"/>

    <script src="<?php echo base_url(); ?>assets/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

    <title>Wiki | Admin Area | XenaPedia</title>

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


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
     tinymce.init ({
        selector: "#mytextarea",
            plugins : "autolink,image,emoticons,fullpage,fullscreen,imagetools,media,insertdatetime,preview,save,table,textcolor,visualchars,nonbreaking",
            theme_advanced_buttons1_add: 'insertimage,insertfile',
            theme_advanced_buttons2_add: 'separator,forecolor,backcolor',
               extended_valid_elements :"img[src|border=0|alt|title|width|height|align|name],"
            +"a[href|target|name|title],"
            +"p,"
            
        }); 

            </script>
</head>
<body>
<?php include('include/main-menu.php'); ?>




 <div class="container-fluid">
      <div class="row">
        <?php include('include/left-menu.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Create new Wiki Item</h1>
          <?php if($this->session->flashdata('success')) : ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')) : ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<p class="alert alert-danger">'); ?>
          

<h1>Add new post</h1>
        <form action="<?php echo base_url() ?>index.php/admin/wiki/create" method="post" name="form1">
           
            <label for="title">Title</label>
            </br>
            <input type="input" name="title" size="100" />
            </br>
            </br>
			<label for="text">Wiki Text</label></br>
            <textarea id="mytextarea" for="text" type="text" name="text"> </textarea>
            </br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" value="Create wiki item">Create new Wiki post </button>
                        
        <?php echo form_close(); ?>


<br>
<br>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>

  
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