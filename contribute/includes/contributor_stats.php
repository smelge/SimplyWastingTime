<div class="notice">
	<div class="notice-head" style="border-top:2px solid black;">
		Account
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Account Type
		</div>
		<div class="col-sm-6 stat-right">
			<?php
				switch($stats['contributor_type']){
					case 0:
						echo 'Shit, something broke';
						break;
					case 1:
						if ($stats['twitch'] == true && $stats['youtube'] == true){
							echo 'Full Contributor';
						} elseif ($stats['twitch'] == true && $stats['youtube'] == false){
							echo 'Streamer';
						} elseif ($stats['twitch'] == false && $stats['youtube'] == true){
							echo 'Youtuber';
						} elseif ($stats['twitch'] == false && $stats['youtube'] == false){
							echo 'Basic Contributor';
						}
						break;
					case 2:
						if ($stats['twitch'] == true && $stats['youtube'] == true){
							echo 'Full Admintributor';
						} elseif ($stats['twitch'] == true && $stats['youtube'] == false){
							echo 'Streamer Admintributor';
						} elseif ($stats['twitch'] == false && $stats['youtube'] == true){
							echo 'Youtuber Admintributor';
						} elseif ($stats['twitch'] == false && $stats['youtube'] == false){
							echo 'Basic Admintributor';
						}
						break;
				}
			?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Status
		</div>
		<div class="col-sm-6 stat-right">
			<?php
				switch($stats['moderated']){
					case 0:
						echo 'Unmoderated';
						break;
					case 1:
						echo 'Moderated';
						break;
				}
			?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Postcount
		</div>
		<div class="col-sm-6 stat-right">
			<?php echo $user_stats['posts'];?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Karma
		</div>
		<?php
			$karma = $user_stats['karma_good'] - $user_stats['karma_bad'];
			if ($karma < 0){
				echo '<div class="col-sm-6 stat-right" style="color:red;font-weight:bold;">'.$karma.'</div>';
			} elseif ($karma == 0){
				echo '<div class="col-sm-6 stat-right" style="color:black;font-weight:bold;">'.$karma.'</div>';
			} else {
				echo '<div class="col-sm-6 stat-right" style="color:green;font-weight:bold;">'.$karma.'</div>';
			}
		?>		
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Warnings
		</div>
		<?php
			if ($user_stats['warning'] <= 5){
				echo '<div class="col-sm-6 stat-right" style="color:green;font-weight:bold;">'. $user_stats['warning'] .'%</div>';
			} elseif ($user_stats['warning'] > 5 && $user_stats['warning'] < 60){
				echo '<div class="col-sm-6 stat-right" style="color:orange;font-weight:bold;">'. $user_stats['warning'] .'%</div>';
			} elseif ($user_stats['warning'] >= 60){
				echo '<div class="col-sm-6 stat-right" style="color:red;font-weight:bold;">'. $user_stats['warning'] .'%</div>';
			}
		?>		
	</div>
<!-- Youtube Stats -->	
	<?php
		if ($stats['youtube'] == true){
			$youtubeconnect = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$stats['youtube_id']."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU"), true);
			$youtubetotal = $youtubeconnect['items']['0']['statistics']['viewCount'];
			$watchertotal = $youtubeconnect['items']['0']['statistics']['subscriberCount'];
			$youtube_video_total = $youtubeconnect['items']['0']['statistics']['videoCount'];
			$average_views = round($youtubetotal / $youtube_video_total,0);
	
			echo '<div class="notice-head" style="border-top:2px solid black;">Youtube</div>';
			echo '<div class="stat-item">';
				echo '<div class="col-sm-6 stat-left">Subscribers</div>';
				echo '<div class="col-sm-6 stat-right">';
					echo $watchertotal;
				echo '</div>';			
			echo '</div>';
			echo '<div class="stat-item">';
				echo '<div class="col-sm-6 stat-left">Channel Views</div>';
				echo '<div class="col-sm-6 stat-right">';
					echo $youtubetotal;
				echo '</div>';			
			echo '</div>';
			echo '<div class="stat-item">';
				echo '<div class="col-sm-6 stat-left">Videos</div>';
				echo '<div class="col-sm-6 stat-right">';
					echo $youtube_video_total;
				echo '</div>';			
			echo '</div>';	
			echo '<div class="stat-item">';
				echo '<div class="col-sm-6 stat-left">Avg. Video Views</div>';
				echo '<div class="col-sm-6 stat-right">';
					echo $average_views;
				echo '</div>';			
			echo '</div>';
		}
	?>
	
<!-- Twitch Stats -->	
	<div class="notice-head" style="border-top:2px solid black;">
		Twitch
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Subscribers
		</div>
		<div class="col-sm-6 stat-right">
			Coming Soon
		</div>			
	</div>
		
<!-- Submissions Stats -->
	<?php
		$news_count = 0;
		$blog_count = 0;
		$review_count = 0;
		$video_count = 0;
		$authorised = 0;
		
		$sub_set = mysqli_query($dbnews,"SELECT * FROM `main` WHERE `author_id` = '$cont_id'");
		while ($sub = mysqli_fetch_array($sub_set)){
			switch ($sub['type']){
				case 'video':
					if ($sub['awaiting_review'] == 1){
						$authorised++;
					} else {
						$video_count++;
					}
					break;
				case 'news':
					if ($sub['awaiting_review'] == 1){
						$authorised++;
					} else {
						$news_count++;
					}
					break;
				case 'blog':
					if ($sub['awaiting_review'] == 1){
						$authorised++;
					} else {
						$blog_count++;
					}
				break;
				case 'review':
					if ($sub['awaiting_review'] == 1){
						$authorised++;
					} else {
						$review_count++;
					}
				break;
			}
		}
	?>
	
	<div class="notice-head" style="border-top:2px solid black;">
		Submissions
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Videos
		</div>
		<div class="col-sm-6 stat-right">
			<?php echo $video_count;?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			News
		</div>
		<div class="col-sm-6 stat-right">
			<?php echo $news_count;?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Blog
		</div>
		<div class="col-sm-6 stat-right">
			<?php echo $blog_count;?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Reviews
		</div>
		<div class="col-sm-6 stat-right">
			<?php echo $review_count;?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-6 stat-left">
			Awaiting Review
		</div>
		<div class="col-sm-6 stat-right">
			<?php echo $authorised;?>
		</div>			
	</div>
</div>
