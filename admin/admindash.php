<?php 
	require_once ('./includes/adminessentials.php');
	require_once ('./includes/admin_db.php'); //$dbnews
	require_once ('../includes/member_database.php'); //$dbmembers
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
		<link rel="stylesheet" type="text/css" href="./css/admin.css"/>
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
			$process = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_SPECIAL_CHARS);
			
			if ($process == true){ //if Header states email was sent, inform user				
				echo "<script>";
					echo "$(document).ready(function(){";
						echo "$('#emailFail').modal('show');";
					echo "})";
				echo "</script>";
			}
		?>
	</head>

	<body>
		<div class="container-fluid" id="main-container">
					<!-- Fail modal -->
					<div class="modal fade" style="padding-top:25%;" id="emailFail" tabindex="-1" role="dialog" aria-labelledby="emailFailLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">							
								<div class="modal-body">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<center>
										<b>CRITICAL EXISTENCE FAILURE</b><hr style="border:1px solid black;margin:5px 0;width:90%;">
										Oh shit. Whatever you just did went wrong.<br>
										Please reboot the Universe and try again next time.
									</center>
								</div>
							</div>
						</div>
					</div>
					
					<?php include "./includes/adminheader.php"; ?> <!---Calls all header sections-->
					<div class="row" style="margin-bottom:5px;">						
						<div class="col-sm-8" style="padding:0;">
							<?php 
								include('./includes/notices.php');
							?>
						</div>
						<div class="col-sm-4" style="padding-right:0;">
							<?php include('./includes/statistics.php');?>
						</div>
					</div>
				</div>
				<div class="container-fluid" style="padding:0 5%;">
					<center><?php include "../includes/footer.php";?></center> <!--- Calls footer stuff-->
				</div>
		
	</body>
</html>