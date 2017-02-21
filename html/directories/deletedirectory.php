<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');

	if(empty($_GET['id'])) {
		$_GET['id'] = null;
		header('Refresh:0; url=managedirectories.php');
	}
	else {
		deletedirectory($_GET['id']);
		header('Refresh:0; url=managedirectories.php');
	}
?>
