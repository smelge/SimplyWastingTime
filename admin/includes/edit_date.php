<?php
	$timestamp = $edit['release'];
	$timestamp = explode("-",$timestamp);
	
	$current_year = date("Y");
	$edit_year = $timestamp[0];
	$edit_month = $timestamp[1];

	$daystamp = explode(" ",$timestamp[2]);
	$hourstamp = explode(":",$daystamp[1]);
	
	
	$edit_day = $daystamp[0];
	$edit_hour = $hourstamp[0];
	
	function getSuffix($dayselect){
		// return English ordinal number
		return $dayselect.substr(date('jS', mktime(0,0,0,1,($dayselect%10==0?9:($dayselect%100>20?$dayselect%10:$dayselect%100)),2000)),-2);
	}	
	
	$max_year = $edit_year + 1;
	$next_hour = $edit_hour + 1;
	if ($edit_hour >= 24){
		$next_hour = 0;
		$edit_day = $edit_day + 1;
	}
	echo '<div style="margin:0 auto;text-align:center;padding:10px;">';
		// Hour
		
		echo '<select name="hour">';
			$timeselect = 0;
			
			while ($timeselect < $edit_hour) {
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
			
			while ($dayselect < $edit_day) {
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
			if ($key == $edit_month) {
				echo '<option value="'.$key.'" selected>'.$val.'</option>';
			} else {
				echo '<option value="'.$key.'">'.$val.'</option>';
			}
		}
		echo '</select>';
		// Year		
		echo '<select name="year">';
			echo '<option value="'.$current_year.'">'.$current_year.'</option>';
			echo '<option value="'.$edit_year.'">'.$edit_year.'</option>';
			echo '<option value="'.$max_year.'">'.$max_year.'</option>';
		echo '</select>';
	echo '</div>';
?>