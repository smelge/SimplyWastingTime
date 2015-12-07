<?php
	$hostname = "";
	$username = "";
	$password = "";

	$dbmembers = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbmembers, "simplywa_ly2h") or die ("Could not connect to Member Server");
?>
