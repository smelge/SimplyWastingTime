<div class="col-sm-12 standard">
	<?php
		$gallery_set = mysqli_query($dbnews,"SELECT * FROM `swt_images` ORDER BY `id` DESC LIMIT 10");
		while($gallery = mysqli_fetch_array($gallery_set)){
			// Modal Setup
			echo '<div class="modal fade" id="Modal'.$gallery['id'].'" tabindex="-1" role="dialog" aria-labelledby="Modal'.$gallery['id'].'Label">';
				echo '<div class="modal-dialog" role="document">';
					echo '<div class="modal-content">';
						echo '<div class="modal-header">';
							echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
							echo '<h4 class="modal-title" id="Modal'.$gallery['id'].'Label">'.$gallery['img_alt'].'</h4>';
						echo '</div>';
						echo '<div class="modal-body">';							
							echo '<div class="row" style="border-bottom:2px solid black;">';
								echo '<div class="col-sm-12">';
									echo '<img class="img-responsive" src="../assets/uploaded/'.$gallery['img_path'].'" alt="'.$gallery['img_alt'].'"/>';
								echo '</div>';
							echo '</div>';
							echo '<div class="row" style="text-align:center;border-bottom:2px solid black;">';
								echo '<div class="col-sm-4">';
									list($width, $height) = getimagesize('../assets/uploaded/'.$gallery['img_path']);
									echo 'Dimensions: '.$width.' x '.$height;
								echo '</div>';
								echo '<div class="col-sm-4">';
									echo 'Size: '. round(($gallery['img_size'])/1024,2) .'kb';
								echo '</div>';
								echo '<div class="col-sm-4">';
									echo 'Author: '.$gallery['user_name'];
								echo '</div>';
							echo '</div>';
							echo '<div class="row" style="border-bottom:2px solid black;">';
								echo '<div class="col-sm-12">';
									echo 'Drag and drop the image from the gallery into the text editor.';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="modal-footer">';
							echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			// Display Image
			echo '<a class="modal-trigger" data-toggle="modal" data-target="#Modal'.$gallery['id'].'">';	
				echo '<div class="col-sm-4" style="padding:5px;">';
					echo '<img src="../assets/uploaded/'.$gallery['img_path'].'" alt="'.$gallery['img_alt'].'" class="img-responsive" style="border:2px solid black;border-radius:10px;"/>';
				echo '</div>';
			echo '</a>';
		}
	?>
</div>