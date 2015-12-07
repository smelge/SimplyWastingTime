<?php 	
	require_once ('./includes/essentials.php'); //$dbnews
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="keywords" content="simply, wasting, time, gaming, site, minecraft, youtube, online, community, livestream, twitch">
		<?php 
			include_once ('./includes/meta.php');
			
			$content_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
			$cat = filter_input(INPUT_GET, 'cat', FILTER_SANITIZE_SPECIAL_CHARS);
			$gamefilter = filter_input(INPUT_GET, 'game', FILTER_SANITIZE_SPECIAL_CHARS);
			$start_display = filter_input(INPUT_GET, 'n', FILTER_SANITIZE_SPECIAL_CHARS);
			if ($start_display == ''){
				$start_display = 0;
			}
			$older = $start_display + 10;
			$newer = $start_display - 10;
		
			if ($content_id != ''){
				//Video is to be displayed
				$content_set = mysqli_query($dbnews,"SELECT * FROM main WHERE id = $content_id");
				$content = mysqli_fetch_array($content_set);
				?>
				<meta property="og:title" content="<?php echo $content['title'];?>"/> <!-- Article title -->
				<meta property="og:site_name" content="Simply Wasting Time"/> <!-- Site name -->
				<meta property="og:url" content="http://www.simplywastingtime.com/new_site/watch.php?id=<?php echo $content_id;?>"/> <!-- URL of page -->
				<meta property="og:description" content="<?php echo $content['intro'];?>"/> <!-- First paragraph of article -->
				<meta property="og:image" content="http://www.simplywastingtime.com/assets/fb-share-img.jpg"/><!-- Display image -->
				<meta property="fb:app_id" content="460496590772535"/> <!-- App ID for Facebook insights -->
				<meta property="og:type" content="article"/> <!-- Article type -->
				<?php
			}
			include_once('./includes/facebook.php');
		?>
		
	</head>

	<body>
		<div class="container-fluid padding" id="main-container">
			<?php include "./includes/header.php"; ?> <!---Calls all header sections-->
			<!-- video selection pages -->
			<?php
				if ($content_id == ''){
					// No selected video
					if ($gamefilter == ''){
						switch ($cat){
							case 'check':
								$search = "SELECT * FROM main WHERE `vid_type` = 'check' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							case 'coop':
								$search = "SELECT * FROM main WHERE `vid_type` = 'coop' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							case 'vs':
								$search = "SELECT * FROM main WHERE `vid_type` = 'vs' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							case 'lp':
								$search = "SELECT * FROM main WHERE `vid_type` = 'lp' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							case 'high':
								$search = "SELECT * FROM main WHERE `vid_type` = 'high' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							case 'story':
								$search = "SELECT * FROM main WHERE `vid_type` = 'story' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							case 'mix':
								$search = "SELECT * FROM main WHERE `vid_type` = 'mix' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							case 'bonus':
								$search = "SELECT * FROM main WHERE `vid_type` = 'bonus' AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";
								break;
							default:
								$search = "SELECT * FROM main WHERE `category` = 6 AND `release` < '$date' ORDER BY `release` DESC LIMIT $start_display,10";							
								break;
						}
					} else {
						$gamefilter = str_ireplace("_"," ",$gamefilter);
						$search = "SELECT * FROM main WHERE `game` = '$gamefilter' AND `release` < '$date' ORDER BY `release` DESC";
					}
					echo '<div class="row pad">';	
						echo '<div class="col-sm-12" id="newsfeed-head">';
							$gameset = mysqli_query ($dbnews,"SELECT DISTINCT `game` FROM main WHERE `category` = 6 AND `release` < '$date' ORDER BY `game` ASC");
							echo '<form action="./includes/functions.php" method="POST">';
								echo '<input type="hidden" name="page" value="watch">';
								echo '<select name = "game" onchange="this.form.submit()">';
									echo '<option value="none">Select a Game</option>';
									while ($games = mysqli_fetch_array($gameset)){
										$gamename = str_ireplace(" ","_",$games['game']);										
										echo '<option value="'.$gamename.'">'.$games['game'].'</option>';
									}
								echo '</select>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row pad">';
						echo '<div class="col-sm-12 standard">';							
							$content_setup = mysqli_query($dbnews,$search);
							$count = mysqli_num_rows($content_setup);							
							while ($content = mysqli_fetch_array($content_setup)){
								include ('./includes/video-feed-item.php');
							}
						echo '</div>';
					echo '</div>';
					if ($gamefilter == ''){
						echo '<div class="row pad">';	
							echo '<div class="col-sm-12" id="newsfeed-head">';
							if ($count < 10){
								echo '<a class="btn btn-default" style="float:left;" disabled="disabled">Older Stuff</a>';
							} else {
								if ($cat == ''){
									echo '<a class="btn btn-default" style="float:left;" href="?n='.$older.'">Older Stuff</a>';
								} else {
									echo '<a class="btn btn-default" style="float:left;" href="?cat='.$cat.'&n='.$older.'">Older Stuff</a>';
								}
							}
							if ($start_display != 0){ 
								if ($cat == ''){
									echo '<a class="btn btn-default" style="float:right;" href="?n='.$newer.'">Newer Stuff</a>';
								} else {
									echo '<a class="btn btn-default" style="float:right;" href="?cat='.$cat.'&n='.$newer.'">Newer Stuff</a>';
								}
							} else {
								echo '<a class="btn btn-default" disabled="disabled" style="float:right;">Newer Stuff</a>';
							}							
							echo '</div>';
						echo '</div>';
					}
				} else { 
					//Display video
					?>
					<div class="col-sm-12 standard watchtitle" style="border-top-right-radius:30px;">
						<?php 
							echo $content['game'].' Ep. '.$content['episode'].'<hr>'.$content['title'];
						?>
					</div>
					
					<div class="col-sm-8 padding">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe style="min-width:360px;border:2px solid black;" class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $content['youtube'];?>" allowfullscreen></iframe>
						</div>
						<?php
							$curr_game = $content['game'];
							$curr_episode = $content['episode'];
							$next_episode = $curr_episode + 1;
							$prev_episode = $curr_episode - 1;
							$nextset = mysqli_query($dbnews, "SELECT * FROM main WHERE game = '$curr_game' AND episode = $next_episode");
							$next = mysqli_fetch_array($nextset);
							$next_id = $next['id'];
							$first_set = mysqli_query($dbnews, "SELECT `id` FROM main WHERE game = '$curr_game' AND episode = 1");
							$first_episode = mysqli_fetch_array($first_set);
							$first = $first_episode['id'];
							
							$last_set = mysqli_query($dbnews, "SELECT `id` FROM main WHERE game = '$curr_game' ORDER BY `id` DESC LIMIT 1");
							$last_episode = mysqli_fetch_array($last_set);
							$last = $last_episode['id'];
							if ($prev_episode != 0){
								$prevset = mysqli_query($dbnews, "SELECT * FROM main WHERE game = '$curr_game' AND episode = $prev_episode");							
								$prev = mysqli_fetch_array($prevset);
								$prev_id = $prev['id'];							
							}
//Link to first episode of series						
							if ($content_id == $first){ 
								echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control unclick">';
									echo 'First Episode';
								echo '</div>';
							} else {
								echo '<a class="click" href="./watch.php?id='. $first .'">';
									echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control">';
										echo 'First Episode'; //Select based on game + episode
									echo '</div>';
								echo '</a>';
							}
//Previous Episode						
							if ($prev_id == 0){
								echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control unclick">';
									echo 'Previous Episode';
								echo '</div>';
							} else {
								echo '<a class="click" href="./watch.php?id='. $prev_id .'">';
									echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control">';
										echo 'Previous Episode'; //Select based on game + episode
									echo '</div>';
								echo '</a>';
							}						
//Next Episode						
							if ($next_id == ''){
								echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control unclick">';
									echo 'Next Episode';
								echo '</div>';							
							} else {
								if($next['release'] > $date){
									echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control unclick">';
										echo 'Coming Soon';
									echo '</div>';
								} else {
									echo '<a class="click" href="./watch.php?id='. $next_id .'">';
										echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control">';
											echo 'Next Episode'; //Select based on Game + episode no. If Episode 1 Season 1, disable button
										echo '</div>';
									echo '</a>';
								}
							}
//Latest Episode						
							if ($content_id == $last){ 
								echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control unclick">';
									echo 'Last Episode';
								echo '</div>';
							} else {
								echo '<a href="./watch.php?id='. $last .'">';
									echo '<div class="col-xs-12 col-sm-6 col-md-3 standard watch-control">';
										echo 'Last Episode'; //Select based on game + episode
									echo '</div>';
								echo '</a>';
							}
						?>
						<br style="clear:left;">						
						<div id="disqus_thread" class="standard" style="padding:0 10px;"></div>
						<script type="text/javascript">
							/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
							var disqus_shortname = 'simply-wasting-time'; // required: replace example with your forum shortname
							var disqus_identifier = '<?php echo $content['release'].'/'.$content['id'];?>';
							/* * * DON'T EDIT BELOW THIS LINE * * */
							(function() {
								var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
								dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
								(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
							})();
						</script>
						<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
						<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
					</div>					
					<div class="col-sm-4 padding">
						<div class="col-sm-12 stripes"></div>
						<div class="col-sm-12 standard watch-head">
							<span class="infohead">Category:</span>
							<?php 
								switch ($content['vid_type']){
									case 'check':
										echo " Check Out";
										break;
									case 'story':
										echo " Story Mode";
										break;
									case 'coop':
										echo " Co-Operative";
										break;
									case 'vs':
										echo " Versus";
										break;
									case 'lp':
										echo " Let's Play";
										break;
									case 'mix':
										echo " Mix It Up";
										break;
									case 'high':
										echo " Highlights";
										break;
									case 'bonus':
										echo " Contributors Bonus";
										break;
								}
							?>
						</div>
						<div class="col-sm-12 stripes"></div>
						<div class="col-sm-12 standard" style="padding:20px;">
							<?php echo $content['intro'];?>
						</div>
						<div class="col-sm-12 facebook">
							<!-- Facebook Like/Share button -->
							<a href="https://twitter.com/share" class="twitter-share-button" style="display:inline-block;">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							<div class="fb-like" data-href="http://www.simplywastingtime.com/new_site/watch.php?id=<?php echo $content_id;?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
						</div>
						<a href="https://www.youtube.com/watch?v=<?php echo $content['youtube'];?>" target="_blank">
							<div class="col-sm-12 facebook">
								<?php
									$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$content['youtube']."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU&part=statistics");
									$JSON_Data = json_decode($JSON,true);
									$like = $JSON_Data['items']['0']['statistics']['likeCount'];
									$dislike = $JSON_Data['items']['0']['statistics']['dislikeCount'];
									$yt_views = $JSON_Data['items']['0']['statistics']['viewCount'];
									$yt_comments = $JSON_Data['items']['0']['statistics']['commentCount'];
									
									echo '<span class="yt-stat"><i class="fa fa-youtube-play" style="color:red;"></i></span>';
									echo '<span class="yt-stat"><i class="fa fa-eye"></i> '.$yt_views.'</span>';
									echo '<span class="yt-stat"><i class="fa fa-plus" style="color:green;"></i> '.$like.'</span>';
									echo '<span class="yt-stat"><i class="fa fa-minus" style="color:red;"></i> '.$dislike.'</span>';
									echo '<span class="yt-stat"><i class="fa fa-comments"></i> '.$yt_comments.'</span>';
								?>							
							</div>
						</a>
					</div>
					<!--
					<div class="col-sm-12 standard" style="margin-top:10px;">
						Comments Section				
					</div>
					-->
					<?php
				}
			?>
		</div>
		<div class="container-fluid" style="margin:0 2%;">
			<?php include "./includes/footer.php";?>
		</div>
	</body>
</html>