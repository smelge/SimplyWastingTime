<div class="col-sm-4 standard" id="votebox" style="padding-bottom:10px;">
	<center>
		<h3 style="margin:5px;">Rating</h3>
	</center>
	<?php
		$votebox_setup = mysqli_query($dbnews, "SELECT * FROM main WHERE id = $content_id");
		$votebox = mysqli_fetch_array($votebox_setup);
		
		
		if ($context['user']['is_guest']){
			echo "<div class='col-xs-12'>";
				echo "<center>";
					echo "<h1 style='margin:10px;'>".$votebox['rating']."</h1>";
				echo "</center>";
			echo "</div>";
			echo "<div class='col-xs-12'>";
				echo "<center>";
					echo "Want to Rate this article? Either Sign In or Register above to join in!";
				echo "</center>";
			echo "</div>";
		} else {
			//Check if user has already voted on this page
				$voted_string = $votebox['voted'];
				$voted_array = explode(";",$voted_string);
				$voted_array_length = count($voted_array) - 1;
				
				$vote_loop = 0;
				
				while($vote_loop < $voted_array_length){
					if ($voted_array[$vote_loop] == $context['user']['id']){
						$voted = 1;
					}
					$vote_loop++;
				}
				if ($voted == 1){
					// User has already voted
					echo "<div class='col-xs-4'>";
						echo "<center><i data-toggle='tooltip' data-placement='top' title='You have already voted!' class='fa fa-minus-square fa-5x voted'></i></center>";						
					echo "</div>";
					echo "<div class='col-xs-4'>";
						echo "<center><h1 style='margin:10px;'>".$votebox['rating']."</h1></center>";
					echo "</div>";
					echo "<div class='col-xs-4'>";
						echo "<center><i data-toggle='tooltip' data-placement='top' title='You have already voted!' class='fa fa-plus-square fa-5x voted'></i></center>";
					echo "</div>";
				} else {
					// User has not yet voted
					echo "<div class='col-xs-4'>";
						echo "<center><a href='./includes/article_vote.php?v=minus&i=".$context['user']['id']."&d=".$votebox['id']."' class='minusvote'><i class='fa fa-minus-square fa-5x'></i></a></center>";
					echo "</div>";
					echo "<div class='col-xs-4'>";
						echo "<center><h1 style='margin:10px;'>".$votebox['rating']."</h1></center>";
					echo "</div>";
					echo "<div class='col-xs-4'>";
						echo "<center><a href='./includes/article_vote.php?v=plus&i=".$context['user']['id']."&d=".$votebox['id']."' class='plusvote'><i class='fa fa-plus-square fa-5x'></i></a></center>";						
					echo "</div>";
				}	
		}
	?>
</div>
<div class="col-sm-4 standard" style="padding:0;">
	<div class="col-sm-12" style="border-bottom: 2px solid black;padding:10px;">
		<center><b>Other Articles you may enjoy...</b></center>
	</div>
	<?php
		$other_set = mysqli_query($dbnews,"SELECT * FROM main WHERE id <> $content_id AND `category` <> 6 ORDER BY rating DESC LIMIT 0,2");
		while ($other = mysqli_fetch_array($other_set)){
			echo "<a href='./news.php?id=".$other['id']."'>";	
				echo "<div class='col-sm-12 linkover' style='border-bottom:2px solid black;padding:10px;'>";
					echo "<center>";
						echo $other['title'];
					echo "</center>";
				echo "</div>";
			echo "</a>";
		}
	?>
	<div class="col-sm-12" style="border-bottom: 2px solid black;border-top:2px solid black;padding:10px;">
		<center><b>Videos you may enjoy...</b></center>
	</div>
	<?php
		$top_video_set = mysqli_query($dbnews,"SELECT * FROM main WHERE `category` = 6 ORDER BY views DESC LIMIT 0,3");
		while ($top_video = mysqli_fetch_array($top_video_set)){
			echo "<a href='./watch.php?id=".$top_video['id']."'>";	
				echo "<div class='col-sm-12 linkover' style='border-bottom:2px solid black;padding:10px;'>";
					echo "<center>";
						echo $top_video['game']." Ep.".$top_video['episode']." - ".$top_video['title'];
					echo "</center>";
				echo "</div>";
			echo "</a>";
		}
	?>
</div>
<!--
<div class="col-sm-4 standard">
	Ads<br>
	<ul>
		<li>Ad 1</li>
		<li>Ad 2</li>
		<li>Ad 3</li>
	</ul>
</div>
-->