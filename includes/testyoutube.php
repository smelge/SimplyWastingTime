<?php
	$youtube = 'simplywastingtime';
	$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=id&forUsername=".$youtube."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU");
	$JSON_Data = json_decode($JSON,true);
	$youtube_id = $JSON_Data['items']['0']['id'];
	
	print_r($JSON_Data);
?>