<?php
	include '../../conf.php';
	$args = $argv;
	$oldname = array_pop($args);
	$args = getoptopt('upt', $args);
	/* disable E_NOTICE as i'm using proper functionality of the language that happens to generate unwanted notice messages. if an array offset is undefined, the value passed is null. */
	error_reporting(E_STRICT & ~E_DEPRECATED);
	return updateuser($oldname, $args['u'], $args['p'], $args['t']);
?>
