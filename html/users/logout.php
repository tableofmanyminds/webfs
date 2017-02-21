<?php
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=login.php');

	include '../../conf.php';
	if(empty($_COOKIE['cookie'])) $_COOKIE['cookie'] = 'null';
	$username = readuserbycookie($_COOKIE['cookie']);
	if(isset($username[0][0])) {
		logout($username[0][0]);
		setcookie('cookie', 'null', 1, '/');
	}
	header('Refresh:0; url=../index.php');
?>
