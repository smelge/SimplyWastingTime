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
			$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
			switch ($type){
				case 'news':
					$category = 1;
					break;
				case 'review':
					$category = 2;
					break;
				case 'blog':
					$category = 3;
					break;
				case 'comp':
					$category = 4;
					break;
				case 'challenge':
					$category = 5;
					break;
				case 'video':
					$category = 6;
					break;
			}
		// SET DATE/TIME ELEMENTS	
			$year = date("Y");
			$curr_month = date("m");
			$day = date("d");
			$hour = date("H");
			
			switch ($curr_month) {
				case 01:
				$length = 31;
				break;
				case 02:
				$length = 28;
				break;
				case 03:
				$length = 31;
				break;
				case 04:
				$length = 30;
				break;
				case 05:
				$length = 31;
				break;
				case 06:
				$length = 30;
				break;
				case 07:
				$length = 31;
				break;
				case 08:
				$length = 31;
				break;
				case 09:
				$length = 30;
				break;
				case 10:
				$length = 31;
				break;
				case 11:
				$length = 30;
				break;
				case 12:
				$length = 31;
				break;
			}
		?>		
	</head>

	<body>
		
			<div class="container-fluid" id="main-container">
				<?php include "./includes/adminheader.php"; ?> <!---Calls all header sections-->				
				<div class="row" style="margin-bottom:5px;">
					<div class="col-sm-12 standard">
						<?php
							switch($category){
								case 1: // News
								?>
									<div class="row">
										<div class="col-sm-6 standard">
											<form role="form" name="content" enctype="multipart/form-data" action="./includes/addcontent.php" method="post">
												<div class="form-group">
													<hr>
													User ID: <?php echo $context['user']['id'];?>  |  Author: <?php echo $context['user']['name'];?>  |  Category: News
													<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
													<input type="hidden" name="user_name" value="<?php echo $context['user']['name'];?>">
													<input type="hidden" name="category" value="<?php echo $category;?>">
												</div>
												<hr>
												<div class="form-group">
													<p class="help-block">Headline (50 characters max)</p>
													<input type="text" class="form-control" maxlength="50" required name="headline">
													<p class="help-block">Intro/Summary (150 characters max)</p>
													<input type="text" class="form-control" maxlength="150" required name="summary">
													<hr>
													<p class="help-block">Main Story (Please use pagebreaks to split story into manageable sections if too long)</p>
													<script>var pageCount = 0;</script>
													<button type="button" class="btn btn-primary" onClick="boldText();"><b>Bold</b></button> <!-- Add <b></b> tags -->
													<button type="button" class="btn btn-primary" onClick="italicText();"><i>Italic</i></button> <!-- Add <i></i> tags -->
													<button type="button" class="btn btn-primary" onClick="lineText();">Line</button>
													<button type="button" class="btn btn-primary" onClick="headingText();"><i>Heading</i></button> <!-- Add heading tags -->
													<button type="button" class="btn btn-primary" onClick="linkText();">Link</button> <!-- Add a href -->
													<button type="button" class="btn btn-primary" onClick="videoText();">Video</button> <!-- add youtube window -->
													<textarea class="form-control" rows="8" required name="story"></textarea>											
												</div>
												<div class="form-group">
													Schedule release time (Leave as it is for immediate release)<br>
												<select name="year">
													<option value="<?php echo $year;?>"><?php echo $year;?></option>
													<option value="<?php echo $year+1;?>"><?php echo $year+1;?></option>
												</select>
													<?php
														$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
														$select = "<select name=\"month\">\n";
														foreach ($month as $key => $val) {
															$select .= "\t<option val=\"".$key."\"";
															if ($key == $curr_month) {
																$select .= " selected=\"selected\">".$val."</option>\n";
															} else {
																$select .= ">".$val."</option>\n";
															}
														}
														$select .= "</select>";
														echo $select;
													?>
													<select name="day">
														<?php 
															$dayselect = 01;
															
															while ($dayselect < $day) {
																echo "<option value='";
																echo $dayselect;
																echo "'>";
																echo $dayselect;
																echo "</option>";
																$dayselect++;
															}
															echo "<option value='";
															echo $dayselect;
															echo "' selected>";
															echo $dayselect;
															echo "</option>";
															$dayselect++;
															
															while ($dayselect <= $length) {
																echo "<option value='";
																echo $dayselect;
																echo "'>";
																echo $dayselect;
																echo "</option>";
																$dayselect++;
															}
														?>
													</select>
													<select name="hour">
														<?php 
															$timeselect = 0;
															
															while ($timeselect < $hour) {
																echo "<option value='";
																echo $timeselect;
																echo "'>";
																echo $timeselect;
																echo "</option>";
																$timeselect++;
															}
															echo "<option value='";
															echo $timeselect;
															echo "' selected>";
															echo $timeselect;
															echo "</option>";
															$timeselect++;
															
															while ($timeselect <= 23) {
																echo "<option value='";
																echo $timeselect;
																echo "'>";
																echo $timeselect;
																echo "</option>";
																$timeselect++;
															}
														?>
													</select>:00
												</div>
												<hr>
												<button type="reset" class="btn btn-danger">Reset</button>
												<button type="submit" class="btn btn-success">Submit</button>										
											</form>
											<br>
										</div>
										<div class="col-sm-6 standard padding">
											<!-- Call image uploader plugin -->
											<?php include ('./includes/image_uploader.php');?>
											<!-- Call image gallery plugin -->
											<?php include ('./includes/image_gallery.php');?>
										</div>				
									</div>
								<?php
								break;
								
								case 2: //reviews
								?>
								<div class="row">
									<div class="col-sm-6 standard">
										<form role="form" enctype="multipart/form-data" action="./includes/addcontent.php" method="post">
											<div class="form-group">
												<hr>
												User ID: <?php echo $context['user']['id'];?>  |  Author: <?php echo $context['user']['name'];?>  |  Category: Review
												<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
												<input type="hidden" name="user_name" value="<?php echo $context['user']['name'];?>">
												<input type="hidden" name="category" value="<?php echo $category;?>">
											</div>
											<hr>
											<div class="form-group">
												<p class="help-block">Headline (50 characters max)</p>
												<input type="text" class="form-control" maxlength="50" required name="headline">
												<p class="help-block">Intro (150 characters max)</p>
												<input type="text" class="form-control" maxlength="150" required name="summary">
												<hr>
												<p class="help-block">Main Story (Please use pagebreaks to split story into manageable sections if too long)</p>
												<button class="btn btn-primary"><b>Bold</b></button>
												<button class="btn btn-primary"><i>Italic</i></button>
												<button class="btn btn-primary">Link</button>
												<button class="btn btn-primary">Image</button>
												<button class="btn btn-primary">Video</button>
												<button class="btn btn-primary">Page Break</button>
												<textarea class="form-control" rows="8" required name="story"></textarea>											
											</div>
											<div class="form-group">
												<hr>
												<p class="help-block">Summary</p>											
												<textarea class="form-control" rows="4" required name="reviewsummary"></textarea>
												<p class="help-block">Rating / 10</p>
												<select class="form-control" required name="rating">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
												</select>
											</div>
											<div class="form-group">
													Schedule release time (Leave as it is for immediate release)<br>
											<select name="year">
												<option value="<?php echo $year;?>"><?php echo $year;?></option>
												<option value="<?php echo $year+1;?>"><?php echo $year+1;?></option>
											</select>
												<?php
													$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
													$select = "<select name=\"month\">\n";
													foreach ($month as $key => $val) {
														$select .= "\t<option val=\"".$key."\"";
														if ($key == $curr_month) {
															$select .= " selected=\"selected\">".$val."</option>\n";
														} else {
															$select .= ">".$val."</option>\n";
														}
													}
													$select .= "</select>";
													echo $select;
												?>
												<select name="day">
													<?php 
														$dayselect = 01;
														
														while ($dayselect < $day) {
															echo "<option value='";
															echo $dayselect;
															echo "'>";
															echo $dayselect;
															echo "</option>";
															$dayselect++;
														}
														echo "<option value='";
														echo $dayselect;
														echo "' selected>";
														echo $dayselect;
														echo "</option>";
														$dayselect++;
														
														while ($dayselect <= $length) {
															echo "<option value='";
															echo $dayselect;
															echo "'>";
															echo $dayselect;
															echo "</option>";
															$dayselect++;
														}
													?>
												</select>
												<select name="hour">
													<?php 
														$timeselect = 0;
														
														while ($timeselect < $hour) {
															echo "<option value='";
															echo $timeselect;
															echo "'>";
															echo $timeselect;
															echo "</option>";
															$timeselect++;
														}
														echo "<option value='";
														echo $timeselect;
														echo "' selected>";
														echo $timeselect;
														echo "</option>";
														$timeselect++;
														
														while ($timeselect <= 23) {
															echo "<option value='";
															echo $timeselect;
															echo "'>";
															echo $timeselect;
															echo "</option>";
															$timeselect++;
														}
													?>
												</select>:00
											</div>
											<hr>
											<button type="reset" class="btn btn-danger">Reset</button>
											<button type="submit" class="btn btn-success">Submit</button>										
										</form>
										<br>
									</div>
									<div class="col-sm-6 standard">
										Image Uploader
									</div>				
								</div>
								<?php
								break;
								case 3: //Blog ?>
									<div class="row">
										<div class="col-sm-6 standard">
											<form role="form" name="content" enctype="multipart/form-data" action="./includes/addcontent.php" method="post">
												<div class="form-group">
													<hr>
													User ID: <?php echo $context['user']['id'];?>  |  Author: <?php echo $context['user']['name'];?>  |  Category: Blog
													<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
													<input type="hidden" name="user_name" value="<?php echo $context['user']['name'];?>">
													<input type="hidden" name="category" value="<?php echo $category;?>">
												</div>
												<hr>
												<div class="form-group">
													<p class="help-block">Headline (50 characters max)</p>
													<input type="text" class="form-control" maxlength="50" required name="headline">
													<p class="help-block">Intro/Summary (150 characters max)</p>
													<input type="text" class="form-control" maxlength="150" required name="summary">
													<hr>
													<p class="help-block">Main Story (Please use pagebreaks to split story into manageable sections if too long)</p>
													<script>var pageCount = 0;</script>
													<button type="button" class="btn btn-primary" onClick="boldText();"><b>Bold</b></button> <!-- Add <b></b> tags -->
													<button type="button" class="btn btn-primary" onClick="italicText();"><i>Italic</i></button> <!-- Add <i></i> tags -->
													<button type="button" class="btn btn-primary" onClick="lineText();">Line</button>
													<button type="button" class="btn btn-primary" onClick="headingText();"><i>Heading</i></button> <!-- Add heading tags -->
													<button type="button" class="btn btn-primary" onClick="linkText();">Link</button> <!-- Add a href -->
													<button type="button" class="btn btn-primary" onClick="videoText();">Video</button> <!-- add youtube window -->
													<button type="button" class="btn btn-primary" onClick="breakText();">Add Pages</button> <!-- ??? -->
													<textarea class="form-control" rows="8" required name="story"></textarea>											
												</div>
												<div class="form-group">
													Schedule release time (Leave as it is for immediate release)<br>
													<select name="year">
														<option value="<?php echo $year;?>"><?php echo $year;?></option>
														<option value="<?php echo $year+1;?>"><?php echo $year+1;?></option>
													</select>
													<?php
														$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
														$select = "<select name=\"month\">\n";
														foreach ($month as $key => $val) {
															$select .= "\t<option val=\"".$key."\"";
															if ($key == $curr_month) {
																$select .= " selected=\"selected\">".$val."</option>\n";
															} else {
																$select .= ">".$val."</option>\n";
															}
														}
														$select .= "</select>";
														echo $select;
													?>
													<select name="day">
														<?php 
															$dayselect = 01;
															
															while ($dayselect < $day) {
																echo "<option value='";
																echo $dayselect;
																echo "'>";
																echo $dayselect;
																echo "</option>";
																$dayselect++;
															}
															echo "<option value='";
															echo $dayselect;
															echo "' selected>";
															echo $dayselect;
															echo "</option>";
															$dayselect++;
															
															while ($dayselect <= $length) {
																echo "<option value='";
																echo $dayselect;
																echo "'>";
																echo $dayselect;
																echo "</option>";
																$dayselect++;
															}
														?>
													</select>
													<select name="hour">
														<?php 
															$timeselect = 0;
															
															while ($timeselect < $hour) {
																echo "<option value='";
																echo $timeselect;
																echo "'>";
																echo $timeselect;
																echo "</option>";
																$timeselect++;
															}
															echo "<option value='";
															echo $timeselect;
															echo "' selected>";
															echo $timeselect;
															echo "</option>";
															$timeselect++;
															
															while ($timeselect <= 23) {
																echo "<option value='";
																echo $timeselect;
																echo "'>";
																echo $timeselect;
																echo "</option>";
																$timeselect++;
															}
														?>
													</select>:00
												</div>
												<hr>
												<button type="reset" class="btn btn-danger">Reset</button>
												<button type="submit" class="btn btn-success">Submit</button>										
											</form>
											<br>
										</div>
										<div class="col-sm-6 standard padding">
											<!-- Call image uploader plugin -->
											<?php include ('./includes/image_uploader.php');?>
											<!-- Call image gallery plugin -->
											<?php include ('./includes/image_gallery.php');?>
										</div>				
									</div>
								<?php
								break;
								case 4: //Competitions
									echo "Competitions - COMING SOON";
								break;
								case 5: //Challenges
									echo "Challenges - COMING SOON";
								break;
								case 6: //Videos?>
									<div class="row">
										<div class="col-sm-6 standard">
											<form role="form" enctype="multipart/form-data" action="./includes/addcontent.php" method="post">
												<div class="form-group">
													<hr>
													User ID: <?php echo $context['user']['id'];?>  |  Author: <?php echo $context['user']['name'];?>  |  Category: Video
													<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
													<input type="hidden" name="user_name" value="<?php echo $context['user']['name'];?>">
													<input type="hidden" name="category" value="<?php echo $category;?>">
												</div>
												<hr>
												<div class="form-group">
													<p class="help-block">Video Title (Do not include episode or game - 50 characters max)</p>
													<input type="text" class="form-control" maxlength="50" required name="headline">
													<p class="help-block">Description (150 characters max)</p>
													<input type="text" class="form-control" maxlength="150" required name="summary">
													<p class="help-block">Video URL</p>
													<input type="text" class="form-control" required name="youtube">
													<p class="help-block">Video Category</p>
													<select class="form-control" required name="video_cat">
														<option value="1">Check Out</option>
														<option value="2">Story</option>
														<option value="3">Co-Op</option>
														<option value="4">Verus</option>
														<option value="5">Let's Play</option>
														<option value="6">Mix It Up</option>
														<option value="7">Highlights</option>
														<option value="8">Bonus</option>
													</select>
													<p class="help-block">Game</p>
													<select class="form-control" required name="game">
														<option value="new">New Game (add below)</option>
														<?php
															$game_name_set = mysqli_query($dbnews,"SELECT DISTINCT game FROM videos ORDER BY id ASC");
															while ($game_name = mysqli_fetch_array($game_name_set)){
																echo '<option value="'. $game_name['game'] .'">'. $game_name['game'] .'</option>';
															}													
														?>
													</select>
													<input type="text" class="form-control" name="newgame" placeholder="New Game">
													<p class="help-block">Episode</p>
													<input type="text" class="form-control" required name="episode">
													<p class="help-block">Series</p>
													<input type="text" class="form-control" required name="series">
												</div>
												<div class="form-group">
													Schedule release time (Leave as it is for immediate release)<br>
													<select name="year">
														<option value="<?php echo $year;?>"><?php echo $year;?></option>
														<option value="<?php echo $year+1;?>"><?php echo $year+1;?></option>
													</select>
													<?php
														$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
														$select = "<select name=\"month\">\n";
															foreach ($month as $key => $val) {
															$select .= "\t<option val=\"".$key."\"";
															if ($key == $curr_month) {
															$select .= " selected=\"selected\">".$val."</option>\n";
															} else {
															$select .= ">".$val."</option>\n";
															}
															}
														$select .= "</select>";
														echo $select;
													?>
													<select name="day">
														<?php 
															$dayselect = 01;
															
															while ($dayselect < $day) {
																echo "<option value='";
																echo $dayselect;
																echo "'>";
																echo $dayselect;
																echo "</option>";
																$dayselect++;
															}
															echo "<option value='";
															echo $dayselect;
															echo "' selected>";
															echo $dayselect;
															echo "</option>";
															$dayselect++;
															
															while ($dayselect <= $length) {
																echo "<option value='";
																echo $dayselect;
																echo "'>";
																echo $dayselect;
																echo "</option>";
																$dayselect++;
															}
														?>
													</select>
													<select name="hour">
														<?php 
															$timeselect = 0;
															
															while ($timeselect < $hour) {
																echo "<option value='";
																echo $timeselect;
																echo "'>";
																echo $timeselect;
																echo "</option>";
																$timeselect++;
															}
															echo "<option value='";
															echo $timeselect;
															echo "' selected>";
															echo $timeselect;
															echo "</option>";
															$timeselect++;
															
															while ($timeselect <= 23) {
																echo "<option value='";
																echo $timeselect;
																echo "'>";
																echo $timeselect;
																echo "</option>";
																$timeselect++;
															}
														?>
													</select>:00
												</div>
												<hr>
												<button type="reset" class="btn btn-danger">Reset</button>
												<button type="submit" class="btn btn-success">Submit</button>										
											</form>
											<br>
										</div>										
									</div>
								<?php
								break;
							}
						?>
					</div>
				</div>
			</div>
			<div class="container-fluid" style="padding:0 5%;">
				<center><?php include "../includes/footer.php";?></center> <!--- Calls footer stuff-->
			</div>
		
	</body>
</html>