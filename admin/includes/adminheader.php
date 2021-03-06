<?php
	//Get and format Date/Time
	$date = date("Y-m-d H:i:s");
	include ('../includes/vid_check.php');
?>

<div class="row">
	<!-- Header Section -->
	<div class="col-sm-8 padding" id="logobar">
		<a href="../index.php"><img class="img-responsive" src="../assets/logo.png" alt="Simply Wasting Time Logo"></a>
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
<div class="row" style="margin-bottom:5px;"> <!-- Navbar -->
	<div class="col-sm-12 padding" id="navigation-bar">
		<ul class="nav nav-pills" role="tablist">
			<li id="main"><a href="../index.php" style="color:black;" id="main">Main Site</a></li>
			<li id="home"><a href="./admindash.php" style="color:black;" id="home">Admin Dashboard</a></li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">
				Add Content <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li id="contentnews"><a href="./content.php?type=news" id="news">News</a></li>
					<li id="contentreview"><a href="./content.php?type=review" id="reviews">Reviews</a></li>
					<li id="contentblog"><a href="./content.php?type=blog" id="blog">Blogatronic</a></li>
					<li id="contentcomps"><a class="text-danger bg-danger" href="./content.php?type=comp" id="comp">Competitions</a></li>
					<li id="contentchallenge"><a class="text-danger bg-danger" href="./content.php?type=challenge" id="challenge">Challenges</a></li>
					<li id="contentvideo"><a href="./content.php?type=video" id="video">Video</a></li>
				</ul>
			</li>
			<li id="articles"><a href="./articles.php" style="color:black;">Articles</a></li>
			<li id="members"><a href="./members.php" style="color:black;">Members</a></li>
			<li id="videos"><a href="./videos.php" style="color:black;">Videos</a></li>
			
			<li role="presentation" class="dropdown" style="float:right;">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">
					<?php echo $_SESSION['username'];?><span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li id="directory"><a href="../contribute/dashboard.php" id="contribute">Contributor Panel</a></li>
					<li id="directory"><a href="./admindash.php" id="admin">Admin Panel</a></li>
					<li id="logout"><a href="../includes/logout.php" id="logout" style="color:black;">Log Out</a></li>
				</ul>
			</li>
		</ul>				
	</div>
</div>
<!-- End of header -->