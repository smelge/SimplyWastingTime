<?php	
	require_once("../forum/SSI.php");
	$_SESSION['login_url']='http://www.simplywastingtime.com';
	$_SESSION['logout_url']='http://www.simplywastingtime.com';	
	trackStats(array('hits' => '+')); trackStats();
	include_once ('../includes/member_database.php');
?>