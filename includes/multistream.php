<?php
	// Multistream Setup
	$multicount = 0;
	if(isset($_POST['multi'])){
		foreach($_POST['multi'] as $streamer){
			$multistream = $multistream.$streamer.'/';
			$multicount++;
		}
	}
	if ($multicount != 0){
		header('Location: http://www.multitwitch.tv/'.$multistream);
	} else {
		echo 'Error! Select some of those streamers to work MultiStream. Duh.';
	}
?>