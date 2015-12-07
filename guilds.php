<?php 
	require_once ('./includes/essentials.php');
	require_once ('./includes/news_database.php'); //$dbnews
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Simply Wasting Time</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Simply Wasting Time - Gaming and Stupid">
		<meta name="keywords" content="simply, wasting, time, gaming, site, minecraft, youtube, online, community, livestream, twitch">
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
			$game = filter_input(INPUT_GET, 'game', FILTER_SANITIZE_SPECIAL_CHARS);
			$guild_set = mysqli_query($dbnews,"SELECT * FROM guilds WHERE game = 'Guild Wars 2'");
			$guild = mysqli_fetch_array($guild_set);
			$announce_set = mysqli_query($dbnews,"SELECT * FROM announcements WHERE game = 'Guild Wars 2' ORDER BY date_to ASC");			
		?>
		
	</head>

<body>
	<div class="container-fluid padding" id="main-container">
		<?php include "./includes/header.php"; ?> <!---Calls all header sections-->
		<div class="row pad" style="margin-bottom:5px;">
			<div class="col-xs-12 standard padding">
				<img src="./assets/banners/<?php echo $guild['banner'];?>" alt="<?php echo $guild['game'];?> Banner" class="img-responsive" style="margin:0 auto;"/>
			</div>
		</div>
		<div class="row pad">
			<div class="col-sm-6 padding" style="height:400px;">
				<div class="col-xs-12 standard watch-head" style="margin:0 0 2px 0;">
					Announcements and Events
				</div>
				<?php/*
					while ($announce = mysqli_fetch_array($announce_set)){
						echo '<div class="col-xs-12 standard" style="margin:2px 0; padding:10px;">';
							echo 'Posted - '.$announce['date_from'].' by ID: '.$announce['posted_by'].' Expires: '.$announce['date_to'].'<br>';
							echo $announce['message'];
						echo '</div>';
					}*/
				?>
			</div>
			<div class="col-sm-6 padding" style="height:400px;">
				<div class="col-xs-12 standard" style="padding:10px;">
					<?php echo $guild['description'];?>
				</div>
				<div class="col-xs-12 standard padding">
					<table border="1" style="width:100%;">
						<tr>
							<th>Username</th>
							<th>Ingame Name</th>
							<th>Message</th>
						</tr>
						<tr>
							<th colspan="3">Admins</th>
						</tr>
						<tr>
							<td>MrKolestryl</td>
							<td>Mighty_Rockfucker</td>
							<td><a href="./forum/index.php?action=pm;sa=send;u=5">PM</a></td>
						</tr>
						<tr>
							<th colspan="3">Moderators</th>
						</tr>
						<tr>
							<td>JammyBugger</td>
							<td>Hello_Gritty</td>
							<td><a href="./forum/index.php?action=pm;sa=send;u=5">PM</a></td>
						</tr>
						<tr>
							<th colspan="3">Whitelist</th>
						</tr>
						<tr>
							<td>Jim E Saville</td>
							<td>boyloveRuelz</td>
							<td><a href="./forum/index.php?action=pm;sa=send;u=5">PM</a></td>
						</tr>
						<tr>
							<td>Bruce Wayne</td>
							<td>MYPARENTSAREDEAD</td>
							<td><a href="./forum/index.php?action=pm;sa=send;u=5">PM</a></td>
						</tr>
					</table>					
				</div>
			</div>
		</div>
		<!--<ul>			
			<li>Server info
				<ul>
					<li>How to connect</li>
					<li>How to apply for whitelist</li>
					<li>Game Server</li>
				</ul>
			</li>
			<li>List of admin/mods
				<ul>
					<li>Ingame name</li>
					<li>PM button</li>
				</ul>
			</li>
			<li>List of whitelisted members
				<ul>
					<li>Ingame name</li>
					<li>PM button</li>
				</ul>
			</li>
			<li>Latest Forum threads for game</li>
			<li>Announcements</li>
			<li>Scheduled Events
				<ul>
					<li>Modal - click to expand info</li>
				</ul>
			</li>
		</ul>-->
	</div>
	<div class="container-fluid" style="padding:0 5%;">
		<center><?php include "./includes/footer.php";?></center> <!--- Calls footer stuff-->
	</div>
</body>
</html>