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
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->	
		<?php
			include_once('../includes/member_database.php');
		
			$user_group = $user_info['groups'];
			$user_group = $user_group[0];
			$cont_id = $context['user']['id'];
			$stats_set = mysqli_query($dbnews,"SELECT * FROM `contributor` WHERE `user_id` = '$cont_id'");
			$stats = mysqli_fetch_array($stats_set);
			$user_stats_set = mysqli_query($dbmembers,"SELECT * FROM `upci_members` WHERE `id_member` = '$cont_id'");
			$user_stats = mysqli_fetch_array($user_stats_set);
		?>
	</head>

	<body>
		<?php
			if ($context['user']['is_admin'] || $user_group == '9'){
				?>			
				<div class="container-fluid" id="main-container">
					<?php include "./includes/contribute_header.php"; ?> <!---Calls all header sections-->
					<div class="row" style="margin-bottom:5px;">						
						<div class="col-sm-8 padding">
							<div class="col-sm-12 padding" style="border:2px solid black;">
								<?php
									echo '<img src="../assets/banners/'.$stats['banner'].'" alt="'.$stats['display_name'].'&#39;s Banner" class="img-responsive"/>';
								?>
							</div>
							<div class="col-sm-12 padding">
								<?php include_once('./includes/contributor_notices.php');?>
							</div>
						</div>
						<div class="col-sm-4 padding">
							<?php include_once('./includes/contributor_stats.php');?>
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