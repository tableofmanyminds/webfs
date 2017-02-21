<?php
	function createdirectory($hostname, $username, $passwd, $systemname, $directorypath) {
		$directoryid = uniqid();
		$hostname = escape($hostname);
		$username = escape($username);
		$passwd = escape($passwd);
		$systemname = escape($systemname);
		$directorypath = escape($directorypath);
		$directoryid = escape($directoryid);
		return runsql(sprintf("insert into directories (hostname, username, passwd, systemname, directorypath, directoryid) values ('%s', '%s', '%s', '%s', '%s', '%s');", $hostname, $username, $passwd, $systemname, $directorypath, $directoryid));
	}

	function readdirectories() { return runsql('select * from directories;'); }

	function readdirectoriesbyhost($hostname) {
		$hostname = escape($hostname);
		return runsql(sprintf("select * from directories where hostname = '%s';", $hostname));
	}

	function readsystems() {
		$ret = runsql('select systemname from directories');
		for($i = 0; $i < count($ret); ++$i) {
			$ret[$i] = $ret[$i][0];
		}
		return array_unique($ret);
	}

	function readhosts() {
		$ret = runsql('select hostname from directories');
		for($i = 0; $i < count($ret); ++$i) {
			$ret[$i] = $ret[$i][0];
		}
		return array_unique($ret);
	}

	function readhostsbysystem($system) {
		$system = escape($system);
		return runsql(sprintf("select hostname from directories where systemname ='%s';", $system));
	}

	function updatedirectory($directoryid, $hostname = null, $username = null, $passwd = null, $systemname = null, $directorypath = null) {
		$directoryid = escape($directoryid);
		$hostname = escape($hostname);
		$username = escape($username);
		$passwd = escape($passwd);
		$systemname = escape($systemname);
		$directorypath = escape($directorypath);
		$set = '';
		if(!is_null($hostname) && !empty($hostname)) $set .= sprintf(", hostname = '%s'", $hostname);
		if(!is_null($username) && !empty($username)) $set .= sprintf(", username = '%s'", $username);
		if(!is_null($passwd) && !empty($passwd)) $set .= sprintf(", passwd = '%s'", $passwd);
		if(!is_null($systemname) && !empty($systemname)) $set .= sprintf(", systemname = '%s'", $systemname);
		if(!is_null($directorypath) && !empty($directorypath)) $set .= sprintf(", directorypath = '%s'", $directorypath);
		$set = str_split($set);
		unset($set[0]);
		unset($set[1]);
		$set = implode('', $set);
		return runsql(sprintf("update directories set %s where directoryid = '%s';", $set, $directoryid));
	}

	function deletedirectory($directoryid) {
		$directoryid = escape($directoryid);
		return runsql(sprintf("delete from directories where directoryid = '%s';", $directoryid));
	}

	function mount($directoryid) {
		global $rootdir;
		$directoryid = escape($directoryid);
		$opts = runsql(sprintf("select * from directories where directoryid = '%s';", $directoryid));
		$opts = $opts[0];
		if(!file_exists(sprintf("%s/mnt/%s/%s/%s", $rootdir, $opts[3], $opts[0], $opts[5]))) mkdir(sprintf("%s/mnt/%s/%s/%s", $rootdir, $opts[3], $opts[0], $opts[5]), 0777, true);
		$sshdescriptor = array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('file', '/dev/null', 'a'));
		$sshfs = proc_open(sprintf("sshfs -oStrictHostKeyChecking=no -opassword_stdin %s@%s:%s %s/mnt/%s/%s/%s", $opts[1], $opts[0], $opts[4], $rootdir, $opts[3], $opts[0], $opts[5]), $sshdescriptor, $pipes, './', array());
		fwrite($pipes[0], $opts[2]);
		fclose($pipes[0]);
		fclose($pipes[1]);
		return proc_close($sshfs);
	}

	function mountall() {
		$ids = runsql('select directoryid from directories;');
		for($i = 0; $i < count($ids); ++$i) $ids[$i] = $ids[$i][0];
		foreach($ids as $id) mount($id);
	}

	function umount($directoryid) {
		global $rootdir;
		$directoryid = escape($directoryid);
		$opts = runsql(sprintf("select * from directories where directoryid = '%s';", $directoryid));
		$opts = $opts[0];
		exec(sprintf("fusermount -u %s/mnt/%s/%s/%s", $rootdir, $opts[3], $opts[0], $opts[5]));
		if(file_exists(sprintf("%s/mnt/%s/%s/%s", $rootdir, $opts[3], $opts[0], $opts[5]))) rmdir(sprintf("%s/mnt/%s/%s/%s", $rootdir, $opts[3], $opts[0], $opts[5]));
	}

	function umountall() {
		$ids = runsql('select directoryid from directories;');
		for($i = 0; $i < count($ids); ++$i) $ids[$i] = $ids[$i][0];
		foreach($ids as $id) umount($id);
	}
?>
