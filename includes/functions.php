<?php
	$page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
	
	switch ($page){
		case 'watch':
			$game = filter_input(INPUT_POST, 'game', FILTER_SANITIZE_SPECIAL_CHARS);
			header('Location: ../watch.php?game='.$game);
			break;
	}	
?>

