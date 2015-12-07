<?php
	$hostname = "";
	$username = "";
	$password = "";

	$dbnews = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbnews, "simplywa_news") or die ("Could not connect to News Server");
?>
