<?php
require_once('db.php');

if(isset($_POST['User_ID'])) {
	$userid = trim($_POST['User_ID']);

	if (!empty($userid)) {
		$addedQuery = $db->prepare("
				INSERT INTO items (userid, description, status)
				VALUES (:User_ID, :Description, 0())
			");

		$addedQuery->execute([
			'userid' = $_SESSION['User_ID',
			'description' = $Description,

			]);
	}
}

?>