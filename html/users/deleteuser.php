<?php
	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=login.php');
	if(readuserbycookie($_COOKIE['cookie'])[0][2] != 'admin') header('Refresh:0; url=../index.php');

	if(empty($_GET['name'])) {
		$_GET['name'] = null;
		header('Refresh:0; url=manageusers.php');
	}
	else {
		deleteuser($_GET['name']);
		header('Refresh:0; url=manageusers.php');
	}
?>
