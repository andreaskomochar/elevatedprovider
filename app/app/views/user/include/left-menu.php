<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
  <li><?php echo anchor('user', 'Dashboard'); ?></li>
  <br/>
    <li><a href="#">Overview</a></li>
    <li><a href="#">Reports</a></li>
    <li><a href="#">Analytics</a></li>
    <li><a href="#">Export</a></li>
    
  </ul>
  <ul class="nav nav-sidebar">
 <!--  <li><?php echo anchor('user/campaigns', 'Elastic Email'); ?></li>-->

 <li><?php echo anchor('user/wikis', 'Wiki'); ?>
  <br/>
    <li><?php echo anchor('user/creatives', 'Creatives Overview'); ?></li>
    <li><?php echo anchor('user/creatives/tags', 'Tags'); ?></li>
    <li><?php echo anchor('user/creatives/offers', 'Offers'); ?></li>
    <li><?php echo anchor('user/creatives/verticals', 'Verticals'); ?></li>
    <li><?php echo anchor('user/creatives/subjects', 'Subject Lines'); ?></li>
  </ul>
  <!-- <ul class="nav nav-sidebar">
    <li><a href="">Nav item again</a></li>
    <li><a href="">One more nav</a></li>
    <li><a href="">Another nav item</a></li>
  </ul>-->
</div>
