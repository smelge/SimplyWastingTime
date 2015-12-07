<?php
	$hostname = "10.169.0.14";
	$username = "simplywa_ly2h";
	$password = "K(JZdF0nMm44*~8";

	$dbmembers = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbmembers, "simplywa_ly2h") or die ("Could not connect to Member Server");
?>