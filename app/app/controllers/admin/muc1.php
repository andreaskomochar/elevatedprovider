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

    <title>Unsubscribe email | Admin Area | XenaPedia</title>

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
    <script>
        $(function () {
            $("#datepickerstart").datepicker({
                dateFormat : 'yy-mm-dd'
            });
        });

    </script>


</head>
<body>
<?php include('include/main-menu.php'); ?>

<div class="container-fluid">

    <div class="row">
        <?php include('include/left-menu.php'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php if ($this->session->flashdata('success')) : ?>
                <?php echo '<p class="alert alert-success">' . $this->session->flashdata('success') . '</p>'; ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')) : ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('error') . '</p>'; ?>
            <?php endif; ?>

            <h1 class="page-header">Email</h1>

            <div class="row">
                
                <div class="col-xs-6 col-sm-4">
                    <span class="metric"><?php echo $this->Muc_model->count_muc_duplicates(); ?></span>
                    <h3>Duplicated emails</h3>
                    <span class="text-muted">Number of duplicate emails to download</span>
                    <form action="<?php echo base_url() ?>index.php/admin/muc/exportCSV" method="post" enctype="multipart/form-data" name="form1" id="form">
                        <table>
                            
                            <input type="submit" name="submit" value="Download Duplicates" class="btn btn-primary">
                            </br>
                        </table>
                    <?php echo form_close(); ?>
                </div>


                <div class="col-xs-6 col-sm-4">
                    <span class="metric"><?php echo $this->Muc_model->count_muc_active(); ?></span>
                    <h3>Active emails uploaded </h3>
                    <span class="text-muted">Active mails to be checked with unsubscribers</span>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <span class="metric"><?php echo $this->Muc_model->count_muc_unsubscribers(); ?></span>
                    <h3>Total Unsubscribed emails</h3>
                    <span class="text-muted">Total number of unsubscribed emails</span>
                </div>
            </div>

            <hr>
            <div class="container" style="margin-top:00px">
                <div style="width:1000px; margin:0 auto;">
                    <h3>!! Check For Duplicated Emails In Boath Databases Before Download CSV File !!</h3>
                    <form action="<?php echo base_url() ?>index.php/admin/muc/check_duplicates" method="post" enctype="multipart/form-data" name="form" id="form">

                        <div style="width:600px;margin:0 auto;">
                            <h4>After import of all emails, check for duplicated emails and download them.</h4>
                            <h5 style = "color:red">NOTE: CHECK WILL RESET ACTIVES AND PREVIOUS DUPLICATE CHECK!</h5>
                        </div>

                        <div style="width:450px;margin:0 auto;">

                            <button class="btn btn-lg btn-primary" type="submit" name="submit">!! Check Duplicated
                                Emails !!
                            </button>
                        </div>
                    </form>
                </div>
                </br>
                <th>


                    <h3>Import CSV File - Active Emails Into Database</h3>
                    
                      <h4>CSV file: max size 3MB - 3000KB (max 100.000 e-mails in a file)</h4>
                    <?php echo form_open_multipart('admin/upload/do_upload_ac');?>
                          
                        <input type="file" name="userfile"><br><br>
                        <input type="submit" name="submit" value="Add Active Emails" class="btn btn-primary">
					<?php echo form_close(); ?>


                    </br>
                    </br>

                    <h3>Import CSV File - Unsubscribed Emails Into Database</h3>
                    
                      <h4>CSV file: max size 3MB - 3000KB (max 100.000 e-mails in a file)</h4>
                    <?php echo form_open_multipart('admin/upload/do_upload_un');?>
                        <input type="file" name="userfile"><br><br>
                        <input type="submit" name="submit" value="Add Unsubscribed Emails" class="btn btn-primary">
                    <?php echo form_close(); ?>

                    <br>
                    <br>


                    <!--DELA!!! -->
                    <h3>Download CSV File - Duplicated Emails from Database</h3>

                    </br>

                    <form action="<?php echo base_url() ?>index.php/admin/muc/exportCSV" method="post" enctype="multipart/form-data" name="form1" id="form">
                        <table>
                            
                            <input type="submit" name="submit" value="Download Duplicates" class="btn btn-primary">
                            </br>
                        </table>
                    <?php echo form_close(); ?>


                    </br>
                    

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
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