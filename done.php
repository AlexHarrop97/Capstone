<?php 
require_once("db.php");

if(isset($_GET['as'], $_GET['item'])) {
	$as = $_GET['as'];
	$item = $_GET['item'];

	switch ($as) {
		case 'done':
			$doneQuery = $db->prepare("
				UPDATE items
				SET status = 1
				WHERE id = :item
				AND user= :user
				");
			break;

			$doneQuery->execute([
				'item' => $item, 
				'user' => $_SESSION['User_ID']
			]);
		break;
	}
}

header('Location: todo.php');


?>