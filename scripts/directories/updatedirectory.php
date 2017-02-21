<?php
	include '../../conf.php';
	$args = $argv;
	$directoryid = array_pop($args);
	$args = getoptopt('hupsd', $args);
	/* disable E_NOTICE as i'm using proper functionality of the language that happens to generate unwanted notice messages. */
	error_reporting(E_STRICT & ~E_DEPRECATED);
	return updatedirectory($directoryid, $args['h'], $args['u'], $args['p'], $args['s'], $args['d']);
?>
