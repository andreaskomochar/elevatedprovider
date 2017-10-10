<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <!-- <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li> -->
    <li><?php echo anchor('admin', 'Dashboard'); ?></li>
    <li><?php echo anchor('admin/users', 'Users Overview'); ?></li>
    <li><?php echo anchor('admin/users/add', 'Add New User'); ?></li>    
 </ul>
 <hr>
 
 <ul class="nav nav-sidebar">    
    <li><?php echo anchor('admin/muc', 'Unsubscribers'); ?></li>
    <li><?php echo anchor('admin/campaigns', 'Campaigns'); ?></li>  
 </ul>
 <hr>
 
  <ul class="nav nav-sidebar">
   <!-- <li><?php echo anchor('admin/campaigns', 'Elastic Email'); ?></li> -->
 <!--  <li><?php echo anchor('admin/muc', 'Unsubscribers'); ?></li>  -->
   <br/>
    <li><?php echo anchor('admin/creatives', 'Creatives Overview'); ?></li>
    <li><?php echo anchor('admin/creatives/add', 'Add New Creative'); ?></li>
    <li><?php echo anchor('admin/creatives/tags', 'Tags'); ?></li>
    <li><?php echo anchor('admin/creatives/offers', 'Offers'); ?></li>
    <li><?php echo anchor('admin/creatives/verticals', 'Verticals'); ?></li>
    <li><?php echo anchor('admin/creatives/subjects', 'Subject Lines'); ?></li>

  </ul>
  <!-- <ul class="nav nav-sidebar">
    <li><a href="">Nav item again</a></li>
    <li><a href="">One more nav</a></li>
    <li><a href="">Another nav item</a></li>
  </ul> -->
</div>
