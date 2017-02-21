<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');
?>

<a href='createuser.php'>Create user</a>

<p>
	<?php
		foreach(readusersnamesandtypes() as $nameandtype) {
			$name = $nameandtype[0];
			$type = $nameandtype[1];
			printf("\t%s, %s, <a href='edituser.php?name=%s'>edit</a>, <a href='deleteuser.php?name=%s'>delete</a><br>\n", $name, $type, $name, $name);
		}
	?>
</p>
