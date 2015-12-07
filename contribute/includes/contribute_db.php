<?php
	$hostname = "";
	$username = "";
	$password = "";

	$dbcont = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbcont, "simplywa_news") or die ("Could not connect to News Server");
?>
