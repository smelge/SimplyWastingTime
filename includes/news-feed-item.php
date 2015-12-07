<?php
	switch($news_feed['category']){
		case 1:$icon = 'news-temp';$icon_alt = 'News Icon';$link = 'news.php?';break;
		case 2:$icon = 'review-temp';$icon_alt = 'Review Icon';$link = 'news.php?';break;
		case 3:$icon = 'blog-temp';$icon_alt = 'Blog Icon';$link = 'news.php?';break;
		case 4:$icon = 'comp-temp';$icon_alt = 'Competition Icon';$link = 'news.php?';break;
		case 5:$icon = 'challenge-temp';$icon_alt = 'Challenge Icon';$link = 'news.php?';break;
		case 6:
			//get youtube video info
			$game = $news_feed['game'];
			$episode = $news_feed['episode'];
			
			$set_video = mysqli_query($dbnews,"SELECT * FROM main WHERE game = '$game' AND episode = $episode");
			$find_video = mysqli_fetch_array($set_video);
			
			$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$find_video['youtube']."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU&part=snippet,statistics");
			$JSON_Data = json_decode($JSON,true);
			$thumb = $JSON_Data['items']['0']['snippet']['thumbnails']['default']['url'];
			if ($thumb == ''){
				$thumb = "./assets/issues.jpg";
			}
			
			$icon_alt = $JSON_Data['items']['0']['snippet']['title'];
			$icon = 'video-temp';
			$link = 'watch.php?';
			break;
	}
	$author_id = $news_feed['author_id'];
	$author_set = mysqli_query($dbmembers,"SELECT `member_name` FROM `upci_members` WHERE `id_member` = $author_id");
	$author = mysqli_fetch_assoc($author_set);
	$author = $author['member_name'];

	if ($news_feed['release_date'] <= $date){
		// Format release date and time for display
		$pre_date = $news_feed['release'];
		$split_date = (explode(" ",$pre_date));
		$date_array = $split_date[0];
		$time_array = $split_date[1];
		$date_array = (explode("-",$date_array));		
		$release_date = $date_array[2] ."/". $date_array[1] ."/". $date_array[0];
		
		$time_format = (explode(":",$time_array));
		if ($time_format[0] == '12' && $time_format[1] == '00'){
			$release_time = 'Noon';
		} elseif ($time_format[0] == '00' && $time_format[1] == '00'){
			$release_time == 'Midnight';
		} else {
			if ($time_format[0] < 12){
				$time_desc = 'am';
			} else {
				$time_desc = 'pm';
			}
			$release_time = $time_format[0] .":". $time_format[1] . $time_desc;
		}
		
		echo '<div class="row" style="padding-bottom:0;">';
			echo '<div class="col-sm-12" style="margin-bottom:-5px;">';	
				echo '<a href="./'. $link .'id='. $news_feed['id'] .'" style="text-decoration:none;">';
					echo '<div class="alert alert-info newsfeed-item" role="alert" style="overflow:hidden;">';
						echo '<div class="media">';
							echo '<div class="media-left">';
								if ($news_feed['category'] == 6){
									echo '<img src="'.$thumb.'" alt="'.$icon_alt.'">';
								} else {
									echo '<img src="./assets/icons/'. $icon .'.jpg" alt="'. $icon_alt .'">';
								}
							echo '</div>';			
							echo '<div class="media-body" style="color:black;">';
								echo '<h4 class="media-heading">'. $news_feed['title'] .'</h4>';
								echo '<hr style="margin:5px;border: 1px dashed black;">';
								
								$intro = htmlspecialchars_decode($news_feed['intro']);
								$intro = str_ireplace("<p>","",$intro);
								$intro = str_ireplace("</p>","",$intro);
								
								echo $intro;								
								echo "<br><span style='font-size:11px;'>Posted by ".$author.": ". $release_date ." at ". $release_time ."</span>";
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
		echo '</div>';
		$count_posts++;
	}
?>


