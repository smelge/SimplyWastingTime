<?php
//Get and format Date/Time
$date = date("Y-m-d H:i:s");
include ('./includes/vid_check.php');
?>

<div class="row pad">
	<!-- Header Section -->
	<div class="col-sm-8 padding" id="logobar">
		<a href="./index.php"><img class="img-responsive" src="../assets/logo.png" alt="Simply Wasting Time Logo"></a>
	</div>
	<div class="col-sm-4">
		<a class="btn btn-default social-media" href="https://www.facebook.com/simplywastingtime" target="_blank">	
			<i class="fa fa-facebook fa-2x"></i>
		</a>
		<a class="btn btn-default social-media" href="http://steamcommunity.com/groups/simplywastingtime" target="_blank">	
			<i class="fa fa-steam fa-2x"></i>
		</a>
		<a class="btn btn-default social-media" href="https://twitter.com/SimplyWT" target="_blank">	
			<i class="fa fa-twitter fa-2x"></i>
		</a>
		<a class="btn btn-default social-media" href="https://www.youtube.com/simplywastingtime" target="_blank">	
			<i class="fa fa-youtube fa-2x"></i>
		</a>
		<a class="btn btn-default social-media" href="http://www.twitch.tv/simplywastingtime" target="_blank">	
			<i class="fa fa-twitch fa-2x"></i>
		</a>
	</div>			
</div>
<div class="row pad">
	<!--Randomised tagline-->
	<div class="col-xs-12 padding tagline">
		<?php include_once('./includes/tagline.php');?>
	</div>
</div>
<div class="row pad" style="margin-bottom:5px;"> <!-- Navbar -->
	<div class="col-sm-12 padding" id="navigation-bar">
		<ul class="nav nav-pills" role="tablist">
			<li id="home"><a href="./index.php" id="home" style="color:black;">Home</a></li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">
				News & Stuff <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<?php
						if ($news_no_news != 0){echo '<li id="directory"><a href="./news.php?c=n" id="news">News</a></li>';}
						if ($news_no_reviews != 0){echo '<li id="directory"><a href="./news.php?c=r" id="reviews">Reviews</a></li>';}
						if ($news_no_blog != 0){echo '<li id="directory"><a href="./news.php?c=b" id="blog">Blogatronic</a></li>';}
						if ($news_no_comp != 0){echo '<li id="directory"><a href="./news.php?c=co" id="comp">Competitions</a></li>';}
						if ($news_no_challenge != 0){echo '<li id="directory"><a href="./news.php?c=ch" id="challenge">Challenges</a></li>';}
					?>
				</ul>
			</li>
			<!--<li id="home"><a href="./streaming.php" id="home" style="color:black;">Streams</a></li>-->
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">
				Videos <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<?php 
						if ($vid_no_check != 0){echo '<li id="directory"><a href="./watch.php?cat=check" id="checkout">Check Out</a></li>';}
						if ($vid_no_story != 0){echo '<li id="directory"><a href="./watch.php?cat=story" id="story">Story</a></li>';}
						if ($vid_no_coop != 0){echo '<li id="directory"><a href="./watch.php?cat=coop" id="coop">Co-Op</a></li>';}
						if ($vid_no_vs != 0){echo '<li id="directory"><a href="./watch.php?cat=vs" id="vs">Versus</a></li>';}
						if ($vid_no_lp != 0){echo '<li id="directory"><a href="./watch.php?cat=lp" id="letsplay">Lets Play</a></li>';}
						if ($vid_no_mix != 0){echo '<li id="directory"><a href="./watch.php?cat=mix" id="mix">Mix it Up</a></li>';}
						if ($vid_no_awesome != 0){echo '<li id="directory"><a href="./watch.php?cat=high" id="highlights">Highlights</a></li>';}
					?>
				</ul>
			</li>
			<li id="streaming"><a href="./streaming.php" id="streaming" style="color:black;">Streaming</a></li>
			
			<?php
				if (isset($_SESSION['username'])){
					// Check rank
					if ($_SESSION['rank'] == 1){
						// Admin Rank
						echo '<li role="presentation" class="dropdown" style="float:right;">';
							echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">';
								echo $_SESSION['username'] .' <span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu" role="menu">';
								echo '<li id="directory"><a href="./contribute/dashboard.php" id="contribute">Contributor Panel</a></li>';
								echo '<li id="directory"><a href="./admin/admindash.php" id="admin">Admin Panel</a></li>';
								echo '<li id="logout"><a href="./includes/logout.php" id="logout" style="color:black;">Log Out</a></li>';
							echo '</ul>';
						echo '</li>';
					} elseif ($_SESSION['rank'] == 2){
						// Contributor Rank
						echo '<li role="presentation" class="dropdown" style="float:right;">';
							echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">';
								echo $_SESSION['username'] .' <span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu" role="menu">';
								echo '<li id="directory"><a href="./contribute/dashboard.php" id="contribute">Contributor Panel</a></li>';
								echo '<li id="logout"><a href="./includes/logout.php" id="logout" style="color:black;">Log Out</a></li>';
							echo '</ul>';
						echo '</li>';						
					}					
				}
			?>
		</ul>
	</div>
</div>
<!-- End of header -->