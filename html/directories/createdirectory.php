<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');

	if(empty($_POST['hostname']) || empty($_POST['username']) || empty($_POST['passwd']) || empty($_POST['systemname']) || empty($_POST['directorypath'])) {
		$_POST['hostname'] = null;
		$_POST['username'] = null;
		$_POST['passwd'] = null;
		$_POST['systemname'] = null;
		$_POST['directorypath'] = null;
		?>
			<form method='post'>
				<p>
					Hostname:<br>
					<input type='text' name='hostname'><br>
					Username:<br>
					<input type='text' name='username'><br>
					Password:<br>
					<input type='password' name='passwd'><br>
					Systemname:<br>
					<input type='text' name='systemname'><br>
					Directorypath:<br>
					<input type='text' name='directorypath'><br>
					<input type='submit' value='Create directory'>
				</p>
			</form>
		<?php
	}
	else {
		createdirectory($_POST['hostname'], $_POST['username'], $_POST['passwd'], $_POST['systemname'], $_POST['directorypath']);
		header('Refresh:0; url=createdirectory.php');
	}
?>
