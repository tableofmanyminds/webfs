<?php
	include '../../conf.php';
	$toprint = possearch($argv[1], file($argv[2]));
	print_r($toprint);
	return 0;
?>
