<?php 
	require_once ('./includes/essentials.php'); //$dbnews
	include_once('./includes/member_database.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>	
		<?php 
			if ($activate['verified'] == 1){
				header('Location: ./login.php');
			} else {
				if ($activate['verification'] == $activation){								
					// Update account to verified
					$password_exchange = $activate['temp_password'];
					$sqlpath = "UPDATE `swt_userbase` SET `verified` = '1', `password` = '$password_exchange', `temp_password` = '' WHERE `username` = '$user'";
					
					if (!mysqli_query($dbmembers,$sqlpath)) {
						header('Location: ./index.php?error=shit');// Gone Wrong
					} else {
						header('Location: ./login.php');
					}
				}
			}
					
			$newsfilter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_SPECIAL_CHARS);
			$displayNo = filter_input(INPUT_GET, 'n', FILTER_SANITIZE_SPECIAL_CHARS);
			
			if ($displayNo == ''){
				$start_display = 0;			
			} else {
				$start_display = $displayNo;
			}
			$older = $start_display + 6;
			$newer = $start_display - 6;
			
			$user = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
			$activation = filter_input(INPUT_GET, 'activation', FILTER_SANITIZE_SPECIAL_CHARS);
			
			$activate_setup = mysqli_query($dbmembers,"SELECT * FROM `swt_userbase` WHERE `username` = '$user'");
			$activate = mysqli_fetch_array($activate_setup);
		?>
	</head>

	<body>	
		<div class="container-fluid padding" id="main-container">
			<?php include "./includes/header.php"; ?> <!---Calls all header sections-->			
			<div class="row pad">
				<div class="col-sm-6 col-sm-offset-3 standard">
					Sorry, the Activation codes do not match.
				</div>
			</div>
		</div>
		<div class="container-fluid" style="margin:0 2%;">
			<?php include "./includes/footer.php";?>
		</div>
	</body>
</html>