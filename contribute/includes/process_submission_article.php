<?php
	include('./contribute_db.php');

	$title = filter_input(INPUT_POST, 'article-title', FILTER_SANITIZE_SPECIAL_CHARS);
		$title = str_ireplace("'","&#39;",$title);
	$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
		$content = str_ireplace("'","&#39;",$content);
	
	$intro = explode("&#60;p&#62;",$content);
	
	$intro = $intro[1];
	
	$intro = explode(" ",$content);
		$intro_group = $intro[0];
		for($intro_loop = 1;$intro_loop <60;$intro_loop++){
			$intro_group = $intro_group.' '.$intro[$intro_loop];
		}
	
	$hour = filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_SPECIAL_CHARS);
	$day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_SPECIAL_CHARS);
	$month = filter_input(INPUT_POST, 'month', FILTER_SANITIZE_SPECIAL_CHARS);
	$year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
	$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
	$moderated = filter_input(INPUT_POST, 'moderated', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$publish = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00';
	
	$sqlpath = "
				INSERT INTO main
					(`type`, `author_id`, `release`, `awaiting_review`, `category`, `title`, `intro`, `story`) 
				VALUES 
					('news', '$user_id', '$publish', '$moderated', '1', '$title', '$intro_group', '$content')
				";
	if (!mysqli_query($dbcont,$sqlpath)) {
		die('<br><br><b>Error: ' . mysqli_error($dbcont) .'<b>');
	} else {
		header('Location: ../dashboard.php?result=success');
	}
?>

