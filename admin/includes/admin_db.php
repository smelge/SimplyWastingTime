<?php
	$hostname = "10.169.0.14";
	$username = "simplywa_admin";
	$password = "*%kgkgCF85Hy8%%*JG9";

	$dbadmin = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbadmin, "simplywa_news") or die ("Could not connect to Admin Server");
?>