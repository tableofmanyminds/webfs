<?php
	include '../../conf.php';
	$toprint = readhostsbysystem($argv[1]);
	print_r($toprint);
	if($toprint != false) return 0;
	return 1;
?>
