<?php
	if(empty($_COOKIE['cookie'])) header('Refresh:0; url=users/login.php');

	include '../../conf.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>WebFS</title>
	<link rel='stylesheet' type='text/css' href='../css/files/upload.css'>
</head>
<body>
	<p id='title'>WebFS</p>
	<hr>
<?php
	if(empty($_POST['system'])) {
		?>
			<form method='post'>
				<p>
					System:<br>
					<select name='system'>
						<?php foreach(readsystems() as $system) printf("\t\t\t\t<option value='%s'>%s</option>\n", $system, $system); ?>
					</select><br>
					<input type='submit' value='Select host'>
				</p>
			</form>
		<?php
	}
	if(!empty($_POST['system']) && empty($_POST['host'])) {
		?>
			<form method='post'>
				<p>
					<input type='hidden' name='system' value='<?php printf("%s", $_POST['system']); ?>'>
					Host:<br>
					<select name='host'>
						<?php foreach(readhostsbysystem($_POST['system']) as $host) printf("\t\t\t\t<option value='%s'>%s</option>\n", $host[0], $host[0]); ?>
					</select><br>
					<input type='submit' value='Select directory'>
				</p>
			</form>
		<?php
	}
	if(!empty($_POST['system']) && !empty($_POST['host']) && empty($_POST['directory'])) {
		?>
			<form method='post'>
				<p>
					<input type='hidden' name='system' value='<?php printf("%s", $_POST['system']); ?>'>
					<input type='hidden' name='host' value='<?php printf("%s", $_POST['host']); ?>'>
					Directory:<br>
					<select name='directory'>
						<?php foreach(readdirectoriesbyhost($_POST['host']) as $directory) printf("\t\t\t\t<option value='%s'>%s</option\n", $directory[5], $directory[4]); ?>
					</select><br>
					<input type='submit' value='Select file'>
				</p>
			</form>
		<?php
	}
	if(!empty($_POST['system']) && !empty($_POST['host']) && !empty($_POST['directory']) && empty($_FILES['upload'])) {
		?>
			<form method='post' enctype='multipart/form-data'>
				<p>
					<input type='hidden' name='system' value='<?php printf("%s", $_POST['system']); ?>'>
					<input type='hidden' name='host' value='<?php printf("%s", $_POST['host']); ?>'>
					<input type='hidden' name='directory' value='<?php printf("%s", $_POST['directory']); ?>'>
					<input type='file' name='upload'><br>
					<input type='submit' value='Upload file'>
				</p>
			</form>
		<?php
	}
	if(!empty($_POST['system']) && !empty($_POST['host']) && !empty($_POST['directory']) && !empty($_FILES['upload'])) {
		mount($_POST['directory']);
		global $rootdir;
		move_uploaded_file($_FILES['upload']['tmp_name'], $rootdir . '/mnt/' . $_POST['system'] . '/' . $_POST['host'] . '/' . $_POST['directory'] . '/' . basename($_FILES['upload']['name']));
		?>
			<p>Upload complete!</p>
			<a href='../index.php'>Return to index</a>
		<?php
	}
?>
</body>
</html>
