<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');
?>

<a href='createdirectory.php'>Create directory</a>

<p>
	<?php
		foreach(readdirectories() as $directory) {
			$host = $directory[0];
			$user = $directory[1];
			$pass = $directory[2];
			$sys = $directory[3];
			$dir = $directory[4];
			$id = $directory[5];
			printf("\t%s, %s, %s, %s, %s, <a href='editdirectory.php?id=%s'>edit</a>, <a href='deletedirectory.php?id=%s'>delete</a>\n", $host, $user, $pass, $sys, $dir, $id, $id);
		}
	?>
</p>
