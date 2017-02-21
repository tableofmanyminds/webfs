<?php
	include '../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>WebFS</title>
	<link rel='stylesheet' type='text/css' href='css/index.css'>
</head>
<body>
	<p id='title'>WebFS</p>
	<hr>
	<div id='user'>
		<a href='files/search.php'>search</a>
		<a href='files/upload.php'>upload</a>
	</div>
	<?php if(!empty($_COOKIE['cookie']) && readuserbycookie($_COOKIE['cookie'])[0][2] == 'admin') { ?>
		<div id='admin'>
			<a href='users/manageusers.php'>users</a>
			<a href='directories/managedirectories.php'>directories</a>
		</div>
	<?php } ?>
	<div>
		<a href='users/logout.php'>logout</a>
		<a href='users/resetpasswd.php'>reset passwd</a>
	</div>
</body>
</html>
