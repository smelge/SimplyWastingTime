<?php
	$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$content['youtube']."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU&part=snippet,statistics");
	$JSON_Data = json_decode($JSON,true);
	$thumb = $JSON_Data['items']['0']['snippet']['thumbnails']['default']['url'];
	$icon_alt = $JSON_Data['items']['0']['snippet']['title'];
	
	if ($content['release'] <= $date){
		echo '<div class="row" style="padding-bottom:0;">';
			echo '<div class="col-sm-12 padding" style="margin-bottom:-5px;">';	
				echo '<a href="./watch.php?id='. $content['id'] .'" style="text-decoration:none;">';
					echo '<div class="alert alert-info newsfeed-item" role="alert">';
						echo '<div class="media">';
							echo '<div class="media-left">';
								echo '<img src="'.$thumb.'" alt="'.$icon_alt.'">';
							echo '</div>';			
							echo '<div class="media-body" style="color:black;">';
								echo '<h4 class="media-heading">'. $content['game'] .' Ep.'. $content['episode'] .' : '. $content['title'] .'</h4>';
								echo '<hr style="margin:5px;border: 1px dashed black;">';
								echo $content['intro'];
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
		echo '</div>';
	}
?>