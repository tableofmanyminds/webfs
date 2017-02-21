<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');

	if(empty($_GET['name'])) $_GET['name'] = null;
	if(empty($_POST['newname'])) $_POST['newname'] = null;
	if(empty($_POST['passwd'])) $_POST['passwd'] = null;
	if(empty($_POST['type'])) $_POST['type'] = null;

	if(empty($_POST['newname']) && empty($_POST['passwd']) && empty($_POST['type'])) {
		$_POST['newname'] = null;
		$_POST['passwd'] = null;
		$_POST['type'] = null;
		?>
			<form method='post'>
				<p>
					<input type='hidden' name='name' value='<?php printf("%s", $_GET['name']); ?>'>
					Username:<br>
					<input type='text' name='newname'><br>
					Password:<br>
					<input type='password' name='passwd'><br>
					<select name='type'>
						<option value='user'>User</option>
						<option value='admin'>Admin</option>
					</select><br>
					<input type='submit' value='Edit user'>
				</p>
			</form>
		<?php
	}
	else {
		updateuser($_POST['name'], $_POST['newname'], $_POST['passwd'], $_POST['type']);
		header('Refresh:0; url=edituser.php');
	}
?>
