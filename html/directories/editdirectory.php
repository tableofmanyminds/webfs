<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');

	if(empty($_GET['id'])) $_GET['id'] = null;
	if(empty($_POST['hostname'])) $_POST['hostname'] = null;
	if(empty($_POST['username'])) $_POST['username'] = null;
	if(empty($_POST['passwd'])) $_POST['passwd'] = null;
	if(empty($_POST['systemname'])) $_POST['id'] = null;
	if(empty($_POST['directorypath'])) $_POST['directorypath'] = null;

	if(empty($_POST['hostname']) && empty($_POST['username']) && empty($_POST['passwd']) && empty($_POST['systemname']) && empty($_POST['directorypath'])) {
		$_POST['hostname'] = null;
		$_POST['username'] = null;
		$_POST['passwd'] = null;
		$_POST['systemname'] = null;
		$_POST['directorypath'] = null;
		?>
			<form method='post'>
				<p>
					<input type='hidden' name='id' value='<?php printf("%s", $_GET['id']); ?>'>
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
					<input type='submit' value='Edit directory'>
				</p>
			</form>
		<?php
	}
	else {
		updatedirectory($_POST['id'], $_POST['hostname'], $_POST['username'], $_POST['passwd'], $_POST['systemname'], $_POST['directorypath']);
		header('Refresh:0; url=editdirectory.php');
	}
?>
