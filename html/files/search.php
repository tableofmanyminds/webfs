<?php
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');

	if(empty($_GET['system']) || empty($_GET['term'])) {
		$_GET['system'] = null;
		$_GET['term'] = null;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>WebFS</title>
	<link rel='stylesheet' type='text/css' href='../css/files/search.css'>
</head>
<body>
	<p id='title'>WebFS</p>
	<hr>
	<form method='get'>
		<p>
			Search term:<input type='text' name='term'><br>
			System:<select name='system'>
				<?php
					include '../../conf.php';
					foreach(readsystems() as $system) printf("\t\t\t\t<option value='%s'>%s</option>\n", $system, $system);
				?>
			</select><br>
			<input type='submit' value='Search'>
		</p>
	</form>
	
	<hr>
	
	<p id='files'>
		<?php
			if(!empty($_GET['system']) && !empty($_GET['term'])) {
				$hosts = readhostsbysystem($system);
				foreach($hosts as $host) {
					$directories = readdirectoriesbyhost($host[0]);
					foreach($directories as $directory) { mount($directory[5]); }
				}
				global $rootdir;
				foreach(search($_GET['term'], $rootdir. '/mnt/' . $_GET['system']) as $result) printf("<a href='download.php?file=%s'>%s</a><br>\n", $result, $result);
			}

		?>
	</p>
</body>
</html>
