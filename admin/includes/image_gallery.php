<?php 
	$gallery_set = mysqli_query($dbnews,"SELECT * FROM swt_images ORDER BY id");	
?>
	<!-- Image Gallery Plugin -->
	<div class="col-sm-12 padding" style="background:#9966cc;">
		<div style="font-size:14px;font-weight:bold;margin:5px 10px;">
			Quick Gallery
		</div>
	</div>
	<div class="col-sm-12 padding" style="border-bottom:2px solid black;padding:2px;">
		<?php
			while ($gallery = mysqli_fetch_array($gallery_set)){
				$name_set = (explode(".",$gallery['img_path']));
				$name = $name_set[0] . $gallery['img_size'];
				$path = $gallery["img_path"];
				$alt = $gallery['img_alt'];
				
				echo '<a style="cursor:pointer;" data-toggle="modal" data-target="#'. $name .'">';	
					echo '<img style="max-height:120px;display:inline-block;margin:2px;" class="img-responsive" src="../assets/uploaded/'. $gallery['img_path'] .'" alt="'. $gallery['img_alt'] .'"/>';
				echo '</a>';
				//Modal Setup
		?>		
			<!-- Modal -->
				<div class="modal fade bs-example-modal-lg" id="<?php echo $name;?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body" style="text-align:center;">
								<img src="../assets/uploaded/<?php echo $gallery['img_path'];?>" alt="<?php echo $gallery['img_alt'];?>"><br>
								<hr class="arthead">
								Category: <?php echo $gallery['img_category'];?><br>
								Image Size: <?php echo round(($gallery['img_size'])/1000,2);?>kb<br>
								Dimensions: 
								<?php
									$fullpath = "../assets/uploaded/". $gallery['img_path'];
									list($width, $height, $type, $attr) = getimagesize($fullpath);
									echo $attr;
								?>
								<br>
								<hr class="arthead">
								<span style="font-size:11px;">
									Left: <?php echo "&lt;img class='img-left' src='./assets/uploaded/". $path ."' alt='". $alt ."'>";?><br>
									Centre: <?php echo "&lt;div class='col-sm-12 img-centre'>&lt;img src='./assets/uploaded/". $path ."' alt='". $alt ."'>&lt;/div>";?><br>
									Right: <?php echo "&lt;img class='img-right' src='./assets/uploaded/". $path ."' alt='". $alt ."'>";?><br>
								</span>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
		<?php
			}
		?>
	</div>
	<div class="col-sm-12 padding" style="background:black;">
		<a disabled="disabled" class="btn btn-primary btn-lg btn-block" href="#" role="button">Open Full Gallery</a>
	</div>
<?php ?>