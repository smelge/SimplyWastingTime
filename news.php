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
			$newstype = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
			
			if ($content_id != ''){
				$content_setup = mysqli_query($dbnews, "SELECT * FROM main WHERE id = $content_id AND `awaiting_review` = 0");
				$content = mysqli_fetch_array($content_setup);
			}
		?>		
		<!-- Facebook Tags -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<meta property="og:title" content="<?php echo $content['title'];?>"/> <!-- Article title -->
		<meta property="og:site_name" content="Simply Wasting Time"/> <!-- Site name -->
		<meta property="og:url" content="http://www.simplywastingtime.com/news.php?id=<?php echo $content_id;?>"/> <!-- URL of page -->
		<meta property="og:description" content="<?php echo htmlspecialchars_decode($content['intro']);?>"/> <!-- First paragraph of article -->
		<meta property="og:image" content="http://www.simplywastingtime.com/assets/fblogo.gif"/> <!-- Display image -->
		<!--<meta property="fb:app_id" content=""/>--> <!-- App ID for Facebook insights -->
		<meta property="og:type" content="article"/> <!-- Content Type -->
		<meta name="author" content="<?php echo $content['author'];?>">
		<!-- End Facebook Tags -->
	</head>

<body>
	<?php include ('./includes/facebook.php');?>
	<div class="container-fluid padding" id="main-container">
		<?php include "./includes/header.php"; ?> <!---Calls all header sections-->
		<div class="row pad">
			<div class="col-sm-12 standard">
				<?php
					if ($content_id == ''){
					?>
						<!-- Main news list displays when no id selected -->
						<?php
							switch ($newstype){
								case 'n':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE category = 1 AND `awaiting_review` = 0 ORDER BY id DESC");
									break;
								case 'r':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE category = 2 AND `awaiting_review` = 0 ORDER BY id DESC");
									break;
								case 'b':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE category = 3 AND `awaiting_review` = 0 ORDER BY id DESC");
									break;
								case 'co':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE category = 4 AND `awaiting_review` = 0 ORDER BY id DESC");
									break;
								case 'ch':
									$news_feed_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE category = 5 AND `awaiting_review` = 0 ORDER BY id DESC");
									break;
							}
							while ($news_feed = mysqli_fetch_array($news_feed_setup)){
								include ('./includes/newsarchive.php');
							}
						?>
					<?php
					} else {
						//Hitcounter
							$views = "UPDATE main SET pageviews = pageviews + 1 WHERE id = $content_id";
							$viewupdate = mysqli_query($dbnews, $views);
						
						switch($content['category']){
							case 1: //News Display ?>
								<div class="row">
									<div class="col-sm-12 standard">
										<h2><?php echo $content['title'];?></h2>
									</div>
									<div class="col-sm-8 standard" style="padding:10px;">										
										<?php 
											if ($content['release'] <= '2015-09-01'){
												echo nl2br($content['intro']);
												echo '<br><br>';
												echo nl2br($content['story']);
											} else {
												echo htmlspecialchars_decode($content['story']);
											}
										?>
										<br><br>
										<!-- Facebook Like/Share button -->
										<a href="https://twitter.com/share" class="twitter-share-button" style="display:inline-block;">Tweet</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
										<div class="fb-like" style="display:inline-block;" data-href="http://www.simplywastingtime.com/news.php?id=<?php echo $content_id;?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
										<div id="disqus_thread"></div>
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
									<?php include('./includes/sidebar.php');?>
								</div>
							<?php
							break;
							case 2: //Review Display ?>
								<div class="row">
									<div class="col-sm-12 standard">
										<span class="watchtitle"><?php echo $content['title'];?></span>
										<h6><small>Written By <?php echo $content['author'];?></small></h6>
									</div>
									<div class="col-sm-8 standard" style="padding:10px;">																			
										<br>
										<b><?php echo $content['intro'];?></b>
										<br><br>
										<img src="./assets/images/articletest.gif" alt="test image" style="border:2px solid black;margin:10px;float:right;">	
										<?php 
											echo htmlspecialchars_decode($content['story']);
										?>
										<hr>
										<b><i><?php echo $content['review_summary'];?></i></b>
										<br><br>
										Score: 
										<?php
											for ($s_pos=1;$s_pos<=$content['rating'];$s_pos++){
												echo '<i class="fa fa-star fa-lg"></i>';
											}
											for ($m_pos=$content['rating']+1;$m_pos<=10;$m_pos++){											
												echo '<i class="fa fa-star-o fa-lg"></i>';
											}
										?>
										<br><br>
									</div>
									<?php include('./includes/sidebar.php');?>	
								</div>
							<?php
							break;
							case 3: //Blog Display
								echo '<div class="row">';
									echo '<div class="col-sm-12 standard">';
										echo '<h2>'. $content['title'] .'</h2>';
									echo '</div>';
									echo '<div class="col-sm-8 standard" style="padding:10px;">';
										if ($content['release'] <= '2015-09-01'){
											echo nl2br($content['intro']);
											echo '<br><br>';
											echo nl2br($content['story']);
										} else {
											echo htmlspecialchars_decode($content['story']);
										}
										?>
										<br><br>
										<!-- Facebook Like/Share button -->
										<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
										<div class="fb-like" data-href="http://www.simplywastingtime.com/news.php?id=<?php echo $content_id;?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
										<div id="disqus_thread"></div>
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
										<?php
									echo '</div>';
									include('./includes/sidebar.php');
								echo '</div>';
							break;
							case 4: //Competition Display
							break;
							case 5: //Challenge display
							break;
						}
					}
				?>				
			</div>
		</div>
	</div>
	<div class="container-fluid" style="padding:0 5%;">
		<center><?php include "./includes/footer.php";?></center> <!--- Calls footer stuff-->
	</div>
</body>
</html>