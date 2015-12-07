<?php
	// Admin Notices section for dashboard
?>

<div class="col-sm-12 notice">
	<div class="notice-head">
		Announcements
	</div>
	<div class="announcement-body">
		<?php
			$announce_set = mysqli_query($dbadmin,"SELECT * FROM `admin_announcements` WHERE `status` = '1' ORDER BY `id` DESC");
			while ($announce = mysqli_fetch_array($announce_set)){
				echo '<div class="notice-item">';
					echo nl2br($announce['notice']);
					echo '<a type="button" class="close" href="./includes/process_notice.php?type=announce&id='.$announce['id'].'"><span aria-hidden="true">&times;</span></a>';
				echo '</div>';
			}
		?>
	</div>
</div>
<div class="col-sm-12" style="padding:0;">
	<div class="col-sm-6 notice">
		<div class="notice-head">
			To Do
		</div>
		<div class="notice-body">
			<?php
				$announce_set = mysqli_query($dbadmin,"SELECT * FROM `admin_announcements` WHERE `status` = '3' ORDER BY `id` ASC");
				while ($announce = mysqli_fetch_array($announce_set)){
					echo '<div class="notice-item">';
						echo nl2br($announce['notice']);
						echo '<a type="button" class="close" href="./includes/process_notice.php?type=todo&id='.$announce['id'].'"><span aria-hidden="true">&times;</span></a>';
					echo '</div>';
				}
			?>
		</div>
	</div>
	<div class="col-sm-6 notice">
		<div class="notice-head">
			Completed
		</div>
		<div class="notice-body">
			<?php
				$announce_set = mysqli_query($dbadmin,"SELECT * FROM `admin_announcements` WHERE `status` = '4' ORDER BY `updated` DESC");
				while ($announce = mysqli_fetch_array($announce_set)){
					echo '<div class="notice-item">';
						echo nl2br($announce['notice']);
						echo '<a type="button" class="close" href="./includes/process_notice.php?type=complete&id='.$announce['id'].'"><span aria-hidden="true">&times;</span></a>';
					echo '</div>';
				}
			?>
		</div>
	</div>
</div>
<div class="col-sm-12 notice">
	<div class="notice-head">
		Add Items
	</div>
	<form role="form" name="announce" enctype="multipart/form-data" action="./includes/process_notice.php" method="post">
		<div class="row" style="text-align:center;">
			<div class="col-sm-4">
				<input type="radio" name="shout" value="admin" checked>Admin-only Announcement
			</div>
			<div class="col-sm-4">
				<input type="radio" name="shout" value="announce" checked>Announcement
			</div>
			<div class="col-sm-4">
				<input type="radio" name="shout" value="todo" checked>To-Do
			</div>
		</div>
		<textarea class="form-control" rows="8" required name="input"></textarea>
		<input type="hidden" name="user_id" value="<?php echo $context['user']['id'];?>">
		<br>
		<input type="submit" value="Submit">
		<input type="reset" value="Reset">
	</form>
</div>

