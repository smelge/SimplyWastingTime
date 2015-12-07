<?php
	include_once('./member_database.php');
	//$dbmembers
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
	
	// Get user info from DB
	$find_member_setup = mysqli_query($dbmembers,"SELECT * FROM `swt_userbase` WHERE `username` = '$username'");
	$find_member = mysqli_fetch_array($find_member_setup);
	if($mem_exist = mysqli_num_rows($find_member_setup) == 0){
		header('Location: ../index.php?error=not-a-member');
	} else {
		$verification = md5(time());
		$salt = '$5$'.md5(date("Y-d-m H:i:s"));
		$encrypted = crypt($password,$salt);
		$email = $find_member['email'];
		
		$sqlpath = "
			UPDATE 
				`swt_userbase`
			SET 
				`salt` = '$salt',
				`temp_password` = '$encrypted',
				`verification` = '$verification'
			WHERE
				`username` = '$username'
		";
		if(!mysqli_query($dbmembers,$sqlpath)) {
			die(header('Location: ../get_password.php?error=database+fucked+up'));// Gone Wrong
		} else {
			$subject = "Simply Wasting Time";
			$headers = "From: admin@simplywastingtime.com";
			$content = 
'Your password has been added. 
To Activate it, please follow the following link: http://www.simplywastingtime.com/activation.php?user='.$username.'&activation='.$verification;
			
		mail($email,$subject,$content,$headers);			
		header('Location: ../index.php?thing=just+you+wait');
		}
	}
?>