<?php ?>
	<!-- Image Uploader Plugin -->
	<div class="col-sm-12 padding" style="background:#9966cc;">
		<div style="font-size:14px;font-weight:bold;margin:5px 10px;">
			Upload an Image
		</div>
	</div>
	<div class="col-sm-12 padding" style="border-bottom:2px solid black;padding:5px;">
		<form role="form" name="img_upload" enctype="multipart/form-data" action="./includes/img_upload.php" method="post" target="blank" onsubmit="this.submit(); this.reset(); return false;">
			<div class="form-group">
				<input type="file" style="float:left;" name="newimage"><br>
				<input type="text" class="form-control" maxlength="100" required name="imgalt" placeholder="Alt-text (100 characters max)">
			</div>
			<div class="form-group">
				<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
				<input type="hidden" name="user_name" value="<?php echo $context['user']['name'];?>">
				Select a Category:   
				<select name="img_category">
					<option value="none">Uncategorised</option>
					<option value="thumbnail">Thumbnail</option>
					<option value="game">Game</option>
					<option value="tutorial">Tutorial</option>
					<option value="screenshot">Screenshot</option>
					<option value="photo">Photo</option>
					<option value="infographic">Infographic</option>
					<option value="comic">Comic</option>
				</select>
			</div>
			<div class="form-group">
				<button type="reset" class="btn btn-danger">Reset</button>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
<?php ?>