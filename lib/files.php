<?php
	function ls($directory) {
		if(substr($directory, -1) == '/') $directory = rtrim($directory, '/');
		$ret = [];
		foreach(scandir($directory) as $file) {
			if($file == '.' || $file == '..') continue;
			$fullpath = sprintf("%s/%s", $directory, $file);
			if(is_dir($fullpath)) $ret = array_merge($ret, ls($fullpath));
			else array_push($ret, $fullpath);
		}
		return $ret;
	}

	function possearch($term, $list) {
		$ret = [];
		for($i = $rc = 0; $i < count($list); ++$i) {
			if(strpos($list[$i], $term) !== false) {
				$ret[$rc] = $i;
				++$rc;
			}
		}
		return $ret;
	}

	function search($term, $directory) {
		$fulllist = ls($directory);
		$baselist = [];
		for($i = 0; $i < count($fulllist); ++$i) $baselist[$i] = basename($fulllist[$i]);
		$index = possearch($term, $baselist);
		$ret = [];
		for($i = 0; $i < count($index); ++$i) $ret[$i] = $fulllist[$index[$i]];
		return $ret;
	}

	function download($file) {
		global $rootdir;
		if(!file_exists($file)) return 1;
		if(strpos($file, $rootdir . '/mnt/') !== 0) return 1;
		if(strpos($file, '..') !== false) return 1;
		header('Content-Description: File Transfer');
		header('Content-Type: application/octect-stream');
		header('Content-Disposition: attachment; filename=' . basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		$ret = readfile($file);
		if($ret != false) return 0;
		else return 1;
	}
?>
