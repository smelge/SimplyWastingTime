<?php
	// Process Announcements Inputs
	//Load Database Connection
	include ('./admin_db.php');
	
	$item_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	$input = filter_input(INPUT_POST, 'input', FILTER_SANITIZE_SPECIAL_CHARS);
		$input = str_ireplace("'","&#39;",$input);
	$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
	$shout = filter_input(INPUT_POST, 'shout', FILTER_SANITIZE_SPECIAL_CHARS);
	$user = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
	$timestamp = date("Y-m-d H:i:s");
		
	if ($item_id == true){
		//get type
		switch ($type){			
			case 'announce':
				// Change [status] to 2
				$sqlpath = "UPDATE `admin_announcements` SET `status` = '2',`updated` = '$timestamp' WHERE `id` = '$item_id'";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
					header('Location: ../admindash.php?error=1');
				} else {
					header('Location: ../admindash.php');
				}
				break;
			case 'todo':
				// Change [status] to 4
				$sqlpath = "UPDATE `admin_announcements` SET `status` = '4',`updated` = '$timestamp' WHERE `id` = '$item_id'";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
					header('Location: ../admindash.php?error=1');
				} else {
					header('Location: ../admindash.php');
				}
				break;
			case 'complete':
				// Change [status] to 5
				$sqlpath = "UPDATE `admin_announcements` SET `status` = '5',`updated` = '$timestamp' WHERE `id` = '$item_id'";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
					header('Location: ../admindash.php?error=1');
				} else {
					header('Location: ../admindash.php');
				}
				break;
		}
	} else {
		switch ($shout){
			case 'admin':
				// [status] = 1
				$sqlpath = "INSERT INTO `admin_announcements` (user_id,admin_only,status,notice,updated) VALUES ('$user', '1', '1', '$input', '$timestamp')";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
					header('Location: ../admindash.php?error=1');
				} else {
					header('Location: ../admindash.php');
				}
				break;
			case 'announce':
				// [status] = 1
				$sqlpath = "INSERT INTO `admin_announcements` (user_id,admin_only,status,notice,updated) VALUES ('$user', '0', '1', '$input', '$timestamp')";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
					header('Location: ../admindash.php?error=1');
				} else {
					header('Location: ../admindash.php');
				}
				break;
			case 'todo':
				// [status] = 3
				$sqlpath = "INSERT INTO `admin_announcements` (user_id,status,notice,updated) VALUES ('$user', '3', '$input', '$timestamp')";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
					header('Location: ../admindash.php?error=1');
				} else {
					header('Location: ../admindash.php');
				}
				break;
		}
	}
?>