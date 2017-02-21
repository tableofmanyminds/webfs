<?php
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');

	if(empty($_GET['file'])) {
		$_GET['file'] = null;
		header('Refresh:0; url=../index.php');
	}
	else {
		include '../../conf.php';
		download($_GET['file']);
	}
?>
