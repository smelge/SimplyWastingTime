<div class="col-sm-4 standard padding" style="background:#<?php echo $hex_content;?>;">
	<div class="row">
		<div class="col-sm-12">
			<div class="playlist-title">
				Playlists
			</div>
		</div>
	</div>
	<?php
		//get youtube playlist
		$JSON_PLAYLIST = file_get_contents("https://www.googleapis.com/youtube/v3/playlists?channelId=".$icons['youtube_id']."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU&maxResults=5&part=snippet");
		$JSON_PLAYLIST_Data = JSON_decode($JSON_PLAYLIST,true);
		
		for($playlist_loop = 0;$playlist_loop <= 4;$playlist_loop++){
			$play_title = $JSON_PLAYLIST_Data['items'][$playlist_loop]['snippet']['title'];
			$play_id = $JSON_PLAYLIST_Data['items'][$playlist_loop]['id'];
			$play_thumb = $JSON_PLAYLIST_Data['items'][$playlist_loop]['snippet']['thumbnails']['default']['url'];
			
			echo '<div class="col-sm-12 playlist-segment">';
				echo '<a class="playlist" href="https://www.youtube.com/playlist?list='.$play_id.'">';
					echo '<div class="row playlist-item">';
						echo '<div class="col-sm-3 playlist-image">';
							echo '<img class="img-responsive" src="'.$play_thumb.'" alt="'.$play_title.'"/>';
						echo '</div>';
						echo '<div class="col-sm-9 playlist-name">';
							echo $play_title;
						echo '</div>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
		}	
	?>
</div>
<div class="col-sm-4 standard padding" style="background:#<?php echo $hex_content;?>;">
	<div class="playlist-title">
		5 Latest Videos
	</div>
	<?php
		$JSON_VIDEO = file_get_contents("https://www.googleapis.com/youtube/v3/search?channelId=".$icons['youtube_id']."&key=AIzaSyAwhdYiGmLOj-Bk5XTHj3aLi1E8eaQOeOU&maxResults=5&part=snippet,id&order=date");
		$JSON_VIDEO_Data = JSON_decode($JSON_VIDEO,true);
		
		for($videolist_loop = 0;$videolist_loop <= 4;$videolist_loop++){
			$video_title = $JSON_VIDEO_Data['items'][$videolist_loop]['snippet']['title'];
			$video_id = $JSON_VIDEO_Data['items'][$videolist_loop]['id']['videoId'];
			$video_thumb = $JSON_VIDEO_Data['items'][$videolist_loop]['snippet']['thumbnails']['default']['url'];
			
			echo '<div class="col-sm-12 playlist-segment">';
				echo '<a href="https://www.youtube.com/playlist?list='.$video_id.'">';
					echo '<div class="row playlist-item">';
						echo '<div class="col-sm-3 playlist-image">';
							echo '<img class="img-responsive" src="'.$video_thumb.'" alt="'.$video_title.'"/>';
						echo '</div>';
						echo '<div class="col-sm-9 playlist-name">';
							echo $video_title;
						echo '</div>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
		}
	?>	
</div>