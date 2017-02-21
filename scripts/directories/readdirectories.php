<?php
	include '../../conf.php';
	$toprint = readdirectories();
	print_r($toprint);
	if($toprint != false) return 0;
	return 1;
?>
