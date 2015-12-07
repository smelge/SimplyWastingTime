<?php
	switch($news_feed['category']){
		case 1:
			$icon = 'news-temp';
			$icon_alt = 'News Icon';
			$link = 'news.php?';
			break;
		case 2:
			$icon = 'review-temp';
			$icon_alt = 'Review Icon';
			$link = 'news.php?';
			break;
		case 3:
			$icon = 'blog-temp';
			$icon_alt = 'Blog Icon';
			$link = 'news.php?';
			break;
		case 4:
			$icon = 'comp-temp';
			$icon_alt = 'Competition Icon';
			$link = 'news.php?';
			break;
		case 5:
			$icon = 'challenge-temp';
			$icon_alt = 'Challenge Icon';
			$link = 'news.php?';
			break;
	}


	if ($news_feed['release'] <= $date){
		echo '<div class="row" style="padding-bottom:0;">';
			echo '<div class="col-sm-12 padding" style="margin-bottom:-5px;">';	
				echo '<a href="./'. $link .'id='. $news_feed['id'] .'" style="text-decoration:none;">';
					echo '<div class="alert alert-info newsfeed-item" role="alert">';
						echo '<div class="media">';
							echo '<div class="media-left">';
								echo '<img src="../assets/icons/'. $icon .'.jpg" alt="'. $icon_alt .'">';
							echo '</div>';			
							echo '<div class="media-body" style="color:black;overflow:hidden;">';
								echo '<h4 class="media-heading">'. $news_feed['title'] .'</h4>';
								echo '<hr style="margin:5px;border: 1px dashed black;">';
								echo htmlspecialchars_decode($news_feed['intro']);
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
		echo '</div>';
	}
?>


