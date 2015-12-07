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
			<li id="home"><a href="./dashboard.php" style="color:black;" id="home">Contribute Dashboard</a></li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">
				SUBMIT <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li id="contentnews"><a href="./submit.php?type=news" id="news">News</a></li>
					<li class="disabled" id="contentreview"><a href="./submit.php?type=review" id="reviews">Reviews</a></li>
					<li class="disabled" id="contentblog"><a href="./submit.php?type=blog" id="blog">Blogatronic</a></li>
					<li class="disabled" id="contentvideo"><a href="./submit.php?type=video" id="video">Video</a></li>
				</ul>
			</li>			
			<li id="stream"><a href="./settings.php" style="color:black;">Stream Settings & Profile</a></li>
			<li id="videos"><a href="#" style="color:black;">My SUBMITs</a></li>
			<?php
				if ($context['user']['is_guest']){
					echo '<li id="home" style="float:right;"><a href="./forum/index.php?action=register" id="register" style="color:black;">Register</a></li>';
					echo '<li id="home" style="float:right;"><a href="#" id="login" style="color:black;" data-toggle="modal" data-target="#loginModal">Login</a></li>';
				} else {
					echo '<li id="logout" style="float:right;"><a href="#" style="color:black;height:39px;" data-toggle="modal" data-target="#logoutModal">Log Out</a></li>';
				}	
			?>
			<!-- Modal -->
			<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="loginModalLabel">Login!</h4>
						</div>
						<div class="modal-body">
							<?php ssi_login();?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="logoutModalLabel">Where do you think you're going?</h4>
						</div>
						<div class="modal-body">
							<a class="btn btn-danger" href="<?php echo $scripturl;?>?action=logout;<?php echo $context['session_var'];?>=<?php echo $context['session_id'];?>">I'm Leaving!</a>
							<button type="button" class="btn btn-success" data-dismiss="modal">Actually, I might stay a bit longer...</button>
						</div>
					</div>
				</div>
			</div>					
			<?php	
				if ($context['user']['is_guest']){
					//Do not display if not logged in
				} else {
					if ($context['user']['is_admin']){	
						echo '<li role="presentation" class="dropdown" style="float:right;">';
							echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">';
								echo $context['user']['name'] .' <span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu" role="menu">';
								echo '<li id="directory"><a href="../forum/index.php?action=pm" id="message">Messages <span class="badge">'. $context['user']['messages'] .'</span></a></li>';
								echo '<li id="directory"><a href="../forum/index.php?action=profile" id="profile">Profile</a></li>';
								echo '<li id="directory"><a href="../admin/admindash.php" id="admin">Admin Panel</a></li>';
								echo '<li id="directory"><a href="../forum/index.php?action=admin" id="forumadmin">Forum Admin</a></li>';
								//echo '<li id="directory""><a href="#" id="adminalert">Admin Alerts</a></li>';
							echo '</ul>';
						echo '</li>';
					} elseif ($user_group == 9){
						echo '<li role="presentation" class="dropdown" style="float:right;">';
							echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">';
								echo $context['user']['name'] .' <span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu" role="menu">';
								echo '<li id="directory"><a href="../forum/index.php?action=pm" id="message">Messages <span class="badge">'. $context['user']['messages'] .'</span></a></li>';
								echo '<li id="directory"><a href="../forum/index.php?action=profile" id="profile">Profile</a></li>';
							echo '</ul>';
						echo '</li>';
					} else {
						echo '<li role="presentation" class="dropdown" style="float:right;">';
							echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black;">';
								echo $context['user']['name'] .' <span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu" role="menu">';
								echo '<li id="directory"><a href="../forum/index.php?action=pm" id="message">Messages <span class="badge">'. $context['user']['messages'] .'</span></a></li>';
								echo '<li id="directory"><a href="../forum/index.php?action=profile" id="profile">Profile</a></li>';
							echo '</ul>';
						echo '</li>';
					}
				}
			?>	
		</ul>				
	</div>
</div>
<!-- End of header -->