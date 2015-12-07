<?php 
	require_once ('./includes/adminessentials.php');
	require_once ('./includes/admin_db.php'); //$dbnews
	require_once ('../includes/member_database.php');
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
				case 'idp': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 WHERE category <> 6 ORDER BY id ASC"); break;
				case 'idm': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY id DESC"); break;
				case 'catp': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY category ASC"); break;
				case 'catm': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY category DESC"); break;
				case 'authp': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY author ASC"); break;
				case 'authm': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY author DESC"); break;
				case 'addp': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY submitted ASC"); break;
				case 'addm': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY submitted DESC"); break;
				case 'releasep': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY release_date ASC"); break;
				case 'releasem': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY release_date DESC"); break;
				case 'ratingp': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY rating ASC"); break;
				case 'ratingm': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY rating DESC"); break;
				case 'udp': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY updated ASC"); break;
				case 'udm': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY updated DESC"); break;
				case 'pvp': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY pageviews ASC"); break;
				case 'pvm': $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY pageviews DESC"); break;
				default: $article_set = mysqli_query($dbnews,"SELECT * FROM main WHERE category <> 6 ORDER BY id DESC"); break;
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
												if ($filter == 'catp'){ // Category Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=catm">Category <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'catm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Category <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=catp">Category</a></th>';
												}
												if ($filter == 'authp'){ // Author Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=authm">Author <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'authm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Author <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=authp">Author</a></th>';
												}
												
												echo '<th style="text-align:center;">Title</th>'; //No filter needed
												
												if ($filter == 'addp'){ // Submitted Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=addm">Submitted <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'addm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Submitted <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=addp">Submitted</a></th>';
												}
												if ($filter == 'releasep'){ // Released Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=releasem">Released <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'releasem'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Released <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=releasep">Released</a></th>';
												}
												if ($filter == 'udp'){ // Updated Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=udm">Updated <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'udm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Updated <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=udp">Updated</a></th>';
												}
												if ($filter == 'ratingp'){ // Rating Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=ratingm">Rating <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'ratingm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Rating <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=ratingp">Rating</a></th>';
												}
												if ($filter == 'pvp'){ // ID Filter
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=pvm">Views <i class="fa fa-caret-down"></i></a></th>';
												} elseif ($filter == 'pvm'){
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=">Views <i class="fa fa-caret-up"></i></a></th>';
												} else {
													echo '<th style="text-align:center;"><a style="color:black;" href="?filter=pvp">Views</a></th>';
												}
												echo '<th style="text-align:center;">Edit</th>';
											?>
										</tr>
										<?php
											while ($article = mysqli_fetch_array($article_set)){
												$author_id = $article['author_id'];
												$author_set = mysqli_query($dbmembers,"SELECT `member_name` FROM `upci_members` WHERE `id_member` = $author_id");
												$author = mysqli_fetch_assoc($author_set);
												$author = $author['member_name'];												
												
												echo '<tr>';
													echo '<td>'. $article['id'] .'</td>';
													echo '<td>'. $article['category'] .'</td>';
													echo '<td>'. $author .'</td>';
													echo '<td>'. $article['title'] .'</td>';
													echo '<td>'. $article['added'] .'</td>';
													if ($article['release'] <= $date){
														echo "<td class='success'>". $article['release'] ."</td>";
													} else {
														echo "<td class='danger'>". $article['release'] ."</td>";
													}
													echo '<td>'. $article['updated'] .'</td>';
													echo '<td>Outdated</td>';
													echo '<td>'. $article['views'] .'</td>';
													echo "<td><a class='btn btn-default' href='?id=". $article['id'] ."'>Edit</a></td>";
												echo '</tr>';
											}
										?>
									</table>
								</div>
							</div>
					<?php
						} else { //Display edit section 
							$edit_set = mysqli_query($dbnews,"SELECT * FROM main WHERE id = $id");
							$edit = mysqli_fetch_array($edit_set);
							?>
							<div class="row" style="margin-bottom:5px;">
								<div class="col-sm-12 standard">
									<?php
										switch($edit['category']){
										case 1: //News Display ?>
											<div class="row">
												<div class="col-sm-12 standard">
													<h2><?php echo $edit['title'];?></h2>
												</div>
												<div class="col-sm-8 standard" style="padding:10px;">	
													<?php 
														// add on replacer to change ./ to ../
														$story = str_replace("./","../",$edit['story']);
														echo htmlspecialchars_decode($story);
													?>
													
													<br><br>													
												</div>
												<div class="col-sm-4 standard" style="padding:5px;">
													Category: 
													<?php 
														switch ($edit['category']){
															case 1:
																echo "News";
																break;
															case 2:
																echo "Review";
																break;
															case 3:
																echo "Blog";
																break;
															case 4:
																echo "Competition";
																break;
															case 5:
																echo "Challenge";
																break;
														}
													?>
													<br>													
													<?php
														$author_id = $edit['author_id'];
														$author_set = mysqli_query($dbmembers,"SELECT `member_name` FROM `upci_members` WHERE `id_member` = $author_id");
														$author = mysqli_fetch_assoc($author_set);
														$author = $author['member_name'];
													?>
													Author: <?php echo $author;?><br>
													Date Submitted: <?php echo $edit['added'];?><br>
													Scheduled Release: <?php echo $edit['release'];?><br>
													Rating: <?php echo $edit['rating'];?><br>
													Views: <?php echo $edit['views'];?><br>
													<?php include ('./includes/article_edit.php');?>
												</div>
											</div>
										<?php
											break;
										case 2: //Review Display ?>
											<div class="row">
												<div class="col-sm-12 standard">
													<h2><?php echo $edit['title'];?></h2>
													<h6><small>Written By <?php echo $edit['author_id'];?></small></h6>
												</div>
												<div class="col-sm-8 standard" style="padding:10px;">																			
													<br>
													<b><?php echo $edit['intro'];?></b>
													<br><br>
													<img src="./assets/images/articletest.gif" alt="test image" style="border:2px solid black;margin:10px;float:right;">	
													<?php echo nl2br($edit['story']);?>
													<hr>
													<b><i><?php echo $edit['review_summary'];?></i></b>
													<br><br>
													Score: 
													<?php
														for ($s_pos=1;$s_pos<=$edit['rating'];$s_pos++){
															echo '<i class="fa fa-star fa-lg"></i>';
														}
														for ($m_pos=$edit['rating']+1;$m_pos<=10;$m_pos++){											
															echo '<i class="fa fa-star-o fa-lg"></i>';
														}
													?>
													<br><br>
												</div>
												<div class="col-sm-4 standard" style="padding:5px;">
													Category: 
													<?php 
														switch ($edit['category']){
															case 1:
															echo "News";
															break;
															case 2:
															echo "Review";
															break;
															case 3:
															echo "Blog";
															break;
															case 4:
															echo "Competition";
															break;
															case 5:
															echo "Challenge";
															break;
														}
													?>
													<br>													
													<?php
														$author_id = $edit['author_id'];
														$author_set = mysqli_query($dbmembers,"SELECT `member_name` FROM `upci_members` WHERE `id_member` = $author_id");
														$author = mysqli_fetch_assoc($author_set);
														$author = $author['member_name'];
													?>
													Author: <?php echo $author;?><br>
													Date Submitted: <?php echo $edit['added'];?><br>
													Scheduled Release: <?php echo $edit['release'];?><br>
													Rating: <?php echo $edit['rating'];?><br>
													Views: <?php echo $edit['views'];?><br>
													<?php include ('./includes/article_edit.php');?>
												</div>
											</div>
										<?php
											break;
											case 3: //Blog Display
												echo '<div class="row">';
													echo '<div class="col-sm-12 standard">';
														echo '<h2>'. $edit['title'] .'</h2>';
													echo '</div>';
													echo '<div class="col-sm-8 standard" style="padding:10px;">';
														echo '<b>'. $edit['intro'] .'</b>';
														echo '<br><br>';
														echo nl2br($edit['story']);
														echo '<br><br>';
													echo '</div>';
													echo '<div class="col-sm-4 standard" style="padding:5px;">';
														echo 'Category:'; 
														switch ($edit['category']){
															case 1:
															echo "News";
															break;
															case 2:
															echo "Review";
															break;
															case 3:
															echo "Blog";
															break;
															case 4:
															echo "Competition";
															break;
															case 5:
															echo "Challenge";
															break;
														}
														echo '<br>';													
												
														$author_id = $edit['author_id'];
														$author_set = mysqli_query($dbmembers,"SELECT `member_name` FROM `upci_members` WHERE `id_member` = $author_id");
														$author = mysqli_fetch_assoc($author_set);
														$author = $author['member_name'];
												
														echo 'Author: '.$author.'<br>';
														echo 'Date Submitted: '.$edit['added'].'<br>';
														echo 'Scheduled Release: '.$edit['release'].'<br>';
														echo 'Rating: '.$edit['rating'].'<br>';
														echo 'Views: '.$edit['views'].'<br>';
														include ('./includes/article_edit.php');
													echo '</div>';
												echo '</div>';
											break;
											case 4: //Competition Display
											break;
											case 5: //Challenge display
											break;
										}
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 standard" style="padding:10px;">
									<span style="font-size:20px;">Delete?</span>
									<a class="btn btn-danger" style="margin-left:20px;" href="./includes/article_edit_process.php?type=delete&id=<?php echo $id;?>">KILL IT WITH FIRE</a>
							<?php
						}
					?>
					
				</div>
				<div class="container-fluid" style="padding:0 5%;">
					<center><?php include "../includes/footer.php";?></center> <!--- Calls footer stuff-->
				</div>
	</body>
</html>