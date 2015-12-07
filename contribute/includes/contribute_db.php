<?php
	$hostname = "10.169.0.14";
	$username = "simplywa_contrib";
	$password = "R_W2PEZ.930oKp";

	$dbcont = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbcont, "simplywa_news") or die ("Could not connect to News Server");
?>