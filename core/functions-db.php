<?php

function db_connect() {
	include('./config.php');
	extract($config);
	$db = mysqli_connect($hostname, $username, $password, $db_name);
	if (!$db) {
		if (ENV == ENV_DEV)
			die("Connection failed: " . mysqli_connect_error());
		else
			die("Aplikacija trenutno nije u funkciji. Molimo Vas da malo kasnije pokušate ponovo.");
	}
	return $db;
}

function db_close($db) {
	mysqli_close($db);
}

?>