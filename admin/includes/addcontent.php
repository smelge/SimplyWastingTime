<?php
	//Process and add content to database
	
	//Load Database Connection
	include ('./admin_db.php');
	
	// Generic Fields
	$submitted = date("Y-m-d H");
	
	$author_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
	$author = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_SPECIAL_CHARS);
	$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
	$release_date = filter_input(INPUT_POST, 'release_date', FILTER_SANITIZE_SPECIAL_CHARS);
	if ($release_date == ''){ //if no release_date date specified, release_date immediately
		$release_date = $submitted;
	}

	//////////////////////////////////////////////////////////////////////////
	// Date/Time for releases
	$year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_SPECIAL_CHARS);
	$month = filter_input(INPUT_POST, 'month', FILTER_SANITIZE_SPECIAL_CHARS);
	switch($month){
		case 'January': $month = "01"; break;
		case 'February': $month = "02"; break;
		case 'March': $month = "03"; break;
		case 'April': $month = "04"; break;
		case 'May': $month = "05"; break;
		case 'June': $month = "06"; break;
		case 'July': $month = "07"; break;
		case 'August': $month = "08"; break;
		case 'September': $month = "09"; break;
		case 'October': $month = 10; break;
		case 'November': $month = 11; break;
		case 'December': $month = 12; break;
	}
	$day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_SPECIAL_CHARS);
	switch($day){
		case 1: $day = "01"; break;
		case 2: $day = "02"; break;
		case 3: $day = "03"; break;
		case 4: $day = "04"; break;
		case 5: $day = "05"; break;
		case 6: $day = "06"; break;
		case 7: $day = "07"; break;
		case 8: $day = "08"; break;
		case 9: $day = "09"; break;
		default: $day = $day; break;
	}
	$hour = filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$release_date = $year ."-". $month ."-". $day ." ". $hour .":00:00";
	//////////////////////////////////////////////////////////////////////////
	
	// News & Review Fields
	$headline = filter_input(INPUT_POST, 'headline', FILTER_SANITIZE_SPECIAL_CHARS);
	$intro = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_SPECIAL_CHARS);
	$intro = str_ireplace("'","\'",$intro);
	$intro = str_ireplace('"','\"',$intro); //Escape ' and "
	
	$story = $_POST['story'];
	$story = str_ireplace("'","\'",$story);
	$story = str_ireplace('"','\"',$story); //Escape ' and "
	
	$reviewsummary = filter_input(INPUT_POST, 'reviewsummary', FILTER_SANITIZE_SPECIAL_CHARS);
	$reviewsummary = str_ireplace("'","\'",$reviewsummary);
	$reviewsummary = str_ireplace('"','\"',$reviewsummary); //Escape ' and "
	
	$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_SPECIAL_CHARS);
	
	// Video Fields
	$video_set = filter_input(INPUT_POST, 'youtube', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$video_get = (explode("=",$video_set));
	
	if ($video_get[1] == ''){ //Not standard youtube address, resplit with new parameters
		$video_get = (explode(".be/",$video_set));
		$video = $video_get[1];
	} else { //Standard Youtube Address
		$video = $video_get[1];
	}
	
	$video_cat = filter_input(INPUT_POST, 'video_cat', FILTER_SANITIZE_SPECIAL_CHARS);
	$game = filter_input(INPUT_POST, 'game', FILTER_SANITIZE_SPECIAL_CHARS);
	$new_game = filter_input(INPUT_POST, 'newgame', FILTER_SANITIZE_SPECIAL_CHARS);
	$episode = filter_input(INPUT_POST, 'episode', FILTER_SANITIZE_SPECIAL_CHARS);
	$series = filter_input(INPUT_POST, 'series', FILTER_SANITIZE_SPECIAL_CHARS);
	
	switch ($video_cat){
		case 1: $video_cat = 'check'; break;
		case 2: $video_cat = 'story'; break;
		case 3: $video_cat = 'coop'; break;
		case 4: $video_cat = 'vs'; break;
		case 5: $video_cat = 'lp'; break;
		case 6: $video_cat = 'mix'; break;
		case 7: $video_cat = 'high'; break;
		case 8: $video_cat = 'bonus'; break;
	}
	
	//////////////////////////////////////////////////////////////////////////
	echo "Time: ". $submitted ."<br>";
	echo "Release Date: ". $release_date ."<br><br>";
	echo "Author ID: ". $author_id ."<br>";
	echo "Author: ". $author ."<br>";
	echo "Category: ". $category ."<br><br>";	
	
	switch($category){
		case 1: //News
			echo "<hr><h2><b> ". $headline ."</b></h2><hr>";
			echo "Intro:<b> ". $intro ."</b><br><br>";
			echo nl2br($story) ."<br>";			
			
			$sqlpath = "INSERT INTO main (`author_id`, `added`, `release`, `type`, `category`, `title`, `intro`, `story`) VALUES ('$author_id', '$submitted', '$release_date', 'news', '$category', '$headline', '$intro', '$story')";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				echo "<br><br><b>Stuff uploaded</b>";
			}
			echo "<br><br>";
		break;
		case 2: //Reviews
		/*	echo "<hr><h2><b> ". $headline ."</b></h2><hr>";
			echo "Intro:<b><br> ". $intro ."</b><br><br>";
			echo "Review:<br>". nl2br($story) ."<br><br>";
			echo "Summary:<br><b><i>". nl2br($reviewsummary) ."</i></b><br>";
			echo "Rating: ". $rating ."/10<br><br>";
			
			$sqlpath = "INSERT INTO news (author_id, author, submitted, release_date, category, headline, intro, story, review_summary, rating) VALUES ('$author_id', '$author', '$submitted', '$release_date', '$category', '$headline', '$intro', '$story', '$reviewsummary', '$rating')";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				echo "<br><br><b>Stuff uploaded</b>";
			}
			echo "<br><br>";
		*/
		break;
		case 3: //Blog
			echo "<hr><h2><b> ". $headline ."</b></h2><hr>";
			echo "Intro:<b> ". $intro ."</b><br><br>";
			echo nl2br($story) ."<br>";			
			
			$sqlpath = "INSERT INTO main (`author_id`, `added`, `release`, `type`, `category`, `title`, `intro`, `story`) VALUES ('$author_id', '$submitted', '$release_date', 'blog', '$category', '$headline', '$intro', '$story')";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				echo "<br><br><b>Stuff uploaded</b>";
			}
			echo "<br><br>";
		break;
		case 4: //Competitions
		
		break;
		case 5: //Challenges
		
		break;
		case 6: //Video
			if ($game != 'new'){
				$game = $game;
			} else {
				$game = $new_game;
			}
			
			$game_headline = $game ." Ep.". $episode ." - ". $headline;
			
			echo "<hr><h2><b> ". $game ." Ep.". $episode ." - ". $headline ."</b></h2><hr>";
			echo "Intro:<b><br> ". $intro ."</b><br><br>";
			echo "Youtube Address: ". $video ."<br>";
			echo "Category: ". $video_cat ."<br>";
			echo "Series: ". $series ."<br>";
			
			$sqlpath = "INSERT INTO main(`author_id`, `type`, `added`, `release`, `title`, `youtube`, `game`, `episode`, `series`, `intro`, `vid_type`, `category`) VALUES ('$author_id', 'video', '$submitted', '$release_date', '$headline', '$video', '$game', '$episode', '$series', '$intro', '$video_cat', '$category')";
			if (!mysqli_query($dbadmin,$sqlpath)) {
				die('<br><br><b>Error: ' . mysqli_error($dbadmin) .'<b>');
			} else {
				echo "<br><br><b>Stuff uploaded</b>";
			}			
		break;
	}
	
	
	echo '<a class="btn btn-primary" href="../admindash.php">Back to Admin Dashboard</button>';
	
	
?>

