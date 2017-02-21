<?php
	function getoptopt($opts, $args) {
		$ret;
		for($i = 1; $i < count($args); ++$i) for($j = 0; $j < strlen($opts); ++$j) if($args[$i] == '-' . $opts[$j]) if(isset($args[$i + 1])) $ret[$opts[$j]] = $args[$i + 1];
		if(empty($ret)) return false;
		return $ret;
	}
?>
