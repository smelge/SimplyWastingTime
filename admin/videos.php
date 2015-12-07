<?php 
	require_once ('./includes/adminessentials.php');
	require_once ('./includes/admin_db.php'); //$dbnews
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SWT - Admin Area</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Tavy Fraser">
					
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!--New css-->
		<link rel="stylesheet" type="text/css" href="../css/swt.css"/>
		<link rel="icon" href="../assets/swticon.png" type="image/x-icon">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="../js/bootstrap.min.js"></script>
		<?php include ('./adminfunctions/textformat.php');?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<?php
			$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_SPECIAL_CHARS);
			$startlimit = filter_input(INPUT_GET, 'display', FILTER_SANITIZE_SPECIAL_CHARS);
			
			if ($startlimit == ''){
				$startlimit = 0;			
			} else {
				$startlimit = $startlimit;
			}
			$older = $startlimit + 30;
			$newer = $startlimit - 30;
			
			switch ($filter){
				case 'idp': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY id ASC LIMIT $startlimit,30"); break;
				case 'idm': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY id DESC LIMIT $startlimit,30"); break;
				case 'gamep': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY game ASC LIMIT $startlimit,30"); break;
				case 'gamem': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY game DESC LIMIT $startlimit,30"); break;
				case 'catp': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY video_cat ASC LIMIT $startlimit,30"); break;
				case 'catm': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY video_cat DESC LIMIT $startlimit,30"); break;
				case 'addp': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY date_added ASC LIMIT $startlimit,30"); break;
				case 'addm': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY date_added DESC LIMIT $startlimit,30"); break;
				case 'releasep': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY date_release ASC LIMIT $startlimit,30"); break;
				case 'releasem': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY date_release DESC LIMIT $startlimit,30"); break;
				case 'ratingp': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY rating ASC LIMIT $startlimit,30"); break;
				case 'ratingm': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY rating DESC LIMIT $startlimit,30"); break;
				case 'pvp': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY viewcount ASC LIMIT $startlimit,30"); break;
				case 'pvm': $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY viewcount DESC LIMIT $startlimit,30"); break;
				default: $video_setup = mysqli_query($dbnews,"SELECT * FROM main WHERE type = 'video' ORDER BY id DESC LIMIT $startlimit,30"); break;
			}
		?>
		
	</head>

	<body>
		
			
				<div class="container-fluid" id="main-container">
					<?php include "./includes/adminheader.php"; ?> <!---Calls all header sections-->
					<div class="row" style="margin-bottom:5px;">
						<div class="col-sm-12 standard">
							<table class="table table-bordered table-hover" style="text-align:center; font-size:12px;">
								<tr>
									<?php
										if ($filter == 'idp'){ // ID Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=idm">ID</a></th>';
										} elseif ($filter == 'idm'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">ID</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=idp">ID</a></th>';
										}
										
										if ($filter == 'gamep'){ // Game Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=gamem">Game</a></th>';
										} elseif ($filter == 'gamem'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Game</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=gamep">Game</a></th>';
										}
										
										// Do not need filters
										echo '<th style="text-align:center;">Title</th>';	
										echo '<th style="text-align:center;">Season</th>';
										echo '<th style="text-align:center;">Ep.</th>';										
										
										if ($filter == 'catp'){ // Category Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=catm">Category</a></th>';
										} elseif ($filter == 'catm'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Category</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=catp">Category</a></th>';
										}
										
										if ($filter == 'addp'){ // Date Added Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=addm">Added</a></th>';
										} elseif ($filter == 'addm'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Added</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=addp">Added</a></th>';
										}
										
										if ($filter == 'releasep'){ // Date Released Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=releasem">Released</a></th>';
										} elseif ($filter == 'releasem'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Released</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=releasep">Released</a></th>';
										}
										
										if ($filter == 'ratingp'){ // Rating Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=ratingm">Rating</a></th>';
										} elseif ($filter == 'ratingm'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Rating</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=releasep">Rating</a></th>';
										}
										
										if ($filter == 'pvp'){ // Page Views Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=pvm">Views</a></th>';
										} elseif ($filter == 'pvm'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Views</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=pvp">Views</a></th>';
										}
										
										if ($filter == 'ytp'){ // Youtube Views Filter
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=ytm">YT Views</a></th>';
										} elseif ($filter == 'ytm'){
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">YT Views</a></th>';
										} else {
											echo '<th style="text-align:center;"><a style="color:black;" href="?filter=ytp">YT Views</a></th>';
										}
										echo '<th style="text-align:center;">Edit</th>';	
									?>
								</tr>
								<?php									
									while ($video = mysqli_fetch_array($video_setup)){
										echo "<tr>";
											echo "<td>". $video['id'] ."</td>";
											echo "<td>". $video['game'] ."</td>";
											echo "<td>". $video['title'] ."</td>";
											echo "<td>". $video['series'] ."</td>";
											echo "<td>". $video['episode'] ."</td>";
											
											switch ($video['vid_type']){
												case 'check':
													$category = 'Check Out';
													break;
												case 'story':
													$category = 'Story';
													break;
												case 'coop':
													$category = 'Co-Op';
													break;
												case 'vs':
													$category = 'Versus';
													break;
												case 'lp':
													$category = "Let's Play";
													break;
												case 'mix':
													$category = 'Mix It Up';
													break;
												case 'high':
													$category = 'Highlights';
													break;
												case 'bonus':
													$category = 'Bonus';
													break;
											}
											echo "<td>". $category ."</td>";
											echo "<td>". $video['added'] ."</td>";
											if ($video['release'] <= $date){
												echo "<td class='success'>". $video['release'] ."</td>";
											} else {
												echo "<td class='danger'>". $video['release'] ."</td>";
											}
											echo "<td>Depreciated</td>";
											echo "<td>". $video['views'] ."</td>";
											
											//get youtube video info
											$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$video['youtube']."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU&part=snippet,statistics");
											$JSON_Data = json_decode($JSON,true);
											$views = $JSON_Data['items']['0']['statistics']['viewCount'];
											if ($views == ''){$views=0;}
											
											echo "<td>". $views ."</td>";
											echo "<td><a class='btn btn-default' href='?id=". $video['id'] ."'>Edit</a></td>";
										echo "</tr>";
									}
								?>
							</table>
						</div>
					</div>
				</div>
				<div class="container-fluid" style="padding:0 5%;">
					<center><?php include "../includes/footer.php";?></center> <!--- Calls footer stuff-->
				</div>
	</body>
</html>