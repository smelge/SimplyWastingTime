<?php
	require_once ('../../admin/includes/admin_db.php'); //$dbadmin
	$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
	$user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
	
	switch($type){
		case 'create':
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
			$sqlpath = "
				INSERT INTO
					`contributor`
					(`user_id`)
				VALUES
					('$id')
			";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('Error: ' . mysqli_error($dbadmin));
			} else {
				header('Location: ../settings.php?redirect=success');
			}
			break;
		
		case 'social':
			$youtube = filter_input(INPUT_POST, 'youtube', FILTER_SANITIZE_SPECIAL_CHARS);
			$youtube = str_ireplace(" ","_",$youtube);
			$twitch = filter_input(INPUT_POST, 'twitch', FILTER_SANITIZE_SPECIAL_CHARS);
			$twitter = filter_input(INPUT_POST, 'twitter', FILTER_SANITIZE_SPECIAL_CHARS);
			$facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_SPECIAL_CHARS);
			$steam = filter_input(INPUT_POST, 'steam', FILTER_SANITIZE_SPECIAL_CHARS);
			$googleplus = filter_input(INPUT_POST, 'googleplus', FILTER_SANITIZE_SPECIAL_CHARS);
			$website = filter_input(INPUT_POST, 'website', FILTER_SANITIZE_SPECIAL_CHARS);
			$patreon = filter_input(INPUT_POST, 'patreon', FILTER_SANITIZE_SPECIAL_CHARS);
			$reddit = filter_input(INPUT_POST, 'reddit', FILTER_SANITIZE_SPECIAL_CHARS);
			$livestream = filter_input(INPUT_POST, 'livestream', FILTER_SANITIZE_SPECIAL_CHARS);
			$vimeo = filter_input(INPUT_POST, 'vimeo', FILTER_SANITIZE_SPECIAL_CHARS);
			$spotify = filter_input(INPUT_POST, 'spotify', FILTER_SANITIZE_SPECIAL_CHARS);
			$deviantart = filter_input(INPUT_POST, 'deviantart', FILTER_SANITIZE_SPECIAL_CHARS);
			$flickr = filter_input(INPUT_POST, 'flickr', FILTER_SANITIZE_SPECIAL_CHARS);
			$instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_SPECIAL_CHARS);
			$tumblr = filter_input(INPUT_POST, 'tumblr', FILTER_SANITIZE_SPECIAL_CHARS);
			
			//get youtube video info
			$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=id&forUsername=".$youtube."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU");
			$JSON_Data = json_decode($JSON,true);
			$youtube_id = $JSON_Data['items']['0']['id'];
			
			$sqlpath = "
				UPDATE 
					`contributor` 
				SET 
					`youtube` = '$youtube', 
					`youtube_id` = '$youtube_id',
					`twitch` = '$twitch',
					`twitter` = '$twitter',
					`facebook` = '$facebook',
					`steam` = '$steam',
					`googleplus` = '$googleplus',
					`website` = '$website',
					`patreon` = '$patreon',
					`reddit` = '$reddit',
					`livestream` = '$livestream',
					`vimeo` = '$vimeo',
					`spotify` = '$spotify',
					`deviantart` = '$deviantart',
					`flickr` = '$flickr',
					`instagram` = '$instagram',
					`tumblr` = '$tumblr'
				WHERE 
					`user_id` = '$user'";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				header('Location: ../settings.php');
			}
			
			break;
		case 'banner':
			$currentupload = ($_FILES['newimage']['name']);
			$currentupload = str_ireplace(" ","_",$currentupload);
			if ($currentupload == ''){
				echo "No valid file";
			}
			else {
				move_uploaded_file($_FILES['newimage']['tmp_name'], "../../assets/banners/".$currentupload);
				
				$img_name = $_FILES['newimage']['name'];
				$img_name = str_ireplace(" ","_",$img_name);
				
				$sqlpath = "
					UPDATE
						`contributor`
					SET
						`banner` = '$img_name'
					WHERE
						`user_id` = '$user'
				";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('Error: ' . mysqli_error($dbadmin));
				} else {
					header('Location: ../settings.php');
				}
			}
			break;
		case 'minibanner':
			$currentupload = ($_FILES['newminiimage']['name']);
			if ($currentupload == ''){
				echo "No valid file";
			}
			else {
				move_uploaded_file($_FILES['newminiimage']['tmp_name'], "../../assets/banners/{$_FILES['newminiimage']['name']}");
				
				$img_name = $_FILES['newminiimage']['name'];
				$img_name = str_ireplace(" ","_",$img_name);
				
				$sqlpath = "
				UPDATE
				`contributor`
				SET
				`minibanner` = '$img_name'
				WHERE
				`user_id` = '$user'
				";
				if (!mysqli_query($dbadmin,$sqlpath)) {
					die('Error: ' . mysqli_error($dbadmin));
				} else {
					header('Location: ../settings.php');
				}
			}
			break;
		case 'details':
			$schedule = filter_input(INPUT_POST, 'schedule', FILTER_SANITIZE_SPECIAL_CHARS);
			$schedule = str_ireplace("'","&#39;",$schedule);
			$about = filter_input(INPUT_POST, 'about', FILTER_SANITIZE_SPECIAL_CHARS);
			$about = str_ireplace("'","&#39;",$about);
			$displayname = filter_input(INPUT_POST, 'displayname', FILTER_SANITIZE_SPECIAL_CHARS);
			$displayname = str_ireplace("'","&#39;",$displayname);
			
			$sqlpath = "
				UPDATE 
					`contributor` 
				SET 
				`schedule` = '$schedule', 
				`about` = '$about',
				`display_name` = '$displayname'
				WHERE 
				`user_id` = '$user'
			";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				header('Location: ../settings.php');
			}
			break;
		case 'colours':
			$bg_color = filter_input(INPUT_POST, 'bg-color', FILTER_SANITIZE_SPECIAL_CHARS);
			$bg_color = explode("#",$bg_color);
			$bg_color = $bg_color[1];			
			$fore_color = filter_input(INPUT_POST, 'fore-color', FILTER_SANITIZE_SPECIAL_CHARS);
			$fore_color = explode("#",$fore_color);
			$fore_color = $fore_color[1];
			$cont_color = filter_input(INPUT_POST, 'cont-color', FILTER_SANITIZE_SPECIAL_CHARS);
			$cont_color = explode("#",$cont_color);
			$cont_color = $cont_color[1];
			$link_color = filter_input(INPUT_POST, 'hover-color', FILTER_SANITIZE_SPECIAL_CHARS);
			$link_color = explode("#",$link_color);
			$link_color = $link_color[1];
			
			$sqlpath = "
				UPDATE 
					`contributor` 
				SET 
					`background_hex` = '$bg_color', 
					`main_hex` = '$fore_color',
					`content_hex` = '$cont_color',
					`link_hex` = '$link_color'
				WHERE 
					`user_id` = '$user'
			";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				header('Location: ../settings.php');
			}
			break;
		case 'resetcolour':
			$user = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
			$background = '9966cc';
			
			$sqlpath = "
				UPDATE 
					`contributor` 
				SET 
					`background_hex` = '$background', 
					`main_hex` = '663399',
					`content_hex` = 'cccccc',
					`link_hex` = '333333'
				WHERE 
					`user_id` = '$user'
			";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				header('Location: ../settings.php');
			}
			break;
	}
?>

