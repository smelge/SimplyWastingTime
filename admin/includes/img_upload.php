<?php
	//Image Upload Script
	require_once ('./admin_db.php'); //$dbnews
	
	$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
	$user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_SPECIAL_CHARS);
	$img_cat = filter_input(INPUT_POST, 'img_category', FILTER_SANITIZE_SPECIAL_CHARS);
	$img_alt = filter_input(INPUT_POST, 'imgalt', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$currentupload = ($_FILES['newimage'] ['name']);
	if ($currentupload == ''){
		echo "No valid file";
	}
	else {
		move_uploaded_file($_FILES['newimage'] ['tmp_name'], "../../assets/uploaded/{$_FILES['newimage']['name']}");
		
		$img_name = $_FILES['newimage']['name'];
		$img_size = $_FILES['newimage']['size'];
		
		echo "User Name: ". $user_name ."<br>";
		echo "User ID: ". $user_id ."<br>";
		echo "Image Name: ". $img_name ."<br>";
		echo "Image Alt-text: ". $img_alt ."<br>";
		echo "Category: ". $img_cat ."<br>";
		echo "Image Size: ". round(($img_size)/1000,2) ."kb<br>";
		
		
		$sqlpath = "INSERT INTO swt_images (user_id,user_name,img_category,img_size,img_path,img_alt) VALUES ('$user_id','$user_name','$img_cat','$img_size','$currentupload','$img_alt')";
		if (!mysqli_query($dbadmin,$sqlpath)) {
			die('Error: ' . mysqli_error($dbadmin));
		}
		header('Location: ../admindash.php');
	}
?>