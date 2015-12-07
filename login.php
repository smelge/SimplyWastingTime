<?php 	
	require_once ('./includes/essentials.php'); //$dbnews
?>
<!DOCTYPE html>
<html lang="en">
	<head>	
		<?php 
			include_once ('./includes/meta.php');
		
			$newsfilter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_SPECIAL_CHARS);
			$displayNo = filter_input(INPUT_GET, 'n', FILTER_SANITIZE_SPECIAL_CHARS);
			
			if ($displayNo == ''){
				$start_display = 0;			
			} else {
				$start_display = $displayNo;
			}
			$older = $start_display + 6;
			$newer = $start_display - 6;
		?>
	</head>

	<body>	
		<div class="container-fluid padding" id="main-container">
			<?php include "./includes/header.php"; ?> <!---Calls all header sections-->	
			<div class="row pad">
				<div class="col-sm-6 col-sm-offset-3 standard" style="text-align:center;">
					<?php
						if (isset($_SESSION['username'])){
							echo '<h3 style="text-align:center;">Already Logged In</h3>';
							echo '<a href="./includes/logout.php" class="btn btn-danger">Log Out?</a></br></br>';
						} else {
							echo '<h3 style="text-align:center;">Login</h3>';
							echo '<form action="./includes/login_script.php" method="POST">';
								echo '<div class="form-group">';
									echo '<label for="username">Username</label>';
									echo '<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>';
								echo '</div>';
								echo '<div class="form-group">';
									echo '<label for="password">Password</label>';
									echo '<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>';
								echo '</div>';
								echo '<div class="form-group btn-group">';
									echo '<input class="btn btn-success" type="submit" class="form-control" value="Login"/>';
									echo '<a class="btn btn-warning" class="form-control" id="get_password" href="./get_password.php"/>Create a Password</a>';
								echo '</div>';
							echo '</form>';
						}
					?>					
				</div>
			</div>
		</div>
		<div class="container-fluid" style="margin:0 2%;">
			<?php include "./includes/footer.php";?>
		</div>
	</body>
</html>