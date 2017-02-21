<?php
	include '../../conf.php';
	$ret = readusers();
	print_r($ret);
	if($ret != false) return 0;
	return 1;
?>
