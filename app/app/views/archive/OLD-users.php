<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Users | Admin Area</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
</head>
<body>

<div id="container">
	<h1>Users Management | Admin Dashboard</h1>

	<div id="body">
		<p>HERE COMES THE FIRST LINE OF LINKS (MAIN MENU)</p>
		<p>HERE COMES THE SECOND LINE OF LINKS (SECONDARY MENU)</p>
		<p>
			<table>
				<tr>
					<th>User ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Admin?</th>
					<th>Edit</th>
				</tr>
				<?php foreach ($users as $user) : ?>
					<tr>
						<td><?php echo $user->id; ?></td>
						<td><?php echo $user->first_name; ?></td>
						<td><?php echo $user->last_name; ?></td>
						<td><?php echo $user->email; ?></td>
						<td><?php if($user->is_admin > 0) echo "Yes"; else echo "No"; ?> (<a href="<?php echo base_url(); ?>admin/users/admin/<?php echo $user->id; ?>" title="<?php if($user->is_admin > 0) echo "Disable"; else echo "Enable"; echo " $user->first_name $user->last_name administrator rights"; ?>"><?php if($user->is_admin > 0) echo "UNSET"; else echo "Set"; ?> as Admin</a>)</td>
						<td><a href="<?php echo base_url(); ?>admin/users/edit/<?php echo $user->id; ?>" title="Edit <?php echo "$user->first_name $user->last_name"; ?>">Edit user</a> | <a href="<?php echo base_url(); ?>admin/users/active/<?php echo $user->id; ?>" title="<?php if ($user->is_disabled > 0) echo 'Enable'; else echo 'Disable'; echo " $user->first_name $user->last_name" ?>"><?php if ($user->is_disabled > 0) : ?>Enable user<?php else : ?>Disable user<?php endif; ?></a><?php if($user->is_disabled > 0) echo " (DISABLED)"; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
