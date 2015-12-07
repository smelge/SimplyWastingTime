<div class="col-sm-12 notice">
	<div class="notice-head">
		Announcements
	</div>
	<div class="announcement-body">
		<?php
			$announce_set = mysqli_query($dbnews,"SELECT * FROM `admin_announcements` WHERE `status` = '1' AND `admin_only` = 0 ORDER BY `id` DESC LIMIT 10");
			while ($announce = mysqli_fetch_array($announce_set)){
				echo '<div class="notice-item">';
					echo nl2br($announce['notice']);
				echo '</div>';
			}
		?>
	</div>
</div>