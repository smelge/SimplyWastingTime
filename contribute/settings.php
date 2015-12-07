<?php 	
	require_once ('./includes/contribute_essentials.php');
	require_once ('../includes/news_database.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SWT - Contribute</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Tavy Fraser">
					
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--New css-->
		<link rel="stylesheet" type="text/css" href="../css/swt.css"/>
		<link rel="stylesheet" type="text/css" href="./css/admin.css"/>
		<link rel="icon" href="../assets/swticon.png" type="image/x-icon">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="../js/bootstrap.min.js"></script>
		
		<script src='../js/spectrum.js'></script>
		<link rel='stylesheet' href='../css/spectrum.css' />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->	
		<?php
			$user_id = $context['user']['id'];
			$user_group = $user_info['groups'];
			$user_group = $user_group[0];
			$user_set = mysqli_query($dbnews,"SELECT * FROM `contributor` WHERE `user_id` = '$user_id'");
			$user = mysqli_fetch_array($user_set);
			
			$redirect = filter_input(INPUT_GET, 'redirect', FILTER_SANITIZE_SPECIAL_CHARS);
			
			if (mysqli_num_rows($user_set)){
			} else {
				echo "<script>";
					echo "$(document).ready(function(){";
						echo "$('#createStream').modal('show');";
					echo "})";
				echo "</script>";
			}
			
			if ($redirect == 'success'){
				echo "<script>";
					echo "$(document).ready(function(){";
						echo "$('#createSuccess').modal('show');";
					echo "})";
				echo "</script>";
			}
		?>
	</head>

	<body>
		<?php
			if ($context['user']['is_admin'] || $user_group == '9'){
				?>			
				<div class="container-fluid" id="main-container">
					<!-- Create Streaming Account modal -->
					<div class="modal fade" style="padding-top:25%;" id="createStream" tabindex="-1" role="dialog" aria-labelledby="emailSuccessLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">							
								<div class="modal-body">
									<center>
										Do you want to create a Streaming Account?<br><br>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Fuck No. Maybe later.</button>
										<a class="btn btn-success" href="./includes/user_settings.php?type=create&id=<?php echo $user_id;?>">Yeah</a>
									</center>									
								</div>
							</div>
						</div>
					</div>
					<!-- Create Streaming Account modal -->
					<div class="modal fade" style="padding-top:25%;" id="createSuccess" tabindex="-1" role="dialog" aria-labelledby="emailSuccessLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">							
								<div class="modal-body">
									<center>
										Success! Your streaming account has been created.<br><br>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</center>									
								</div>
							</div>
						</div>
					</div>
					<?php include "./includes/contribute_header.php"; ?> <!---Calls all header sections-->
					
					<?php
						if ($user['youtube'] == false || $user['twitch'] == false || $user['banner'] == false){
							echo '<div class="row padding">';
								echo '<div class="col-sm-12" style="margin:0;">';
									echo '<div class="alert alert-danger" role="alert">';
										echo 'You will not appear in the Streaming list until you have set a Twitch channel and a banner.<br><br>';
										echo 'You still need to add:<br>';
										if ($user['twitch'] == false){echo '<b>Twitch Channel</b><br>';}
										if ($user['banner'] == false){echo '<b>Channel Banner</b><br>';}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					?>					
					<div class="row" style="margin-bottom:5px;">						
						<div class="col-sm-12 standard">
							<form role="form" name="content" enctype="multipart/form-data" action="./includes/user_settings.php?type=social" method="post">
								<div class="form-group">
									<p class="help-block">Current Links</p>
									<div class="col-sm-12 socmed-bar">										
										<?php
											// Icons	
											if ($user['youtube'] == true){echo '<i class="fa fa-youtube fa-3x" title="Youtube" style="color:green;"></i>';} else {echo '<i class="fa fa-youtube fa-3x" title="Youtube" style="color:red;"></i>';}
											if ($user['twitch'] == true){echo '<i class="fa fa-twitch fa-3x" title="Twitch" style="color:green;"></i>';} else {echo '<i class="fa fa-twitch fa-3x" title="Twitch" style="color:red;"></i>';}
											if ($user['twitter'] == true){echo '<i class="fa fa-twitter-square fa-3x" title="Twitter" style="color:green;"></i>';} else {echo '<i class="fa fa-twitter-square fa-3x" title="Twitter" style="color:red;"></i>';}
											if ($user['facebook'] == true){echo '<i class="fa fa-facebook fa-3x" title="Facebook" style="color:green;"></i>';} else {echo '<i class="fa fa-facebook fa-3x" title="Facebook" style="color:red;"></i>';}
											if ($user['steam'] == true){echo '<i class="fa fa-steam-square fa-3x" title="Steam" style="color:green;"></i>';} else {echo '<i class="fa fa-steam-square fa-3x" title="Steam" style="color:red;"></i>';}
											if ($user['googleplus'] == true){echo '<i class="fa fa-google-plus-square fa-3x" title="Google+" style="color:green;"></i>';} else {echo '<i class="fa fa-google-plus-square fa-3x" title="Google+" style="color:red;"></i>';}
											if ($user['website'] == true){echo '<i class="fa fa-globe fa-3x" title="Website" style="color:green;"></i>';} else {echo '<i class="fa fa-globe fa-3x" title="Website" style="color:red;"></i>';}
											if ($user['patreon'] == true){echo '<i class="fa fa-usd fa-3x" title="Patreon" style="color:green;"></i>';} else {echo '<i class="fa fa-usd fa-3x" title="Patreon" style="color:red;"></i>';}
											if ($user['reddit'] == true){echo '<i class="fa fa-reddit-square fa-3x" title="Reddit" style="color:green;"></i>';} else {echo '<i class="fa fa-reddit-square fa-3x" title="Reddit" style="color:red;"></i>';}
											if ($user['livestream'] == true){echo '<i class="fa fa-coffee fa-3x" title="Livestream" style="color:green;"></i>';} else {echo '<i class="fa fa-coffee fa-3x" title="Livestream" style="color:red;"></i>';}
											if ($user['vimeo'] == true){echo '<i class="fa fa-vimeo-square fa-3x" title="Vimeo" style="color:green;"></i>';} else {echo '<i class="fa fa-vimeo-square fa-3x" title="Vimeo" style="color:red;"></i>';}
											if ($user['spotify'] == true){echo '<i class="fa fa-spotify fa-3x" title="Spotify" style="color:green;"></i>';} else {echo '<i class="fa fa-spotify fa-3x" title="Spotify" style="color:red;"></i>';}
											if ($user['deviantart'] == true){echo '<i class="fa fa-deviantart fa-3x" title="Deviant Art" style="color:green;"></i>';} else {echo '<i class="fa fa-deviantart fa-3x" title="Deviant Art" style="color:red;"></i>';}
											if ($user['flickr'] == true){echo '<i class="fa fa-flickr fa-3x" title="Flickr" style="color:green;"></i>';} else {echo '<i class="fa fa-flickr fa-3x" title="Flickr" style="color:red;"></i>';}
											if ($user['instagram'] == true){echo '<i class="fa fa-instagram fa-3x" title="Instagram" style="color:green;"></i>';} else {echo '<i class="fa fa-instagram fa-3x" title="Instagram" style="color:red;"></i>';}
											if ($user['tumblr'] == true){echo '<i class="fa fa-tumblr-square fa-3x" title="Tumblr" style="color:green;"></i>';} else {echo '<i class="fa fa-tumblr-square fa-3x" title="Tumblr" style="color:red;"></i>';}
										?>
									</div>
								</div>
								<div class="form-group">
									<?php 
										if ($user['deviantart'] == true){$deviantart_state ='success';$deviantart = 'value="'.$user['deviantart'].'"';} else {$deviantart_state='error';$deviantart = 'placeholder="DeviantArt"';}
										if ($user['facebook'] == true){$facebook_state ='success';$facebook = 'value="'.$user['facebook'].'"';} else {$facebook_state='error';$facebook = 'placeholder="facebook"';}
										if ($user['flickr'] == true){$flickr_state ='success';$flickr = 'value="'.$user['flickr'].'"';} else {$flickr_state='error';$flickr = 'placeholder="flickr"';}
										if ($user['googleplus'] == true){$googleplus_state ='success';$googleplus = 'value="'.$user['googleplus'].'"';} else {$googleplus_state='error';$googleplus = 'placeholder="googleplus"';}
										if ($user['instagram'] == true){$instagram_state ='success';$instagram = 'value="'.$user['instagram'].'"';} else {$instagram_state='error';$instagram = 'placeholder="instagram"';}
										if ($user['livestream'] == true){$livestream_state ='success';$livestream = 'value="'.$user['livestream'].'"';} else {$livestream_state='error';$livestream = 'placeholder="livestream"';}
										if ($user['patreon'] == true){$patreon_state ='success';$patreon = 'value="'.$user['patreon'].'"';} else {$patreon_state='error';$patreon = 'placeholder="patreon"';}
										if ($user['reddit'] == true){$reddit_state ='success';$reddit = 'value="'.$user['reddit'].'"';} else {$reddit_state='error';$reddit = 'placeholder="reddit"';}
										if ($user['spotify'] == true){$spotify_state ='success';$spotify = 'value="'.$user['spotify'].'"';} else {$spotify_state='error';$spotify = 'placeholder="spotify"';}
										if ($user['steam'] == true){$steam_state ='success';$steam = 'value="'.$user['steam'].'"';} else {$steam_state='error';$steam = 'placeholder="steam"';}
										if ($user['tumblr'] == true){$tumblr_state ='success';$tumblr = 'value="'.$user['tumblr'].'"';} else {$tumblr_state='error';$tumblr = 'placeholder="tumblr"';}
										if ($user['twitch'] == true){$twitch_state ='success';$twitch = 'value="'.$user['twitch'].'"';} else {$twitch_state='error';$twitch = 'placeholder="twitch"';}
										if ($user['twitter'] == true){$twitter_state ='success';$twitter = 'value="'.$user['twitter'].'"';} else {$twitter_state='error';$twitter = 'placeholder="twitter"';}
										if ($user['vimeo'] == true){$vimeo_state ='success';$vimeo = 'value="'.$user['vimeo'].'"';} else {$vimeo_state='error';$vimeo = 'placeholder="vimeo"';}
										if ($user['website'] == true){$website_state ='success';$website = 'value="'.$user['website'].'"';} else {$website_state='error';$website = 'placeholder="website"';}
										if ($user['youtube'] == true){$youtube_state ='success';$youtube = 'value="'.$user['youtube'].'"';} else {$youtube_state='error';$youtube = 'placeholder="youtube"';}
									?>
									<p class="help-block">Important Links</p>
									<div class="row" style="text-align:center;">
										<div class="col-sm-3 has-<?php echo $youtube_state;?>">Youtube<input type="text" class="form-control" name="youtube" <?php echo $youtube;?>></div>
										<div class="col-sm-3 has-<?php echo $twitch_state;?>">Twitch<input type="text" class="form-control" name="twitch" <?php echo $twitch;?>></div>
										<div class="col-sm-3 has-<?php echo $twitter_state;?>">Twitter<input type="text" class="form-control" name="twitter" <?php echo $twitter;?>></div>
										<div class="col-sm-3 has-<?php echo $facebook_state;?>">Facebook<input type="text" class="form-control" name="facebook" <?php echo $facebook;?>></div>
									</div>
									<div class="row" style="text-align:center;">
										<div class="col-sm-3 has-<?php echo $steam_state;?>">Steam<input type="text" class="form-control" name="steam" <?php echo $steam;?>></div>
										<div class="col-sm-3 has-<?php echo $googleplus_state;?>">Google+<input type="text" class="form-control" name="googleplus" <?php echo $googleplus;?>></div>
										<div class="col-sm-3 has-<?php echo $website_state;?>">Website<input type="text" class="form-control" name="website" <?php echo $website;?>></div>
										<div class="col-sm-3 has-<?php echo $patreon_state;?>">Patreon<input type="text" class="form-control" name="patreon" <?php echo $patreon;?>></div>
									</div>
									<p class="help-block">Other Links</p>
									<div class="row" style="text-align:center;">
										<div class="col-sm-3 has-<?php echo $reddit_state;?>">Reddit<input type="text" class="form-control" name="reddit" <?php echo $reddit;?>></div>
										<div class="col-sm-3 has-<?php echo $livestream_state;?>">Livestream<input type="text" class="form-control" name="livestream" <?php echo $livestream;?>></div>
										<div class="col-sm-3 has-<?php echo $vimeo_state;?>">Vimeo<input type="text" class="form-control" name="vimeo" <?php echo $vimeo;?>></div>
										<div class="col-sm-3 has-<?php echo $spotify_state;?>">Spotify<input type="text" class="form-control" name="spotify" <?php echo $spotify;?>></div>
									</div>
									<p class="help-block">Dumb Stuff</p>
									<div class="row" style="text-align:center;">	
										<div class="col-sm-3 has-<?php echo $deviantart_state;?>">DeviantArt<input type="text" class="form-control" name="deviantart" <?php echo $deviantart;?>></div>
										<div class="col-sm-3 has-<?php echo $flickr_state;?>">Flickr<input type="text" class="form-control" name="flickr" <?php echo $flickr;?>></div>
										<div class="col-sm-3 has-<?php echo $instagram_state;?>">Instagram<input type="text" class="form-control" name="instagram" <?php echo $instagram;?>></div>
										<div class="col-sm-3 has-<?php echo $tumblr_state;?>">Tumblr<input type="text" class="form-control" name="tumblr" <?php echo $tumblr;?>></div>
									</div>							
								</div>
								<hr>
								<div class="form-group">
									<div class="col-sm-12" style="margin-bottom:10px;">
										<input type="hidden" name="user" value="<?php echo $user_id;?>">
										<button type="reset" class="btn btn-danger">Reset</button>
										<button type="submit" class="btn btn-success">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="row" style="margin-bottom:5px;">						
						<div class="col-sm-12 standard">
							<div class="col-sm-6">							
								<form role="form" name="content" enctype="multipart/form-data" action="./includes/user_settings.php?type=banner" method="post">
									<div class="form-group">
										<div class="col-sm-12" style="padding-bottom;10px;">										
											<p class="help-block">Customise your banner (1200px x 200px)</p>
											<input type="file" style="float:left;" name="newimage">
											<input type="hidden" name="user" value="<?php echo $user_id;?>">
											<button type="reset" class="btn btn-danger">Reset</button>
											<button type="submit" class="btn btn-success">Submit</button>
											<br><br>
										</div>
									</div>									
								</form>
							</div>
							<div class="col-sm-6" style="padding:10px;">							
								<?php
									if ($user['banner'] == true){
										echo '<img class="img-responsive" src="../assets/banners/'.$user['banner'].'" alt="Your banner"/>';
									} else {
										echo '<img class="img-responsive" src="../assets/banners/example-banner.jpg" alt="Your banner"/>';
									}
								?>
							</div>
						</div>
					</div>
					<div class="row" style="margin-bottom:5px;">						
						<div class="col-sm-12 standard">
							<form role="form" name="content" enctype="multipart/form-data" action="./includes/user_settings.php?type=details" method="post">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<p class="help-block">Streaming / Release Schedule</p>
											<?php
												if ($user['schedule'] == true){
													echo '<textarea class="form-control" rows="6" required name="schedule">'.$user['schedule'].'</textarea>';
												} else {
													echo '<textarea class="form-control" rows="6" required name="schedule" placeholder="Add a schedule"></textarea>';
												}
											?>
										</div>
										<div class="col-sm-6">
											<p class="help-block">About your or your channel</p>
											<?php
												if ($user['about'] == true){
													echo '<textarea class="form-control" rows="6" required name="about">'.$user['about'].'</textarea>';
												} else {
													echo '<textarea class="form-control" rows="6" required name="about" placeholder="Add some info about you and your channel"></textarea>';
												}
											?>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<p class="help-block">This is how your name is displayed on your page (e.g. Simply Wasting Time)</p>
											<?php
												if ($user['display_name'] == true){
													echo '<input type="text" class="form-control" name="displayname" value="'.$user['display_name'].'">';
												} else {
													echo '<input type="text" class="form-control" name="displayname" placeholder="Display Name">';
												}
											?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="hidden" name="user" value="<?php echo $user_id;?>">
												<button type="reset" class="btn btn-danger">Reset</button>
												<button type="submit" class="btn btn-success">Submit</button>
											</div>
										</div>
									</div>
								</div>									
							</form>
						</div>
					</div>
					<div class="row" style="margin-bottom:5px;">						
						<div class="col-sm-12 standard">
							<form role="form" name="content" enctype="multipart/form-data" action="./includes/user_settings.php?type=colours" method="post">
								<div class="form-group">
									<div class="row" style="text-align:center;">
										<div class="col-sm-3">
											<p class="help-block">Custom Background</p>
											<?php
												if ($user['background_hex'] == true){
													echo '<input type="text" id="bg-color" name="bg-color" value="#'.$user['background_hex'].'"/>';
												} else {
													echo '<input type="text" id="bg-color" name="bg-color" value="#9966cc"/>';
												}
											?>
										</div>
										<div class="col-sm-3">
											<p class="help-block">Custom Foreground</p>
											<?php
												if ($user['main_hex'] == true){
													echo '<input type="text" id="fore-color" name="fore-color" value="#'.$user['main_hex'].'"/>';
												} else {
													echo '<input type="text" id="fore-color" name="fore-color" value="#663399"/>';
												}
											?>
										</div>
										<div class="col-sm-3">
											<p class="help-block">Custom Content</p>											
											<?php
												if ($user['content_hex'] == true){
													echo '<input type="text" id="cont-color" name="cont-color" value="#'.$user['content_hex'].'"/>';
												} else {
													echo '<input type="text" id="cont-color" name="cont-color" value="#cccccc"/>';
												}
											?>
										</div>
										<div class="col-sm-3">
											<p class="help-block">Custom Button Hover</p>
											<?php
												if ($user['link_hex'] == true){
													echo '<input type="text" id="hover-color" name="hover-color" value="#'.$user['link_hex'].'"/>';
												} else {
													echo '<input type="text" id="hover-color" name="hover-color" value="#333333"/>';
												}
											?>
										</div>
										
										<script>
											// Initialize background colour picker
											$("#bg-color").spectrum({
												preferredFormat: "hex",
												<?php
													if ($user['background_hex'] == true){
														echo 'color: "#'.$user['background_hex'].'",';
													} else {
														echo 'color: "#9966cc",';
													}
												?>
												showInput: true,
												allowEmpty:true,
												showInitial: true,
												showInput: true,
												clickoutFiresChange: true
											});
											// Initialize Foreground colour picker
											$("#fore-color").spectrum({
												preferredFormat: "hex",
												<?php
												if ($user['main_hex'] == true){
													echo 'color: "#'.$user['main_hex'].'",';
												} else {
													echo 'color: "#663399",';
												}
												?>
												showInput: true,
												allowEmpty:true,
												showInitial: true,
												showInput: true,
												clickoutFiresChange: true
											});
											// Initialize Content colour picker
											$("#cont-color").spectrum({
												preferredFormat: "hex",
												<?php
												if ($user['content_hex'] == true){
													echo 'color: "#'.$user['content_hex'].'",';
												} else {
													echo 'color: "#cccccc",';
												}
												?>
												showInput: true,
												allowEmpty:true,
												showInitial: true,
												showInput: true,
												clickoutFiresChange: true
											});
											// Initialize Hover colour picker
											$("#hover-color").spectrum({
												preferredFormat: "hex",
												<?php
												if ($user['link_hex'] == true){
													echo 'color: "#'.$user['link_hex'].'",';
												} else {
													echo 'color: "#333333",';
												}
												?>
												showInput: true,
												allowEmpty:true,
												showInitial: true,
												showInput: true,
												clickoutFiresChange: true
											});
										</script>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="user" value="<?php echo $user_id;?>">
											<button type="reset" class="btn btn-danger">Reset</button>
											<button type="submit" class="btn btn-success">Submit</button>
											<a class="btn btn-default" href="./includes/user_settings.php?type=resetcolour&user=<?php echo $user_id;?>">Reset to Default Colours</a>											
										</div>
									</div>
								</div>	
							</form>							
						</div>
					</div>
				</div>
				<div class="container-fluid" style="padding:0 5%;">
					<center><?php include "../includes/footer.php";?></center> <!--- Calls footer stuff-->
				</div>
				<?php
			} else {
				echo '<div class="container-fluid" style="padding:0 5%;margin-top:100px;">';
					echo '<div class="row">';
						echo '<div class="col-sm-12 standard">';
							echo "<center><br>You shouldn't be here...<br><br><a class='btn btn-primary' href='../index.php'>Go Away</a></center><br>";
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		?>
	</body>
</html>