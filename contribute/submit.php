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
			$user_group = $user_info['groups'];
			$user_group = $user_group[0];
			
			$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
		?>
		<script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",
				plugins: [
				"autolink lists link image charmap anchor media",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime table contextmenu paste hr"
				],
				menubar: "edit insert view format table",
				theme_advanced_buttons1 : "imgmanager",
				toolbar: "undo redo | styleselect | bold italic underline strikethrough subscript superscript| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent blockquote | table | hr"
			});
			
			// Prevent bootstrap dialog from blocking focusin
			$(document).on('focusin', function(e) {
				if ($(e.target).closest(".mce-window").length) {
					e.stopImmediatePropagation();
				}
			});
		</script>
	</head>
	<!--
		Add content for
			- News (type = news)
			- Reviews (type = review)
			- Blogatronic (type = blog)
			- Videos (type = video)	
	-->
	
	<body>
		<?php
			if ($context['user']['is_admin'] || $user_group == '9'){
				?>			
				<div class="container-fluid" id="main-container">
					<?php 
						include "./includes/contribute_header.php";
// NEWS SECTION ///////////////////////////////////////////////////////////////////////////////////////////////////////////					
						if ($type == 'news'){
							?>
							<div class="row" style="margin-bottom:5px;">
								<div class="col-sm-7 padding" style="padding-right:10px;">
									<form method="post" action="./includes/process_submission_article.php">
										<div class="col-sm-12 padding">
											<div class="col-sm-12 section-title">Give it a title</div>
											<div class="col-sm-12 standard padding">
												<input type="text" style="width:100%" name="article-title" placeholder="Stick your title here" required>
											</div>
											<div class="col-sm-12 standard padding">
												<textarea name="content" style="width:100%;height:400px;"></textarea>
											</div>
											<div class="col-sm-12 standard padding">
												<div class="col-sm-12 section-title"style="margin-bottom:10px;">Schedule that thing</div>										
												<?php include ('./includes/scheduling.php');?>
											</div>
											<div class="col-sm-12 standard btn-group padding" style="background:black;">
												<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
												<input type="hidden" name="moderated" value="<?php echo $mod_check;?>">
												<button type="submit" class="btn btn-success" style="width:50%;border-radius:0;">Submit</button>
												<button type="reset" class="btn btn-danger" style="width:50%;border-radius:0;">Reset</button>					
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-5 standard padding">
									<div class="col-sm-12 section-title">
										Image Uploader
									</div>
									<?php include_once ('./includes/image_uploader.php');?>
									<div class="col-sm-12 section-title">
										Quick Gallery - Reload page to view new images
									</div>
									<?php include_once ('./includes/quick_gallery.php');?>
									<div class="col-sm-12 padding" style="text-align:center;">
										<a class="btn btn-info" style="width:100%;border-radius:0;" href="#">Open Gallery</a>
									</div>			
								</div>
							</div>
							<?php
						} elseif ($type == 'review'){
// REVIEW SECTION ///////////////////////////////////////////////////////////////////////////////////////////////////////////					
							echo '<div class="row" style="margin-bottom:5px;">';
								echo '<div class="col-sm-12 standard">';
									echo 'Reviews Coming Soon';
								echo '</div>';
							echo '</div>';
						} elseif ($type == 'blog'){
// BLOG SECTION ///////////////////////////////////////////////////////////////////////////////////////////////////////////					
							echo '<div class="row" style="margin-bottom:5px;">';
								echo '<div class="col-sm-12 standard">';
									echo 'Blogs coming soon';
								echo '</div>';
							echo '</div>';
						} elseif ($type == 'video'){							
// VIDEO SECTION ///////////////////////////////////////////////////////////////////////////////////////////////////////////	
							?>
							<div class="row" style="margin-bottom:5px;">
								<div class="col-sm-12 standard padding">
									<form method="post" action="./submit_video.php">
										<div class="col-sm-12 padding">
											<div class="col-sm-12 section-title">Enter video Address</div>
											<div class="col-sm-12 standard padding">
												<input type="text" style="width:100%" name="youtube-address" placeholder="e.g. https://www.youtube.com/watch?v=7ecYoSvGO60" required>
											</div>
																						
											<div class="col-sm-12 standard btn-group padding" style="background:black;">
												<button type="submit" class="btn btn-success" style="width:50%;border-radius:0;">Submit</button>
												<button type="reset" class="btn btn-danger" style="width:50%;border-radius:0;">Reset</button>					
											</div>
										</div>
									</form>								
								</div>
							</div>
							<?php
						} else {
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
							echo '<div class="row" style="margin-bottom:5px;">';
								echo '<div class="col-sm-12 standard">';
									echo 'No idea what you did there';
								echo '</div>';
							echo '</div>';
						}
					?>
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