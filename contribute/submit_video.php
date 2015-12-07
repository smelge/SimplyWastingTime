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
			
			$address = filter_input(INPUT_POST, 'youtube-address', FILTER_SANITIZE_SPECIAL_CHARS);
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
	
	<body>
		<?php
			if ($context['user']['is_admin'] || $user_group == '9'){
				?>			
				<div class="container-fluid" id="main-container">
					<?php 
						include "./includes/contribute_header.php";
					?>
					<div class="row">
						<div class="col-sm-12 standard padding">
							<?php
								$youtube = explode("=",$address);
								$youtube = $youtube[1];
								$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$youtube."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU&part=snippet");
								$JSON_Data = json_decode($JSON,true);
								
								$publish = $JSON_Data['items']['0']['snippet']['publishedAt'];
								$title = $JSON_Data['items']['0']['snippet']['title'];
								$description = $JSON_Data['items']['0']['snippet']['description'];
								$thumbnail = $JSON_Data['items']['0']['snippet']['thumbnails']['standard']['url'];
								$tags = $JSON_Data['items']['0']['snippet']['tags'];
								foreach ($tags as $datatags){
									$tag_string = $tag_string.$datatags.';';
								}
							?>
							<div class="col-sm-12 section-title" style="border:2px solid black;">Check this is the correct video?</div>
							<div class="col-sm-12 standard padding" style="text-align:center;margin-bottom:10px;">
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $youtube;?>"></iframe>
								</div>
								<a class="btn btn-danger" style="margin:10px;" href="./submit.php?type=video">Click if this is the wrong video</a>
							</div>
							<form method="post" action="./includes/process_submission_video.php">
								<div class="col-sm-12 section-title" style="border:2px solid black;">Video Title</div>
								<div class="col-sm-12 standard padding">
									<input type="text" style="width:100%" name="title" placeholder="Stick your title here" value="<?php echo $title;?>" required>
								</div>
								<div class="col-sm-12 section-title" style="border:2px solid black;">Video Description</div>
								<div class="col-sm-12 standard padding">
									<textarea name="description" style="width:100%;height:150px;"><?php echo nl2br($description);?></textarea>
								</div>
								<div class="col-sm-3 section-title" style="border:2px solid black;">Thumbnail</div>
								<div class="col-sm-9 section-title" style="border:2px solid black;">Video Tags</div>
								<div class="col-sm-3 standard padding">
									<img class="img-responsive" src="<?php echo $thumbnail;?>" alt="<?php echo $title;?>"/>
								</div>
								<div class="col-sm-9 standard padding">
									<input type="text" style="width:100%" name="tags" placeholder="Stick your tags here" value="<?php echo $tag_string;?>" required>
								</div>
								<div class="col-sm-12 standard padding">
									Publishing: <?php echo $publish;?>
								</div>	
								<div class="col-sm-12 standard btn-group padding" style="background:black;">
									<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
									<input type="hidden" name="moderated" value="<?php echo $mod_check;?>">
									<button type="submit" class="btn btn-success" style="width:50%;border-radius:0;">Submit</button>
									<button type="reset" class="btn btn-danger" style="width:50%;border-radius:0;">Reset</button>					
								</div>
								
							</form>
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