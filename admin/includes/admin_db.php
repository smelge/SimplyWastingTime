<?php
	$hostname = "";
	$username = "";
	$password = "";

	$dbadmin = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbadmin, "simplywa_news") or die ("Could not connect to Admin Server");
?>
