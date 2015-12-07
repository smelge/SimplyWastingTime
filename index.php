<?php 
	require_once ('./includes/essentials.php'); //$dbnews
?>
<!DOCTYPE html>
<html lang="en">
	<head>		
		<meta name="keywords" content="simply, wasting, time, gaming, site, minecraft, youtube, online, community, livestream, twitch">
			
		<?php 
			include_once ('./includes/meta.php');
		
			$newsfilter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_SPECIAL_CHARS);
			$displayNo = filter_input(INPUT_GET, 'n', FILTER_SANITIZE_SPECIAL_CHARS);
			
			if ($displayNo == ''){
				$start_display = 0;			
			} else {
				$start_display = $displayNo;
			}
			$older = $start_display + 6;
			$newer = $start_display - 6;
		?>
	</head>

	<body>	
		<div class="container-fluid padding" id="main-container">
			<?php include "./includes/header.php"; ?> <!---Calls all header sections-->
			<!-- Alert Bar for issues -->			
			<?php
				$alert_setup = mysqli_query($dbnews,"SELECT * FROM `announcements` WHERE `type` = 'frontpage'");
				if ($alert = mysqli_fetch_array($alert_setup)){
					if ($alert['date_from'] <= $date && $alert['date_to'] >= $date){
						echo '<div class="row pad" style="margin-bottom: -10px;">';
							echo '<div class="alert alert-'.$alert['urgency'].' alert-dismissible" role="alert">';
								echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
									echo $alert['message'];
							echo '</div>';		
						echo '</div>';
					}
				}
			?>
		<!--	
			<div class="row pad" style="margin-bottom:5px;">
				<div class="col-sm-12 standard btn-group" style="padding: 5px;">
					<a class="btn btn-default" href="./streaming.php">Streams : </a>
					<?php
						$stream_set = mysqli_query($dbnews,"SELECT * FROM `contributor` WHERE `twitch` <> '' AND `banner` <> '' ORDER BY `display_name` ASC");
						while ($stream = mysqli_fetch_array($stream_set)){
							$channelName = $stream['twitch'];
							$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName)), true);
							
							if ($json_array['stream'] != NULL) {
								$channelTitle = $json_array['stream']['channel']['display_name'];
								$currentGame = $json_array['stream']['channel']['game'];
								
								echo '<a class="btn btn-success" href="./streaming.php?channel='.$stream['twitch'].'">'.$channelTitle.'</a>';								
							} else {
								echo '<a class="btn btn-danger" href="./streaming.php?channel='.$stream['twitch'].'">'.$stream['display_name'].'</a>';
							}
						}
					?>
				</div>
			</div>			
		-->
			<div class="row pad">
				<div class="col-sm-9" style="padding: 0 5px 0 0;">
					<!-- News Feed Start -->
					<!-- Collect this stuff from database of news stories -->
					<div class="col-sm-12" id="newsfeed-head"> 
						<b>Filter by:</b>
						<div class="btn-group">
							<a class="btn btn-<?php if($newsfilter == ''){echo 'success';}else{echo 'default';}?>" href="./index.php">No filter</a>
							<a class="btn btn-<?php if($newsfilter == 'news'){echo 'success';}else{echo 'default';}?>" href="?filter=news">News</a>
							<a <?php if ($news_no_reviews == 0){echo 'disabled="disabled"';}?> class="btn btn-<?php if($newsfilter == 'reviews'){echo 'success';}else{echo 'default';}?>" href="?filter=reviews">Reviews</a>
							<a class="btn btn-<?php if($newsfilter == 'videos'){echo 'success';}else{echo 'default';}?>" href="?filter=videos">Videos</a>
							<a <?php if ($news_no_blog == 0){echo 'disabled="disabled"';}?> class="btn btn-<?php if($newsfilter == 'blogs'){echo 'success';}else{echo 'default';}?>" href="?filter=blogs">Blogs</a>
							<a <?php if ($news_no_comp == 0){echo 'disabled="disabled"';}?> class="btn btn-<?php if($newsfilter == 'comps'){echo 'success';}else{echo 'default';}?>" href="?filter=comps">Competitions</a>
							<a <?php if ($news_no_challenge == 0){echo 'disabled="disabled"';}?> class="btn btn-<?php if($newsfilter == 'challenge'){echo 'success';}else{echo 'default';}?>" href="?filter=challenge">Challenges</a>
						</div>
					</div>
					<div class="col-sm-12 padding" id="news-feed">					
						<?php
							$count_posts = 0;
							switch ($newsfilter){
								case 'news':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE `type` = 'news' AND `awaiting_review` = 0 AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,6");
									while ($news_feed = mysqli_fetch_array($news_feed_setup)){
										include('./includes/news-feed-item.php');
									}
									break;
								case 'reviews':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE `type` = 'review' AND `awaiting_review` = 0 AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,6");
									while ($news_feed = mysqli_fetch_array($news_feed_setup)){
										include('./includes/news-feed-item.php');
									}
									break;
								case 'blogs':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE `type` = 'blog' AND `awaiting_review` = 0 AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,6");
									while ($news_feed = mysqli_fetch_array($news_feed_setup)){
										include('./includes/news-feed-item.php');
									}
									break;
								case 'comps':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE `type` = 'comp' AND `awaiting_review` = 0 AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,6");
									while ($news_feed = mysqli_fetch_array($news_feed_setup)){
										include('./includes/news-feed-item.php');
									}
									break;
								case 'challenge':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE `type` = 'challenge' AND `awaiting_review` = 0 AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,6");
									while ($news_feed = mysqli_fetch_array($news_feed_setup)){
										include('./includes/news-feed-item.php');
									}
									break;
								case 'videos':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE `type` = 'video' AND `awaiting_review` = 0 AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,6");
									while ($news_feed = mysqli_fetch_array($news_feed_setup)){
										include('./includes/news-feed-item.php');
									}
									break;
								default:
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE `release` < '$date' AND `awaiting_review` = 0 ORDER BY `release` DESC LIMIT $start_display,6");
									while ($news_feed = mysqli_fetch_array($news_feed_setup)){
										include('./includes/news-feed-item.php');
									}							
									break;
							}	
						?>
					</div>
					<div class="col-sm-12" id="newsfeed-head">
						<?php
							if ($newsfilter == ''){
								if ($count_posts < 6){
									echo '<a class="btn btn-default" style="float:left;" disabled="disabled">Older Stuff</a>';
								} else {
									echo '<a class="btn btn-default" style="float:left;" href="?n='.$older.'">Older Stuff</a>';
								}
								if ($start_display != 0){ 
									echo '<a class="btn btn-default" style="float:right;" href="?n='.$newer.'">Newer Stuff</a>';
								} else {
									echo '<a class="btn btn-default" disabled="disabled" style="float:right;">Newer Stuff</a>';
								}
							} else {
								if ($count_posts < 6){
									echo '<a class="btn btn-default" style="float:left;" disabled="disabled">Older Stuff</a>';
								} else {
									echo '<a class="btn btn-default" style="float:left;" href="?filter='.$newsfilter.'&n='.$older.'">Older Stuff</a>';	
								}
								if ($start_display != 0){ 
									echo '<a class="btn btn-default" style="float:right;" href="?filter='.$newsfilter.'&n='.$newer.'">Newer Stuff</a>';
								} else {
									echo '<a class="btn btn-default" disabled="disabled" style="float:right;">Newer Stuff</a>';
								}
							}
						?>	
					</div>
					<!-- News Feed End -->
				</div>
				<div class="col-sm-3 padding" id="twitter-column">
					<!-- Don't ask...-->
					<?php
						$doge = date("m-d");
						if ($doge == '12-31' || $doge == '01-01'){
							echo '<img src="./assets/doge.png" style="z-index:99;position:absolute;bottom:785px;right:10px;">';
						}
					?>					
					<a class="twitter-timeline"  href="https://twitter.com/SimplyWT/lists/simplywastingtime" data-widget-id="635641876503248896">
						Tweets from https://twitter.com/SimplyWT/lists/simplywastingtime
					</a>
					<script>
						!function(d,s,id){
							var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
							if(!d.getElementById(id)){
								js=d.createElement(s);
								js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
								fjs.parentNode.insertBefore(js,fjs);
							}
						}
						(document,"script","twitter-wjs");
					</script>			
				</div>
			</div>
		</div>
		<div class="container-fluid" style="margin:0 2%;">
			<?php include "./includes/footer.php";?>
		</div>
	</body>
</html>