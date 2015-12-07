<?php
	include ('./admin_db.php');
	
	$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
	
	
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	if ($id == false){
		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	}
	
	$hour = filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_SPECIAL_CHARS);
	$day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_SPECIAL_CHARS);
	$month = filter_input(INPUT_POST, 'month', FILTER_SANITIZE_SPECIAL_CHARS);
	$year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$date = $year.'-'.$month.'-'.$day.' '.$hour.':00:00';
	
	$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
	$timestamp = date("Y-m-d H:i:s");
	
	switch ($type){
		case 'date':
			$sqlpath = "UPDATE `main` SET `release` = '$date' WHERE `id` = '$id'";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
				header('Location: ../articles.php?error=shit_that_went_wrong');
			} else {
				header('Location: ../articles.php');
			}
			break;
		case 'cat':
			$sqlpath = "UPDATE `main` SET `category` = '$category' WHERE `id` = '$id'";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
				header('Location: ../articles.php?error=shit_that_went_wrong');
			} else {
				header('Location: ../articles.php');
			}
			break;
		case 'delete':
			$sqlpath = "DELETE FROM `main` WHERE `id` = '$id'";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
				header('Location: ../articles.php?error=shit_that_went_wrong');
			} else {
				header('Location: ../articles.php');
			}
			break;
	}	
?>
