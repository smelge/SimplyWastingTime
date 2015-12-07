<?php	
	$background = filter_input(INPUT_POST, 'bg', FILTER_SANITIZE_SPECIAL_CHARS);
	$main = filter_input(INPUT_POST, 'main', FILTER_SANITIZE_SPECIAL_CHARS);
	$content = filter_input(INPUT_POST, 'cont', FILTER_SANITIZE_SPECIAL_CHARS);
	
	header('Location: ../streaming.php?channel=simplywastingtime&bg='.$background.'&main='.$main.'&content='.$content);
?>