<?php
	function createuser($name, $passwd, $type) {
		$name = escape($name);
		$passwd = escape($passwd);
		$type = escape($type);
		$passwd = password_hash($passwd, PASSWORD_DEFAULT);
		return runsql(sprintf("insert into users(name, passwd, type) values('%s', '%s', '%s');", $name, $passwd, $type));
	}

	function readusers() {
		return runsql('select * from users;');
	}

	function readuserbycookie($cookie) {
		$cookie = escape($cookie);
		return runsql(sprintf("select * from users where cookie = '%s';", $cookie));
	}

	function readusersnamesandtypes() {
		return runsql('select name, type from users;');
	}

	function updateuser($oldname, $name = null, $passwd = null, $type = null) {
		$oldname = escape($oldname);
		$name = escape($name);
		$passwd = escape($passwd);
		$type = escape($type);
		$set = '';
		if(!is_null($name) && !empty($name)) $set .= sprintf(", name = '%s'", $name);
		if(!is_null($passwd) && !empty($passwd)) {
			$passwd = password_hash($passwd, PASSWORD_DEFAULT);
			$set .= sprintf(", passwd = '%s'", $passwd);
		}
		if(!is_null($type) && !empty($type)) $set .= sprintf(", type = '%s'", $type);
		$set = str_split($set);
		unset($set[0]);
		unset($set[1]);
		$set = implode('', $set);
		return runsql(sprintf("update users set %s where name = '%s';", $set, $oldname));
	}

	function deleteuser($name) {
		$name = escape($name);
		return runsql(sprintf("delete from users where name = '%s';", $name));
	}

	function login($name, $passwd) {
		$name = escape($name);
		$passwd = escape($passwd);
		$passwdstored = runsql(sprintf("select passwd from users where name = '%s';", $name));
		$cookie = false;
		if(isset($passwdstored[0][0]) && password_verify($passwd, $passwdstored[0][0])) {
			$cookie = uniqid();
			runsql(sprintf("update users set cookie = '%s' where name = '%s';", $cookie, $name));
		}
		return $cookie;
	}

	function logout($name) {
		$name = escape($name);
		return runsql(sprintf("update users set cookie = NULL where name = '%s';", $name));
	}
?>
