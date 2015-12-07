<?php
	//Image Upload Script
	require_once ('../../admin/includes/admin_db.php'); //$dbnews
	
	$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
	$user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_SPECIAL_CHARS);
	$img_cat = filter_input(INPUT_POST, 'img_category', FILTER_SANITIZE_SPECIAL_CHARS);
	$img_alt = filter_input(INPUT_POST, 'imgalt', FILTER_SANITIZE_SPECIAL_CHARS);
	$img_tags = filter_input(INPUT_POST, 'imgtags', FILTER_SANITIZE_SPECIAL_CHARS);
	$img_tags = str_ireplace(" ",";",$img_tags);
	
	$currentupload = ($_FILES['newimage'] ['name']);
	if ($currentupload == ''){
		echo "No valid file";
	}
	else {
		move_uploaded_file($_FILES['newimage'] ['tmp_name'], "../../assets/uploaded/{$_FILES['newimage']['name']}");
		
		$img_name = $_FILES['newimage']['name'];
		$img_size = $_FILES['newimage']['size'];
		
		$sqlpath = 
			"
				INSERT INTO 
					`swt_images`
						(
							user_id,
							user_name,
							img_category,
							img_size,
							img_path,
							img_alt,
							tags
						) 
				VALUES 
						(
							'$user_id',
							'$user_name',
							'$img_cat',
							'$img_size',
							'$currentupload',
							'$img_alt',
							'$img_tags'
						)
			";
		if (!mysqli_query($dbadmin,$sqlpath)) {
			die('Error: ' . mysqli_error($dbadmin));
		}
		echo '<script>window.close();</script>';
		//header('Location: ../admindash.php');
	}
?>