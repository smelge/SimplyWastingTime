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
				<div class="col-sm-6 col-sm-offset-3 standard">
					<h3 style="text-align:center;">Set a Password</h3>
					<form action="./includes/send_password.php" method="POST">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-group btn-group">
							<input class="btn btn-success" type="submit" class="form-control" value="Set Password"/>
						</div>
					</form>
					<div class="alert alert-info" role="alert">It may take a few minutes to receive your confirmation email.</div>
				</div>
			</div>
		</div>
		<div class="container-fluid" style="margin:0 2%;">
			<?php include "./includes/footer.php";?>
		</div>
	</body>
</html>