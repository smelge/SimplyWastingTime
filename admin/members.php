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
			$id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
			$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_SPECIAL_CHARS);
		
			switch ($filter){
				case 'idp': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY id_member ASC"); break;
				case 'idm': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY id_member DESC"); break;
				case 'catp': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY real_name ASC"); break;
				case 'catm': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY real_name DESC"); break;
				case 'authp': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY posts ASC"); break;
				case 'authm': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY posts DESC"); break;				
				case 'releasep': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY warnings ASC"); break;
				case 'releasem': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY warnings DESC"); break;
				case 'udp': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY id_group ASC"); break;
				case 'udm': $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY id_group DESC"); break;
				default: $members_set = mysqli_query($dbmembers,"SELECT * FROM upci_members ORDER BY id_member DESC"); break;
			}	
		?>
		
	</head>

	<body>
		
				<div class="container-fluid" id="main-container">
					<?php include "./includes/adminheader.php"; //Calls all header sections
						if ($id == ''){ //Not editing article, display standard page
					?>
							<div class="row" style="margin-bottom:5px;">
								<div class="col-sm-12 standard">
									<table class="table table-bordered table-hover" style="text-align:center; font-size:12px;">
										<tr>
											<?php	//Filter headings for table
												if ($filter == 'idp'){ // ID Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=idm">ID <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'idm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">ID <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=idp">ID</a></th>';
												}
												if ($filter == 'catp'){ // User Name Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=catm">User <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'catm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">User <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=catp">User</a></th>';
												}
												if ($filter == 'udp'){ // Permissions Filter (id_group 1 = admin; 0 = member; mod = 2
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=udm">Permissions <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'udm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Permissions <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=udp">Permissions</a></th>';
												}
												if ($filter == 'authp'){ // Posts Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=authm">Posts <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'authm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Posts <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=authp">Posts</a></th>';
												}
												
												echo '<th style="text-align:center;">Email</th>'; //No filter needed
												echo '<th style="text-align:center;">Karma</th>'; //No filter needed
												
												if ($filter == 'releasep'){ // Warnings Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=releasem">Warnings <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'releasem'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Warnings <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=releasep">Warnings</a></th>';
												}
												echo '<th style="text-align:center;">Edit</th>'; //No filter needed
											?>
										</tr>
										<?php
											while ($members = mysqli_fetch_array($members_set)){
												$banned = 0;
												$ban_check_set = mysqli_query($dbmembers,"SELECT * FROM upci_ban_groups");
												while ($ban_check = mysqli_fetch_array($ban_check_set)){
													if ($ban_check['name'] == $members['member_name']){
														$banned = 1;
													}
												}
												
												if ($banned == 1){
													echo '<tr class="danger">';
												} else {
													echo '<tr>';
												}
													echo '<td>'. $members['id_member'] .'</td>';
													echo '<td>'. $members['real_name'] .'</td>';
												if ($banned == 1){	
													echo '<td>BANNED</td>';
												} else {
													switch ($members['id_group']){
														case 0:
															echo '<td>Member</td>';
															break;
														case 1:
															echo '<td>Admin</td>';
															break;
														case 2:
															echo '<td>Mod</td>';
															break;
														case 9:
															echo '<td>Contributor</td>';
															break;
														default:
															echo '<td>Unassigned</td>';
															break;
													}
												}
													echo '<td>'. $members['posts'] .'</td>';
													echo '<td>'. $members['email_address'] .'</td>';
													
													$karma = $members['karma_good'] - $members['karma_bad'];
													if ($karma < 0){
														echo "<td class='danger'>".$karma."</td>";
													} elseif ($karma == 0){
														echo "<td class='default'>".$karma."</td>";
													} else {
														echo "<td class='success'>".$karma."</td>";
													}
													// 0-5% = green: no result
													// 10-55% = orange: mod watch list
													// 60-100% = red: unable to post
													
													if ($members['warning'] <= 5){
														echo '<td class="success">'. $members['warning'] .'%</td>';
													} elseif ($members['warning'] > 5 && $members['warning'] < 60){
														echo '<td class="warning">'. $members['warning'] .'%</td>';
													} elseif ($members['warning'] >= 60){
														echo '<td class="danger">'. $members['warning'] .'%</td>';
													}
													echo "<td><a class='btn btn-default' href='?id=".$members['id_member'] ."'>Edit</a></td>";
												echo '</tr>';
											}
										?>
									</table>
								</div>
							</div>
					<?php
						} else {
							//THIS IS FOR VIEWING USER STATS AND EDIT THEIR PERMISSIONS
							echo "Modify permissions<br>";
							echo "Add posts<br>";
							echo "Alter Karma<br>";
							echo "Give Warning<br>";
							echo "Ban this fucker<br>";
						}
					?>
					
				</div>
				<div class="container-fluid" style="padding:0 5%;">
					<center><?php include "../includes/footer.php";?></center> <!--- Calls footer stuff-->
				</div>
	</body>
</html>