<?php
	include '../../conf.php';
	$toprint = search($argv[1], $argv[2]);
	print_r($toprint);
	return 0;
?>
