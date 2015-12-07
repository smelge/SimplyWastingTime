<div class="modal fade" id="changedateModal" tabindex="-1" role="dialog" aria-labelledby="changedateModalLabel">
	<div class="modal-dialog" role="document">
		<form method="post" action="./includes/article_edit_process.php?type=date">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="changedateModalLabel">Change Release Date</h4>
				</div>
				<div class="modal-body">
					<?php include('./includes/edit_date.php');?>
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
				</div>
				<div class="modal-footer">					
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel">
	<div class="modal-dialog" role="document">
		<form method="post" action="./includes/article_edit_process.php?type=cat">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="categoryModalLabel">Change Article category</h4>
				</div>
				<div class="modal-body">
					<select name="category">
						<option value="1" <?php if($edit['category'] == 1){echo 'selected';}?>>News</option>
						<option value="2" <?php if($edit['category'] == 2){echo 'selected';}?>>Review</option>
						<option value="3" <?php if($edit['category'] == 3){echo 'selected';}?>>Blog</option>
						<option value="4" <?php if($edit['category'] == 4){echo 'selected';}?>>Competition</option>
						<option value="5" <?php if($edit['category'] == 5){echo 'selected';}?>>Challenge</option>
					</select>
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
	<div class="modal-dialog" role="document">
		<form method="post" action="./includes/article_edit_process.php?type=delete">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="deleteModalLabel">Delete Article</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<button type="submit" class="btn btn-danger">Kill it</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<a class="btn btn-success btn-lg btn-block" href="./articles.php" role="button">Back to Article Overview</a>
<hr class='arthead'>
<a class="btn btn-info btn-lg btn-block" disabled="disabled" href="#" role="button">Edit Article Content</a>
<?php
	if ($edit['release'] >= $date){		
		echo '<a class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#changedateModal" role="button">Change Release Date</a>';
	}
?>	
<a class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#categoryModal" role="button">Change Article Category</a>
<a class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#deleteModal" role="button">Delete Article</a>