<?php
	include '../../conf.php';
	$toprint = readhosts();
	print_r($toprint);
	if($toprint != false) return 0;
	return 1;
?>
