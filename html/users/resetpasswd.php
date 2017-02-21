<?php
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=login.php');

	if(empty($_COOKIE['cookie'])) {
		$_COOKIE['cookie'] = null;
		header('Refresh:0; url=../index.php');
	}
	elseif(!empty($_COOKIE['cookie']) && empty($_POST['passwd'])) {
		$_POST['passwd'] = null;
		?>
			<form method='post'>
				<p>
					Password:<br>
					<input type='password' name='passwd'><br>
					<input type='submit' value='Reset password'>
				</p>
			</form>
		<?php
	}
	else {
		include '../../conf.php';
		$username = readuserbycookie($_COOKIE['cookie']);
		updateuser($username[0][0], null, $_POST['passwd'], null);
		header('Refresh:0; url=resetpasswd.php');
	}
?>
