<?php
	function escape($string) {
		$string = str_replace("'", "\'", $string);
		$string = str_replace('"', '\"', $string);
		$string = str_replace("\n", '', $string);
		$string = str_replace("\r", '', $string);
		$string = str_replace("\0", '', $string);
		$string = preg_replace('/[\x00-\x1F\x7F]/', '', $string);
		return $string;
	}

	function runsql($query) {
		global $dbhost, $dbuser, $dbpass, $dbbase;
		$sql = mysqli_connect($dbhost, $dbuser, $dbpass, $dbbase);
		$ret = mysqli_query($sql, $query);
		if(!is_bool($ret)) $ret = mysqli_fetch_all($ret);
		mysqli_close($sql);
		return $ret;
	}
?>
