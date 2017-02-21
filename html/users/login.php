<?php
	if(empty($_POST['username']) || empty($_POST['password'])) {
		$_POST['username'] = null;
		$_POST['password'] = null;
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>WebFS</title>
				<link rel='stylesheet' type='text/css' href='../css/users/login.css'>
			</head>
			<body>
				<p id='title'>WebFS</p>
				<hr>
				<form method='post'>
					<p>
						Username:<input type='text' name='username'><br>
						Password:<input type='password' name='password'><br>
						<input type='submit' value='Login'>
					</p>
				</form>
			</body>
			</html>
		<?php
	}
	else {
		include '../../conf.php';
		$cookie = login($_POST['username'], $_POST['password']);
		setcookie('cookie', $cookie, 0, '/');
		header('Refresh:0; url=../index.php');
	}
?>
