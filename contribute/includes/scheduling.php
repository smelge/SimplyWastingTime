<?php
	function getSuffix($dayselect){
		// return English ordinal number
		return $dayselect.substr(date('jS', mktime(0,0,0,1,($dayselect%10==0?9:($dayselect%100>20?$dayselect%10:$dayselect%100)),2000)),-2);
	}
	$current_year = date("Y");
	$max_year = $current_year + 1;
	$current_month = date("n");
	$current_day = date("d");
	$current_hour = date("G");
	$next_hour = $current_hour + 1;
	if ($current_hour >= 24){
		$next_hour = 0;
		$current_day = $current_day + 1;
	}
	echo '<div style="margin:0 auto;text-align:center;padding:10px;">';
		// Hour
		
		echo '<select name="hour">';
			$timeselect = 0;
			
			while ($timeselect < $current_hour) {
				echo '<option value="'.$timeselect.'">'.$timeselect.':00</option>';
				$timeselect++;
			}
			echo '<option value="'.$timeselect.'" selected>'.$timeselect.':00</option>';
			$timeselect++;
			
			while ($timeselect <= 23) {
				echo '<option value="'.$timeselect.'">'.$timeselect.':00</option>';
				$timeselect++;
			}
		echo '</select>';

		// Day
		echo '<select name="day">';
			$dayselect = '1';
			$month_length = date("t");
			
			while ($dayselect < $current_day) {
				echo '<option value="'.$dayselect.'">'.getSuffix($dayselect).'</option>';
				$dayselect++;
			}
			echo '<option value="'.$dayselect.'" selected>'.getSuffix($dayselect).'</option>';
			$dayselect++;
				
			while ($dayselect <= $month_length) {
				echo '<option value="'.$dayselect.'">'.getSuffix($dayselect).'</option>';
				$dayselect++;
			}
		echo '</select>';
		// Month
		$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		echo '<select name="month">';
		foreach ($month as $key => $val) {
			if ($key == $current_month) {
				echo '<option value="'.$key.'" selected>'.$val.'</option>';
			} else {
				echo '<option value="'.$key.'">'.$val.'</option>';
			}
		}
		echo '</select>';
		// Year		
		echo '<select name="year">';
			echo '<option value="'.$current_year.'">'.$current_year.'</option>';
			echo '<option value="'.$max_year.'">'.$max_year.'</option>';
		echo '</select>';
	echo '</div>';	

	$cont_id = $context['user']['id'];
	$modcheck_set = mysqli_query($dbnews,"SELECT * FROM `contributor` WHERE `user_id` = '$cont_id'");
	$modcheck = mysqli_fetch_array($modcheck_set);
		
	if (!$context['user']['is_admin']){
		$mod_check = 1;
		echo '<div class="col-sm-12 bg-warning" style="text-align:center;font-weight:bold;padding:10px;border-top:1px solid black;">';
			echo "Notice: Submitted content requires a review before going Live on the site. 
			We will try to review your content before the required release time, though this can take up to 24hrs.<br><br>";
		echo '</div>';
	} else {
		$mod_check = 0;
		echo '<div class="col-sm-12 bg-success" style="text-align:center;font-weight:bold;padding:10px;border-top:1px solid black;">';
			echo "You have been verified. There is no need for content verification";
		echo '</div>';
	}
?>