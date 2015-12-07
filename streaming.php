<?php 
	require_once ('./includes/essentials.php');
	require_once ('./includes/news_database.php'); //$dbnews
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Simply Wasting Time</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="X-Clacks-Overhead" content="GNU Terry Pratchett" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="MTB Trail Database">
		<meta name="keywords" content="mtb,mountain,bike,cycling,cross,country,xc,downhill,dh,freeride,united,kingdom,uk,ae,forest,scotland">
		<meta name="author" content="Tavy Fraser">
					
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--New css-->
		<link rel="stylesheet" type="text/css" href="css/swt.css"/>
		<link rel="icon" href="./assets/swticon.png" type="image/x-icon">
		<link rel="stylesheet" href="./css/font-awesome.min.css">
		<?php include ('./fonts/fonts.php');?>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php
			$channel = filter_input(INPUT_GET, 'channel', FILTER_SANITIZE_SPECIAL_CHARS);
			$icons_set = mysqli_query($dbnews,"SELECT * FROM `contributor` WHERE `twitch` = '$channel'");
			$icons = mysqli_fetch_array($icons_set);			
			
			if ($icons['background_hex'] == false){$hex_background = '9966cc';}else{$hex_background = $icons['background_hex'];}
			if ($icons['main_hex'] == false){$hex_main = '663399';}else{$hex_main = $icons['main_hex'];}
			if ($icons['content_hex'] == false){$hex_content = 'cccccc';}else{$hex_content = $icons['content_hex'];}
			if ($icons['link_hex'] == false){$hex_link = '333333';}else{$hex_link = $icons['link_hex'];}
		?>
		<style>
			.playlist-segment:hover{
				background: #<?php echo $hex_link;?>;
			}
		</style>
	</head>

<body style="background:#<?php echo $hex_background;?>;">
	<?php include_once('./includes/analytics_tracking.php');?>
	<div class="container-fluid" id="main-container" style="background:#<?php echo $hex_main;?>;padding:0 0 5px 0;">
		<?php include "./includes/header.php"; ?> <!---Calls all header sections-->
		<?php
			if ($channel == true){
				// Clicked on a Streamers name, specific page
				?>
				<div class="row">
					<div class="col-sm-12 banner">
						<?php
							if ($icons['banner'] == true){
								echo '<img style="margin:0 auto;" class="img-responsive" src="./assets/banners/'.$icons['banner'].'" alt="Banner for '.$icons['display_name'].'"/>';
							} else {
								echo '<img style="margin:0 auto;" class="img-responsive" src="./assets/banners/example-banner.jpg" alt="Default Banner"/>';
							}
						?>
					</div>
				</div>
				<div class="row pad">
					<div class="col-sm-12 socmed-bar" style="background:#<?php echo $hex_content;?>;">
						<?php include('./includes/icons.php');?>
					</div>
				</div>				
				<div class="row">
					<div class="col-sm-12">
						<div class="col-sm-4 stream" style="background:#<?php echo $hex_content;?>;">
							<iframe frameborder="0" 
								scrolling="no" 
								id="chat_embed" 
								src="http://twitch.tv/chat/embed?channel=<?php echo $icons['twitch'];?>&amp;popout_chat=true" 
								height="500" 
								width="100%">
							</iframe>
						</div>
						<div class="col-sm-8 stream" style="background:#<?php echo $hex_content;?>;">
							<object type="application/x-shockwave-flash" height="500" width="100%" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo $icons['twitch'];?>" background="#000000">
								<param name="allowFullScreen" value="true" />
								<param name="allowScriptAccess" value="always" />
								<param name="allowNetworking" value="all" />
								<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
								<param name="flashvars" value="hostname=www.twitch.tv&channel=<?php echo $icons['twitch'];?>&auto_play=true&start_volume=25" />
							</object>
						</div>						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="col-sm-12 standard playlist-title">
							<?php
								$channelName = $icons['twitch'];
								$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName)), true);
								
								if ($json_array['stream'] != NULL) {
									$currentGame = $json_array['stream']['channel']['game'];
								}
							?>
							Current Game: <?php echo $currentGame;?>
						</div>
					</div>
				</div>
				<?php
					echo '<div class="row padding" style="margin-top:10px;">';
						echo '<div class="col-sm-12">';
							if ($icons['schedule'] == true){
								echo '<div class="col-sm-12 stream-about standard padding" style="background:#'.$hex_content.';text-align:center;">';
									echo '<div class="playlist-title">';
										echo 'Scheduling';
									echo '</div>';
									// Access Schedule table for ['$user_id']
									echo '<div class="playlist-body">';
										include('./includes/schedule.php');
									echo '</div>';							
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				?>
				<div class="row" style="margin-top:10px;">
					<?php
						if ($icons['youtube'] == true){
							echo '<div class="col-sm-12">';
								include ('./includes/playlist.php');
								echo '<div class="col-sm-4 stream-about standard padding" style="background:#'.$hex_content.';">';
									echo '<div class="playlist-title">';
										echo 'About';
									echo '</div>';
									echo '<div class="playlist-about">';
										echo htmlspecialchars_decode($icons['about']);
									echo '</div>';
								echo '</div>';
							echo '</div>';
						} else {
							echo '<div class="col-sm-12">';
								echo '<div class="col-sm-12 stream-about standard padding" style="background:#'.$hex_content.';">';
									echo '<div class="playlist-title">';
										echo 'About';
									echo '</div>';
									echo '<div style="padding:10px;">';
										echo nl2br($icons['about']);
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					?>
				</div>
				<?php
			} else {
				// General Streaming page
				?>	
				<div class="row padding" style="margin-bottom:10px;">
					<div class="col-sm-12">
						<div class="col-sm-12 standard playlist-title">
							Streams
						</div>
					</div>
				</div>
				<div class="row padding">
					<?php
						//$stream_set = mysqli_query($dbnews,"SELECT * FROM `contributor` ORDER BY `display_name` ASC");
						$stream_set = mysqli_query($dbnews,"SELECT * FROM `contributor` WHERE `twitch` <> '' AND `banner` <> '' ORDER BY `display_name` ASC");
						while ($stream = mysqli_fetch_array($stream_set)){
							$channelName = $stream['twitch'];
							$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channelName)), true);
							
							if ($json_array['stream'] != NULL) {
								//$channelTitle = $json_array['stream']['channel']['display_name'];
								//$streamTitle = $json_array['stream']['channel']['status'];
								$currentGame = $json_array['stream']['channel']['game'];
								
								$streamstatus = 1;
							} else {
								$streamstatus = 0;
							}
							
							echo '<div class="col-sm-6 streamlist">';
								echo '<a href="./streaming.php?channel='.$stream['twitch'].'">';
									echo '<img src="./assets/banners/'.$stream['banner'].'" class="img-responsive" alt="'.$stream['display_name'].'"/>';
								if ($streamstatus == 0){	
									echo '<div class="col-sm-12 streaminfo" style="border-bottom-left-radius: 20px;background:#cc3333;">';
										echo 'Offline';
									echo '</div>';
								} else {	
									echo '<div class="col-sm-8 streaminfo" style="border-bottom-left-radius: 20px;">';
										echo 'Playing: '.$currentGame;
									echo '</div>';									
									echo '<div class="col-sm-4 streaminfo" style="background:#66cc33;">';
										echo 'Online';
									echo '</div>';
								}
									
								echo '</a>';
							echo '</div>';
						}		
					?>
				</div>
				<div class="row padding" style="margin-bottom:5px;">
					<div class="col-sm-12">
						<div class="col-sm-12 standard pad playlist-title">
							Multi-Twitch
						</div>
					</div>
				</div>	
				<form role="form" name="content" enctype="multipart/form-data" target="_blank" action="./includes/multistream.php" method="post">
					<div class="row padding" style="margin-bottom:5px;">
						<div class="col-sm-12">
							<div class="col-sm-12 pad" style="text-align:center;">
								<div class="btn-group" data-toggle="buttons">
									<?php
										$multi_set = mysqli_query($dbnews,"SELECT * FROM `contributor` WHERE `twitch` <> '' AND `banner` <> '' ORDER BY `display_name` ASC");
										$multi_no = mysqli_num_rows($multi_set);
										echo '<input type="hidden" name="no_streams" value="'.$multi_no.'">';
										$multi_loop = 1;
										while ($multi = mysqli_fetch_array($multi_set)){
											$channel = $multi['twitch'];
											$json_array = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams/'.strtolower($channel)), true);
											
											if ($json_array['stream'] != NULL) {
												$channelTitle = $json_array['stream']['channel']['display_name'];
												//Stream Active, display as green
												echo '<label class="btn btn-success">';
													echo '<input type="checkbox" name="multi[]" value="'.$channel.'" autocomplete="off">';
													echo $channelTitle;
												echo '</label>';
											} else {
												echo '<label class="btn btn-danger">';
													echo '<input type="checkbox" name="multi[]" value="'.$channel.'" autocomplete="off">';
													echo $multi['display_name'];
												echo '</label>';
											}
										}									
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="row padding">
						<div class="col-sm-12" style="text-align:center;">
							<button type="submit" class="btn btn-default">Go!</button>
						</div>
					</div>
				</form>
				<?php
			}
		?>
	</div>
	<div class="container-fluid" style="padding:0 5%;">
		<?php
			if ($channel == true){
				echo '<div class="row" style="margin-top:10px;">';
					echo '<div class="col-sm-12" id="footer" style="background:#'.$hex_content.';text-align:center;">';
						echo 'Site is <i class="fa fa-copyright"></i> Simply Wasting Time '.date("Y").'<br>';
						echo 'Designed and built by <a href="http://www.laserbirdmedia.com">Laserbird Media</a>';
					echo '</div>';
				echo '</div>';
			} else {
				echo '<center>';
					include ('./includes/footer.php');
				echo '</center>';
			}
		?>
	</div>
</body>
</html>