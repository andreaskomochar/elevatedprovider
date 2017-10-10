<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h2>Stanje uploada</h2>
	
	<ul>
	<?php foreach ($upload_data as $item => $value):?>
		<li><?php echo $item;?>: <?php echo $value;?></li>
		<?php endforeach; ?>
	</ul>
	
	<?php echo "Upload finished in: ".$time."</br>"; ?>
	<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>

</body>
</html>