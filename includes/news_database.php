<?php
	$hostname = "10.169.0.14";
	$username = "simplywa_swtmain";
	$password = "p{^mTp$~Jfpa";

	$dbnews = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($dbnews, "simplywa_news") or die ("Could not connect to News Server");
?>