<?php
	include '../../conf.php';
	$toprint = readuserbycookie($argv[1]);
	print_r($toprint);
	return 0;
?>
