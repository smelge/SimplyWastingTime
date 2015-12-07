<?php
	//Check number of videos in each category for menu
	$datecheck = date("Y-m-d H:i:s");
	
	$vid_no_setup = mysqli_query($dbnews,"SELECT * FROM main");
	
	$vid_no_check = 0;
	$vid_no_story = 0;
	$vid_no_coop = 0;
	$vid_no_vs = 0;
	$vid_no_lp = 0;
	$vid_no_mix = 0;
	$vid_no_awesome = 0;
	$vid_no_bonus = 0;
	
	while ($vid_no = mysqli_fetch_array($vid_no_setup)){
		switch ($vid_no['vid_type']){
			case 'check':
				$vid_no_check++;
			break;
			case 'story':
				$vid_no_story++;
			break;
			case 'coop':
				$vid_no_coop++;
			break;
			case 'vs':
				$vid_no_vs++;
			break;
			case 'lp':
				$vid_no_lp++;
			break;
			case 'mix':
				$vid_no_mix++;
			break;
			case 'high':
				$vid_no_awesome++;
			break;
			case 'bonus':
				$vid_no_bonus++;
			break;
		}
	}
	
	$news_no_setup = mysqli_query ($dbnews,"SELECT * FROM news");
	
	$news_no_news = 0;
	$news_no_reviews = 0;
	$news_no_blog = 0;
	$news_no_comp = 0;
	$news_no_challenge = 0;
	
	while ($news_no = mysqli_fetch_array($news_no_setup)){
		switch ($news_no['category']){
			case 1:
				$news_no_news++;
				break;
			case 2:
				$news_no_reviews++;
				break;
			case 3:
				$news_no_blog++;
				break;
			case 4:
				$news_no_comp++;
				break;
			case 5:
				$news_no_challenge++;
				break;
		}
	}
?>