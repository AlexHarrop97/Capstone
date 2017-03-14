<?php
require_once('dependencies/db.php');
require_once('todo.php');

$getUser = $db->prepare("SELECT * FROM users");
$getUser->execute();
$users = $getUser->fetchAll();

foreach($users as $user) {

	if ($user["Email"] == $_SESSION["User"]) {

		$userId = $user["User_ID"];
	}
	
}


if(isset($_POST['User_ID'])) {
	$userid = trim($_POST['User_ID']);

	if (!empty($userid)) {
		$addedQuery = $db->prepare("
				INSERT INTO todo(User_ID, Project_ID, Description, Status)
				VALUES (:uID, pID, :descr, :stat)
			");
		$addedQuery->bindparam(':uID', $userId);
		$addedQuery->bindparam('pID', '001');
		$addedQuery->bindparam(':descr', $Description);
		$addedQuery->bindparam(':stat', '0');

		$addedQuery->execute();
	}
}
header('Location: todo.php');

?>