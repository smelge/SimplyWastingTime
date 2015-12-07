<?php
	session_start();
	include_once('./member_database.php');
	//$dbmembers
	
	// Login
	
	// Get Variables
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
	
	// Get user info from DB
	$find_member_setup = mysqli_query($dbmembers,"SELECT * FROM `swt_userbase` WHERE `username` = '$username'");
	$find_member = mysqli_fetch_array($find_member_setup);
	if($mem_exist = mysqli_num_rows($find_member_setup) == 0){
		header('Location: ../index.php?error=not-a-member');
	}
	if ($find_member['password'] == false){
		header('Location: ../get_password.php');
	} else {
		//Password Set
		
		if (crypt($password,$find_member['salt']) == $find_member['password']){
			// Set SESSION
			$_SESSION['username'] = $find_member['username'];
			$_SESSION['user_id'] = $find_member['id'];
			$_SESSION['rank'] = $find_member['rank'];
			header('Location: ../index.php');
		} else {
			header('Location: ../login.php?error=wrong-password');
		}
	}
?>