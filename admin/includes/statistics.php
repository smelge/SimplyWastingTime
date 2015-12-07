<?php
	// Dashboard Statistics
	$youtubeconnect = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=simplywastingtime&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU"), true);
	$youtubetotal = $youtubeconnect['items']['0']['statistics']['viewCount'];
	$watchertotal = $youtubeconnect['items']['0']['statistics']['subscriberCount'];
	$youtube_video_total = $youtubeconnect['items']['0']['statistics']['videoCount'];
	$video_average = round(($youtubetotal / $youtube_video_total),0);
	
	$suspensions = 0;
	$bans = 0;
	$get_total_suspended = mysqli_query($dbmembers,"SELECT * FROM `upci_ban_groups`");
	while($total_suspended = mysqli_fetch_array($get_total_suspended)){
		if ($total_suspended['expire_time'] == true){
			$suspensions++;
		} else {
			$bans++;
		}
	}
?>
<!-- TABLE -->
<div class="notice">
	<div class="notice-head" style="border-top:2px solid black;">
		Members
	</div>
	<div class="stat-item">
		<div class="col-sm-7 stat-left">
			Latest Member
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_latest_member = mysqli_query($dbmembers,"SELECT * FROM `upci_members` ORDER BY `id_member` DESC LIMIT 0,1");
				$latest_member = mysqli_fetch_array($get_latest_member);
				echo $latest_member['member_name'];
			?>
		</div>			
	</div>
	<div class="stat-item">
		<div class="col-sm-7 stat-left">
			Total Members
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_total_member = mysqli_query($dbmembers,"SELECT * FROM `upci_members`");
				$total_member = mysqli_num_rows($get_total_member);
				echo $total_member;
			?>
		</div>		
	</div>
	<div class="stat-item">
		<div class="col-sm-7 stat-left">
			Suspended Members
		</div>
		<div class="col-sm-5 stat-right">
			<?php				
				echo $suspensions;
			?>
		</div>		
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Banned Members
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				echo $bans;
			?>
		</div>
	</div>
	<div class="notice-head" style="border-top:2px solid black;">
		Site Stats
	</div>
	<div class="stat-item">	
		<div class="col-sm-7 stat-left">
			Items Awaiting Review
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_total_waiting = mysqli_query($dbadmin,"SELECT * FROM `main` WHERE `awaiting_review` = '1'");
				$total_waiting = mysqli_num_rows($get_total_waiting);
				if ($total_waiting != 0){
					echo '<span style="color:red;font-weight:bold;">'.$total_waiting.'</span>';
				} else {
					echo '<span style="color:green;font-weight:bold;">'.$total_waiting.'</span>';
				}
			?>
		</div>
	</div>
	<div class="stat-item">			
		<div class="col-sm-7 stat-left">
			News Posts
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_total_news = mysqli_query($dbadmin,"SELECT * FROM `main` WHERE `type` = 'news'");
				$total_news = mysqli_num_rows($get_total_news);
				echo $total_news;
			?>
		</div>
	</div>	
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Reviews
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_total_reviews = mysqli_query($dbadmin,"SELECT * FROM `main` WHERE `type` = 'reviews'");
				$total_reviews = mysqli_num_rows($get_total_reviews);
				echo $total_reviews;
			?>
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Blogs
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_total_blog = mysqli_query($dbadmin,"SELECT * FROM `main` WHERE `type` = 'blog'");
				$total_blog = mysqli_num_rows($get_total_blog);
				echo $total_blog;
			?>
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Videos
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_total_video = mysqli_query($dbadmin,"SELECT * FROM `main` WHERE `type` = 'video'");
				$total_video = mysqli_num_rows($get_total_video);
				echo $total_video;
			?>
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Comments
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Site Pageviews
		</div>
		<div class="col-sm-5 stat-right">
			<?php
				$get_total_views = mysqli_query($dbadmin,"SELECT * FROM `main`");
				while ($total_views_count = mysqli_fetch_array($get_total_views)){
					$total_views = $total_views + $total_views_count['views'];
				}
				echo $total_views;
			?>
		</div>
	</div>
	<div class="notice-head" style="border-top:2px solid black;">
		Media Stats
	</div>
	<div class="stat-item">
		<div class="col-sm-7 stat-left">
			Youtube Views
		</div>
		<div class="col-sm-5 stat-right">
			<?php echo $youtubetotal;?>
		</div>
		
	</div>
	<div class="stat-item">
		<div class="col-sm-7 stat-left">
			Youtube Subs
		</div>
		<div class="col-sm-5 stat-right">
			<?php echo $watchertotal;?>
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Average Video Views
		</div>
		<div class="col-sm-5 stat-right">
			<?php echo $video_average;?>
		</div>
	</div>
<!--
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Twitter Followers
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Facebook Followers
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Facebook Likes
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Facebook Shares
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>

	<div class="notice-head" style="border-top:2px solid black;">
		Admin Stuff
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Reports
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Articles for Review
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Videos for Review
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Edits for Review
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
	<div class="stat-item">		
		<div class="col-sm-7 stat-left">
			Moderation Requests
		</div>
		<div class="col-sm-5 stat-right">
			#
		</div>
	</div>
-->
</div>