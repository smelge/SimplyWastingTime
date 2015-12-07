<?php
	session_start();
	include_once ('../includes/news_database.php');
	if(!isset($_SESSION['username']) || $_SESSION['rank'] == 2){
		header('Location: ../index.php');
	}
?>