<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Xenapedia</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/">Dashboard</a></li>
        <li><?php echo anchor('user/settings', 'Settings', 'title="Settings"'); ?></li>

         <li><a href="<?php echo base_url(); ?>index.php/user/wiki" target="_blank" title="Internal Xena WikiPedia">Wiki</a></li>

        <!--  <li><a href="<?php echo base_url(); ?>wiki" target="_blank" title="Internal Xena WikiPedia">Wiki</a></li> -->
       <!--  <li><a href="<?php echo base_url(); ?>index.php/user/wikis" target="_blank" title="Internal Xena WikiPedia">Wiki</a></li> -->
        <?php if($this->User_model->isadmin($this->session->userdata('user_id'))) : ?>

        <li><?php echo anchor('admin', 'Admin Area', 'target="_blank" title="Admin Area"'); ?></li>
      <?php endif; ?>
        <li><?php echo anchor('user/logout', 'Log Out', 'title="Log Out"'); ?></li>
        <li><a href="mailto:rok@xenainteractive.com">Help</a></li>
      </ul>
      <form class="navbar-form navbar-right" accept-charset="utf-8" action="/index.php/user/creatives/search" method="get">
        <input <?php if(isset($search)) echo 'value="'.$search.'" '; ?>type="text" name="q" class="form-control" placeholder="Search...">
      </form>
    </div>
  </div>
</nav>
