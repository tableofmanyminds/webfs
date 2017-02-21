<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');

	if(empty($_POST['name']) || empty($_POST['passwd']) || empty($_POST['type'])) {
		$_POST['name'] = null;
		$_POST['passwd'] = null;
		$_POST['type'] = null;
		?>
			<form method='post'>
				<p>
					Username:<br>
					<input type='text' name='name'><br>
					Password:<br>
					<input type='password' name='passwd'><br>
					<select name='type'>
						<option value='user'>User</option>
						<option value='admin'>Admin</option>
					</select><br>
					<input type='submit' value='Create user'>
				</p>
			</form>
		<?php
	}
	else {
		createuser($_POST['name'], $_POST['passwd'], $_POST['type']);
		header('Refresh:0; url=createuser.php');
	}
?>
