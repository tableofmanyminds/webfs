<?php
	include '../../conf.php';
	$ret = login($argv[1], $argv[2]);
	print("$ret\n");
	if($ret != false) return 0;
	return 1;
?>
